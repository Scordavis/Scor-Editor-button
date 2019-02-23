<?php
require('header.php');
$args = array(
	'meta_key' => 'slider',
	'orderby' => 'meta_value_num',
	'posts_per_page' => -1,
);
$loop = new WP_Query($args);
if ( $loop->have_posts() ) { ?>
	<div class="slider">
		<ul id="slider">
			<?php
			$i = 0;
			while ( $loop->have_posts() ) { $loop->the_post();
				if ( ($i % 4) == 0 ) echo '<li>';
					if ($i == 0) {
						$w = 500; $h = 400;
						$i++;
					} elseif ($i == 1) {
						$w = 500; $h = 200;
						$i++;
					} else {
						$w = 250; $h = 200;
						$i++;
					} ?>
					<div class="slider__item">
					    <a href="<?php the_permalink(); ?>">
							<?php
							if (kama_thumb_src()){
							    echo '<img src="'.kama_thumb_src('w='.$w.'&h='.$h).'" width="'.$w.'" height="'.$h.'" class="slider__img" alt="'.get_the_title().'" />';
							}else{
							    echo '<img src="'.get_stylesheet_directory_uri().'/images/no-photo.jpg" width="'.$w.'" height="'.$h.'" class="slider__img" alt="Изображение для публикации не задано">';
							} ?>
					    </a>
					    <div class="slider-text">
			    		    <div class="post-info post-info_slider">
			    		    	<?php
			    		    	$post_cat = get_the_category();
			    		    	$post_cat = $post_cat[0]->cat_ID;
			    		    	?>
			    		    	<div class="post-info__cat">
			    		    		<a href="<?php echo get_category_link($post_cat) ?>"><?php echo get_cat_name($post_cat); ?></a>
			    		    	</div>
			    		    	<?php if ($show_date) { ?>
		    		    			<time class="post-info__time" datetime="<?php the_time('Y-m-d') ?>"><?php the_time('d.m.Y') ?></time>
		    		    		<?php } ?>
			    		    </div>
			    		    <div class="slider-text__title">
			    	   			<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
		    	   			</div>
					    </div>
					</div>
					<?php
					if ( ($i % 4) == 0 ) {
						echo '</li>';
						$i = 0;
					} ?>
				<?php
			} ?>
		</ul>
	</div>
<?php } wp_reset_query(); ?>
<div class="content-wrapper">
	<?php
	$class_home_content = '';
	if ($disable_sidebar_homepage) {
		$class_home_content = ' content_remove-sidebar';
	}
	?>
	<main class="content<?php echo $class_home_content; ?>">
		<?php
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $posts_per_home,
			'paged' => $paged,
		);
		$loop = new WP_Query($args);
		if ($loop->have_posts()) {
			?>
			<div class="title">Свежие публикации</div>
			<div class="posts posts_home ajax_pagination">
				<?php
				while ($loop->have_posts()) { $loop->the_post();
					require 'loop.php';
				} ?>
			</div>
			<?php
		 	if ( $loop->max_num_pages > 1 ) {
				?>
				<div class="more"
					data-newposts="1"
					data-items="<?php echo $posts_per_home; ?>"
					data-offset="<?php echo $posts_per_home; ?>"
					data-theme="<?php echo get_template(); ?>"
					data-loading="Загрузка..."><span>Показать ещё</span>
				</div>
				<?php
			}
		} wp_reset_query();

		$args = array(
			'posts_per_page' => 15,
			'meta_key' => 'post_views_count',
			'orderby' => 'meta_value_num',
			'meta_query' =>
			array(
			    array(
			        'key'     => 'slider',
			        'compare' => 'NOT EXISTS'
			    )
			),
		);
		$loop = new WP_Query($args);
		if ($loop->have_posts()) {

			if ($disable_sidebar_homepage) echo '<div class="top-widgets-wrap"><div class="top-posts-wrap_remove-sidebar">'; ?>
				<div class="title">Популярные публикации</div>
				<div class="slider-posts-box">
					<div class="slider-posts-wrap">
						<ul id="slider-posts" class="slider-posts">
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
							    	    	<?php if ($show_date) { ?>
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
				</div>
			<?php if ($disable_sidebar_homepage) {
				echo '</div><!-- .top-posts-wrap_remove-sidebar  -->';
				if ( !function_exists ('dynamic_sidebar') || !dynamic_sidebar ('Справа от популярных на главной') ) {}
				echo '</div><!-- .top-widgets-wrap  -->';
			}

		} wp_reset_query(); ?>
	</main>
	<?php
	if (!$disable_sidebar_homepage) {
		require('sidebar.php');
	}
	?>
</div><!-- /.content-wrapper -->
<?php
if ($homepage) {
	$loop = new WP_Query("page_id=$homepage");
	if ( $loop->have_posts() ) {
		while ( $loop->have_posts() ) { $loop->the_post() ?>
		<article class="description single">
			<h1 class="description__title"><?php the_title(); ?></h1>
			<?php
			the_content();
			edit_post_link('Редактировать', '<p>', '</p>') ?>
		</article>
		<?php }
	} wp_reset_query();
}
require('footer.php'); ?>
