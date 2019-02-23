<aside class="sidebar<?php if ( !is_front_page() ) echo ' sidebar_midle' ?>">
    <?php 
    $cur_cat = get_query_var('cat');

    if ( !function_exists ( 'dynamic_sidebar' ) || !dynamic_sidebar ( 'Верх сайдбара' ) ) {}

    $nav = wp_nav_menu(
    array(
        'theme_location' =>'nav_sidebar',
        'container' => false,
        'items_wrap' => '<div class="sidebar-menu"><div class="title">Рубрики</div><ul>%3$s</ul></div>',
        'fallback_cb' => false,
        'echo' => false,
        'depth' => 2,
    )); 
    if ($nav) {
        echo $nav;
    } 

    if ( !is_front_page() ) {
        require 'sidebar-popular.php';
    }

    if ( !function_exists ('dynamic_sidebar') || !dynamic_sidebar ('Низ сайдбара') ) {} ?>

</aside>