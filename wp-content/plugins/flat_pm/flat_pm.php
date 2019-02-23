<?php
/*
Plugin Name: Flat Profit Maker
Plugin URI: http://wp-pro.online
Description: Плагин для вывода рекламных (и не только) блоков. Увеличиваем конверсию в промышленных масштабах! Отдельное спасибо за тестирование Александру Нестерову
Version: 2.36
Author: Михаил Flat
Author URI: https://vk.com/flat41
*/

$flat_pm_plugin_version = '?2.36';

include_once 'inc/functions/flat-core.php';
include_once 'inc/functions/flat-ajax_admin.php';
include_once 'inc/functions/flat-ajax_front.php';
include_once 'inc/functions/flat-shortcode.php';
include_once 'inc/functions/flat-scripts.php';
include_once 'inc/functions/flat-filter_content.php';
include_once 'inc/updater/plugin-update-checker.php';

$MyUpdateChecker = PucFactory::buildUpdateChecker('http://wp-pro.online/updates/?action=get_metadata&slug=flat_pm',__FILE__,'flat_pm');

class Flat_pm_object{
	function __construct(){
		add_action('admin_menu', array(&$this, 'flat_admin') );
	}
	function flat_admin (){
		register_setting( 'flat_plugin_field', 'flat_plugin_options_me');
		if(get_option( 'flat_plugin_options_me' ) == false )
			update_option('flat_plugin_options_me', '');

		register_setting( 'flat_plugin_field_settings', 'flat_plugin_settings_me');
		if(get_option( 'flat_plugin_settings_me' ) == false )
			update_option('flat_plugin_settings_me', array());

		add_menu_page( 'Основные настройки', 'Flat PM', 8, 'blocks_form', '', 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiID8+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+Cjxzdmcgd2lkdGg9IjEzMHB0IiBoZWlnaHQ9IjE1MHB0IiB2aWV3Qm94PSIwIDAgMzc5IDU0OCIgdmVyc2lvbj0iMS4xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8cGF0aCBmaWxsPSIjYTBhNWFhIiBkPSIgTSAwLjY3IDAuMDAgTCAzNzkuMDAgMC4wMCBMIDM3OS4wMCAwLjAwIEMgMzQwLjg4IDQ0LjM2IDMwMy4xNyA4OS4wOSAyNjQuOTQgMTMzLjM0IEMgMjA3LjcyIDEzMy4zNiAxNTAuNTEgMTMzLjIyIDkzLjMwIDEzMy40MSBDIDkyLjMyIDEyOC42NCA5My40MyAxMjMuODMgOTMuMjEgMTE5LjAyIEMgOTMuMDkgMTE0LjU3IDkzLjU1IDExMC4xMiA5My40NCAxMDUuNjcgQyAxNDUuNzcgMTA1LjYzIDE5OC4xMSAxMDUuNzkgMjUwLjQ0IDEwNS41OSBDIDI3MS41NyA4MS4zNiAyOTIuNzIgNTcuMTUgMzEzLjg3IDMyLjk0IEMgMzE1Ljc5IDMwLjc3IDMxNy44OSAyOC43MCAzMTkuMjcgMjYuMTIgQyAyMjIuNjMgMjYuMTEgMTI1Ljk4IDI2LjA0IDI5LjMzIDI2LjE1IEMgMjkuMzAgMTAwLjg4IDI5LjM1IDE3NS42MSAyOS4zMCAyNTAuMzQgQyAxOS43NyAyNTAuMzMgMTAuMjMgMjUwLjMwIDAuNzAgMjUwLjM0IEMgMC42NSAxNjYuOTAgMC43MCA4My40NSAwLjY3IDAuMDAgWiBNIDkyLjYzIDE2OS4yMSBDIDE3Mi4xNSAxNjkuMjAgMjUxLjY4IDE2OS4xOCAzMzEuMjEgMTY5LjIzIEMgMzMwLjg2IDE2OS42MiAzMzAuMTcgMTcwLjQxIDMyOS44MiAxNzAuODAgQyAzMjIuMDcgMTgxLjA1IDMxNC4xMCAxOTEuMTUgMzA2LjI4IDIwMS4zNCBMIDMwNS41OCAyMDEuNjIgQyAzMDUuNTkgMjAzLjAyIDMwNC4yNSAyMDMuNzcgMzAzLjU1IDIwNC44MSBDIDI5NS40NyAyMTUuMzMgMjg3LjM1IDIyNS44MSAyNzkuMjEgMjM2LjI5IEMgMjc3Ljc3IDIzOC4xNiAyNzYuNTIgMjQwLjE5IDI3NC43MSAyNDEuNzUgQyAyNjcuMDYgMjUyLjUxIDI1OC40OCAyNjIuODIgMjUwLjUxIDI3My40MyBDIDIzOS4zMyAyODcuNjAgMjI4LjYwIDMwMi4xNSAyMTcuMTkgMzE2LjEyIEMgMTk5LjEyIDMxNS45MCAxODEuMDQgMzE2LjQyIDE2Mi45OSAzMTUuNzkgQyAxNDIuNjYgMzE1LjcxIDEyMi4zMiAzMTUuOTUgMTAxLjk5IDMxNS42NyBDIDc3LjU2IDMxNS4zNyA1My4xMCAzMTUuNzQgMjguNjggMzE1LjM4IEMgMjguOTcgMzcyLjY2IDI4LjY0IDQyOS45NCAyOC44NCA0ODcuMjIgQyAzMS45OCA0ODUuMzAgMzQuMTUgNDgyLjE5IDM3LjIzIDQ4MC4yMiBDIDU3LjUzIDQ2Mi4wOSA3OC4xNCA0NDQuMjkgOTguNDkgNDI2LjI3IEMgOTguOTAgMzk2Ljk0IDk4LjYyIDM2Ny41NSA5OC42MyAzMzguMjAgQyAxMDcuODcgMzM4LjIyIDExNy4xMSAzMzguMjMgMTI2LjM2IDMzOC4xOSBDIDEyNi4zNCAzNzIuMjggMTI2LjIxIDQwNi4zOCAxMjYuNDIgNDQwLjQ2IEMgMTAwLjkxIDQ2Mi41NiA3NS4wMyA0ODQuMjggNDkuNDkgNTA2LjM0IEMgNDQuNzkgNTA5Ljk3IDQwLjU4IDUxNC4zMiAzNS43NiA1MTcuNzIgQyAyNC45MyA1MjcuNjAgMTMuNDQgNTM2LjgyIDIuNDEgNTQ2LjUxIEMgMi4wNiA1NDYuNjIgMS4zNSA1NDYuODUgMS4wMCA1NDYuOTYgQyAwLjkxIDU0Ni4yMiAwLjc0IDU0NC43NSAwLjY1IDU0NC4wMSBDIDAuNzEgNDYzLjM2IDAuNjMgMzgyLjcyIDAuNjggMzAyLjA3IEMgMC43NSAyOTYuMjggMC40MiAyOTAuNDcgMC44OCAyODQuNjkgQyA1OC41OSAyODQuNjUgMTE2LjI5IDI4NC42OCAxNzQuMDAgMjg0LjY3IEMgMTg1LjQxIDI4NC41NiAxOTYuODIgMjg0LjkwIDIwOC4yMSAyODQuNDkgQyAyMDguNjkgMjgyLjc0IDIxMC4yMyAyODEuNjUgMjExLjE1IDI4MC4xNiBDIDIyMC41MiAyNjguMjAgMjI5Ljc2IDI1Ni4xMSAyMzkuMTkgMjQ0LjIwIEMgMjUxLjMxIDIyOC4yMyAyNjMuOTYgMjEyLjYyIDI3NS45NyAxOTYuNTUgQyAyMTQuODcgMTk2LjU2IDE1My43NyAxOTYuNTQgOTIuNjggMTk2LjU3IEMgOTIuNjQgMTg3LjQ1IDkyLjczIDE3OC4zMyA5Mi42MyAxNjkuMjEgWiIgLz4KPC9zdmc+Cg==' );
		add_submenu_page( 'blocks_form', 'Ваши блоки', 'Ваши блоки', 8, 'blocks_form', array(&$this, 'blocks_form') );
		add_submenu_page( 'blocks_form', 'Добавить блок', '+ Добавить блок', 8, 'add_blocks_form', array(&$this, 'add_blocks_form') );
		add_submenu_page( 'blocks_form', 'Настройки', 'Настройки', 8, 'settings_form', array(&$this, 'settings_form') );
		add_submenu_page( 'blocks_form', 'Лицензия', 'Лицензия', 8, 'license_form', array(&$this, 'license_form') );
	}
	function blocks_form(){
		flat_pm_init();
		include_once 'inc/blocks_form/blocks_form.php';
	}
	function add_blocks_form(){
		flat_pm_init();
		include_once 'inc/blocks_form/add_blocks_form.php';
	}
	function settings_form(){
		flat_pm_init();
		include_once 'inc/settings_form/settings_form.php';
	}
	function license_form(){
		flat_pm_init();
		include_once 'inc/settings_form/license_form.php';
	}
}

$Flat_pm_object = new Flat_pm_object();
?>