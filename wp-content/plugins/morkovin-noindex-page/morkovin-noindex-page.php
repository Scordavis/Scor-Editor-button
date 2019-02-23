<?php
/*
  Plugin Name: Морковный ноиндекс для пагинации
  Description: Выводит noindex follow на пагинационных страницах в рубриках и метках
  Author: Andrey Morkovin
  Plugin URI: https://t.me/miminapifet
  Author URI: http://www.sdelaysite.com
  Version: 1.2
 */

add_action( 'wp_head', 'head_seo_meta_tags' );
function head_seo_meta_tags(){
	if ( is_archive() or is_front_page() ) {
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		if ($paged > 1) {
			echo "\n<!--Морковный ноиндекс-->\n";
			echo '<meta name="robots" content="noindex,follow"/>';
			echo "\n<!--/Морковный ноиндекс-->\n\n";
		}
	}
}