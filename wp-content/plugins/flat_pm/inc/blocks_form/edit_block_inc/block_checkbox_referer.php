<?php
$flat_block_ID = $_GET['block_id'];
?>
<div class="block_checkbox_referer">
	<?php
	$flat_pm_referer = get_post_meta($flat_block_ID, 'flat_pm_referer', true);
	?>
	<div class="flat_settings">
		<div class="item_geo_block">
			<input type="checkbox" name="referer_check_setting" id="referer_check_setting"<?php if($flat_pm_referer != '' && $flat_pm_referer['enabled'] == 'true') echo ' checked="checked"'; ?>>
			<label for="referer_check_setting" class="select_none">Блок настроек </label>
		</div>
		<div class="item_geo_block">
			<div class="notice_me" style="text-align:center"><span style="color:red">!Важно</span> вводить каждый referer с новой строки</div>
			<div class="float_left">
				<h3 style="text-align:center">С каких referer'ов показывать</h3>
				<textarea name="flat_referer_enabled" id="flat_referer_enabled" placeholder="Например: google.com"><?php if($flat_pm_referer != '') echo implode("\n", $flat_pm_referer['referer_enabled']); ?></textarea>
			</div>
			<div class="float_right">
				<h3 style="text-align:center">С каких referer'ов <span>не</span> показывать</h3>
				<textarea name="flat_referer_disabled" id="flat_referer_disabled" placeholder="Например: google.com"><?php if($flat_pm_referer != '') echo implode("\n", $flat_pm_referer['referer_disabled']); ?></textarea>
			</div>
			<p class="notice" style="text-align:center;padding:10px 0 0;clear:both">Достаточно ввести лишь домен, например: google.com. Но можно ввести и более полный url.<br><br><span style="color:red">!Важно</span> Введите <span style="color:red">///:direct</span> - для пользователей без рефёрера (прямые переходы).<br><span style="color:red">!Важно</span> Введите <span style="color:red">///:iframe</span> - для iframe'ов (когда сайт просматривается через iframe).<br><br><span style="color:red">!Важно</span> Определение происходит по подстроке, т.е. при вводе google.com будет заблокирован любой referer наподобие https://site.ru/category/<span style="color:red">google.com</span>/page-2/, имейте это ввиду!</p>
		</div>
	</div>
</div>