<div class="posts__item">
    <div class="posts__item-img">
    	<?php
    	$w = 320; $h = 200;
    	if ( kama_thumb_src() ) {
    	    echo '<img src="'.kama_thumb_src('w='.$w.'&h='.$h).'" width="'.$w.'" height="'.$h.'" alt="'.get_the_title().'" />';    
    	} else {
    	    echo '<img src="'.get_stylesheet_directory_uri().'/images/no-photo.jpg" width="'.$w.'" height="'.$h.'" alt="Изображение для публикации не задано">';
    	} ?>
	    <div class="post-info post-info_loop">
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
    <div class="posts__item-title">
		<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
	</div>
	<div class="posts__item-content">
		<?php
		if ( has_excerpt() ) {
			echo wp_trim_words( get_the_excerpt(), 20, '...' ); 
		} else {
			if ($excerpt_or_content == 1) {
			    global $more;
			    $more = 0;
			    $announce = wp_trim_words(get_the_content(), 20, '...');
			    $pattern = '/\[caption[^\]]+][^\]]+]/';
			    $announce = preg_replace($pattern, '', $announce);
			    echo $announce;
			}
			else {
				if ( get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true) ) {
				    echo wp_trim_words(get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true), 20, '...');
				}
				else {
				    $announce = wp_trim_words(get_the_content(), 20, '...');
				    $pattern = '/\[caption[^\]]+][^\]]+]/';
				    $announce = preg_replace($pattern, '', $announce);
				    echo $announce;
				}
			}
		} ?>
	</div>
</div>