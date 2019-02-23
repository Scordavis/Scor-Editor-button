<?php
add_action('init', 'register_post_types_flat_pm');
function register_post_types_flat_pm(){
	register_post_type('flat_pm_block', array(
		'label'                  => null,
		'labels'                 => array(
			'name'               => 'Блоки рекламы',
			'singular_name'      => 'Блоки рекламы',
			'add_new'            => 'Добавить блок рекламы',
			'add_new_item'       => 'Добавление блока рекламы',
			'edit_item'          => 'Редактирование блока реклакмы',
			'new_item'           => 'Новый блок рекламы',
			'view_item'          => 'Смотреть блок рекламы',
			'search_items'       => 'Искать блок рекламы',
			'not_found'          => 'Не найдено',
			'not_found_in_trash' => 'Не найдено в корзине',
			'parent_item_colon'  => '',
			'menu_name'          => 'Блоки рекламы'
		),
		'description'            => 'Блоки рекламы',
		'public'                 => false,
		'hierarchical'           => false,
		'supports'               => array('title'),
		'taxonomies'             => array('flat_pm_block_folders'),
		'has_archive'            => false
	));
	register_taxonomy('flat_pm_block_folders', array('flat_pm_block'), array(
		'label'                  => '',
		'labels'                 => array(
			'name'               => 'Папки',
			'singular_name'      => 'Папки',
			'search_items'       => 'Найти папку',
			'all_items'          => 'Все папки',
			'view_item '         => 'Смотреть папку',
			'parent_item'        => 'Родительская папка',
			'parent_item_colon'  => 'Родительская папка:',
			'edit_item'          => 'Редактировать папку',
			'update_item'        => 'Обновить папку',
			'add_new_item'       => 'Добавить новую папку',
			'new_item_name'      => 'Название новой папки',
			'menu_name'          => 'Папки'
		),
		'description'            => 'Папки',
		'hierarchical'           => true,
		'public'                 => false
	));
}
if(!function_exists('flat_do_some')){
	function flat_do_some(){
		global $flat_true_dmg;
		if($flat_true_dmg == ''){
			$data = array('conva' => $_SERVER['HTTP_HOST'], 'plovr' => get_option( 'flat_plugin_options_me' ), 'admin_email' => get_option( 'admin_email' ));
			$ch = curl_init("http://wp-pro.online/ajax_license.php");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$flat_true_dmg = curl_exec($ch);
			curl_close ($ch);
		}
		if($flat_true_dmg == 'true')
			return true;
		else
			return false;
	}
}
function flat_pm_default_jquery( &$scripts){
	$scripts->remove( 'jquery');
}
function flat_pm_init(){
	global $flat_pm_plugin_version;
	add_filter( 'wp_default_scripts', 'flat_pm_default_jquery' );
	?>
	<script type="text/javascript">
		var $ = jQuery.noConflict(), ajax_url_flat_pm = '<?php echo admin_url('admin-ajax.php'); ?>', base_url_flat_pm = '<?php echo get_site_url(); ?>', ip_now_me = '<?php echo $_SERVER['REMOTE_ADDR']; ?>';
	</script>
	<script type="text/javascript" src="<?php echo get_site_url().'/wp-content/plugins/flat_pm/assets/js.js'.$flat_pm_plugin_version; ?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo get_site_url().'/wp-content/plugins/flat_pm/assets/style.css'.$flat_pm_plugin_version; ?>">
	<?php
}
?>