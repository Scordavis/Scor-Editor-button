<?php
/**
 * Этот файл можно использовать автономно в темах, для создания миниатюр. 
 * Для этого нужно установить настройки в переменную $GLOBALS['kt_opt']
 * version 2.0
 */

// single unstall or in WP environment?
define('IS_KT_WPENV', !! class_exists('Kama_Thumbnail') );

if( ! IS_KT_WPENV ){
	## опции по умолчанию, если класс используется отдельно
	$GLOBALS['kt_opt'] = (object) array(
		// Путь до папки кэша. По умолчанию - server/.../wp-content/cache/thumb.
		'cache_folder'     => wp_normalize_path( WP_CONTENT_DIR . '/cache/thumb'),
		// УРЛ папки кэша. По умолчанию - .../wp-content/cache/thumb
		'cache_folder_url' => content_url() .'/cache/thumb',
		// УРЛ картинки заглушки. По умолчанию - картинка no_photo.png, которая лежит рядом с этим файлом
		'no_photo_url'     => str_replace( get_template_directory(), get_template_directory_uri(), wp_normalize_path(dirname(__FILE__)) ) .'/images/no-photo.jpg',
		// Название произвольного поля
		'meta_key'         => 'photo_URL',
		// Доп. хосты с которых можно создавать мини-ры. Пр.: array('special.ru', 'files.site.ru'). Если указать array('any'), то будут доступны любые хосты.
		'allow_hosts'      => array(),
		// качество сжатия jpg
		'quality'          => 80,
		// не выводить картинку-заглушку
		'no_stub'          => false,
	);
}


/** 
 * Функции обертки для темы/плагина
 *
 * Аргументы: src, post_id, w/width, h/height, q, alt, class, title, no_stub, notcrop.
 * Если не определяется src и переменная $post определяется неправилно, то определяем параметр
 * post_id - идентификатор поста, чтобы правильно получить произвольное поле с картинкой.
 */
## вернет только ссылку
function kama_thumb_src( $args = '', $src = '' ){
	$kt = new Kama_Make_Thumb( $args, $src );
	return $kt->src();
}

## вернет картинку (готовый тег img)
function kama_thumb_img( $args = '', $src = '' ){
	$kt = new Kama_Make_Thumb( $args, $src );
	return $kt->img();
}

## вернет ссылку-картинку
function kama_thumb_a_img( $args = '', $src = '' ){
	$kt = new Kama_Make_Thumb( $args, $src );
	return $kt->a_img();
}


class Kama_Make_Thumb {
	public $src;
	public $width;
	public $height;
	public $notcrop;
	public $quality;
	public $post_id;
	public $no_stub;
	
	public $args;
	public $opt;	
	
	function __construct( $args = array(), $src = '' ){
		$this->opt = IS_KT_WPENV ? Kama_Thumbnail::$opt : $GLOBALS['kt_opt'];
		$this->opt->allow_hosts[] = self::parse_main_dom( $_SERVER['HTTP_HOST'] ); // add current main domain
		
		$this->set_args( $args, $src );
	}
	
	## Берем ссылку на картинку из произвольного поля, или из текста, создаем произвольное поле.
	## Если в тексте нет картинки, ставим заглушку no_photo
	function get_src_and_set_postmeta(){
		global $post, $wpdb;
		
		$post_id = (int) ( $this->post_id ? $this->post_id : $post->ID );

		if( $src = get_post_meta( $post_id, $this->opt->meta_key, true ) )
			return $src;

		// проверяем наличие стандартной миниатюры
		if( $_thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true ) )
			$src = wp_get_attachment_url( (int) $_thumbnail_id );
		
		// получаем ссылку из контента
		if( ! $src ){
			$content = ( $this->post_id ) ? $wpdb->get_var("SELECT post_content FROM $wpdb->posts WHERE ID = $post_id LIMIT 1") : $post->post_content;
			$src = $this->__get_url_from_text( $content );
		}
		
		// получаем ссылку из вложений - первая картинка
		if( ! $src ){
			$attch_img = get_children( array(
				'numberposts'    => 1,
				'post_mime_type' => 'image',
				'post_parent'    => $post_id,
				'post_type'      => 'attachment'
			) );
			$attch_img = array_shift( $attch_img );
			if( $attch_img )
				$src = wp_get_attachment_url( $attch_img->ID );
		}

		// Заглушка no_photo, чтобы постоянно не проверять
		if( ! $src )
			$src = 'no_photo';
		
		update_post_meta( $post_id, $this->opt->meta_key, $src );
		
		return $src;
	}
	
	## Ссылка из текста 
	function __get_url_from_text( $text ){
		$allows = $this->opt->allow_hosts;
		
		$allows_patt = '';
		if( ! in_array('any', $allows ) ){
			$hosts_regex = implode('|', array_map('preg_quote', $allows ) );
			$allows_patt = '(?:www\.)?(?:'. $hosts_regex .')';
		}	
		
		$hosts_patt = '(?:https?://'. $allows_patt .'|/)';
		
		if(
			( false !== strpos( $text, 'src=') )
			&& 
			preg_match('~(?:<a[^>]+href=[\'"]([^>]+)[\'"][^>]*>)?<img[^>]+src=[\'"]('. $hosts_patt .'.*?)[\'"]~i', $text, $match )
		){
			// проверяем УРЛ ссылки
			$src = $match[1];
			if( ! preg_match('~\.(jpg|jpeg|png|gif)(?:\?.+)?$~i', $src) || ! $this->__is_allow_host($src) ){
				// проверям УРЛ картинки, если не подходит УРЛ ссылки
				$src = $match[2];
				if( ! $this->__is_allow_host($src) )
					$src = '';
			}
			
			return $src;
		}
	}
	
	## Проверяем что картинка с доступного хоста
	function __is_allow_host( $url ){
		// pre filter to change the behavior
		if( IS_KT_WPENV && ($return = apply_filters('kmt_is_allow_host', false, $url, $this->opt )) )
			return $return;
		
		if( ($url{0} == '/') /*относительный УРЛ*/ || in_array('any', $this->opt->allow_hosts ) )
			return true;
		
		// get main domain
		$host = self::parse_main_dom( parse_url( $url, PHP_URL_HOST ) );

		if( $host && in_array( $host, $this->opt->allow_hosts ) )
			return true;
			
		return false;
	}
	
	## get main domain from maybe subdomain: foo.site.com > site.com
	static function parse_main_dom( $host ){
		preg_match('~[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6}$~', $host, $mm );
		return $mm[0];
	}
	
	## Добавляет в конец назыания файла строку 'stub'
	function add_stub_to_path( $path_url ){
		$bname = basename( $path_url );
		return str_replace( $bname, 'stub_'. $bname, $path_url );
	}

	/**
	 * Создает миниатюру.
	 * 
	 * @return false/str УРЛ миниатюры.
	 */
	function do_thumbnail(){
		// если не передана ссылка, то ищем её в контенте и записываем пр.поле
		if( ! $this->src ) 
			$this->src = $this->get_src_and_set_postmeta();
		if( ! $this->src )
			return trigger_error('ERROR: No $src prop.', E_USER_NOTICE );
		
		// проверяем нужна ли картинка заглушка
		if( $this->src == 'no_photo'){
			if( $this->no_stub )
				return false;
			else
				$this->src = $this->opt->no_photo_url;
		}
		
		$path = parse_url( $this->src, PHP_URL_PATH );
		
		// картинка не определена
		if( ! $path )
			return false;
		
		preg_match('~\.([a-z0-9]+)$~i', $path, $m );
		$ext       = $m[1] ? $m[1] : 'png';

		$notcrop   = $this->notcrop ? '_notcrop' : '';
		$file_name = substr( md5($path), -9 ) ."_{$this->width}x{$this->height}{$notcrop}.{$ext}";
		$dest      = $this->opt->cache_folder . "/$file_name"; //файл миниатюры от корня сайта
		$img_url   = rtrim( $this->opt->cache_folder_url, '/') ."/$file_name"; //ссылка на изображение;

		// если миниатюра уже есть, то возвращаем её
		if( file_exists($dest) ){
			return $img_url;
		}
		// если есть заглушка возвращаем её
		elseif( file_exists( $this->add_stub_to_path($dest) ) ){
			if( $this->no_stub )
				return false;
			
			return $this->add_stub_to_path( $img_url );
		}
		
		
		// once ------------------------------------------------------

		$is_no_photo = false;
		
		if( ! $this->__cache_folder_check() ){
			if( class_exists('Kama_Thumbnail') )
				return Kama_Thumbnail::show_message( sprintf( __kt('Директории для создания миниатюр не существует. Создайте её: "s%"'), $this->opt->cache_folder ), 'error');
			else
				die('Kama_Thumbnail: No cache folder. Create it: '. $this->opt->cache_folder );
		}			
		
		if( ! $this->__is_allow_host( $this->src ) ){
			$this->src   = $this->opt->no_photo_url;
			$is_no_photo = true;
		}
		
		// если относительный УРЛ
		if( $this->src{0} == '/' )
			$this->src = home_url() . $this->src;
		
		
		// Если не удалось получить картинку: недоступный хост, файл пропал после переезда или еще чего.
		// То для указаного УРЛ будет создана миниатюра из заглушки no_photo.png
		// Чтобы после появления файла, миниатюра создалась правильно, нужно очистить кэш плагина.
		$img_str = $this->get_img_string( $this->src );
		
		$size = $this->__getimagesizefromstring( $img_str );
		
		if( ! $size || ! isset($size['mime']) || false === strpos( $size['mime'], 'image') ){
			$this->src   = $this->opt->no_photo_url;
			$img_str     = $this->get_img_string( $this->src );
			$is_no_photo = true;
		}
		
		// Изменим название файла если это картинка заглушка
		if( $is_no_photo ){
			$dest    = $this->add_stub_to_path( $dest );
			$img_url = $this->add_stub_to_path( $img_url );
		}
		
		if( ! $img_str ){
			trigger_error('ERROR: Couldn\'t get img data. Even no_photo.', E_USER_NOTICE );
			return false;
		}

		// создаем миниатюру
		// Библиотека Imagick
		if( extension_loaded('imagick') ){
			$this->make_thumbnail_Imagick( $img_str, $this->width, $this->height, $dest, $this->notcrop );
			
			return $img_url;
		}
		
		// Библиотека GD
		if( extension_loaded('gd') ){
			$this->make_thumbnail_GD( $img_str, $this->width, $this->height, $dest, $this->notcrop );
			
			return $img_url;
		}
		
		// выборосить заметку
		trigger_error('ERROR: There is no one of the Image libraries (GD or Imagick) installed on your server.', E_USER_NOTICE );

		return false;
	}
	
	function __getimagesizefromstring( $data ){
		if( function_exists('getimagesizefromstring') )
			return getimagesizefromstring( $data );
		
		return getimagesize('data://application/octet-stream;base64,'. base64_encode($data) );
	}
	
	## проверяем наличие директории, пытаемся создать, если её нет	
	protected function __cache_folder_check(){
		$is = true;
		if( ! is_dir( $this->opt->cache_folder ) )
			$is = @ mkdir( $this->opt->cache_folder, 0755, true );
		
		return $is;
	}
	
	function get_img_string( $img_url ){
		$img_string = '';
		
		if( false === strpos( $img_url, 'http' ) )
			die('error: no http in IMG url');
		
		// пробуем получить по абсолютному пути
		if( strpos( $img_url, $_SERVER['HTTP_HOST'] ) ){
			// получим корень сайта $_SERVER['DOCUMENT_ROOT'] может быть неверный
			$root = ABSPATH;
			
			// maybe WP in sub dir?
			$root_parent = dirname(ABSPATH) .'/';
			if( file_exists( $root_parent . 'wp-config.php') && ! file_exists( $root_parent . 'wp-settings.php' ) ){
				$root = $root_parent;
			}

			$img_path = preg_replace('~^https?://[^/]+/(.*)$~', "$root\\1", $img_url );
			if( file_exists( $img_path ) )
				$img_string = @ file_get_contents( $img_path );

			if( $img_string )
				return $img_string;
		}

		// try ge by URL
		if( ini_get('allow_url_fopen') ){
			$headers = get_headers( $img_url );
		
			// try find 200 OK. it may be 301, 302 redirects. In 3** redirect first status will be 3** and next 200 ...
			$OK = false;
			foreach( $headers as $line ){
				if( false !== strpos( $line, '200 OK' ) ){
					$OK = true;
					break;
				}
			}

			if( $OK && ($img_string = @ file_get_contents( $img_url )) )
				return $img_string;
		}
		
		// curl
		// надо сделать ручной переход по редиректам, а не CURLOPT_FOLLOWLOCATION вроде на некоторых серверах не работает это.
		if( extension_loaded('curl') || function_exists('curl_version') ){
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $img_url);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // To make cURL follow a redirect
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Set so curl_exec returns the result instead of outputting it.
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // accept any server certificate, without doing any verification as to which CA signed it, and whether or not that CA is trusted
			
			$img_string = curl_exec($ch);
			
			$errmsg = curl_error($ch);
			$info   = curl_getinfo($ch);
			$OK = @ $info['http_code'] == 200; //  curl_getinfo($ch, CURLINFO_HTTP_CODE) == 200;
			//is_user_logged_in() && wp_die( var_dump($img_url) );
			
			curl_close($ch);
			
			if( $OK && $img_string )
			   return $img_string;
		}
		
		return $img_string; // ''
	}
	
	/*
	function curl_exec_follow($ch, &$maxredirect = null) {
  
  // we emulate a browser here since some websites detect
  // us as a bot and don't let us do our job
  $user_agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5)".
                " Gecko/20041107 Firefox/1.0";
  curl_setopt($ch, CURLOPT_USERAGENT, $user_agent );

  $mr = $maxredirect === null ? 5 : intval($maxredirect);

  if (filter_var(ini_get(‘open_basedir’), FILTER_VALIDATE_BOOLEAN) === false 
      && filter_var(ini_get(‘safe_mode’), FILTER_VALIDATE_BOOLEAN) === false
  ) {

    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $mr > 0);
    curl_setopt($ch, CURLOPT_MAXREDIRS, $mr);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

  } else {
    
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

    if ($mr > 0)
    {
      $original_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
      $newurl = $original_url;
      
      $rch = curl_copy_handle($ch);
      
      curl_setopt($rch, CURLOPT_HEADER, true);
      curl_setopt($rch, CURLOPT_NOBODY, true);
      curl_setopt($rch, CURLOPT_FORBID_REUSE, false);
      do
      {
        curl_setopt($rch, CURLOPT_URL, $newurl);
        $header = curl_exec($rch);
        if (curl_errno($rch)) {
          $code = 0;
        } else {
          $code = curl_getinfo($rch, CURLINFO_HTTP_CODE);
          if ($code == 301 || $code == 302) {
            preg_match('/Location:(.*?)\n/i', $header, $matches);
            $newurl = trim(array_pop($matches));
            
            // if no scheme is present then the new url is a
            // relative path and thus needs some extra care
            if(!preg_match("/^https?:/i", $newurl)){
              $newurl = $original_url . $newurl;
            }   
          } else {
            $code = 0;
          }
        }
      } while ($code && --$mr);
      
      curl_close($rch);
      
      if (!$mr)
      {
        if ($maxredirect === null)
        trigger_error('Too many redirects.', E_USER_WARNING);
        else
        $maxredirect = 0;
        
        return false;
      }
      curl_setopt($ch, CURLOPT_URL, $newurl);
    }
  }
  return curl_exec($ch);
}

$ch = curl_init("http://example.com");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec_follow($ch);
curl_close($ch);
	*/

	## ядро: создание и запись файла-картинки на основе библиотеки Imagick
	protected function make_thumbnail_Imagick( $img_string, $width, $height, $dest, $notcrop ){		
		$image = new Imagick();
		$image->readImageBlob( $img_string );
		
		# Select the first frame to handle animated images properly
		if( is_callable( array( $image, 'setIteratorIndex') ) )
			$image->setIteratorIndex(0);
		
		// устанавливаем качество
		$format = $image->getImageFormat();
		if( $format == 'JPEG' || $format == 'JPG')
			$image->setImageCompression( Imagick::COMPRESSION_JPEG );
		
		$image->setImageCompressionQuality( $this->quality );
		
		$origin_h = $image->getImageHeight();
		$origin_w = $image->getImageWidth();		
		
		// получим координаты для считывания с оригинала и размер новой картинки
		list( $dx, $dy, $wsrc, $hsrc, $width, $height ) = $this->__resize_coordinates( $height, $origin_h, $width, $origin_w, $notcrop );
		
		// обрезаем оригинал
		$image->cropImage( $wsrc, $hsrc, $dx, $dy );
		$image->setImagePage( $wsrc, $hsrc, 0, 0);
		
		// Strip out unneeded meta data
		$image->stripImage();
		
		// уменьшаем под размер
		$image->scaleImage( $width, $height );
		
		$image->writeImage( $dest );
		chmod( $dest, 0755 );
		$image->clear();
		$image->destroy();
	}
	
	## ядро: создание и запись файла-картинки на основе библиотеки GD
	protected function make_thumbnail_GD( $img_string, $width, $height, $dest, $notcrop ){		
		$size = $this->__getimagesizefromstring( $img_string );
		//die( print_r($size) );

		if( $size === false )
			return false; // не удалось получить параметры файла;
		
		list( $origin_w, $origin_h ) = $size;
		
		$format = strtolower( substr( $size['mime'], strpos($size['mime'], '/')+1 ) );

		// Создаем ресурс картинки
		$image = @ imagecreatefromstring( $img_string );
		if ( ! is_resource( $image ) )
			return false; // не получилось получить картинку
		
		// получим координаты для считывания с оригинала и размер новой картинки
		list( $dx, $dy, $wsrc, $hsrc, $width, $height ) = $this->__resize_coordinates( $height, $origin_h, $width, $origin_w, $notcrop );
		
		// Создаем холст полноцветного изображения
		$thumb = imagecreatetruecolor( $width, $height );
		
		if( function_exists('imagealphablending') && function_exists('imagesavealpha') ) {
			imagealphablending( $thumb, false ); // режим сопряжения цвета и альфа цвета
			imagesavealpha( $thumb, true ); // флаг сохраняющий прозрачный канал
		}
		if( function_exists('imageantialias') )
			imageantialias( $thumb, true ); // включим функцию сглаживания	

		if( ! imagecopyresampled( $thumb, $image, 0, 0, $dx, $dy, $width, $height, $wsrc, $hsrc ) )
			return false; // не удалось изменить размер
		//die( var_dump( $thumb ) );
		// 
		// Сохраняем картинку
		if( $format == 'png'){		
			// convert from full colors to index colors, like original PNG.
			if ( function_exists('imageistruecolor') && ! imageistruecolor( $thumb ) ){
				imagetruecolortopalette( $thumb, false, imagecolorstotal( $thumb ) );
			}
			imagepng( $thumb, $dest );
		} 
		elseif( $format == 'gif'){
			imagegif( $thumb, $dest );
		}
		else {
			imagejpeg( $thumb, $dest, $this->quality );
		}
		@ chmod( $dest, 0755 );
		imagedestroy($image);
		imagedestroy($thumb);
		  
		return true; 
	}
	
	# координаты кадрирования 
	# $height (необходимая высота), $origin_h (оригинальная высота), $width, $origin_w
	# @return array - отступ по Х и Y и сколько пикселей считывать по высоте и ширине у источника: $dx, $dy, $wsrc, $hsrc
	protected function __resize_coordinates( $height, $origin_h, $width, $origin_w, $notcrop ){
		if( $notcrop ){
			// находим меньшую подходящую сторону у картинки и обнуляем её
			if( $width/$origin_w < $height/$origin_h ) $height = 0;
			else $width = 0;
		}
		
		// если не указана одна из сторон задаем ей пропорциональное значение
		if( ! $width ) 	$width = round( $origin_w * ($height/$origin_h) );
		if( ! $height ) $height = round( $origin_h * ($width/$origin_w) );
		
		// Определяем необходимость преобразования размера так чтоб вписывалась наименьшая сторона
		// if( $width < $origin_w || $height < $origin_h )
			$ratio = max( $width/$origin_w, $height/$origin_h );
			
		//срезать справа и слева
		$dx = $dy = 0;
		if( $height/$origin_h > $width/$origin_w ) 
			$dx = round( ($origin_w - $width*$origin_h/$height)/2 ); //отступ слева у источника
		// срезать верх и низ
		else
			$dy = round( ($origin_h - $height*$origin_w/$width)/2 ); // $height*$origin_w/$width)/2*6/10 - отступ сверху у источника *6/10 - чтобы для вертикальных фоток отступ сверху был не половина а процентов 30
		 
		// сколько пикселей считывать c источника
		$wsrc = round( $width/$ratio );
		$hsrc = round( $height/$ratio );
		
		return array( $dx, $dy, $wsrc, $hsrc, $width, $height );
	}
	
	
	## Миниатюры ------------------
	## Обработка параметров для создания миниатюр
	function set_args( $args = '', $src = '' ){
		// все параметры без алиасов
		$def = array(
			//'notcrop' => '', // определяется как isset
			//'no_stub' => '', // определяется как isset
			'allow'   => array(), // разрешенные хосты для этого запроса, чтобы не указывать настройку глобально
			'width'   => '',   // пропорционально
			'height'  => '',   // пропорционально
			'src'     => $src, // алиасы url, link, img
			'quality' => $this->opt->quality,
			'post_id' => '',
			'class'   => 'aligncenter',
			'alt'     => '',
			'title'   => '',
			'attr'    => '', // произвольная строка, вставляется как есть
		);
				
		if( is_string( $args ) ){
			// parse_str превращает пробелы в "_", например тут "w=230 &h=250 &notcrop &class=aligncenter" notcrop будет notcrop_
			$args = preg_replace('~ +&~', '&', trim($args) );
			parse_str( $args, $rg );
		}
		else
			$rg = $args;
		
		$rg = array_map('trim', $rg );
		
		$rg = array_merge( $def, $rg );
	
		// алиасы параметров
		if( isset($rg['w']) )        $rg['width']   = $rg['w'];
		if( isset($rg['h']) )        $rg['height']  = $rg['h'];
		if( isset($rg['q']) )        $rg['quality'] = $rg['q'];
		if( isset($rg['post']) )     $rg['post_id'] = $rg['post'];
		if( isset($rg['url']) )      $rg['src'] = $rg['url'];
		elseif( isset($rg['link']) ) $rg['src'] = $rg['link'];
		elseif( isset($rg['img']) )  $rg['src'] = $rg['img'];
		
		// установим необходимые свойства
		$this->src     = (string) $rg['src'];
		$this->width   = (int)    $rg['width'];
		$this->height  = (int)    $rg['height'];
		$this->quality = (int)    $rg['quality'];
		$this->post_id = (int)    $rg['post_id'];
		$this->notcrop = isset($rg['notcrop']);
		$this->no_stub = ( isset($rg['no_stub']) || isset($this->opt->no_stub) );
		
		if( $rg['allow'] ){
			foreach( preg_split('~[, ]+~', $rg['allow'] ) as $host )
				$this->opt->allow_hosts[] = self::parse_main_dom( $host );
		}
		
		// размер миниатюр по умолчанию
		if( ! $this->width && ! $this->height )
			$this->width = $this->height = 100;
		
		// если в post_id передан объект поста
		if( is_object( $rg['post_id'] ) )
			$rg['post_id']->ID;
		
		$this->args = ( IS_KT_WPENV ? apply_filters('kmt_set_args', $rg ) : $rg );
	}
	
	function src(){
		return $this->do_thumbnail();
	}
	
	function img(){
		if( ! $src = $this->src() )
			return '';
		
		// easy life
		$rg = & $this->args;
		
		if( ! $rg['alt'] && $rg['title'] )
			$rg['alt'] = $rg['title'];
		
		$attr  = ' ';
		if( ! $this->notcrop ){
			$attr .= $this->width  ? ' width="'. $this->width .'"'   : '';
			$attr .= $this->height ? ' height="'. $this->height .'"' : '';
		}
		
		$attr .= $rg['title'] ? ' title="'. esc_attr( $rg['title'] ) .'"' : '';
		$attr .= $rg['attr'] ? ' '. $rg['attr'] : '';
		
		$out = '<img class="'. $rg['class'] .'" src="'. $src .'" alt="'. ($rg['alt'] ? esc_attr( $rg['alt'] ) : '') .'"'. $attr .'>';
		
		return IS_KT_WPENV ? apply_filters('kmt_img', $out, $rg ) : $out;
	}

	function a_img(){
		if( ! $img = $this->img() ) 
			return '';
		
		$out = '<a href="'. $this->src .'">'. $img .'</a>';
		return IS_KT_WPENV ? apply_filters('kmt_a_img', $out ) : $out;
	}
	## / Миниатюры ------------------

}

/* Удалет произвольное поле со ссылкой при обновлении поста, чтобы создать его заново */
add_filter('save_post', 'kt_clear_post_custom');
function kt_clear_post_custom($post_id){
	delete_post_meta($post_id, 'photo_URL');
}



