<?php
$flat_block_ID = $_GET['block_id'];
?>
<div class="block_checkbox_date">
	<?php
	$flat_pm_date = get_post_meta($flat_block_ID, 'flat_pm_date', true);
	?>
	<div class="item_geo_block">
		<input type="checkbox" name="date_check_setting" id="date_check_setting"<?php if($flat_pm_date['date_enabled'] == 'true') echo ' checked="checked"'; ?>>
		<label for="date_check_setting" class="select_none">Блок настроек </label>
	</div>
	<div class="item_geo_block data_float_block">
		<input type="checkbox" name="date_check_setting_time" id="date_check_setting_time"<?php if($flat_pm_date['date_time_enabled'] == 'true') echo ' checked="checked"'; ?>>
		<label for="date_check_setting_time" class="select_none">Блок настроек </label>
		<h3><span>1.</span> Время показа блока</h3>
		<div class="float_left">
			<label for="time_drop_from">Начиная с:</label>
			<input type="text" name="time_drop_from" id="time_drop_from" placeholder="4:19" value="<?php echo $flat_pm_date['time_from']; ?>">
		</div>
		<div class="float_right">
			<label for="time_drop_to">Заканчивая в:</label>
			<input type="text" name="time_drop_to" id="time_drop_to" placeholder="4:20" value="<?php echo $flat_pm_date['time_to']; ?>">
		</div>
	</div>
	<div class="item_geo_block data_float_block">
		<input type="checkbox" name="date_check_setting_date" id="date_check_setting_date"<?php if($flat_pm_date['date_date_enabled'] == 'true') echo ' checked="checked"'; ?>>
		<label for="date_check_setting_date" class="select_none">Блок настроек </label>
		<h3><span>3.</span> Дата показа блока</h3>
		<div class="float_left">
			<label for="date_drop_from">Начиная с:</label>
			<input type="text" name="date_drop_from" id="date_drop_from" data-min-year="2016" data-max-year="2022" data-large-mode="true" data-lang="ru" data-format="j.n.Y" data-default-date="<?php $date_from = explode('.', $flat_pm_date['date_from']); echo $date_from[1].'-'.$date_from[0].'-'.$date_from[2]; ?>">
		</div>
		<div class="float_right">
			<label for="date_drop_to">Заканчивая до:</label>
			<input type="text" name="date_drop_to" id="date_drop_to" data-min-year="2016" data-max-year="2022" data-large-mode="true" data-lang="ru" data-format="j.n.Y" data-default-date="<?php $date_to = explode('.', $flat_pm_date['date_to']); echo $date_to[1].'-'.$date_to[0].'-'.$date_to[2]; ?>">
		</div>
	</div>
</div>