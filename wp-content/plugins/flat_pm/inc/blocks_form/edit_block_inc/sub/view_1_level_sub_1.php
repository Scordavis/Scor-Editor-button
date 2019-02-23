<?php
$flat_block_ID = $_GET['block_id'];
?>
<div class="view_1_level_sub_1">
	<?php
	$flat_pm_view_how = get_post_meta($flat_block_ID, 'flat_pm_view', true)['how'];
	?>
	<input type="radio" name="view_2_level" id="view_2_level_sub_1"<?php if(isset($flat_pm_view_how['simple'])) echo ' checked="checked"'; ?>>
	<label for="view_2_level_sub_1" class="select_none"><span style="position:relative;z-index:3">Простые</span></label>
	<input type="radio" name="view_2_level" id="view_2_level_sub_2"<?php if(isset($flat_pm_view_how['onсe'])) echo ' checked="checked"'; ?>>
	<label for="view_2_level_sub_2" class="select_none"><span style="position:relative;z-index:3">Один раз</span></label>
	<input type="radio" name="view_2_level" id="view_2_level_sub_3"<?php if(isset($flat_pm_view_how['iterable'])) echo ' checked="checked"'; ?>>
	<label for="view_2_level_sub_3" class="select_none"><span style="position:relative;z-index:3">Каждые N</span></label>
	<input type="radio" name="view_2_level" id="view_2_level_sub_4"<?php if(isset($flat_pm_view_how['popup'])) echo ' checked="checked"'; ?>>
	<label for="view_2_level_sub_4" class="select_none"><span style="position:relative;z-index:3">Всплывающие</span></label>
	<input type="radio" name="view_2_level" id="view_2_level_sub_5"<?php if(isset($flat_pm_view_how['outgoing'])) echo ' checked="checked"'; ?>>
	<label for="view_2_level_sub_5" class="select_none"><span style="position:relative;z-index:3">Выезжающие</span></label>
	<div class="view_2_level_sub_1">
		<input type="radio" name="base_radio_type" id="base_radio_type_id_1"<?php if($flat_pm_view_how['simple']['position'] == '1' || !isset($flat_pm_view_how['simple']['position'])) echo ' checked="checked"'; ?>>
		<label for="base_radio_type_id_1" class="select_none">В начале статьи</label>
		<input type="radio" name="base_radio_type" id="base_radio_type_id_2"<?php if($flat_pm_view_how['simple']['position'] == '2') echo ' checked="checked"'; ?>>
		<label for="base_radio_type_id_2" class="select_none">В центре статьи</label>
		<input type="radio" name="base_radio_type" id="base_radio_type_id_3"<?php if($flat_pm_view_how['simple']['position'] == '3') echo ' checked="checked"'; ?>>
		<label for="base_radio_type_id_3" class="select_none">В конце статьи</label>
	</div>
	<div class="view_2_level_sub_2 pseudo1">
		<div class="flex_flat">
			<div class="item_flex">
				<input type="checkbox" name="direction_check_block" id="direction_check_block"<?php if($flat_pm_view_how['onсe']['direction'] == 'top_to_bottom' || !isset($flat_pm_view_how['onсe']['direction'])) echo ' checked="checked"'; ?>>
				<label for="direction_check_block" title="Направление поиска по статье"></label>
			</div>
			<div class="item_flex">
				<input type="radio" name="before_or_after" id="before_or_after_1"<?php if($flat_pm_view_how['onсe']['before_after'] == 'before' || !isset($flat_pm_view_how['onсe']['before_after'])) echo ' checked="checked"'; ?>>
				<label for="before_or_after_1" class="select_none">Перед</label>
				<input type="radio" name="before_or_after" id="before_or_after_2"<?php if($flat_pm_view_how['onсe']['before_after'] == 'after') echo ' checked="checked"'; ?>>
				<label for="before_or_after_2" class="select_none">После</label>
			</div>
			<div class="item_flex">
				<input type="text" name="N_counter" id="N_counter" placeholder="N" value="<?php echo $flat_pm_view_how['onсe']['N']; ?>">
			</div>
			<div class="item_flex">
				<p>
					<select name="tag_choosen" id="tag_choosen">
						<option value="p"<?php if($flat_pm_view_how['onсe']['selector'] == 'p') echo ' selected="selected"'; ?>>Параграфов &lt;p&gt;</option>
						<option value="img"<?php if($flat_pm_view_how['onсe']['selector'] == 'img') echo ' selected="selected"'; ?>>Картинок &lt;img&gt;</option>
						<option value="iframe"<?php if($flat_pm_view_how['onсe']['selector'] == 'iframe') echo ' selected="selected"'; ?>>Видео &lt;iframe&gt;</option>
						<option value="blockquote"<?php if($flat_pm_view_how['onсe']['selector'] == 'blockquote') echo ' selected="selected"'; ?>>Цитат &lt;blockquote&gt;</option>
						<option value="ul"<?php if($flat_pm_view_how['onсe']['selector'] == 'ul') echo ' selected="selected"'; ?>>Списков &lt;ul&gt;</option>
						<option value="ol"<?php if($flat_pm_view_how['onсe']['selector'] == 'ol') echo ' selected="selected"'; ?>>Списков &lt;ol&gt;</option>
						<option value="h1"<?php if($flat_pm_view_how['onсe']['selector'] == 'h1') echo ' selected="selected"'; ?>>H1 &lt;h1&gt;</option>
						<option value="h2"<?php if($flat_pm_view_how['onсe']['selector'] == 'h2') echo ' selected="selected"'; ?>>H2 &lt;h2&gt;</option>
						<option value="h3"<?php if($flat_pm_view_how['onсe']['selector'] == 'h3') echo ' selected="selected"'; ?>>H3 &lt;h3&gt;</option>
						<option value="h4"<?php if($flat_pm_view_how['onсe']['selector'] == 'h4') echo ' selected="selected"'; ?>>H4 &lt;h4&gt;</option>
						<option value="h5"<?php if($flat_pm_view_how['onсe']['selector'] == 'h5') echo ' selected="selected"'; ?>>H5 &lt;h5&gt;</option>
						<option value="h6"<?php if($flat_pm_view_how['onсe']['selector'] == 'h6') echo ' selected="selected"'; ?>>H6 &lt;h6&gt;</option>
					</select>
					<br>&nbsp;&nbsp;или укажите свой селектор&nbsp;&nbsp;<br>
					<input type="text" name="selector_choosen" id="selector_choosen" placeholder="tag.class#id[attr=&quot;attr&quot;]" title="tag&#013;.class&#013;#id&#013;[attr=&quot;attr&quot;]"<?php if(!in_array($flat_pm_view_how['onсe']['selector'], array('p','img','iframe','blockquote','ul','ol','h1','h2','h3','h4','h5','h6'))) echo ' value="'.htmlspecialchars($flat_pm_view_how['onсe']['selector']).'"'; ?>>
				</p>
			</div>
			<div class="item_flex">
				<input type="checkbox" name="find_at_all_page" id="find_at_all_page"<?php if($flat_pm_view_how['onсe']['search_all'] == 'true') echo ' checked="checked"'; ?>>
				<label for="find_at_all_page" class="select_none" title="Поиск не только по статье, а по всей странице">скать<br>по всему документу</label>
			</div>
		</div>
	</div>
	<div class="view_2_level_sub_3 pseudo1">
		<div class="flex_flat">
			<div class="item_flex">
				<input type="checkbox" name="direction_check_block_N" id="direction_check_block_N"<?php if($flat_pm_view_how['iterable']['direction'] == 'top_to_bottom' || !isset($flat_pm_view_how['iterable']['direction'])) echo ' checked="checked"'; ?>>
				<label for="direction_check_block_N" title="Направление поиска по статье"></label>
			</div>
			<div class="item_flex">
				<input type="radio" name="before_or_after_N" id="before_or_after_N_1"<?php if($flat_pm_view_how['iterable']['before_after'] == 'before' || !isset($flat_pm_view_how['iterable']['before_after'])) echo ' checked="checked"'; ?>>
				<label for="before_or_after_N_1" class="select_none">Перед</label>
				<input type="radio" name="before_or_after_N" id="before_or_after_N_2"<?php if($flat_pm_view_how['iterable']['before_after'] == 'after') echo ' checked="checked"'; ?>>
				<label for="before_or_after_N_2" class="select_none">После</label>
			</div>
			<div class="item_flex">
				<p><input type="text" name="N_counter_N" id="N_counter_N" placeholder="N" value="<?php echo $flat_pm_view_how['iterable']['N']; ?>"> каждых</p>
			</div>
			<div class="item_flex">
				<p>
					<select name="tag_choosen_N" id="tag_choosen_N">
						<option value="p"<?php if($flat_pm_view_how['iterable']['selector'] == 'p') echo ' selected="selected"'; ?>>Параграфов &lt;p&gt;</option>
						<option value="img"<?php if($flat_pm_view_how['iterable']['selector'] == 'img') echo ' selected="selected"'; ?>>Картинок &lt;img&gt;</option>
						<option value="iframe"<?php if($flat_pm_view_how['iterable']['selector'] == 'iframe') echo ' selected="selected"'; ?>>Видео &lt;iframe&gt;</option>
						<option value="blockquote"<?php if($flat_pm_view_how['iterable']['selector'] == 'blockquote') echo ' selected="selected"'; ?>>Цитат &lt;blockquote&gt;</option>
						<option value="ul"<?php if($flat_pm_view_how['iterable']['selector'] == 'ul') echo ' selected="selected"'; ?>>Списков &lt;ul&gt;</option>
						<option value="ol"<?php if($flat_pm_view_how['iterable']['selector'] == 'ol') echo ' selected="selected"'; ?>>Списков &lt;ol&gt;</option>
						<option value="h1"<?php if($flat_pm_view_how['iterable']['selector'] == 'h1') echo ' selected="selected"'; ?>>H1 &lt;h1&gt;</option>
						<option value="h2"<?php if($flat_pm_view_how['iterable']['selector'] == 'h2') echo ' selected="selected"'; ?>>H2 &lt;h2&gt;</option>
						<option value="h3"<?php if($flat_pm_view_how['iterable']['selector'] == 'h3') echo ' selected="selected"'; ?>>H3 &lt;h3&gt;</option>
						<option value="h4"<?php if($flat_pm_view_how['iterable']['selector'] == 'h4') echo ' selected="selected"'; ?>>H4 &lt;h4&gt;</option>
						<option value="h5"<?php if($flat_pm_view_how['iterable']['selector'] == 'h5') echo ' selected="selected"'; ?>>H5 &lt;h5&gt;</option>
						<option value="h6"<?php if($flat_pm_view_how['iterable']['selector'] == 'h6') echo ' selected="selected"'; ?>>H6 &lt;h6&gt;</option>
					</select>
					<br>&nbsp;&nbsp;или укажите свой селектор&nbsp;&nbsp;<br>
					<input type="text" name="selector_choosen_N" id="selector_choosen_N" placeholder="tag.class#id[attr=&quot;attr&quot;]" title="tag&#013;.class&#013;#id&#013;[attr=&quot;attr&quot;]"<?php if(!in_array($flat_pm_view_how['iterable']['selector'], array('p','img','iframe','blockquote','ul','ol','h1','h2','h3','h4','h5','h6'))) echo ' value="'.htmlspecialchars($flat_pm_view_how['iterable']['selector']).'"'; ?>>
				</p>
			</div>
			<div class="item_flex">
				<input type="checkbox" name="find_at_all_page_N" id="find_at_all_page_N"<?php if($flat_pm_view_how['iterable']['search_all'] == 'true') echo ' checked="checked"'; ?>>
				<label for="find_at_all_page_N" class="select_none" title="Поиск не только по статье, а по всей странице">скать<br>по всему документу</label>
			</div>
		</div>
	</div>
	<div class="view_2_level_sub_4 pseudo2">
		<div class="flex_flat">
			<div class="item_flex">
				<input type="checkbox" name="cross_check_block_1" id="cross_check_block_1"<?php if($flat_pm_view_how['popup']['cross'] == 'true' || !isset($flat_pm_view_how['popup']['cross'])) echo ' checked="checked"'; ?>>
				<label for="cross_check_block_1" class="select_none">ыводить крестик</label>
			</div>
			<div class="item_flex">
				<p style="padding-left:5px">Выводить через 
					<input type="text" name="after_px_vs_s_block_1" id="after_px_vs_s_block_1" value="<?php echo $flat_pm_view_how['popup']['after']; ?>">
					<input type="checkbox" name="px_vs_s_check_block_1" id="px_vs_s_check_block_1"<?php if($flat_pm_view_how['popup']['px_s'] == 'px' || !isset($flat_pm_view_how['popup']['px_s'])) echo ' checked="checked"'; ?>>
					<label for="px_vs_s_check_block_1" class="select_none"></label>
				</p>
			</div>
		</div>
	</div>
	<div class="view_2_level_sub_5 pseudo3">
		<div class="flex_flat">
			<div class="item_flex">
				<input type="checkbox" name="cross_check_block_2" id="cross_check_block_2"<?php if($flat_pm_view_how['outgoing']['cross'] == 'true' || !isset($flat_pm_view_how['outgoing']['cross'])) echo ' checked="checked"'; ?>>
				<label for="cross_check_block_2" class="select_none">ыводить крестик</label>
			</div>
			<div class="item_flex">
				<input type="radio" name="whence_radio_block" id="whence_radio_block_1"<?php if($flat_pm_view_how['outgoing']['whence'] == '1' || !isset($flat_pm_view_how['outgoing']['whence'])) echo ' checked="checked"'; ?>>
				<label for="whence_radio_block_1" class="select_none">Сверху по центру</label>
				<input type="radio" name="whence_radio_block" id="whence_radio_block_2"<?php if($flat_pm_view_how['outgoing']['whence'] == '2') echo ' checked="checked"'; ?>>
				<label for="whence_radio_block_2" class="select_none">Снизу по центру</label>
				<input type="radio" name="whence_radio_block" id="whence_radio_block_3"<?php if($flat_pm_view_how['outgoing']['whence'] == '3') echo ' checked="checked"'; ?>>
				<label for="whence_radio_block_3" class="select_none">Слева, отступ снизу <input type="text" name="whence_radio_block_3_px" id="whence_radio_block_3_px" placeholder="px" value="<?php if($flat_pm_view_how['outgoing']['whence'] == '3') echo $flat_pm_view_how['outgoing']['indent']; ?>"></label>
				<input type="radio" name="whence_radio_block" id="whence_radio_block_4"<?php if($flat_pm_view_how['outgoing']['whence'] == '4') echo ' checked="checked"'; ?>>
				<label for="whence_radio_block_4" class="select_none">Справа, отступ снизу <input type="text" name="whence_radio_block_4_px" id="whence_radio_block_4_px" placeholder="px" value="<?php if($flat_pm_view_how['outgoing']['whence'] == '4') echo $flat_pm_view_how['outgoing']['indent']; ?>"></label>
			</div>
			<div class="item_flex">
				<p style="padding-left:5px">Выводить через 
					<input type="text" name="after_px_vs_s_block_2" id="after_px_vs_s_block_2" value="<?php echo $flat_pm_view_how['outgoing']['after']; ?>">
					<input type="checkbox" name="px_vs_s_check_block_2" id="px_vs_s_check_block_2"<?php if($flat_pm_view_how['outgoing']['px_s'] == 'px' || !isset($flat_pm_view_how['outgoing']['px_s'])) echo ' checked="checked"'; ?>>
					<label for="px_vs_s_check_block_2" class="select_none"></label>
				</p>
			</div>
		</div>
	</div>
</div>