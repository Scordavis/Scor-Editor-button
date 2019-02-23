<?php
$cur_cat = get_query_var('cat');
$page_id = $wp_query->get_queried_object_id();

if( is_single() ) {

	$categories = get_the_category();
	$cat_in = array();
	foreach ($categories as $item) {
		$cat_in[] = $item->term_id;
	}

	$args = array(
		'posts_per_page' => 3,
		'category__in' => $cat_in,
		'meta_key' => 'post_views_count',
		'orderby' => 'meta_value_num',
		'post__not_in' => array($page_id),
	);
		
} elseif ( is_category() ) {
		
	$child_args = array(
		'child_of' => $cur_cat,
	);

	$child_categories = array();
	$child_categories = get_categories($child_args);
	$cat_in_array[] = $cur_cat;

	if( count($child_categories) ) {
		foreach ($child_categories as $item) {
			$cat_in_array[] = $item->term_id;
		}
	}

	$args = array(
		'posts_per_page' => 3,
		'category__in' => $cat_in_array,
		'meta_key' => 'post_views_count',
		'orderby' => 'meta_value_num',
		'post__not_in' => array($page_id),
		'meta_query' => array(
			array(
				'key' => "recommended_$cur_cat",
				'compare' => 'NOT EXISTS'
			),
		),
	);

} else {
	$args = array(
	    'posts_per_page' => 3,
	    'meta_key' => 'post_views_count',
	    'orderby' => 'meta_value_num',
	    'post__not_in' => array($page_id),
	    'meta_query' => array(
	    	array(
	    		'key' => "recommended_$cur_cat",
	    		'compare' => 'NOT EXISTS'
	    	),
	    ),
	    'meta_query' => array(
	    	array(
	    		'key' => "slider",
	    		'compare' => 'NOT EXISTS'
	    	),
	    ),
	);
}  

$loop = new WP_Query($args);
if ($loop->have_posts()) { 
	?>
	<div class="section-posts-box section">
		<div class="title">Популярные статьи</div>
		<div class="section-posts">
	    	<?php 
	    	while ( $loop->have_posts() ) { $loop->the_post(); 
	    		?>
				<div class="section-posts__item">
					<?php
					$w = 300; $h = 180;
					if ( kama_thumb_src() ) {
					    echo '<img src="'.kama_thumb_src('w='.$w.'&h='.$h).'" width="'.$w.'" height="'.$h.'" class="section-posts__item-img" alt="'.get_the_title().'" />';    
					} else {
					    echo '<img src="'.get_stylesheet_directory_uri().'/images/no-photo.jpg" width="'.$w.'" height="'.$h.'" class="section-posts__item-img" alt="Изображение для публикации не задано">';
					} ?>
					<div class="section-posts__item-title">
					    <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
					</div>
					<div class="section-posts__item-text">
						<?php
						if ( has_excerpt() ) {
							echo wp_trim_words( get_the_excerpt(), 10, '...' ); 
						} else {
							if ($excerpt_or_content == 1) {
							    global $more;
							    $more = 0;
							    echo wp_trim_words(get_the_content(), 10, '...');
							}
							else {
								if ( get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true) ) {
								    echo wp_trim_words(get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true), 10, '...');
								}
								else {
								    echo wp_trim_words(get_the_content(), 10, '...');
								}
							}
						} ?>
					</div>
						<?php
					if ($show_comments_number or $show_date) { ?>
					    <div class="post-info section-posts__item-info">
							<?php if ($show_comments_number) { ?>
								<div class="post-info__comment"><?php echo get_comments_number(); ?></div>
							<?php } ?>
				    		<?php if ($show_date) { ?>
				    			<time class="post-info__time post-info__time_popular" datetime="<?php the_time('Y-m-d') ?>"><?php the_time('d.m.Y') ?></time>
				    		<?php } ?>
					    </div>
				    	<?php
				    } ?>
				</div>
	    		<?php
	    	} ?>
		</div> 
	</div>
<?php } wp_reset_query();