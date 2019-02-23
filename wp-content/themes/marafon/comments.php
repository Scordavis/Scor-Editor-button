<?php // Do not delete these lines
	if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">Запись защищена паролем.</p>
	<?php
		return;
	}
?>
<?php if ( comments_open() ) { ?>
	<?php do_action( 'comment_form_before' ); ?>
	<div id="respond" class="respond">
		<div class="respond__title">Добавить комментарий</div>
		<div id="cancel-comment-reply"><?php cancel_comment_reply_link() ?></div>

		<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) { ?>
			<p><?php printf( 'Вам нужно <a href="%s">войти</a>, чтобы оставить комментарий.', wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ); ?></p>
			<?php do_action( 'comment_form_must_log_in_after' ); ?>
		<?php } else { ?>
			
			<!--noindex-->
			<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" class="respond-form">
				<?php do_action( 'comment_form_top' ); ?>

			<?php if ( is_user_logged_in() ) { ?>

				<p><?php printf( __( 'Вы вошли как <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Выйти?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ); ?></p>
				<?php do_action( 'comment_form_logged_in_after' ); ?>

			<?php } else { ?>
				<?php
				do_action( 'comment_form_before_fields' );

				global $remove_email_site_comment_form;
				$name_field_class = '';
				if ($remove_email_site_comment_form) {
					$name_field_class = ' respond-form__name_width50';
				}
				?>

				<input type="text" name="author" id="author" placeholder="Ваше имя:" class="respond-form__field respond-form__name<?php echo $name_field_class; ?>" value="<?php echo $comment_author; ?>" <?php if ($req) echo "aria-required='true'"; ?> />
				
				<?php 
				if (!$remove_email_site_comment_form) { 
					?>
					<input type="text" name="email" id="email" placeholder="Ваш e-mail:" class="respond-form__field respond-form__email" value="<?php echo $comment_author_email; ?>" <?php if ($req) echo "aria-required='true'"; ?> />
					<input type="text" name="url" id="url" placeholder="Ваш сайт:" class="respond-form__field respond-form__site" value="<?php echo $comment_author_url; ?>" />
					<?php
				} ?>

				<?php do_action( 'comment_form_after_fields' ); ?>
			<?php } ?>
				<textarea name="comment" id="comment_textarea" rows="7" placeholder="Ваш комментарий:" class="respond-form__text respond-form__textarea"></textarea>
				<?php do_action( 'comment_form' ); ?>
				
				<input name="submit" type="submit" class="respond-form__button" value="Отправить" />

				<?php comment_id_fields(); ?>
			</form>
			<!--/noindex-->
		<?php } // If registration required and not logged in ?>

	</div><!-- #respond -->
	<?php do_action( 'comment_form_after' ); ?>
<?php } else { ?>
	<p class="nocomments">Комментарии закрыты.</p>
	<?php do_action( 'comment_form_comments_closed' ); ?>
<?php } ?>
<?php if (have_comments()) { ?>
	<div class="comment-title">Комментарии</div>
	<ul class="commentlist">
		<?php wp_list_comments('callback=mytheme_comment');?>
	</ul>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
	<div class="commentNav">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
	<?php } ?>

<?php } /* if (have_comments()) { */ ?>