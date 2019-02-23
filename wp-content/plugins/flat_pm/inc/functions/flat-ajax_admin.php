<?php
function flat_pm_AB_f($html){
	$group_bool = false;
	foreach ($html as $value) {
		if($value['group'] != '0')
			$group_bool = true;
	}
	unset($value);
	if($group_bool == false)
		$output = 'Нет';
	else
		$output = 'Да';
	return $output;
}
function flat_pm_block_update($method,$arr){
	$current_user_ID   = wp_get_current_user()->ID;
	$flat_pm_html      = $arr['html'];
	$flat_pm_view      = $arr['view'];
	$flat_pm_date      = $arr['date'];
	$flat_pm_geo       = $arr['geo'];
	$flat_pm_referer   = $arr['referer'];
	$flat_pm_browser   = $arr['browser'];
	$flat_pm_os        = $arr['os'];
	$flat_pm_role      = $arr['role'];
	$flat_pm_count_sub = count($arr['html']);
	$flat_pm_AB        = flat_pm_AB_f($arr['html']);
	$block_enabled     = ($arr['view']['view_enabled'] == 'true') ? 1 : 0;

	$args = array(
		'ID'             => (int)$arr['ID'],
		'post_author'    => $new_post_author,
		'post_title'     => $arr['name_of_block'],
		'post_status'    => 'publish',
		'post_type'      => 'flat_pm_block'
	);
	$upd_post_id = wp_update_post( $args );

	foreach ($flat_pm_html as $key => $value) {
		if(!isset($value['resolution_from']) || $value['resolution_from'] == '')
			$flat_pm_html[$key]['resolution_from'] = '∞';
		if(!isset($value['resolution_to']) || $value['resolution_to'] == '')
			$flat_pm_html[$key]['resolution_to'] = '∞';
	}
	unset($value);
	unset($key);

	if(!flat_do_some()){
		foreach ($flat_pm_html as $key => $value) {
			$flat_pm_html[$key]['group'] = '0';
			$flat_pm_html[$key]['resolution_from'] = '∞';
			$flat_pm_html[$key]['resolution_to'] = '∞';
		}
		unset($value);
		unset($key);
		$flat_pm_geo['geo_enabled'] = 'false';
		$flat_pm_geo['city_enabled'] = array('');
		$flat_pm_geo['city_disabled'] = array('');
		$flat_pm_geo['country_enabled'] = array('');
		$flat_pm_geo['country_disabled'] = array('');
		$flat_pm_referer['enabled'] = 'false';
		$flat_pm_referer['referer_enabled'] = array('');
		$flat_pm_referer['referer_disabled'] = array('');
		$flat_pm_browser['enabled'] = 'false';
		$flat_pm_browser['browser_enabled'] = array('');
		$flat_pm_browser['browser_disabled'] = array('');
		$flat_pm_os['enabled'] = 'false';
		$flat_pm_os['os_enabled'] = array('');
		$flat_pm_os['os_disabled'] = array('');
		unset($flat_pm_view['where']['posts_enabled']);
		unset($flat_pm_view['where']['posts_disabled']);
		unset($flat_pm_view['where']['tax_enabled']);
		unset($flat_pm_view['where']['tax_disabled']);
		$flat_pm_role['enabled'] = 'false';
		unset($flat_pm_role['role_enabled']);
		unset($flat_pm_role['role_disabled']);
		$flat_pm_view['where']['show_in_cat'] = '0';
		$flat_pm_view['where']['show_in_home'] = '0';
		$flat_pm_date['date_enabled'] = 'false';
		$flat_pm_date['date_time_enabled'] = 'false';
		$flat_pm_date['time_from'] = '';
		$flat_pm_date['time_to'] = '';
		$flat_pm_date['date_date_enabled'] = 'false';
		$flat_pm_date['date_from'] = '13.3.2018';
		$flat_pm_date['date_to'] = '13.3.2018';
	}
	update_post_meta((int)$arr['ID'], 'flat_pm_block_enabled', (int)$block_enabled);
	update_post_meta((int)$arr['ID'], 'flat_pm_html',               $flat_pm_html);
	update_post_meta((int)$arr['ID'], 'flat_pm_view',               $flat_pm_view);
	update_post_meta((int)$arr['ID'], 'flat_pm_date',               $flat_pm_date);
	update_post_meta((int)$arr['ID'], 'flat_pm_geo',                $flat_pm_geo);
	update_post_meta((int)$arr['ID'], 'flat_pm_role',               $flat_pm_role);
	update_post_meta((int)$arr['ID'], 'flat_pm_os',                 $flat_pm_os);
	update_post_meta((int)$arr['ID'], 'flat_pm_referer',            $flat_pm_referer);
	update_post_meta((int)$arr['ID'], 'flat_pm_browser',            $flat_pm_browser);
	update_post_meta((int)$arr['ID'], 'flat_pm_count_sub',          $flat_pm_count_sub);
	update_post_meta((int)$arr['ID'], 'flat_pm_AB',                 $flat_pm_AB);

	die(json_encode(array($method,array('ID' => $arr['ID']))));
}
function flat_pm_block_create($method,$arr){
	$current_user_ID   = wp_get_current_user()->ID;
	$flat_pm_html      = $arr['html'];
	$flat_pm_view      = $arr['view'];
	$flat_pm_date      = $arr['date'];
	$flat_pm_geo       = $arr['geo'];
	$flat_pm_referer   = $arr['referer'];
	$flat_pm_browser   = $arr['browser'];
	$flat_pm_os        = $arr['os'];
	$flat_pm_role      = $arr['role'];
	$flat_pm_count_sub = count($arr['html']);
	$flat_pm_AB        = flat_pm_AB_f($arr['html']);
	$block_enabled     = ($arr['view']['view_enabled'] == 'true') ? 1 : 0;

	$args = array(
		'post_author'    => $new_post_author,
		'post_title'     => $arr['name_of_block'],
		'post_status'    => 'publish',
		'post_type'      => 'flat_pm_block'
	);
	$new_post_id = wp_insert_post( $args );

	foreach ($flat_pm_html as $key => $value) {
		if(!isset($value['resolution_from']) || $value['resolution_from'] == '')
			$flat_pm_html[$key]['resolution_from'] = '∞';
		if(!isset($value['resolution_to']) || $value['resolution_to'] == '')
			$flat_pm_html[$key]['resolution_to'] = '∞';
	}
	unset($value);
	unset($key);

	if(!flat_do_some()){
		foreach ($flat_pm_html as $key => $value) {
			$flat_pm_html[$key]['group'] = '0';
			$flat_pm_html[$key]['resolution_from'] = '∞';
			$flat_pm_html[$key]['resolution_to'] = '∞';
		}
		unset($value);
		unset($key);
		$flat_pm_geo['geo_enabled'] = 'false';
		$flat_pm_geo['city_enabled'] = array('');
		$flat_pm_geo['city_disabled'] = array('');
		$flat_pm_geo['country_enabled'] = array('');
		$flat_pm_geo['country_disabled'] = array('');
		$flat_pm_referer['enabled'] = 'false';
		$flat_pm_referer['referer_enabled'] = array('');
		$flat_pm_referer['referer_disabled'] = array('');
		$flat_pm_browser['enabled'] = 'false';
		$flat_pm_browser['browser_enabled'] = array('');
		$flat_pm_browser['browser_disabled'] = array('');
		$flat_pm_os['enabled'] = 'false';
		$flat_pm_os['os_enabled'] = array('');
		$flat_pm_os['os_disabled'] = array('');
		unset($flat_pm_view['where']['posts_enabled']);
		unset($flat_pm_view['where']['posts_disabled']);
		unset($flat_pm_view['where']['tax_enabled']);
		unset($flat_pm_view['where']['tax_disabled']);
		$flat_pm_role['enabled'] = 'false';
		unset($flat_pm_role['role_enabled']);
		unset($flat_pm_role['role_disabled']);
		$flat_pm_view['where']['show_in_cat'] = '0';
		$flat_pm_view['where']['show_in_home'] = '0';
		$flat_pm_date['date_enabled'] = 'false';
		$flat_pm_date['date_time_enabled'] = 'false';
		$flat_pm_date['time_from'] = '';
		$flat_pm_date['time_to'] = '';
		$flat_pm_date['date_date_enabled'] = 'false';
		$flat_pm_date['date_from'] = '13.3.2018';
		$flat_pm_date['date_to'] = '13.3.2018';
	}
	update_post_meta((int)$new_post_id, 'flat_pm_order_ID',      (int)$new_post_id);
	update_post_meta((int)$new_post_id, 'flat_pm_block_enabled', (int)$block_enabled);
	update_post_meta((int)$new_post_id, 'flat_pm_html',               $flat_pm_html);
	update_post_meta((int)$new_post_id, 'flat_pm_view',               $flat_pm_view);
	update_post_meta((int)$new_post_id, 'flat_pm_date',               $flat_pm_date);
	update_post_meta((int)$new_post_id, 'flat_pm_geo',                $flat_pm_geo);
	update_post_meta((int)$new_post_id, 'flat_pm_role',               $flat_pm_role);
	update_post_meta((int)$new_post_id, 'flat_pm_os',                 $flat_pm_os);
	update_post_meta((int)$new_post_id, 'flat_pm_referer',            $flat_pm_referer);
	update_post_meta((int)$new_post_id, 'flat_pm_browser',            $flat_pm_browser);
	update_post_meta((int)$new_post_id, 'flat_pm_count_sub',          $flat_pm_count_sub);
	update_post_meta((int)$new_post_id, 'flat_pm_AB',                 $flat_pm_AB);

	die(json_encode(array($method,array('ID' => $new_post_id))));
}
function flat_pm_block_activate($method,$arr){
	foreach ($arr as $value) {
		update_post_meta((int)$value['block_ID'],'flat_pm_block_enabled',(int)$value['enabled']);
		$flat_pm_view = get_post_meta((int)$value['block_ID'], 'flat_pm_view', true);
		$flat_pm_view['view_enabled'] = ((int)$value['enabled'] == 1) ? 0 : 1;
		update_post_meta((int)$value['block_ID'],'flat_pm_view',$flat_pm_view);
	}
	unset($value);
	die(json_encode(array($method,$data)));
}
function flat_pm_block_copy($method,$arr){
	global $wpdb;
	$post_id = $arr['block_ID'];
	$post = get_post( $post_id );
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;
	if (isset( $post ) && $post != null) {
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => $post->post_status,
			'post_title'     => $post->post_title.' (копия)',
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);
		$new_post_id = wp_insert_post( $args );
		$taxonomies = get_object_taxonomies($post->post_type);
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}
		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos)!=0) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) {
				$meta_key = $meta_info->meta_key;
				if( $meta_key == '_wp_old_slug' ) continue;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query.= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		}
		$taxonomy = 'flat_pm_block_folders';
			$terms = get_terms( $taxonomy, array('fields'=>'ids'));
			$args_flat_pm = array(
				'post_type'        => 'flat_pm_block',
				'p'                => $new_post_id
			);
			$query = new WP_Query( $args_flat_pm );
			ob_start();
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					$block_id = get_the_ID();
			?>
			<div class="item_flat_block new_item_flat_block" data-block-id="<?php echo $block_id; ?>" style="overflow:hidden!important;opacity:0!important;max-height:0px!important;padding:0 20px!important">
				<div class="top_of_block">
					<input type="checkbox" name="check_block_id_<?php echo $block_id; ?>" id="check_block_id_<?php echo $block_id; ?>"><label for="check_block_id_<?php echo $block_id; ?>"></label>
					<a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=blocks_form&block_id=<?php echo $block_id; ?>" class="name_of_block"><?php echo get_the_title(); ?></a>
					<div class="float_right">
						<a href="" class="to_top_block"></a>
						<a href="" class="to_bottom_block"></a>
					</div>
					<div class="float_right">
						<a href="" class="delete_this_block" title="Удалить блок"></a>
						<a href="" class="copy_this_block" title="Копировать блок"></a>
						<a href="" class="disable_this_block" title="Активировать?" data-enabled="<?php echo get_post_meta($block_id, 'flat_pm_block_enabled', true); ?>"></a>
					</div>
					<a class="more_of_this"></a>
				</div>
				<div class="bottom_of_block flat_clear">
					<div class="some_stat_block" style="margin:0">
					</div>
					<div class="some_stat_block">
					</div>
				</div>
			</div>
			<?php
				}
			}
			wp_reset_postdata();
			$output = ob_get_contents();
			ob_end_clean();
		die(json_encode(array($method,array('html' => $output))));
	}else{
		die(json_encode(array($method,'Не удалось скопировать блок')));
	}
}
function flat_pm_block_delete($method,$arr){
	foreach ($arr['block_id_arr'] as $value) {
		wp_delete_post($value);
	}
	unset($value);
	die(json_encode(array($method,$data)));
}
function flat_pm_block_move($method,$arr){
	$first = explode('|', $arr[0]);
	$second = explode('|', $arr[1]);
	update_post_meta((int)$first[0],'flat_pm_order_ID',(int)$first[1]);
	update_post_meta((int)$second[0],'flat_pm_order_ID',(int)$second[1]);
	die(json_encode(array($method,$data)));
}
function flat_pm_move_to_folder($method,$arr){
	$cat_id = (int)$arr['cat_id'];
	$block_id_arr = $arr['block_id_arr'];
	if($cat_id != 0){
		foreach ($block_id_arr as $block_id) {
			wp_set_object_terms($block_id,array($cat_id),'flat_pm_block_folders',false);
		}
	}else{
		foreach ($block_id_arr as $block_id) {
			wp_set_object_terms($block_id,NULL,'flat_pm_block_folders',false);
		}
	}
	unset($block_id);
	die(json_encode(array($method,$data)));
}
function flat_pm_folder_add($method,$arr){
	wp_insert_term($arr,'flat_pm_block_folders');
	die(json_encode(array($method,$data)));
}
function flat_pm_folder_remove($method,$arr){
	wp_delete_term($arr,'flat_pm_block_folders');
	die(json_encode(array($method,$data)));
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
function flat_pm_folder_rename($method,$arr){
	wp_update_term($arr['id'],'flat_pm_block_folders',array(
		'name' => $arr['name']
	));
	die(json_encode(array($method,$data)));
}
function flat_pm_settings_update($method,$arr){
	if(!flat_do_some()){
		$arr['referer']['enabled'] = 'false';
		$arr['referer']['referer_enabled'] = array('');
		$arr['referer']['referer_disabled'] = array('');
		$arr['role']['enabled'] = 'false';
		unset($arr['role']['role_enabled']);
		unset($arr['role']['role_disabled']);
	}
	update_option('flat_plugin_settings_me', $arr);
	die(json_encode(array($method,$data)));
}

// !--sub_functions

add_action( 'wp_ajax_flat_pm_admin', 'ajax_hendler_flat_pm_admin' );
function ajax_hendler_flat_pm_admin(){
	$arr = $_REQUEST['data_me']['arr'];
	$method = $_REQUEST['data_me']['method'];
	switch ($method) {
		case 'block_update':
			flat_pm_block_update($method,$arr);
			break;
		case 'block_create':
			flat_pm_block_create($method,$arr);
			break;
		case 'block_activate':
			flat_pm_block_activate($method,$arr);
			break;
		case 'block_copy':
			flat_pm_block_copy($method,$arr);
			break;
		case 'block_delete':
			flat_pm_block_delete($method,$arr);
			break;
		case 'block_move':
			flat_pm_block_move($method,$arr);
			break;
		case 'move_to_folder':
			flat_pm_move_to_folder($method,$arr);
			break;
		case 'folder_add':
			flat_pm_folder_add($method,$arr);
			break;
		case 'folder_remove':
			flat_pm_folder_remove($method,$arr);
			break;
		case 'folder_rename':
			flat_pm_folder_rename($method,$arr);
			break;
		case 'settings_update':
			flat_pm_settings_update($method,$arr);
			break;
		default:
			die(json_encode('Ошибочный метод'));
			break;
	}
}
?>