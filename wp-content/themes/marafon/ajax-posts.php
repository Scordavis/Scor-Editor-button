<?php
header('Content-Type: text/html; charset=utf-8');

require_once("../../../wp-load.php");

$excerpt_or_content = get_theme_mod('excerpt_or_content', 'Опции не существует'); 
if (!$excerpt_or_content) $excerpt_or_content = 1;

if ( isset($_GET['offset']) ) $offset = $_GET['offset'];
if ( isset($_GET['items']) ) $items = $_GET['items'];
if ( isset($_GET['newposts']) ) $newposts = $_GET['newposts'];
if ( isset($_GET['cat']) ) $cat_posts = $_GET['cat'];
if ( isset($_GET['tag']) ) $cat_tag = $_GET['tag'];
if ( isset($_GET['search']) ) $search_query = $_GET['search'];

if ( isset($newposts) ) {
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => $items,
		'offset' => $offset,
	);
	$loop = new WP_Query($args);
	if ( $loop->post_count < $items ) {
		$last_item = " last_item";
	}  
	if ($loop->have_posts()) { 
		?>
		<div class="posts posts_home ajax_pagination<?php echo $last_item; ?>">
			<?php 
			$i = 1;
			while ($loop->have_posts()) { $loop->the_post();
				require 'loop.php';
		 	} ?>
		</div>
		<?php 
	} 
}

if ( isset($cat_posts) ) { 
	$loop = new WP_Query("posts_per_page=$items&offset=$offset&cat=$cat_posts"); 
	if ( $loop->post_count < $items ) {
		$last_item = " last_item";
	} 
	if ($loop->have_posts()) { 
		?>
		<div class="posts cat-posts cat-posts_ajax ajax_pagination<?php echo $last_item; ?>">
			<?php 
			$i = 1;
			while ($loop->have_posts()) { $loop->the_post();
				require 'loop-category.php';
		 	} ?>
		</div>
		<?php 
	} 
}

if ( isset($cat_tag) ) { 
	$loop = new WP_Query("posts_per_page=$items&offset=$offset&tag_id=$cat_tag");
	if ( $loop->post_count < $items ) {
		$last_item = " last_item";
	} 
	if ($loop->have_posts()) { 
		?>
		<div class="posts cat-posts cat-posts_ajax ajax_pagination<?php echo $last_item; ?>">
			<?php 
			$i = 1;
			while ($loop->have_posts()) { $loop->the_post();
				require 'loop-category.php';
		 	} ?>
		</div>
		<?php 
	}  
}

if ( isset($search_query) ) { 
	$loop = new WP_Query("posts_per_page=$items&offset=$offset&s=$search_query");
	if ( $loop->post_count < $items ) {
		$last_item = " last_item";
	} 
	if ($loop->have_posts()) { 
		?>
		<div class="posts cat-posts cat-posts_ajax ajax_pagination<?php echo $last_item; ?>">
			<?php 
			$i = 1;
			while ($loop->have_posts()) { $loop->the_post();
				require 'loop-category.php';
		 	} ?>
		</div>
		<?php 
	}  
} 