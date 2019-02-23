<div class="block_checkbox_html">
	<link rel="stylesheet" id="editor-buttons-css" href="<?php echo get_site_url(); ?>/wp-includes/css/editor.min.css?ver=4.9.4" type="text/css" media="all">
	<div class="item_sub_block">
		<div class="sub_block_wrapper flex_flat">
			<div class="float_flex" style="width:calc(50% - 45px)">
				<h2>Основной рекламный код</h2>
				<?php
				$content_sub_block = '';
				wp_editor($content_sub_block, 'sub_block_1', array(
					'textarea_name' => 'content_sub_block_1',
					'editor_height' => 230,
					'tinymce'       => false,
					'textarea_rows' => 10,
				));
				?>
			</div>
			<div class="float_flex" style="width:calc(50% - 45px)">
				<h2>Рекламный код для пользователей <span style="color:red">ADblock</span></h2>
				<?php
				$content_sub_block_instead = '';
				wp_editor($content_sub_block_instead, 'sub_block_1_instead', array(
					'textarea_name' => 'content_sub_block_1_instead',
					'editor_height' => 230,
					'tinymce'       => false,
					'textarea_rows' => 10,
				));
				?>
			</div>
			<div class="float_flex float_flex_colum" style="width:50px">
				<select name="rotateAB" id="rotateAB"<?php if(flat_do_some()){ ?> title="Выбрать группу для ротации"<?php } ?><?php if(!flat_do_some()){ ?> disabled="disabled" title="Доступно в PRO версии"<?php } ?>>
					<option value="0">нет</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
				<a class="delete" onclick="return false;" title="Удалить этот блок"></a>
				<a class="to_top" onclick="return false;" title="Переместить выше"></a>
				<a class="to_down" onclick="return false;" title="Переместить ниже"></a>
				<a class="plus" onclick="return false;" title="Добавить ещё один блок" data-replace-id="1"></a>
			</div>
		</div>
		<div class="sub_block_wrapper flex_flat">
			<input type="radio" name="sub_block_1_radio_resolution" id="sub_block_1_radio_resolution_all" checked="checked">
			<label class="select_none" for="sub_block_1_radio_resolution_all"><span style="position:relative;z-index:3">Все разрешения</span></label>
			<input type="text" name="sub_block_1_radio_resolution_from" id="sub_block_1_radio_resolution_from" readonly="readonly" value="∞" placeholder="От ... px" title="От ... px">
			<input type="text" name="sub_block_1_radio_resolution_to" id="sub_block_1_radio_resolution_to" readonly="readonly" value="∞" placeholder="До ... px" title="До ... px">
			<input type="radio" name="sub_block_1_radio_resolution" id="sub_block_1_radio_resolution_mob"<?php if(!flat_do_some()){ ?> disabled="disabled"<?php } ?>>
			<label class="select_none" for="sub_block_1_radio_resolution_mob"<?php if(!flat_do_some()){ ?> title="Доступно в PRO версии"<?php } ?>><span style="position:relative;z-index:3">Для мобильных</span></label>
			<input type="radio" name="sub_block_1_radio_resolution" id="sub_block_1_radio_resolution_pad"<?php if(!flat_do_some()){ ?> disabled="disabled"<?php } ?>>
			<label class="select_none" for="sub_block_1_radio_resolution_pad"<?php if(!flat_do_some()){ ?> title="Доступно в PRO версии"<?php } ?>><span style="position:relative;z-index:3">Для планшетов</span></label>
			<input type="radio" name="sub_block_1_radio_resolution" id="sub_block_1_radio_resolution_des"<?php if(!flat_do_some()){ ?> disabled="disabled"<?php } ?>>
			<label class="select_none" for="sub_block_1_radio_resolution_des"<?php if(!flat_do_some()){ ?> title="Доступно в PRO версии"<?php } ?>><span style="position:relative;z-index:3">Для компьютеров</span></label>
			<input type="radio" name="sub_block_1_radio_resolution" id="sub_block_1_radio_resolution_cus"<?php if(!flat_do_some()){ ?> disabled="disabled"<?php } ?>>
			<label class="select_none" for="sub_block_1_radio_resolution_cus"<?php if(!flat_do_some()){ ?> title="Доступно в PRO версии"<?php } ?>><span style="position:relative;z-index:3">Выбрать самому</span></label>
		</div>
	</div>
</div>