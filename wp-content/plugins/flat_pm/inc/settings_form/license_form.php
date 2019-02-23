<?php global $select_options; if ( ! isset( $_REQUEST['settings-updated'] ) ) $_REQUEST['settings-updated'] = false; ?>
<div class="flat_pm_wrap">
	<h1>Лицензия <?php if(!flat_do_some()){ ?> - <a href="http://wp-pro.online/" target="_blank">Купить <span>PRO</span> версию</a><?php } ?></h1>
	<form method="post" action="options.php">
		<?php $options = get_option( 'flat_plugin_options_me' ); ?>
		<?php settings_fields( 'flat_plugin_field' ); ?>
		<input type="text" name="flat_plugin_options_me" id="flat_plugin_options_me" placeholder="Вставить ключ" value="<?php echo $options; ?>">
		<input type="submit" value="Сохранить">
	</form>
	<?php require ABSPATH.'wp-content/plugins/flat_pm/inc/news.php'; ?>
</div>