<?php
$flat_block_ID = $_GET['block_id'];
?>
<div class="block_checkbox_browser">
	<?php
	$flat_pm_browser = get_post_meta($flat_block_ID, 'flat_pm_browser', true);
	?>
	<div class="flat_settings">
		<div class="item_geo_block">
			<input type="checkbox" name="browser_check_setting" id="browser_check_setting"<?php if($flat_pm_browser != '' && $flat_pm_browser['enabled'] == 'true') echo ' checked="checked"'; ?>>
			<label for="browser_check_setting" class="select_none">Блок настроек </label>
		</div>
		<div class="item_geo_block">
			<div class="notice_me" style="text-align:center"><span style="color:red">!Важно</span> вводить каждый браузер с новой строки</div>
			<div class="float_left">
				<h3 style="text-align:center">Для каких браузеров показывать</h3>
				<textarea name="flat_browser_enabled" id="flat_browser_enabled" placeholder="Например: Chrome"><?php if($flat_pm_browser != '') echo implode("\n", $flat_pm_browser['browser_enabled']); ?></textarea>
			</div>
			<div class="float_right">
				<h3 style="text-align:center">Для каких браузеров <span>не</span> показывать</h3>
				<textarea name="flat_browser_disabled" id="flat_browser_disabled" placeholder="Например: Chrome"><?php if($flat_pm_browser != '') echo implode("\n", $flat_pm_browser['browser_disabled']); ?></textarea>
			</div>
			<p class="notice" style="text-align:center;padding:10px 0 0;clear:both"><span style="color:red">Список всех браузеров</span>: Chrome, YaBrowser, Opera, Firefox, Internet Explorer, Edge, Safari, OmniWeb, iCab, Konqueror, Camino, Netscape.<br><br><span style="color:red">!Важно</span> Поиск будет происходить из навигатора: <span style="color:red">navigator.userAgent.indexOf</span></p>
		</div>
	</div>
</div>