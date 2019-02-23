<?php
//Загрузка/отключение скриптов/стилей
function add_styles_scripts(){
	//Jquery
    wp_deregister_script('jquery');
    wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
    wp_enqueue_script('jquery');
    //Отключить стили плагина toc+
    wp_deregister_style('toc-screen');
}
add_action( 'wp_enqueue_scripts', 'add_styles_scripts' );

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

add_action( 'wp_head', function() {
    echo '<link rel="alternate" type="application/rss+xml" title="'.get_bloginfo( 'name' ).' Feed" href="'.get_bloginfo('rss2_url').'" />';
} );

add_filter( 'xmlrpc_methods', 'morkovin_sar_block_xmlrpc_attacks' );
function morkovin_sar_block_xmlrpc_attacks( $methods ) {
   unset( $methods['pingback.ping'] );
   unset( $methods['pingback.extensions.getPingbacks'] );
   return $methods;
}
add_filter( 'wp_headers', 'morkovin_sar_remove_x_pingback_header' );
function morkovin_sar_remove_x_pingback_header( $headers ) {
   unset( $headers['X-Pingback'] );
   return $headers;
}

// include('class.Kama_Make_Thumb.php');
include('morkovin_recent_posts.php');

add_theme_support('menus');
add_theme_support('post-thumbnails');
add_theme_support('title-tag');

register_nav_menu('nav_main', 'Главное меню');
register_nav_menu('nav_add', 'Дополнительное выпадающее');
register_nav_menu('nav_sidebar', 'Меню в сайдбаре');
register_nav_menu('nav_m', 'Меню для мобильной версии');
register_nav_menu('nav_footer', 'Меню в подвале');

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Верх сайдбара',
		'id' => "sidebar-1",
		'description' => '',
		'before_widget' => '<div class="section section_widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="title">',
		'after_title' => '</div>',
	));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Низ сайдбара',
		'id' => "sidebar-2",
		'description' => '',
		'before_widget' => '<div class="section section_widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="title">',
		'after_title' => '</div>',
	));

if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'name' => 'Внутри head',
        'id' => "in_head",
        'description' => '',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
    ));
}

if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'name' => 'Яндекс Метрика',
        'id' => "in_body",
        'description' => '',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
    ));
}

//Удалить атрибут rel
function my_remove_rel_attr($content) {
    return preg_replace('/\s+rel="attachment wp-att-[0-9]+"/i', '', $content);
}
add_filter('the_content', 'my_remove_rel_attr');

function new_excerpt_more($more) {
	global $post;
	return '';
}
add_filter('excerpt_more', 'new_excerpt_more');

//Количество просмотров записи
function get_post_views($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if ($count == '') {
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
		return '0';
	}
	return $count;
}

function set_post_views($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if ($count == '') {
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	} else {
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}

add_filter('the_content', 'set_post_views_in_single');

function set_post_views_in_single($content) {
	if ( is_single() ) {
		set_post_views( get_the_ID() );
	}

	return $content;
}

//Хлебные крошки
function get_parent_of_subcategory($cat_id = false) {
    if($cat_id){
        $cat = get_category($cat_id);
    } else {
        $cat = get_category( get_query_var('cat'),false );
    }

    $cat_parent_id = $cat->parent;

    if($cat_parent_id)
    {
        $cat_name = get_cat_name($cat_parent_id);
        $cat_url = get_category_link($cat_parent_id);

        return "<a href=\"$cat_url\" itemprop=\"item\"><span itemprop=\"name\">$cat_name</span></a>";
    }
    else
    {
        $cat_name = "";

        return FALSE;
    }
}

//Комментарии
function mytheme_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
<li id="comment-<?php comment_ID() ?>">
	<div id="div-comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="gravatar"><?php echo get_avatar($comment, $size='50', $default=''); ?></div>
		<div class="comment_content">
			<div class="cauthor">
				<span class="author_name"><?php printf(__('<span class="fn">%s</span>'), get_comment_author_link()) ?></span>
				<span class="comment_date"> | <?php comment_date('j.m.Y H:i');?> <?php edit_comment_link(__('(Edit)'),'  ','') ?></span>
			</div>

			<div class="ctext">
				<?php if ($comment->comment_approved == '0') : ?>
					<p><em><?php _e('Your comment is awaiting moderation.') ?></em></p>
				<?php endif; ?>
				<?php comment_text() ?>

				<?php if (/*comments_open() AND */(get_option('thread_comments') == 1) AND ($depth != $args['max_depth'])) { ?>
				<div class="reply">
					<?php comment_reply_link(array_merge( $args, array('add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>
				<?php } ?>
			</div><!-- .ctext -->
		</div><!-- .comment_content -->
	</div>
<?php
}

function src_simple_recent_comments($src_count=7, $src_length=60) {
	global $wpdb;
	$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_date, comment_approved, comment_type,
		SUBSTRING(comment_content,1,$src_length) AS com_excerpt
		FROM $wpdb->comments
		LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID)
		WHERE comment_approved = '1' AND comment_type = '' AND post_password = ''
		ORDER BY comment_date_gmt DESC
		LIMIT $src_count";
	$comments = $wpdb->get_results($sql);
	foreach ($comments as $comment) {
		// $date = apply_filters('the_time', mysql2date("j F, H:i", $comment->comment_date));
?>
		<li>
			<p><?php echo strip_tags($comment->com_excerpt) ?>...</p>
			от: <?php echo $comment->comment_author ?> <a href="<?php echo get_permalink($comment->ID) ?>#comment-<?php echo $comment->comment_ID ?>"><?php echo $comment->post_title ?></a>
		</li>
<?php
	}
}

function delete_rel($link) {
    return str_replace('rel="category tag"', "", $link);
}
add_filter('the_category', 'delete_rel');

// удаляем лишние отступы у изображений с подписью
add_filter( 'img_caption_shortcode', 'my_img_caption_shortcode', 10, 3 );
function my_img_caption_shortcode( $empty, $attr, $content ){
	$attr = shortcode_atts( array(
		'id'      => '',
		'align'   => 'alignnone',
		'width'   => '',
		'caption' => ''
	), $attr );
	if ( 1 > (int) $attr['width'] || empty( $attr['caption'] ) ) { return ''; }
	if ( $attr['id'] ) { $attr['id'] = 'id="' . esc_attr( $attr['id'] ) . '" '; }
	return '<div ' . $attr['id']
	. 'class="wp-caption ' . esc_attr( $attr['align'] ) . '" '
	. 'style="max-width: ' . ( (int) $attr['width'] ) . 'px;">'
	. do_shortcode( $content )
	. '<div class="wp-caption-text">' . $attr['caption'] . '</div>'
	. '</div>';
}

if (is_admin()) {
	// колонка "ID" для таксономий (рубрик, меток и т.д.) в админке
	foreach (get_taxonomies() as $taxonomy) {
		add_action("manage_edit-${taxonomy}_columns",          'tax_add_col');
		add_filter("manage_edit-${taxonomy}_sortable_columns", 'tax_add_col');
		add_filter("manage_${taxonomy}_custom_column",         'tax_show_id', 10, 3);
	}
	add_action('admin_print_styles-edit-tags.php', 'tax_id_style');
	function tax_add_col($columns) {return $columns + array ('tax_id' => 'ID');}
	function tax_show_id($v, $name, $id) {return 'tax_id' === $name ? $id : $v;}
	function tax_id_style() {print '<style>#tax_id{width:4em}</style>';}

	// колонка "ID" для постов и страниц в админке
	add_filter('manage_posts_columns', 'posts_add_col', 5);
	add_action('manage_posts_custom_column', 'posts_show_id', 5, 2);
	add_filter('manage_pages_columns', 'posts_add_col', 5);
	add_action('manage_pages_custom_column', 'posts_show_id', 5, 2);
	add_action('admin_print_styles-edit.php', 'posts_id_style');
	function posts_add_col($defaults) {$defaults['wps_post_id'] = __('ID'); return $defaults;}
	function posts_show_id($column_name, $id) {if ($column_name === 'wps_post_id') echo $id;}
	function posts_id_style() {print '<style>#wps_post_id{width:4em}</style>';}
}

// отключаем стили YARPP
add_action('wp_print_styles','lm_dequeue_header_styles');
function lm_dequeue_header_styles() { wp_dequeue_style('yarppWidgetCss'); }
add_action('wp_footer','lm_dequeue_footer_styles');
function lm_dequeue_footer_styles() { wp_dequeue_style('yarppRelatedCss'); }

function genesis(){};

//noindex для toc+
add_filter( 'the_content', 'morkovin_noindex_toc', 1000);
function morkovin_noindex_toc($content){
     return preg_replace('/(<div id="toc_container"[^>]+>[^\n]+)/', '<!--noindex-->$1<!--/noindex-->', $content);
}

//настройки темы
add_action('customize_register', function($customizer){

    //общие настройки ------------------------------------------------------------------------
    $customizer->add_section(
        'section_general',
        array(
            'title' => 'Общие настройки',
            'description' => 'Опции',
            'priority' => 35,
        )
    );

    //Описание главной страницы
    $customizer->add_setting(
        'page_home'
    );
    $customizer->add_control(
        'page_home',
        array(
            'type' => 'dropdown-pages',
            'label' => 'Выберите страницу для главной',
            'section' => 'section_general',
        )
    );

    //Текс хлебной крошки
    $customizer->add_setting(
        'bread_crumbs'
    );
    $customizer->add_control(
        'bread_crumbs',
        array(
            'label' => 'Текст первой хлебной крошки',
            'section' => 'section_general',
            'type' => 'text',
        )
    );

    //Отключение сайдбара
    $customizer->add_setting(
        'remove_sidebar'
    );
    $customizer->add_control(
        'remove_sidebar',
        array(
            'type' => 'select',
            'label' => 'Отключить сайдбар главной',
            'section' => 'section_general',
            'choices' => array(
                '0' => 'Нет',
                '1' => 'Да',
            ),
        )
    );

    //Вывод даты
    $customizer->add_setting(
        'show_date'
    );
    $customizer->add_control(
        'show_date',
        array(
            'type' => 'select',
            'label' => 'Отображать дату',
            'section' => 'section_general',
            'choices' => array(
                '1' => 'Да',
                '0' => 'Нет',
            ),
        )
    );

    //Отображение количества комментариев
    $customizer->add_setting(
        'show_comments_number'
    );
    $customizer->add_control(
        'show_comments_number',
        array(
            'type' => 'select',
            'label' => 'Отображать кол-во коментов',
            'section' => 'section_general',
            'choices' => array(
                '1' => 'Да',
                '0' => 'Нет',
            ),
        )
    );

    //Липкое верхнее меню
    $customizer->add_setting(
        'sticky_top_menu'
    );
    $customizer->add_control(
        'sticky_top_menu',
        array(
            'type' => 'select',
            'label' => 'Липкое верхнее меню',
            'section' => 'section_general',
            'choices' => array(
                '0' => 'Нет',
                '1' => 'Да',
            ),
        )
    );

    //Форма комментирования без запроса e-mail и сайта
    $customizer->add_setting(
        'remove_email_site_comment_form'
    );
    $customizer->add_control(
        'remove_email_site_comment_form',
        array(
            'type' => 'select',
            'label' => 'Убрать из формы комментирования поля «email» и «сайт»',
            'section' => 'section_general',
            'choices' => array(
                '0' => 'Нет',
                '1' => 'Да',
            ),
        )
    );

    //Цитата
    $customizer->add_setting(
        'excerpt_or_content'
    );
    $customizer->add_control(
        'excerpt_or_content',
        array(
            'type' => 'select',
            'label' => 'Что выводить в анонсе поста',
            'section' => 'section_general',
            'choices' => array(
                '1' => 'Цитата',
                '2' => 'Описание из плагина Yoast SEO',
            ),
        )
    );

    //Количество выводимых постов на главной
    $customizer->add_setting(
        'posts_per_home'
    );
    $customizer->add_control(
        'posts_per_home',
        array(
            'label' => 'Количество постов на главной (по умолчанию 6)',
            'section' => 'section_general',
            'type' => 'text',
        )
    );

    //Поиск
    $customizer->add_setting(
        'selection_search_site'
    );
    $customizer->add_control(
        'selection_search_site',
        array(
            'type' => 'select',
            'label' => 'Поиск по сайту',
            'section' => 'section_general',
            'choices' => array(
                '1' => 'Wordpress (по умолчанию)',
                '2' => 'Яндекс поиск',
            ),
        )
    );

    //Якорные ссылки в меню
    $customizer->add_setting(
        'menu_аnchor'
    );
    $customizer->add_control(
        'menu_аnchor',
        array(
            'type' => 'select',
            'label' => 'Якорные ссылки в меню',
            'section' => 'section_general',
            'choices' => array(
                '0' => 'Нет (по умолчанию)',
                '1' => 'Да',
            ),
        )
    );

    //Социальные профили ------------------------------------------------------------------------
        $customizer->add_section(
            'section_social',
            array(
                'title' => 'Ссылки на cоц. сети',
                'description' => 'Ссылки на соц. сети',
                'priority' => 35,
            )
        );

        //ок
        $customizer->add_setting(
            'link_ok'
        );
        $customizer->add_control(
            'link_ok',
            array(
                'label' => 'Однокласники',
                'section' => 'section_social',
                'type' => 'text',
            )
        );
        //yt
        $customizer->add_setting(
            'link_yt'
        );
        $customizer->add_control(
            'link_yt',
            array(
                'label' => 'YouTube',
                'section' => 'section_social',
                'type' => 'text',
            )
        );
        //fb
        $customizer->add_setting(
            'link_fb'
        );
        $customizer->add_control(
            'link_fb',
            array(
                'label' => 'Facebook',
                'section' => 'section_social',
                'type' => 'text',
            )
        );
        //gp
        $customizer->add_setting(
            'link_gp'
        );
        $customizer->add_control(
            'link_gp',
            array(
                'label' => 'GP',
                'section' => 'section_social',
                'type' => 'text',
            )
        );
        //tw
        $customizer->add_setting(
            'link_tw'
        );
        $customizer->add_control(
            'link_tw',
            array(
                'label' => 'Twitter',
                'section' => 'section_social',
                'type' => 'text',
            )
        );
        //in
        $customizer->add_setting(
            'link_in'
        );
        $customizer->add_control(
            'link_in',
            array(
                'label' => 'Instagram',
                'section' => 'section_social',
                'type' => 'text',
            )
        );
        //vk
        $customizer->add_setting(
            'link_vk'
        );
        $customizer->add_control(
            'link_vk',
            array(
                'label' => 'Вконтакте',
                'section' => 'section_social',
                'type' => 'text',
            )
        );

    // Стили ------------------------------------------------------------------------
        $customizer->add_section(
            'section_styles',
            array(
                'title' => 'Стили темы',
                'description' => 'Стили',
                'priority' => 35,
            )
        );

        //Цвет 1
        $customizer->add_setting(
            'section_color_1',
            array(
                'default' => '#6969b3',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $customizer->add_control(
            new WP_Customize_Color_Control(
                $customizer,
                'section_color_1',
                array(
                    'label' => 'Цвет 1',
                    'section' => 'section_styles',
                    'settings' => 'section_color_1',
                )
            )
        );

        //Цвет 2
        $customizer->add_setting(
            'section_color_2',
            array(
                'default' => '#5a5aa1',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $customizer->add_control(
            new WP_Customize_Color_Control(
                $customizer,
                'section_color_2',
                array(
                    'label' => 'Цвет 2',
                    'section' => 'section_styles',
                    'settings' => 'section_color_2',
                )
            )
        );

        //Цвет 3
        $customizer->add_setting(
            'section_color_3',
            array(
                'default' => '#5a5aa1',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $customizer->add_control(
            new WP_Customize_Color_Control(
                $customizer,
                'section_color_3',
                array(
                    'label' => 'Цвет 3',
                    'section' => 'section_styles',
                    'settings' => 'section_color_3',
                )
            )
        );

        //Цвет ссылок в контенте
        $customizer->add_setting(
            'section_color_4',
            array(
                'default' => '#1e73be',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $customizer->add_control(
            new WP_Customize_Color_Control(
                $customizer,
                'section_color_4',
                array(
                    'label' => 'Цвет ссылок в контенте',
                    'section' => 'section_styles',
                    'settings' => 'section_color_4',
                )
            )
        );
        //Цвет ссылок в контенте при наведении
        $customizer->add_setting(
            'section_color_5',
            array(
                'default' => '#e74949',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $customizer->add_control(
            new WP_Customize_Color_Control(
                $customizer,
                'section_color_5',
                array(
                    'label' => 'Цвет ссылок в контенте при наведении',
                    'section' => 'section_styles',
                    'settings' => 'section_color_5',
                )
            )
        );

        //Цвет названия анонсов и подложки рубрики анонса при наведении
        $customizer->add_setting(
            'section_color_6',
            array(
                'default' => '#6969b3',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $customizer->add_control(
            new WP_Customize_Color_Control(
                $customizer,
                'section_color_6',
                array(
                    'label' => 'Цвет ссылок анонсов и подложки рубрики анонса при наведении',
                    'section' => 'section_styles',
                    'settings' => 'section_color_6',
                )
            )
        );

        //Логотип в шапке
        $customizer->add_setting('logo_upload');
        $customizer->add_control(
            new WP_Customize_Image_Control(
                $customizer,
                'logo_upload',
                array(
                    'label' => 'Логотип в шапке)',
                    'section' => 'section_styles',
                    'settings' => 'logo_upload'
                )
            )
        );

        //Логотип в подвале
        $customizer->add_setting('logo_footer_upload');
        $customizer->add_control(
            new WP_Customize_Image_Control(
                $customizer,
                'logo_footer_upload',
                array(
                    'label' => 'Логотип в подвале',
                    'section' => 'section_styles',
                    'settings' => 'logo_footer_upload'
                )
            )
        );
});

//Получение опций темы
    //Лого
    $logo_upload = get_theme_mod('logo_upload', get_bloginfo('template_url').'/images/logo.png');  //по умолчанию стандартный логотип
    $logo_footer_upload = get_theme_mod('logo_footer_upload', false);  //по умолчанию стандартный логотип

    //Страница текст которой выводится в описании на главной
    $homepage = get_theme_mod('page_home', false); //по умолчанию не выводим

    //Хлебные крошки
    $bread_crumbs_home = get_theme_mod('bread_crumbs', 'Главная'); //по умолчанию "главная"

    //Отчелюение сайдбара на главной
    $disable_sidebar_homepage = get_theme_mod('remove_sidebar', 0);

    //Вывод даты
    $show_date = get_theme_mod('show_date', 1);

    //Отображение количества комментариев
    $show_comments_number = get_theme_mod('show_comments_number', 1);

    //Отключить хлебные крошки под записью
    $disable_two_breadcrubs = get_theme_mod('disable_two_breadcrubs', 0);

    //Липкое верхнее меню
    $sticky_top_menu = get_theme_mod('sticky_top_menu', 0);

    //Удаление полей email и сайт из формы комментирования
    $remove_email_site_comment_form = get_theme_mod('remove_email_site_comment_form', 0);

    //Что выводим в анонсе поста
    $excerpt_or_content = get_theme_mod('excerpt_or_content', 1); //по умолчанию цитата

    //Поиск по сайту
    $selection_search_site = get_theme_mod('selection_search_site', 1); //по умолчанию поиск от вордпресс

    //Количество постов на главной
    $posts_per_home = get_theme_mod('posts_per_home', 6); //по умолчанию 6

    //Якорные ссылки в меню
    $menu_аnchor = get_theme_mod('menu_аnchor', 0); //по умолчанию 0, что значит — нет

    //Соц сети
    $social_ok = get_theme_mod('link_ok', '');
    $social_yt = get_theme_mod('link_yt', '');
    $social_fb = get_theme_mod('link_fb', '');
    $social_gp = get_theme_mod('link_gp', '');
    $social_tw = get_theme_mod('link_tw', '');
    $social_in = get_theme_mod('link_in', '');
    $social_vk = get_theme_mod('link_vk', '');

// удаляем ссылку с активного пункта меню
function no_link_current_page($menu) {
    return preg_replace('%((current_page_item|current-menu-item)[^<]+)[^>]+>([^<]+)</a>%', '$1<span>$3</span>', $menu);
}

if (!$menu_аnchor) {
    add_filter('wp_nav_menu', 'no_link_current_page');
}

add_filter('widget_text', 'do_shortcode');

if ( function_exists('register_sidebar') && $disable_sidebar_homepage )
    register_sidebar(array(
        'name' => 'Справа от популярных на главной',
        'id' => "popular-home",
        'description' => '',
        'before_widget' => '<div class="section section_widget section_popular-home %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="title">',
        'after_title' => '</div>',
    ));

add_filter( 'wp_postratings_schema_itemtype', 'wp_postratings_schema_itemtype' );
function wp_postratings_schema_itemtype( $itemtype ) {
    return '';
}

function sample_admin_notice__success() {
    ?>
    <div class="notice">
        <p>Тема разработана командой Андрея Морковина специально для слушателей курсов в рамках проекта Puzat.ru. <a href="https://docs.google.com/document/d/1u8qLmBg4Dj-8g5uKJHwID6eNYrkJGkisX1_gF7mM40o/edit">Инструкция по работе с темой</a>.</p>
    </div>
    <?php
}
add_action( 'admin_notices', 'sample_admin_notice__success' );

function morkovin_change_yoast_description($str) {
    $term_id = '';

    if ( is_category() ) {
        $term_id = get_query_var('cat');
    }
    if ( is_tag() ) {
        $term_id = get_query_var('tag_id');
    }

    if ( $term_id != '' ) {
        if ($str) {
            return $str;
        }

        $morkovin_description = false;
        $term = get_term($term_id);

        $title_posts = array();

        if ( $term->taxonomy == 'category' ) {
            $loop = new WP_Query('cat='.$term->term_id.'&posts_per_page=2');
        }
        if ( $term->taxonomy == 'post_tag' ) {
            $loop = new WP_Query('tag_id='.$term->term_id.'&posts_per_page=2');
        }

        if ( $loop->have_posts() ) {
            while ( $loop->have_posts() ) { $loop->the_post();
                $title_posts[] = get_the_title();
            }
            $morkovin_description = implode(". ", $title_posts);
            $morkovin_description = $morkovin_description.'.';
        } elseif ( $term->description ) {
            $morkovin_description = wp_trim_words($term->description);
        }

        wp_reset_query();

        return $morkovin_description;
    }

    return $str;
};
add_filter( 'wpseo_metadesc', 'morkovin_change_yoast_description', 10, 1 );

/*
 * "Хлебные крошки" для WordPress
 * автор: Dimox
 * версия: 2018.10.05
 * лицензия: MIT
*/
function dimox_breadcrumbs() {

  /* === ОПЦИИ === */
  $text['home'] = get_theme_mod('bread_crumbs', 'Главная'); // текст ссылки "Главная"
  $text['category'] = '%s'; // текст для страницы рубрики
  $text['search'] = 'Результаты поиска по запросу "%s"'; // текст для страницы с результатами поиска
  $text['tag'] = 'Записи с тегом "%s"'; // текст для страницы тега
  $text['author'] = 'Статьи автора %s'; // текст для страницы автора
  $text['404'] = 'Ошибка 404'; // текст для страницы 404
  $text['page'] = 'Страница %s'; // текст 'Страница N'
  $text['cpage'] = 'Страница комментариев %s'; // текст 'Страница комментариев N'

  $wrap_before = '<div class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">'; // открывающий тег обертки
  $wrap_after = '</div><!-- .breadcrumbs -->'; // закрывающий тег обертки
  $sep = '<span class="breadcrumbs__separator"> › </span>'; // разделитель между "крошками"
  $before = '<span class="breadcrumbs__current">'; // тег перед текущей "крошкой"
  $after = '</span>'; // тег после текущей "крошки"

  $show_on_home = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать
  $show_home_link = 1; // 1 - показывать ссылку "Главная", 0 - не показывать
  $show_current = 0; // 1 - показывать название текущей страницы, 0 - не показывать
  $show_last_sep = 0; // 1 - показывать последний разделитель, когда название текущей страницы не отображается, 0 - не показывать
  /* === КОНЕЦ ОПЦИЙ === */

  global $post;
  $home_url = home_url('/');
  $link = '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
  $link .= '<a class="breadcrumbs__link" href="%1$s" itemprop="item"><span itemprop="name">%2$s</span></a>';
  $link .= '<meta itemprop="position" content="%3$s" />';
  $link .= '</span>';
  $parent_id = ( $post ) ? $post->post_parent : '';
  $home_link = sprintf( $link, $home_url, $text['home'], 1 );

  if ( is_home() || is_front_page() ) {

    if ( $show_on_home ) echo $wrap_before . $home_link . $wrap_after;

  } else {

    $position = 0;

    echo $wrap_before;

    if ( $show_home_link ) {
      $position += 1;
      echo $home_link;
    }

    if ( is_category() ) {
      $parents = get_ancestors( get_query_var('cat'), 'category' );
      foreach ( array_reverse( $parents ) as $cat ) {
        $position += 1;
        if ( $position > 1 ) echo $sep;
        echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
      }
      if ( get_query_var( 'paged' ) ) {
        $position += 1;
        $cat = get_query_var('cat');
        echo $sep . sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
        echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
      } else {
        if ( $show_current ) {
          if ( $position >= 1 ) echo $sep;
          echo $before . sprintf( $text['category'], single_cat_title( '', false ) ) . $after;
        } elseif ( $show_last_sep ) echo $sep;
      }

    } elseif ( is_search() ) {
      if ( $show_home_link && $show_current || ! $show_current && $show_last_sep ) echo $sep;
      if ( $show_current ) echo $before . sprintf( $text['search'], get_search_query() ) . $after;

    } elseif ( is_year() ) {
      if ( $show_home_link && $show_current ) echo $sep;
      if ( $show_current ) echo $before . get_the_time('Y') . $after;
      elseif ( $show_home_link && $show_last_sep ) echo $sep;

    } elseif ( is_month() ) {
      if ( $show_home_link ) echo $sep;
      $position += 1;
      echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), $position );
      if ( $show_current ) echo $sep . $before . get_the_time('F') . $after;
      elseif ( $show_last_sep ) echo $sep;

    } elseif ( is_day() ) {
      if ( $show_home_link ) echo $sep;
      $position += 1;
      echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), $position ) . $sep;
      $position += 1;
      echo sprintf( $link, get_month_link( get_the_time('Y'), get_the_time('m') ), get_the_time('F'), $position );
      if ( $show_current ) echo $sep . $before . get_the_time('d') . $after;
      elseif ( $show_last_sep ) echo $sep;

    } elseif ( is_single() && ! is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $position += 1;
        $post_type = get_post_type_object( get_post_type() );
        if ( $position > 1 ) echo $sep;
        echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->labels->name, $position );
        if ( $show_current ) echo $sep . $before . get_the_title() . $after;
        elseif ( $show_last_sep ) echo $sep;
      } else {
        $cat = get_the_category(); $catID = $cat[0]->cat_ID;
        $parents = get_ancestors( $catID, 'category' );
        $parents = array_reverse( $parents );
        $parents[] = $catID;
        foreach ( $parents as $cat ) {
          $position += 1;
          if ( $position > 1 ) echo $sep;
          echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
        }
        if ( get_query_var( 'cpage' ) ) {
          $position += 1;
          echo $sep . sprintf( $link, get_permalink(), get_the_title(), $position );
          echo $sep . $before . sprintf( $text['cpage'], get_query_var( 'cpage' ) ) . $after;
        } else {
          if ( $show_current ) echo $sep . $before . get_the_title() . $after;
          elseif ( $show_last_sep ) echo $sep;
        }
      }

    } elseif ( is_post_type_archive() ) {
      $post_type = get_post_type_object( get_post_type() );
      if ( get_query_var( 'paged' ) ) {
        $position += 1;
        if ( $position > 1 ) echo $sep;
        echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->label, $position );
        echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
      } else {
        if ( $show_home_link && $show_current ) echo $sep;
        if ( $show_current ) echo $before . $post_type->label . $after;
        elseif ( $show_home_link && $show_last_sep ) echo $sep;
      }

    } elseif ( is_attachment() ) {
      $parent = get_post( $parent_id );
      $cat = get_the_category( $parent->ID ); $catID = $cat[0]->cat_ID;
      $parents = get_ancestors( $catID, 'category' );
      $parents = array_reverse( $parents );
      $parents[] = $catID;
      foreach ( $parents as $cat ) {
        $position += 1;
        if ( $position > 1 ) echo $sep;
        echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
      }
      $position += 1;
      echo $sep . sprintf( $link, get_permalink( $parent ), $parent->post_title, $position );
      if ( $show_current ) echo $sep . $before . get_the_title() . $after;
      elseif ( $show_last_sep ) echo $sep;

    } elseif ( is_page() && ! $parent_id ) {
      if ( $show_home_link && $show_current ) echo $sep;
      if ( $show_current ) echo $before . get_the_title() . $after;
      elseif ( $show_home_link && $show_last_sep ) echo $sep;

    } elseif ( is_page() && $parent_id ) {
      $parents = get_post_ancestors( get_the_ID() );
      foreach ( array_reverse( $parents ) as $pageID ) {
        $position += 1;
        if ( $position > 1 ) echo $sep;
        echo sprintf( $link, get_page_link( $pageID ), get_the_title( $pageID ), $position );
      }
      if ( $show_current ) echo $sep . $before . get_the_title() . $after;
      elseif ( $show_last_sep ) echo $sep;

    } elseif ( is_tag() ) {
      if ( get_query_var( 'paged' ) ) {
        $position += 1;
        $tagID = get_query_var( 'tag_id' );
        echo $sep . sprintf( $link, get_tag_link( $tagID ), single_tag_title( '', false ), $position );
        echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
      } else {
        if ( $show_home_link && $show_current ) echo $sep;
        if ( $show_current ) echo $before . sprintf( $text['tag'], single_tag_title( '', false ) ) . $after;
        elseif ( $show_home_link && $show_last_sep ) echo $sep;
      }

    } elseif ( is_author() ) {
      $author = get_userdata( get_query_var( 'author' ) );
      if ( get_query_var( 'paged' ) ) {
        $position += 1;
        echo $sep . sprintf( $link, get_author_posts_url( $author->ID ), sprintf( $text['author'], $author->display_name ), $position );
        echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
      } else {
        if ( $show_home_link && $show_current ) echo $sep;
        if ( $show_current ) echo $before . sprintf( $text['author'], $author->display_name ) . $after;
        elseif ( $show_home_link && $show_last_sep ) echo $sep;
      }

    } elseif ( is_404() ) {
      if ( $show_home_link && $show_current ) echo $sep;
      if ( $show_current ) echo $before . $text['404'] . $after;
      elseif ( $show_last_sep ) echo $sep;

    } elseif ( has_post_format() && ! is_singular() ) {
      if ( $show_home_link && $show_current ) echo $sep;
      echo get_post_format_string( get_post_format() );
    }

    echo $wrap_after;

  }
} // end of dimox_breadcrumbs()
// editor button
function wpb_mce_buttons_2($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');

/*
* Callback function to filter the MCE settings
*/

function my_mce_before_init_insert_formats( $init_array ) {

// определение массива стилей

    $style_formats = array(
        array(
            'title' => 'Жирный',
            'inline' => 'span',
            'classes' => 'scor-bold-text',
            'wrapper' => false,
        ),
        array(
            'title' => 'Выделенный',
            'inline' => 'span',
            'classes' => 'scor-marked-text',
            'wrapper' => false,
        ),
    );
    $init_array['style_formats'] = json_encode( $style_formats );

    return $init_array;

}
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );
