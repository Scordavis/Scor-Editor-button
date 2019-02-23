<?php
function flat_pm_block_pre_filter_content($content){
	if(!empty($content))
		$content = '<div class="flat_pm_start"></div>'.PHP_EOL.$content.PHP_EOL.'<div class="flat_pm_end"></div>';
	return $content;
}
function flat_pm_img_attr($content){
	$content = str_replace('<img', '<img data-flat-attr="img"', $content);
	return $content;
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
function flat_pm_filter_content(){
	wp_reset_postdata();
	wp_reset_query();
	global $post;
	$current_post = $post;
	switch (true) {
		case (is_home() || is_front_page()):
			$we_are_hear = 'is_home';
			break;
		case (is_archive() || is_category()):
			$we_are_hear = 'is_archive';
			break;
		case (is_single() || is_page()):
			$we_are_hear = 'is_single';
			break;
		default:
			break;
	}
	$args_flat_pm_inner_stack = array();
	$args_flat_pm = array(
		'posts_per_page'         => -1,
		'post_type'              => 'flat_pm_block',
		'order'                  => 'ASC',
		'orderby'                => 'meta_value_num',
		'meta_key'               => 'flat_pm_order_ID',
	);
	$query = new WP_Query( $args_flat_pm );
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$block_id        = $post->ID;
			$settings        = get_option( 'flat_plugin_settings_me' );
			$flat_pm_view    = get_post_meta($block_id, 'flat_pm_view', true);
			$flat_pm_geo     = get_post_meta($block_id, 'flat_pm_geo', true);
			$flat_pm_date    = get_post_meta($block_id, 'flat_pm_date', true);
			$flat_pm_html    = get_post_meta($block_id, 'flat_pm_html', true);
			$flat_pm_referer = get_post_meta($block_id, 'flat_pm_referer', true);
			$flat_pm_browser = get_post_meta($block_id, 'flat_pm_browser', true);
			$flat_pm_role    = get_post_meta($block_id, 'flat_pm_role', true);
			$flat_pm_os      = get_post_meta($block_id, 'flat_pm_os', true);
			if($flat_pm_view['view_enabled'] == 'true'){
				$output = $flat_pm_view;
				unset($output['view_enabled']);
				unset($output['where']);
				foreach ($flat_pm_html as $key => $value) {
					$flat_pm_html[$key]['html_main'] = do_shortcode($flat_pm_html[$key]['html_main']);
					$flat_pm_html[$key]['html_block'] = do_shortcode($flat_pm_html[$key]['html_block']);
				}
				unset($value);
				unset($key);
				$output['html'] = $flat_pm_html;
				if($flat_pm_geo['geo_enabled'] == 'true'){
					$output['geo'] = $flat_pm_geo;
					unset($output['geo']['geo_enabled']);
				}
				if($flat_pm_date['date_enabled'] == 'true'){
					$output['date'] = $flat_pm_date;
					$explode_date_from = explode('.', $output['date']['date_from']);
					$output['date']['date_from'] = $explode_date_from[2].'-'.((strlen($explode_date_from[1]) == 2) ? $explode_date_from[1] : '0'.$explode_date_from[1]).'-'.((strlen($explode_date_from[0]) == 2) ? $explode_date_from[0] : '0'.$explode_date_from[0]);
					$explode_date_to = explode('.', $output['date']['date_to']);
					$output['date']['date_to'] = $explode_date_to[2].'-'.((strlen($explode_date_to[1]) == 2) ? $explode_date_to[1] : '0'.$explode_date_to[1]).'-'.((strlen($explode_date_to[0]) == 2) ? $explode_date_to[0] : '0'.$explode_date_to[0]);
					$explode_time_from = explode(':', $output['date']['time_from']);
					$output['date']['time_from'] = ((strlen($explode_time_from[0]) == 2) ? $explode_time_from[0] : '0'.$explode_time_from[0]).':'.((strlen($explode_time_from[1]) == 2) ? $explode_time_from[1] : '0'.$explode_time_from[1]);
					$explode_time_to = explode(':', $output['date']['time_to']);
					$output['date']['time_to'] = ((strlen($explode_time_to[0]) == 2) ? $explode_time_to[0] : '0'.$explode_time_to[0]).':'.((strlen($explode_time_to[1]) == 2) ? $explode_time_to[1] : '0'.$explode_time_to[1]);
					unset($output['date']['date_enabled']);
				}
				if($flat_pm_referer != '' && $flat_pm_referer['enabled'] == 'true'){
					$output['referer'] = $flat_pm_referer;
					unset($output['referer']['enabled']);
				}
				if($flat_pm_browser != '' && $flat_pm_browser['enabled'] == 'true'){
					$output['browser'] = $flat_pm_browser;
					unset($output['browser']['enabled']);
				}
				if($flat_pm_os != '' && $flat_pm_os['enabled'] == 'true'){
					$output['os'] = $flat_pm_os;
					unset($output['os']['enabled']);
				}
				if($flat_pm_role != '' && $flat_pm_role['enabled'] == 'true'){
					$output['role'] = $flat_pm_role;
					unset($output['role']['enabled']);
				}
				if(
					$settings['referer']['referer_enabled'][0] != '' || 
					$settings['referer']['referer_disabled'][0] != ''
				){
					$output['global']['referer'] = $settings['referer'];
				}
				if($we_are_hear == 'is_single' && $flat_pm_view['where']['show_in_home'] != '2' && $flat_pm_view['where']['show_in_cat'] != '2'){
					$post_arr = array();
					$args_flat_pm_inner = array(
						'fields'         => 'ids',
						'posts_per_page' => -1,
						'post_type'      => $flat_pm_view['where']['type_of_posts'],
					);
					if(!empty($flat_pm_view['where']['posts_enabled'])){
						$args_flat_pm_inner['post__in'] = array();
						foreach ($flat_pm_view['where']['posts_enabled'] as $value) {
							$args_flat_pm_inner['post__in'] = array_merge($args_flat_pm_inner['post__in'], $value);
						}
						unset($value);
					}
					if(!empty($flat_pm_view['where']['posts_disabled'])){
						$args_flat_pm_inner['post__not_in'] = array();
						foreach ($flat_pm_view['where']['posts_disabled'] as $value) {
							$args_flat_pm_inner['post__not_in'] = array_merge($args_flat_pm_inner['post__not_in'], $value);
						}
						unset($value);
					}
					if(!empty($flat_pm_view['where']['tax_enabled']) || !empty($flat_pm_view['where']['tax_disabled']))
						$args_flat_pm_inner['tax_query'] = array('relation' => 'OR');
					if(!empty($flat_pm_view['where']['tax_enabled'])){
						foreach ($flat_pm_view['where']['tax_enabled'] as $key => $value) {
							$args_flat_pm_inner['tax_query'] []= array(
								'taxonomy' => $key,
								'field'    => 'id',
								'terms'    => $value,
								'operator' => 'IN',
							);
						}
						unset($value);
						unset($key);
					}
					if(!empty($flat_pm_view['where']['tax_disabled'])){
						foreach ($flat_pm_view['where']['tax_disabled'] as $key => $value) {
							$args_flat_pm_inner['tax_query'] []= array(
								'taxonomy' => $key,
								'field'    => 'id',
								'terms'    => $value,
								'operator' => 'NOT IN',
							);
						}
						unset($value);
						unset($key);
					}
					$stack_bool = true;
					if(!empty($args_flat_pm_inner_stack)){
						foreach ($args_flat_pm_inner_stack as $value_stack) {
							if($value_stack[0] == $args_flat_pm_inner){
								$stack_bool = false;
								$post_arr = $value_stack[1];
								break;
							}
						}
						unset($value_stack);
					}
					if($stack_bool){
						$query_inner = new WP_Query;
						$query_inner_posts = $query_inner->query( $args_flat_pm_inner );
						if($query_inner_posts){
							foreach( $query_inner_posts as $query_inner_post ){
								$post_arr []= $query_inner_post;
							}
							unset($query_inner_post);
						}
						$args_flat_pm_inner_stack []= array( $args_flat_pm_inner, $post_arr );
						unset($args_flat_pm_inner);
						unset($query_inner_posts);
						unset($query_inner);
					}
					if(in_array($current_post->ID, $post_arr)){
?>
<script type="text/javascript">
flat_pm_arr.push(<?php echo json_encode($output); ?>);
</script>
<?php
					}
				}
				if($we_are_hear == 'is_archive' && ($flat_pm_view['where']['show_in_cat'] == '1' || $flat_pm_view['where']['show_in_cat'] == '2')){
					$tax_enabled = array();
					if(!empty($flat_pm_view['where']['tax_enabled'])){
						foreach ($flat_pm_view['where']['tax_enabled'] as $value) {
							$tax_enabled = array_merge($tax_enabled, $value);
						}
						unset($value);
					}
					$tax_disabled = array();
					if(!empty($flat_pm_view['where']['tax_disabled'])){
						foreach ($flat_pm_view['where']['tax_disabled'] as $value) {
							$tax_disabled = array_merge($tax_disabled, $value);
						}
						unset($value);
					}
					if((in_array((string)get_queried_object()->term_id, $tax_enabled) || empty($tax_enabled)) && !in_array((string)get_queried_object()->term_id, $tax_disabled)){
?>
<script type="text/javascript">
flat_pm_arr.push(<?php echo json_encode($output); ?>);
</script>
<?php
					}
				}
				if($we_are_hear == 'is_home' && ($flat_pm_view['where']['show_in_home'] == '1' || $flat_pm_view['where']['show_in_home'] == '2')){
?>
<script type="text/javascript">
flat_pm_arr.push(<?php echo json_encode($output); ?>);
</script>
<?php
				}
			}
		}
	}
	wp_reset_postdata();
	unset($args_flat_pm_inner_stack);
	unset($args_flat_pm);
	unset($query);
}

add_filter( 'the_content', 'flat_pm_block_pre_filter_content', 1 );
add_filter( 'the_content', 'flat_pm_img_attr' );
add_filter( 'wp_footer', 'flat_pm_filter_content');
?>