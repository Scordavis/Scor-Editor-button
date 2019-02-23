<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,700,700i&subset=cyrillic" rel="stylesheet">
	<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet">
	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<!--[if lte IE 9]><script src="http://cdn.jsdelivr.net/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
	<!--[if gte IE 9]><style type="text/css">.gradient{filter: none;}</style><![endif]-->
	<?php 
	if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) wp_enqueue_script('comment-reply'); 
	wp_head(); ?>
	
	<link rel="icon" href="/favicon.ico" type="image/x-icon">
	
		<?php
	if ( is_front_page() || is_category() ) {
		?>
		<script src="<?php bloginfo('template_url'); ?>/js/jquery.bxslider.min.js"></script>
		<?php
	}

	//Цветовые настройки
	$section_color_1 = get_theme_mod('section_color_1');    
	$section_color_2 = get_theme_mod('section_color_2');    
	$section_color_3 = get_theme_mod('section_color_3');
	$section_color_4 = get_theme_mod('section_color_4');
	$section_color_5 = get_theme_mod('section_color_5');
	$section_color_6 = get_theme_mod('section_color_6');
	?>
	<script src="<?php bloginfo('template_url'); ?>/js/scripts.js"></script>
	
	<!-- Лайкли Ильи Бирмана -->
	<?php
	if ( is_single() ) { ?>
		<script src="<?php bloginfo('template_url'); ?>/likely/likely.js"></script>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/likely/likely.css"><?php
	}

	if (!$section_color_2) {
		$section_color_2 = '#5a5aa1';
	}
	if (!$section_color_3) {
		$section_color_3 = '#9187c4';
	}
	?>

	<style>/*1*/.main-menu, .sidebar-menu > ul > li:hover > a, .sidebar-menu > ul > li:hover > span, .sidebar-menu > ul > li > span, .sidebar-menu > ul li.active > a, .slider .bx-pager-item .active, .slider .bx-pager-item a:hover, .slider-posts-wrap .bx-pager-item .active, .slider-posts-wrap .bx-pager-item a:hover, .footer-bottom, .single ul li:before, .single ol li ul li:after, .single ol li:before, .add-menu > ul > li > a:hover, .add-menu > ul > li > span:hover, .main-menu__list > li > ul > li > a:hover, .main-menu__list > li > ul > li > span:hover, .cat-children__item a:hover, .related__item-img .related__item-cat > a:hover, .main-menu__list > li > ul > li > span, .main-menu__list > li > ul > li.current-post-parent > a, .add-menu > ul > li.current-post-parent > a, .add-menu > ul > li > span, .sidebar-menu > ul > .current-post-parent > a, .sidebar-menu > ul > li .menu-arrow:before, .sidebar-menu > ul > li .menu-arrow:after, .commentlist .comment .reply a:hover{background: <?php echo $section_color_1; ?>;}.title, .single #toc_container .toc_title{color: <?php echo $section_color_1; ?>;border-left: 4px solid <?php echo $section_color_1; ?>;}.description{border-top: 4px solid <?php echo $section_color_1; ?>;}.description__title, .single .wp-caption-text, .more, a:hover{color: <?php echo $section_color_1; ?>;}.commentlist .comment, .add-menu > ul > li > a, .add-menu > ul > li > span, .main-menu__list > li > ul > li > a, .main-menu__list > li > ul > li > span{border-bottom: 1px solid <?php echo $section_color_1; ?>;}.more span{border-bottom: 1px dashed <?php echo $section_color_1; ?>;}.slider-posts-wrap .bx-prev:hover, .slider-posts-wrap .bx-next:hover{background-color: <?php echo $section_color_1; ?>;border: 1px solid <?php echo $section_color_1;?>;}#up{border-bottom-color: <?php echo $section_color_1; ?>;}#up:before, .commentlist .comment .reply a{border: 1px solid <?php echo $section_color_1; ?>;}.respond-form .respond-form__button{background-color: <?php echo $section_color_1; ?>;}@media screen and (max-width: 1023px){.main-box{border-top: 50px solid <?php echo $section_color_1; ?>;}
		.m-nav{background: <?php echo $section_color_1; ?>;}.main-menu__list > li > ul > li > span{background: none;}.add-menu > ul > li > a, .add-menu > ul > li > span, .main-menu__list > li > ul > li > a, .main-menu__list > li > ul > li > span{border-bottom: 0;}.sidebar-menu > ul > li .menu-arrow:before, .sidebar-menu > ul > li .menu-arrow:after{background: #85ece7;}}/*2*/.add-menu__toggle{background: <?php echo $section_color_2 ?> url(<?php echo get_bloginfo('template_url') ?>/images/add-ico.png) center no-repeat;}.add-menu > ul > li > a, .related__item-img .related__item-cat > a, .main-menu__list > li > ul > li > a{background: <?php echo $section_color_2; ?>;}#up:hover{border-bottom-color: <?php echo $section_color_2; ?>;}#up:hover:before{border: 1px solid <?php echo $section_color_2; ?>;}a, .sidebar-menu > ul > li > ul > li > span, .sidebar-menu > ul > li > ul > li > a:hover, .sidebar-menu > ul > li > ul > li > span:hover, .sidebar-menu > ul > li > ul > li.current-post-parent > a, .footer-nav ul li a:hover{color: <?php echo $section_color_2; ?>;}.respond-form .respond-form__button:hover{background-color: <?php echo $section_color_2; ?>;}@media screen and (max-width: 1023px){.sidebar-menu > ul > li > a, .main-menu__list li > span, .main-menu__list li > a:hover, .main-menu__list li > span:hover, .main-menu__list li > ul, .main-menu__list > li.current-post-parent > a, .sidebar-menu > ul > li > span, .sidebar-menu > ul > .current-post-parent > a{background: <?php echo $section_color_2; ?>;}.main-menu__list > li > ul > li > a:hover, .main-menu__list > li > ul > li > span:hover, .main-menu__list > li > ul > li.current-post-parent > a{background: none;}}/*3*/.post-info__cat a, .post-info__comment{background: <?php echo $section_color_3; ?>;}.post-info__comment:after{border-color: rgba(0, 0, 0, 0) <?php echo $section_color_3; ?> rgba(0, 0, 0, 0) rgba(0, 0, 0, 0);}/*<1023*/@media screen and (max-width: 1023px){.add-menu > ul > li > a, .sidebar-menu > ul > li > a{background-color: <?php echo $section_color_1; ?>;}.add-menu > ul > li > span, .add-menu > ul > li.current-post-parent > a, .sidebar-menu > ul > li > ul{background-color: <?php echo $section_color_2; ?>;}}.single a, .commentlist .comment .reply a, .sidebar a{color: <?php echo $section_color_4; ?>;}.single a:hover, .commentlist .comment .reply a:hover, .sidebar a:hover{color: <?php echo $section_color_5; ?>;}.post-info .post-info__cat a:hover{background: <?php echo $section_color_6; ?>;}.posts__item .posts__item-title a:hover, .section-posts__item-title a:hover, .related .related__item a:hover{color: <?php echo $section_color_6; ?>; border-bottom: 1px solid <?php echo $section_color_6; ?>;}</style>

	<?php 
		ob_start();
		dynamic_sidebar('in_head');
		$in_head = ob_get_clean();
		$in_head = str_replace('<div class="textwidget custom-html-widget">', '', $in_head);
		$in_head = str_replace('</div>', '', $in_head);
		echo $in_head."\n";
	?>
</head>
<body>
	<?php
	ob_start();
	dynamic_sidebar('in_body');
	$in_body = ob_get_clean();
	$in_body = str_replace('<div class="textwidget custom-html-widget">', '', $in_body);
	$in_body = str_replace('</div>', '', $in_body);
	$in_body = str_replace('</noscript>', '</div></noscript>', $in_body);
	echo $in_body;
	?>

	<div id="main">
		<div class="wrapper">
			<header class="header">
				<?php
				if( is_front_page() ) { 
					?>
					<img src="<?php echo $logo_upload; ?>" class="logo" alt="<?php bloginfo('name'); ?>">
					<?php 
				} else { 
					?>
					<a href="<?php echo home_url(); ?>">
						<img src="<?php echo $logo_upload; ?>" class="logo" alt="<?php bloginfo('name'); ?>">
					</a>
					<?php 
				} ?>
				<div class="m-nav">
					<?php
					require 'search-form.php';

					if ($social_ok || $social_yt || $social_fb || $social_gp || $social_tw || $social_in || $social_vk) {
						?>
						<div class="social-icon">
							<?php
							if ($social_ok) echo "<a href='". $social_ok ."' target='_blank' class='ok'>ok</a>";
							if ($social_yt) echo "<a href='". $social_yt ."' target='_blank' class='yt'>yt</a>";
							if ($social_fb) echo "<a href='". $social_fb ."' target='_blank' class='fb'>fb</a>";
							if ($social_gp) echo "<a href='". $social_gp ."' target='_blank' class='gp'>gp</a>";
							if ($social_tw) echo "<a href='". $social_tw ."' target='_blank' class='tw'>tw</a>";
							if ($social_in) echo "<a href='". $social_in ."' target='_blank' class='in'>in</a>";
							if ($social_vk) echo "<a href='". $social_vk ."' target='_blank' class='vk'>vk</a>";
							?>
						</div>
						<?php
					}

					$nav = wp_nav_menu(
					array(
					    'theme_location' =>'nav_main',
					    'container' => false,
					    'items_wrap' => '<ul class="main-menu__list">%3$s</ul>',
					    'fallback_cb' => false,
					    'echo' => false,
					    'depth' => 2,
					)); 

					$nav_m = wp_nav_menu(
		    		array(
		    		    'theme_location' =>'nav_m',
		    		    'container' => false,
		    		    'items_wrap' => '<ul class="main-menu__list main-menu__list_m">%3$s</ul>',
		    		    'fallback_cb' => false,
		    		    'echo' => false,
		    		    'depth' => 2,
		    		));

					if ($nav or $nav_m) {
						$sticky_class = '';
						$no_main_menu = '';

						if (!$nav) {
							$no_main_menu = ' no_main_menu';
						} else {
							if ($sticky_top_menu) {
								$sticky_class = " sticky_menu";
							}
						}
						?>
						<nav class="main-menu<?php echo $no_main_menu; ?><?php echo $sticky_class; ?>">
					    	<div class="main-menu__inner" data-menu-anchor="<?php echo get_theme_mod('menu_аnchor', 0); ?>">
					    		<?php 
					    		echo $nav;

					    		echo $nav_m;

					    		$nav_add = wp_nav_menu(
					    		array(
					    		    'theme_location' =>'nav_add',
					    		    'container' => false,
					    		    'items_wrap' => '<div class="add-menu"><div class="add-menu__toggle">add-toggle</div><ul>%3$s</ul></div>',
					    		    'fallback_cb' => false,
					    		    'echo' => false,
					    		    'depth' => 1,
					    		)); 
					    		if ($nav_add) {
					    		    echo $nav_add;
					    		} ?>
					    	</div>
						</nav>
						<?php
					} ?>
				</div>
			</header>
			<div class="main-box">
				<?php if ( function_exists( 'dimox_breadcrumbs' ) ) dimox_breadcrumbs(); ?>