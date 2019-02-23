<?php
$flat_block_ID = $_GET['block_id'];
?>
<div class="block_checkbox_geo">
	<?php
	$flat_pm_geo = get_post_meta($flat_block_ID, 'flat_pm_geo', true);
	?>
	<div class="item_geo_block">
		<input type="checkbox" name="geo_check_setting" id="geo_check_setting"<?php if($flat_pm_geo['geo_enabled'] == 'true') echo ' checked="checked"'; ?>>
		<label for="geo_check_setting" class="select_none">Блок настроек </label>
	</div>
	<div class="item_geo_block">
		<p style="font-size:16px">Ваша страна: <span class="your_country" style="color:red;font-size:16px"></span></p>
		<p style="font-size:16px">Ваш город: <span class="your_city" style="color:red;font-size:16px"></span></p>
		<p style="font-size:16px">Узнать геолокацию по ip: <a href="http://ip-api.com/json/<?php echo $_SERVER['REMOTE_ADDR']; ?>?lang=ru" target="_blank" style="color:red;font-size:16px;text-decoration:underline">http://ip-api.com/json/<?php echo $_SERVER['REMOTE_ADDR']; ?>?lang=ru</a></p>
	</div>
	<div class="item_geo_block">
		<h2><span>1.</span> Страны</h2>
		<div class="notice_me"><span style="color:red">!Важно</span> вводить каждую страну с новой строки</div>
		<div class="float_left">
			<h3 style="text-align:center">В каких странах показывать</h3>
			<textarea name="geo_country_enabled" id="geo_country_enabled" placeholder="Страна"><?php echo implode("\n", $flat_pm_geo['country_enabled']); ?></textarea>
		</div>
		<div class="float_right">
			<h3 style="text-align:center">В каких странах <span>не</span> показывать</h3>
			<textarea name="geo_country_disabled" id="geo_country_disabled" placeholder="Страна"><?php echo implode("\n", $flat_pm_geo['country_disabled']); ?></textarea>
		</div>
	</div>
	<div class="item_geo_block">
		<h2><span>2.</span> Города</h2>
		<div class="notice_me"><span style="color:red">!Важно</span> вводить каждый город с новой строки</div>
		<div class="float_left">
			<h3 style="text-align:center">В каких городах показывать</h3>
			<textarea name="geo_city_enabled" id="geo_city_enabled" placeholder="Город"><?php echo implode("\n", $flat_pm_geo['city_enabled']); ?></textarea>
		</div>
		<div class="float_right">
			<h3 style="text-align:center">В каких городах <span>не</span> показывать</h3>
			<textarea name="geo_city_disabled" id="geo_city_disabled" placeholder="Город"><?php echo implode("\n", $flat_pm_geo['city_disabled']); ?></textarea>
		</div>
	</div>
</div>