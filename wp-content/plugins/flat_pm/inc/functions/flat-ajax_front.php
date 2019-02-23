<?php
function flat_pm_block_geo($method,$arr){
	$ip = $_SERVER['REMOTE_ADDR'];
	$ch = curl_init('http://pro.ip-api.com/json/'.$ip.'?key=SduzT5O3D4IUq1z&lang=ru');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$query = json_decode(curl_exec($ch));
	curl_close($ch);
	$data['country'] = '';
	$data['city'] = '';
	if($query && $query->status == 'success'){
		$data['country'] = $query->country;
		$data['city'] = $query->city;
	}
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

// !--sub_functions

add_action( 'wp_ajax_flat_pm_geo', 'ajax_hendler_flat_pm_geo' );
add_action( 'wp_ajax_nopriv_flat_pm_geo', 'ajax_hendler_flat_pm_geo' );
function ajax_hendler_flat_pm_geo(){
	$arr = $_REQUEST['data_me']['arr'];
	$method = $_REQUEST['data_me']['method'];
	switch ($method) {
		case 'flat_pm_block_geo':
			flat_pm_block_geo($method,$arr);
			break;
		default:
			die(json_encode('Ошибочный метод'));
			break;
	}
}
?>