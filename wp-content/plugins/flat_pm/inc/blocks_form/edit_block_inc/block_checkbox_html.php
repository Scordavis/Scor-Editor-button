<?php
$flat_block_ID = $_GET['block_id'];
?>
<div class="block_checkbox_html">
	<link rel="stylesheet" id="editor-buttons-css" href="<?php echo get_site_url(); ?>/wp-includes/css/editor.min.css?ver=4.9.4" type="text/css" media="all">
	<?php
	$flat_pm_html = get_post_meta($flat_block_ID, 'flat_pm_html', true);
	foreach ($flat_pm_html as $key => $value) {
		$key++;
	?>
	<div class="item_sub_block">
		<div class="sub_block_wrapper flex_flat">
			<div class="float_flex" style="width:calc(50% - 45px)">
				<h2>Основной рекламный код</h2>
				<?php
				$content_sub_block = $value['html_main'];
				wp_editor($content_sub_block, 'sub_block_'.$key, array(
					'textarea_name' => 'content_'.'sub_block_'.$key,
					'editor_height' => 230,
					'tinymce'       => false,
					'textarea_rows' => 10,
				));
				?>
			</div>
			<div class="float_flex" style="width:calc(50% - 45px)">
				<h2>Рекламный код для пользователей <span style="color:red">ADblock</span></h2>
				<?php
				$content_sub_block_instead = $value['html_block'];
				wp_editor($content_sub_block_instead, 'sub_block_'.$key.'_instead', array(
					'textarea_name' => 'content_'.'sub_block_'.$key.'_instead',
					'editor_height' => 230,
					'tinymce'       => false,
					'textarea_rows' => 10,
				));
				?>
			</div>
			<div class="float_flex float_flex_colum" style="width:50px">
				<select name="rotateAB" id="rotateAB"<?php if(flat_do_some()){ ?> title="Выбрать группу для ротации"<?php } ?><?php if(!flat_do_some()){ ?> disabled="disabled" title="Доступно в PRO версии"<?php } ?>>
					<option value="0"<?php if($value['group'] == '0') echo ' selected="selected"'; ?>>нет</option>
					<option value="1"<?php if($value['group'] == '1') echo ' selected="selected"'; ?>>1</option>
					<option value="2"<?php if($value['group'] == '2') echo ' selected="selected"'; ?>>2</option>
					<option value="3"<?php if($value['group'] == '3') echo ' selected="selected"'; ?>>3</option>
					<option value="4"<?php if($value['group'] == '4') echo ' selected="selected"'; ?>>4</option>
					<option value="5"<?php if($value['group'] == '5') echo ' selected="selected"'; ?>>5</option>
				</select>
				<a class="delete" onclick="return false;" title="Удалить этот блок"></a>
				<a class="to_top" onclick="return false;" title="Переместить выше"></a>
				<a class="to_down" onclick="return false;" title="Переместить ниже"></a>
				<a class="plus" onclick="return false;" title="Добавить ещё один блок" data-replace-id="<?php echo $key; ?>"></a>
			</div>
		</div>
		<div class="sub_block_wrapper flex_flat">
			<?php
			switch (true) {
				case ($value['resolution_from'] == '∞' and $value['resolution_to'] == '∞'):
					$switch_case = 0;
					break;
				case ($value['resolution_from'] == '∞' and $value['resolution_to'] == '720'):
					$switch_case = 1;
					break;
				case ($value['resolution_from'] == '720' and $value['resolution_to'] == '1024'):
					$switch_case = 2;
					break;
				case ($value['resolution_from'] == '1024' and $value['resolution_to'] == '∞'):
					$switch_case = 3;
					break;
				default:
					$switch_case = 4;
					break;
			}
			?>
			<input type="radio" name="<?php echo 'sub_block_'.$key; ?>_radio_resolution" id="<?php echo 'sub_block_'.$key; ?>_radio_resolution_all"<?php if($switch_case == 0) echo ' checked="checked"'; ?>>
			<label class="select_none" for="<?php echo 'sub_block_'.$key; ?>_radio_resolution_all"><span style="position:relative;z-index:3">Все разрешения</span></label>
			<input type="text" name="<?php echo 'sub_block_'.$key; ?>_radio_resolution_from" id="<?php echo 'sub_block_'.$key; ?>_radio_resolution_from"<?php if($switch_case != 4) echo ' readonly="readonly"'; ?> value="<?php echo $value['resolution_from']; ?>" placeholder="От ... px" title="От ... px">
			<input type="text" name="<?php echo 'sub_block_'.$key; ?>_radio_resolution_to" id="<?php echo 'sub_block_'.$key; ?>_radio_resolution_to"<?php if($switch_case != 4) echo ' readonly="readonly"'; ?> value="<?php echo $value['resolution_to']; ?>" placeholder="До ... px" title="До ... px">
			<input type="radio" name="<?php echo 'sub_block_'.$key; ?>_radio_resolution" id="<?php echo 'sub_block_'.$key; ?>_radio_resolution_mob"<?php if($switch_case == 1) echo ' checked="checked"'; ?><?php if(!flat_do_some()){ ?> disabled="disabled"<?php } ?>>
			<label class="select_none" for="<?php echo 'sub_block_'.$key; ?>_radio_resolution_mob"<?php if(!flat_do_some()){ ?> title="Доступно в PRO версии"<?php } ?>><span style="position:relative;z-index:3">Для мобильных</span></label>
			<input type="radio" name="<?php echo 'sub_block_'.$key; ?>_radio_resolution" id="<?php echo 'sub_block_'.$key; ?>_radio_resolution_pad"<?php if($switch_case == 2) echo ' checked="checked"'; ?><?php if(!flat_do_some()){ ?> disabled="disabled"<?php } ?>>
			<label class="select_none" for="<?php echo 'sub_block_'.$key; ?>_radio_resolution_pad"<?php if(!flat_do_some()){ ?> title="Доступно в PRO версии"<?php } ?>><span style="position:relative;z-index:3">Для планшетов</span></label>
			<input type="radio" name="<?php echo 'sub_block_'.$key; ?>_radio_resolution" id="<?php echo 'sub_block_'.$key; ?>_radio_resolution_des"<?php if($switch_case == 3) echo ' checked="checked"'; ?><?php if(!flat_do_some()){ ?> disabled="disabled"<?php } ?>>
			<label class="select_none" for="<?php echo 'sub_block_'.$key; ?>_radio_resolution_des"<?php if(!flat_do_some()){ ?> title="Доступно в PRO версии"<?php } ?>><span style="position:relative;z-index:3">Для компьютеров</span></label>
			<input type="radio" name="<?php echo 'sub_block_'.$key; ?>_radio_resolution" id="<?php echo 'sub_block_'.$key; ?>_radio_resolution_cus"<?php if($switch_case == 4) echo ' checked="checked"'; ?><?php if(!flat_do_some()){ ?> disabled="disabled"<?php } ?>>
			<label class="select_none" for="<?php echo 'sub_block_'.$key; ?>_radio_resolution_cus"<?php if(!flat_do_some()){ ?> title="Доступно в PRO версии"<?php } ?>><span style="position:relative;z-index:3">Выбрать самому</span></label>
		</div>
	</div>
	<?php
	}
	unset($value);
	unset($key);
	?>
</div>