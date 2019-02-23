<?php global $select_options; if ( ! isset( $_REQUEST['settings-updated'] ) ) $_REQUEST['settings-updated'] = false; ?>
<div class="flat_pm_wrap">
	<h1>Настройки, которые подчиняют все рекламные блоки!<?php if(!flat_do_some()){ ?> - <a href="http://wp-pro.online/" target="_blank">Купить <span>PRO</span> версию</a><?php } ?> <span style="font-size:6px;display:inline-block;line-height:1;margin:0 0 0 10px;vertical-align:text-top;top:2px;position:relative">One Ring to rule them all,<br>One Ring to find them,<br>One Ring to bring them all<br>And in the Darkness bind them.</span></h1>
	<form method="post" action="options.php" onsubmit="return false;">
		<?php $settings = get_option( 'flat_plugin_settings_me' ); ?>
		<div class="block_form_wrapper flat_settings view_1_level_sub_2">
			<div class="item_geo_block">
				<h2 style="margin:0 0 10px"><span>1.</span> Url ajax-обработчика:</h2>
				<p><span style="color:red">!Важно</span> По умолчанию используется admin-ajax.php, но для более быстрого решения советую переключить на flat-ajax.php</p>
				<input type="radio" name="flat_settings_ajax" id="flat_settings_ajax_1" value="admin_ajax"<?php if(!isset($settings['ajax_url']) || $settings['ajax_url'] == 'admin_ajax') echo ' checked="checked"'; ?>>
				<label for="flat_settings_ajax_1">admin-ajax.php</label>
				<input type="radio" name="flat_settings_ajax" id="flat_settings_ajax_2" value="flat_ajax"<?php if(isset($settings['ajax_url']) && $settings['ajax_url'] == 'flat_ajax') echo ' checked="checked"'; ?>>
				<label for="flat_settings_ajax_2">flat-ajax.php</label>
			</div>
			<div class="item_geo_block"<?php if(!flat_do_some()){ ?> style="display:none"<?php } ?>>
				<h2 style="margin:0 0 10px"><span>2.</span> Источники переходов (REFERER):</h2>
				<div class="notice_me"><span style="color:red">!Важно</span> вводить каждый referer с новой строки</div>
				<div class="float_left">
					<h3 style="text-align:center">С каких referer'ов показывать</h3>
					<textarea name="flat_referer_enabled" id="flat_referer_enabled" placeholder="Например: google.com"><?php echo implode("\n", $settings['referer']['referer_enabled']); ?></textarea>
				</div>
				<div class="float_right">
					<h3 style="text-align:center">С каких referer'ов <span>не</span> показывать</h3>
					<textarea name="flat_referer_disabled" id="flat_referer_disabled" placeholder="Например: google.com"><?php echo implode("\n", $settings['referer']['referer_disabled']); ?></textarea>
				</div>
				<p class="notice" style="text-align:center;padding:10px 0 0;clear:both">Достаточно ввести лишь домен, например: google.com. Но можно ввести и более полный url.<br><br><span style="color:red">!Важно</span> Введите <span style="color:red">///:direct</span> - для пользователей без рефёрера (прямые переходы).<br><span style="color:red">!Важно</span> Введите <span style="color:red">///:iframe</span> - для iframe'ов (когда сайт просматривается через iframe).<br><br><span style="color:red">!Важно</span> Определение происходит по подстроке, т.е. при вводе google.com будет заблокирован любой referer наподобие https://site.ru/category/<span style="color:red">google.com</span>/page-2/, имейте это ввиду!</p>
			</div>
			<style>
				.flat_disabled{position:relative}
				.flat_disabled:before{content:'Временно недоступно';display:block;position:absolute;top:-20px;left:0;bottom:0;right:0;background:rgba(133,144,195,.65);z-index:2;line-height:280px;text-align:center;color:#fff;font-size:22px;text-transform:uppercase;text-shadow:1px 1px 2px rgba(35,40,45,0.45);font-weight:700}
			</style>
			<div class="item_geo_block flat_disabled" style="border:none<?php if(!flat_do_some()){ ?>;display:none<?php } ?>">
				<h2 style="margin:0 0 10px"><span>3.</span> Роли пользователей:</h2>
				<?php
				$div_hidden = array();
				global $wp_roles;
				foreach ($wp_roles->get_names() as $key => $value) {
					$div_hidden []= array($key,translate_user_role($value));
				}
				unset($value);
				unset($key);
				?>
				<div class="flex_flat">
					<div class="item_flex" style="align-self:flex-start">
						<h3 style="text-align:center">Для каких ролей показывать рекламу?</h3>
						<div class="flat_search_role_enabled"><?php
							if(!empty($settings['role']['role_enabled'])){
								foreach ($settings['role']['role_enabled'] as $key => $value) {
									echo '<div class="item" data-id="'.$key.'" data-type="'.$value.'">'.$value.'<span class="delete_me_pls"></span></div>';
								}
								unset($value);
								unset($key);
							}
						?></div>
						<label for="flat_search_role_enabled" class="title select_none">Быстрый поиск:</label>
						<input type="text" name="flat_search_role_enabled" id="flat_search_role_enabled" placeholder="Начните вводить название роли">
						<ul class="role_flat_enabled"></ul>
					</div>
					<div class="item_flex" style="align-self:flex-start">
						<h3 style="text-align:center">Для каких ролей <span>не</span> показывать рекламу?</h3>
						<div class="flat_search_role_disabled"><?php
							if(!empty($settings['role']['role_disabled'])){
								foreach ($settings['role']['role_disabled'] as $key => $value) {
									echo '<div class="item" data-id="'.$key.'" data-type="'.$value.'">'.$value.'<span class="delete_me_pls"></span></div>';
								}
								unset($value);
								unset($key);
							}
						?></div>
						<label for="flat_search_role_disabled" class="title select_none">Быстрый поиск:</label>
						<input type="text" name="flat_search_role_disabled" id="flat_search_role_disabled" placeholder="Начните вводить название роли">
						<ul class="role_flat_disabled"></ul>
					</div>
				</div>
				<script>
				var roles_flat = <?php echo json_encode($div_hidden); ?>;
				</script>
				<p class="notice" style="text-align:center;clear:both">Введите <span style="color:red">all</span> для отображения полного списка</p>
				<p class="notice" style="text-align:center"><span style="color:red">!Важно</span> Если ничего не выбрано, то реклама будет показываться всем ролям или в зависимости от индивидуальной настройки в рекламном блоке</p>
			</div>
			<a class="flat_settings_btn"><span>Сохранить настройки</span></a>
		</div>
	</form>
	<?php require ABSPATH.'wp-content/plugins/flat_pm/inc/news.php'; ?>
</div>