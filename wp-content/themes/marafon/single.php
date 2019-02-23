<?php
require('header.php'); ?>
<div class="content-wrapper">
	<main class="content">
		<?php
		if (have_posts()) {
			while (have_posts()) { the_post(); ?>
				<?php if ($show_date) { ?>
	    			<time class="post-info__time post-info__time_single" datetime="<?php the_time('Y-m-d') ?>"><?php the_time('d.m.Y') ?></time>
	    		<?php } ?>
		    		<div class="article-wrap" itemscope itemtype="http://schema.org/Article">
						<article class="single">
							<?php
							$title_img = get_post_meta( $post->ID, 'title_img', true );
							if($title_img) {
								?>
								<div class="title-img">
									<?php echo kama_thumb_img("src=".$title_img."&w=660&h=300&class=h1_img&alt=". get_the_title() .""); ?>
									<h1 class="single__title"><?php the_title(); ?></h1>
								</div>
								<?php
							} else {
								?>
								<h1 class="single__title"><?php the_title(); ?></h1>
								<?php
							} ?>
							<div itemprop="articleBody">
								<?php the_content();
								edit_post_link('Редактировать', '<p>', '</p>'); ?>
							</div>
						</article>

						<div class="post-meta"><?php
							if (function_exists('the_ratings')) { ?>
								<div class="post-rating">
									<div class="post-rating__title">Оценка статьи:</div>
									<?php the_ratings(); ?>
								</div><?php
							} ?>
							<div class="post-share">
								<div class="post-share__title">Поделиться с друзьями:</div>
								<div class="likely">
									<div class="twitter">Твитнуть</div>
									<div class="facebook">Поделиться</div>
									<div class="vkontakte">Поделиться</div>
									<div class="telegram">Отправить</div>
									<div class="odnoklassniki">Класснуть</div>
								</div>
							</div>
						</div>

						<?php
						$yoast_title = get_post_meta( get_the_ID(), '_yoast_wpseo_title', true );
						if ($yoast_title) {
							$title_headline = $yoast_title;
						} else {
							$title_headline = get_the_title();
						}
						?>
						<meta itemprop="headline" content="<?php echo $title_headline; ?>">

						<?php
						$author_display_name = get_the_author();
						if ($author_display_name) {
							$itemprop_author = $author_display_name;
						} else {
							$itemprop_author = 'admin';
						} ?>
						<meta itemprop="author" content="<?php echo $itemprop_author; ?>">

						<meta itemprop="datePublished" content="<?php the_date('Y-m-d'); ?>">
						<meta itemprop="dateModified" content="<?php the_modified_date('Y-m-d'); ?>">
						<a itemprop="url" href="<?php the_permalink() ?>" style="display:none"><?php the_title(); ?></a>
						<a itemprop="mainEntityOfPage" href="<?php the_permalink() ?>" style="display:none">Ссылка на основную публикацию</a>

						<?php
						$w = 320; $h = 200;
						if ( kama_thumb_src() ) {
						    $first_img_src = kama_thumb_src('w='.$w.'&h='.$h);
						} else {
						    $first_img_src = get_stylesheet_directory_uri().'/images/no-photo.jpg';
						}
						?>
						<div style="display: none;" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
							<img itemprop="url" src="<?php echo $first_img_src; ?>" alt="<?php echo get_the_title() ?>">
							<meta itemprop="width" content="320">
							<meta itemprop="height" content="200">
						</div>


						<div style="display: none;" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
							<meta itemprop="name" content="<?php bloginfo('name'); ?>">
							<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
								<img itemprop="url" src="<?php echo $logo_upload; ?>" alt="<?php bloginfo('name'); ?>">
							</div>
						</div>
					</div><!-- .article-wrap -->
				<?php
				if (function_exists( 'perelink_after_content') ) {
				    ob_start();
				    perelink_after_content();
				    $perelink_content = ob_get_contents();
				    ob_end_clean();

				    if ($perelink_content) { ?>
				    <div class="title"><span>Похожие публикации</span></div>
				    <div class="yarpp-related">
				        <ul class="related">
				        	<?php
				        	if ( class_exists('PerelinkPlugin') ) {
		                        PerelinkPlugin::getAfterText();
		                    } ?>
				        </ul>
				    </div>
				    <?php
					} else {
				    	if ( function_exists('related_posts') ) {
					        ob_start();
					        related_posts();
					        $yarpp_content = ob_get_contents();
					        ob_end_clean();

					        $pos = strpos($yarpp_content, 'yarpp-related-none');

					        if (!$pos) echo $yarpp_content;
						}
					}
				} else {
				    if ( function_exists( 'related_posts') ) {
				    	ob_start();
				        related_posts();
				        $yarpp_content = ob_get_contents();
				        ob_end_clean();

				        $pos = strpos($yarpp_content, 'yarpp-related-none');

				        if (!$pos) echo $yarpp_content;
				    }
				}
			}
			if ( comments_open() ) {
				?>
				<aside class="comments-block">
					<?php comments_template(); ?>
				</aside>
				<?php
			}
		} else {
			?>
			<div class="single">
				<h2>Не найдено</h2>
				<p>Извините, по вашему запросу ничего не найдено.</p>
			</div>
			<?php
		} ?>
	</main>
	<?php
	require('sidebar.php'); ?>
</div><!-- /.content-wrapper -->
<?php require('footer.php'); ?>
