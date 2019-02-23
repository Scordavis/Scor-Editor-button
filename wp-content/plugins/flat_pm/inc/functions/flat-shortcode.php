<?php
function flat_pm_shortcode_id(){
	global $post;
	return $post->ID;
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
function flat_pm_shortcode_url(){
	return $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
}

add_shortcode('flat_pm_url', 'flat_pm_shortcode_url');
add_shortcode('flat_pm_id', 'flat_pm_shortcode_id');
?>