<?php
define( 'DOING_AJAX', true);
define( 'SHORTINIT', true);

if(!isset($_REQUEST['action']))
	die('-1');

if(stristr(__FILE__, '/wp-content/plugins/flat_pm/inc/functions/flat-ajax.php') === FALSE)
	include_once $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';
else
	include_once str_replace('/wp-content/plugins/flat_pm/inc/functions/flat-ajax.php', '/wp-load.php', __FILE__);

header( 'Content-Type: text/html' );
header( 'X-Robots-Tag: noindex' );
send_nosniff_header();
header('Cache-Control: no-cache');
header('Pragma: no-cache');

// include_once ABSPATH . WPINC . '/formatting.php';
// include_once ABSPATH . WPINC . '/meta.php';
// include_once ABSPATH . WPINC . '/post.php';
include_once 'flat-ajax_front.php';

$action = htmlspecialchars(trim($_POST['action']));

$allowed_actions = array(
	'flat_pm_geo',
);

if(!in_array($action, $allowed_actions))
	die('-1');

do_action('wp_ajax_nopriv_'.$action);