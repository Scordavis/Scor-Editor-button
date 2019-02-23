<?php
if ( !category_description() and !have_posts() ) {
	global $wp_query;
	$wp_query->set_404();
	status_header(404);
	include( get_query_template( '404' ) );
	die();
}
require('header.php');
$cur_cat = get_query_var('cat');
$temp_morkovin = true; ?>
<div class="content-wrapper">
	<main class="content">
		<?php
		if (have_posts()) { ?>
			<div class="title"><?php echo single_cat_title(); ?></div>
			<?php
	        $cats =  get_categories("child_of=$cur_cat");
	        if ($cats) {
	        	?>
				<div class="cat-children">
					<?php
					$i = 1;
					foreach ($cats as $cat) {
						$cats_name = $cat->cat_name;
						$cats_id = $cat->cat_ID;
						?>
						<div class="cat-children__item">
							<a href="<?php echo get_category_link($cats_id); ?> "><?php echo $cats_name; ?></a>
						</div>
						<?php
						$i++;
					} ?>
				</div>
				<?php
			}

			$args = array(
				'meta_key' => "recommended_$cur_cat",
				'orderby' => 'meta_value_num',
				'posts_per_page' => -1,
			);
			$loop = new WP_Query($args);
			if ($loop->have_posts()) { ?>
				<div class="title title_recommended">Рекомендованные публикации</div>
				<div class="slider-posts-box">
					<div class="slider-posts-wrap">
						<ul id="recommended-posts" class="slider-posts">
							<?php
							while ($loop->have_posts()) { $loop->the_post();
								?>
								<li>
									<div class="slider-posts__img">
									    <?php
									    $w = 210; $h = 131;
									    if (kama_thumb_src()){
									        echo '<img src="'.kama_thumb_src('w='.$w.'&h='.$h).'" width="'.$w.'" height="'.$h.'" alt="'.get_the_title().'" />';
									    }else{
									        echo '<img src="'.get_stylesheet_directory_uri().'/images/210-131.jpg" width="'.$w.'" height="'.$h.'" alt="Изображение для публикации не задано">';
									    } ?>
							    	    <div class="post-info post-info_slider-posts">
							    	    	<?php
							    	    	$post_cat = get_the_category();
							    	    	$post_cat = $post_cat[0]->cat_ID;
							    	    	?>
							    	    	<div class="post-info__cat">
							    	    		<a href="<?php echo get_category_link($post_cat) ?>"><?php echo get_cat_name($post_cat); ?></a>
							    	    	</div>
							    	    	<?php if($show_date){ ?>
							        			<time class="post-info__time" datetime="<?php the_time('Y-m-d') ?>"><?php the_time('d.m.Y') ?></time>
							        		<?php } ?>
							    	    </div>
						    	    </div>
								    <div class="slider-posts__title">
			    	   					<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
		    	   					</div>
								</li>
								<?php
							} ?>
						</ul>
					</div>
				</div><?php
			} wp_reset_query(); ?>
			<div class="posts cat-posts ajax_pagination">
				<?php
				$i = 1;
				while ( have_posts() ) { the_post();
					if ($i == 1) {
						?>
						<div class="posts__item posts__item_first">
						    <div class="posts__item-img">
						    	<?php
						    	$w = 660; $h = 300;
						    	if ( kama_thumb_src() ) {
						    	    echo '<img src="'.kama_thumb_src('w='.$w.'&h='.$h).'" width="'.$w.'" height="'.$h.'" alt="'.get_the_title().'" />';
						    	} else {
						    	    echo '<img src="'.get_stylesheet_directory_uri().'/images/660-300.jpg" width="'.$w.'" height="'.$h.'" alt="Изображение для публикации не задано">';
						    	} ?>
							    <div class="post-info post-info_loop">
							    	<?php if ($show_comments_number) { ?>
							    		<div class="post-info__comment"><?php echo get_comments_number(); ?></div>
							    	<?php } ?>
						    		<?php if ($show_date) { ?>
						    			<time class="post-info__time" datetime="<?php the_time('Y-m-d') ?>"><?php the_time('d.m.Y') ?></time>
						    		<?php } ?>
							    </div>
						    </div>
						    <div class="posts__item-title">
								<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
							</div>
							<div class="posts__item-content">
								<?php if ($excerpt_or_content == 1) {
								    global $more;
								    $more = 0;
								    $announce = wp_trim_words(get_the_content(), 20, '...');
				    			    $pattern = '/\[caption[^\]]+][^\]]+]/';
				    			    $announce = preg_replace($pattern, '', $announce);
				    			    echo $announce;
								}
								else {
									if ( get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true) ) {
									    echo wp_trim_words( get_post_meta( get_the_ID(), '_yoast_wpseo_metadesc', true ), 20, '...' );
									}
									else {
									    $announce = wp_trim_words(get_the_content(), 20, '...');
					    			    $pattern = '/\[caption[^\]]+][^\]]+]/';
					    			    $announce = preg_replace($pattern, '', $announce);
					    			    echo $announce;
									}
								} ?>
							</div>
						</div>
						<?php
						$i++;
					} else {
						require 'loop-category.php';
						$i++;
					}
				} ?>
			</div>
			<?php
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			if ( $wp_query->max_num_pages > 1 && $paged == 1 ) {
				$posts_num = get_option('posts_per_page'); ?>
				<div class="more"
					data-items="<?php echo $posts_num-1; ?>"
					data-offset="<?php echo $posts_num; ?>"
					<?php if (is_category()) echo 'data-category="' . $cur_cat . '"'; ?>
					data-theme="<?php echo get_template(); ?>"
					data-loading="Загрузка..."><span>Показать ещё</span>
				</div>
				<?php
			}
		} else { ?>
			<article class="single">
				<h1 class="single"><?php echo single_cat_title(); ?></h1>
				<div>
					<?php
					$description = category_description();
					$description = apply_filters('the_content',$description);
					echo $description;
					?>
				</div>
			</article><?php
			$temp_morkovin = false;
		} ?>
	</main>
	<?php
	require('sidebar.php'); ?>
</div><!-- /.content-wrapper -->
<?php
if ( category_description() && $paged == 1 && $temp_morkovin ) { ?>
	<article class="single description">
		<h1 class="description__title"><?php echo single_cat_title(); ?></h1>
		<div>
			<?php
			$description = category_description();
			$description = apply_filters('the_content',$description);
			echo $description;
			?>
		</div>
	</article><?php
}

require('footer.php'); ?>

