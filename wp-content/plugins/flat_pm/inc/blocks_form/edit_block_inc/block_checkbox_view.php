<?php
$flat_block_ID = $_GET['block_id'];
?>
<div class="block_checkbox_view">
	<?php
	$flat_pm_view_all = get_post_meta($flat_block_ID, 'flat_pm_view', true);
	$flat_pm_view_all['view_enabled'] = ((get_post_meta($flat_block_ID, 'flat_pm_block_enabled', true) == '1') ? 'true' : 'false');
	?>
	<div class="item_geo_block">
		<input type="checkbox" name="view_check_setting" id="view_check_setting"<?php if($flat_pm_view_all['view_enabled'] == 'true') echo ' checked="checked"'; ?>>
		<label for="view_check_setting" class="select_none">Блок настроек </label>
		<p style="padding-top:10px;text-align:center;font-size:16px">Если <span style="color:red;font-size:16px">отключить</span> этот блок настроек, то вывод блоков будет <span style="color:red;font-size:16px">недоступен</span>.</p>
	</div>
	<div class="item_view_block">
		<input type="radio" name="view_1_level" id="view_1_level_sub_1"<?php if(!isset($_GET['sub_tab']) || $_GET['sub_tab'] == 'sub_1') echo ' checked="checked"'; ?>>
		<label for="view_1_level_sub_1" class="select_none"><span style="position:relative;z-index:3">Как выводить?</span></label>
		<input type="radio" name="view_1_level" id="view_1_level_sub_2"<?php if($_GET['sub_tab'] == 'sub_2') echo ' checked="checked"'; ?><?php if(!flat_do_some()){ ?> disabled="disabled"<?php } ?>>
		<label for="view_1_level_sub_2" class="select_none"><span style="position:relative;z-index:3">Где выводить?</span></label>
		<?php include_once 'sub/view_1_level_sub_1.php'; ?>
		<?php include_once 'sub/view_1_level_sub_2.php'; ?>
	</div>
	<div class="item_view_block">
		<div class="min_chapter_length" style="text-align:center;font-size:16px">
			<span style="color:red;font-size:16px">Не</span> выводить блок, если контента меньше <input type="text" name="min_chapter_length" id="min_chapter_length" placeholder="N" value="<?php echo $flat_pm_view_all['chapter_limit']; ?>"> символов<br>Оставьте <span style="color:red;font-size:16px">пустым</span>, если ограничение не нужно
		</div>
	</div>
</div>