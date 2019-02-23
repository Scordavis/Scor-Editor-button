<?php 
require('header.php'); 
$cur_cat = get_query_var('cat');
$cur_tag = get_query_var('tag_id'); ?>
<div class="content-wrapper">
	<main class="content">
		<?php
		if (have_posts()) { 
			?>
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
								    echo wp_trim_words(get_the_excerpt(), 20, '...');
								}
								else {
									if ( get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true) ) {
									    echo wp_trim_words(get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true), 20, '...');
									}
									else {
									    echo wp_trim_words(get_the_excerpt(), 20, '...');
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
			if ( $wp_query->max_num_pages > 1 ) { 
				$posts_num = get_option('posts_per_page'); ?>
				<div class="more"
					data-items="<?php echo $posts_num-1; ?>"
					data-offset="<?php echo $posts_num; ?>"
					<?php if (is_search()) echo 'data-search="' .  get_search_query() . '"'; ?>
					data-theme="<?php echo get_template(); ?>"
					data-loading="Загрузка..."><span>Показать ещё</span>
				</div>
				<?php 
			}		
		} else { 
			?>
			<div class="single">
				<h1>Ничего не найдено</h1>
				<p>Измените условия поиска, или посетите интересующий Вас раздел сайта:</p>
				<ul>
					<?php wp_list_categories('use_desc_for_title=0&title_li=0'); ?>
				</ul>
			</div>
			<?php 
		} ?>
	</main>
	<?php 
	require('sidebar.php'); ?>
</div><!-- /.content-wrapper -->
<?php 		
require('footer.php'); ?>

