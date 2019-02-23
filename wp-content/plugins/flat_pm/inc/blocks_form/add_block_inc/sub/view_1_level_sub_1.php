<div class="view_1_level_sub_1">
	<input type="radio" name="view_2_level" id="view_2_level_sub_1" checked="checked">
	<label for="view_2_level_sub_1" class="select_none"><span style="position:relative;z-index:3">Простые</span></label>
	<input type="radio" name="view_2_level" id="view_2_level_sub_2">
	<label for="view_2_level_sub_2" class="select_none"><span style="position:relative;z-index:3">Один раз</span></label>
	<input type="radio" name="view_2_level" id="view_2_level_sub_3">
	<label for="view_2_level_sub_3" class="select_none"><span style="position:relative;z-index:3">Каждые N</span></label>
	<input type="radio" name="view_2_level" id="view_2_level_sub_4">
	<label for="view_2_level_sub_4" class="select_none"><span style="position:relative;z-index:3">Всплывающие</span></label>
	<input type="radio" name="view_2_level" id="view_2_level_sub_5">
	<label for="view_2_level_sub_5" class="select_none"><span style="position:relative;z-index:3">Выезжающие</span></label>
	<div class="view_2_level_sub_1">
		<input type="radio" name="base_radio_type" id="base_radio_type_id_1" checked="checked">
		<label for="base_radio_type_id_1" class="select_none">В начале статьи</label>
		<input type="radio" name="base_radio_type" id="base_radio_type_id_2">
		<label for="base_radio_type_id_2" class="select_none">В центре статьи</label>
		<input type="radio" name="base_radio_type" id="base_radio_type_id_3">
		<label for="base_radio_type_id_3" class="select_none">В конце статьи</label>
	</div>
	<div class="view_2_level_sub_2 pseudo1">
		<div class="flex_flat">
			<div class="item_flex">
				<input type="checkbox" name="direction_check_block" id="direction_check_block" checked="checked">
				<label for="direction_check_block" title="Направление поиска по статье"></label>
			</div>
			<div class="item_flex">
				<input type="radio" name="before_or_after" id="before_or_after_1" checked="checked">
				<label for="before_or_after_1" class="select_none">Перед</label>
				<input type="radio" name="before_or_after" id="before_or_after_2">
				<label for="before_or_after_2" class="select_none">После</label>
			</div>
			<div class="item_flex">
				<input type="text" name="N_counter" id="N_counter" placeholder="N">
			</div>
			<div class="item_flex">
				<p>
					<select name="tag_choosen" id="tag_choosen">
						<option value="p">Параграфов &lt;p&gt;</option>
						<option value="img">Картинок &lt;img&gt;</option>
						<option value="iframe">Видео &lt;iframe&gt;</option>
						<option value="blockquote">Цитат &lt;blockquote&gt;</option>
						<option value="ul">Списков &lt;ul&gt;</option>
						<option value="ol">Списков &lt;ol&gt;</option>
						<option value="h1">H1 &lt;h1&gt;</option>
						<option value="h2">H2 &lt;h2&gt;</option>
						<option value="h3">H3 &lt;h3&gt;</option>
						<option value="h4">H4 &lt;h4&gt;</option>
						<option value="h5">H5 &lt;h5&gt;</option>
						<option value="h6">H6 &lt;h6&gt;</option>
					</select>
					<br>&nbsp;&nbsp;или укажите свой селектор&nbsp;&nbsp;<br>
					<input type="text" name="selector_choosen" id="selector_choosen" placeholder="tag.class#id[attr=&quot;attr&quot;]" title="tag&#013;.class&#013;#id&#013;[attr=&quot;attr&quot;]">
				</p>
			</div>
			<div class="item_flex">
				<input type="checkbox" name="find_at_all_page" id="find_at_all_page">
				<label for="find_at_all_page" class="select_none" title="Поиск не только по статье, а по всей странице">скать<br>по всему документу</label>
			</div>
		</div>
	</div>
	<div class="view_2_level_sub_3 pseudo1">
		<div class="flex_flat">
			<div class="item_flex">
				<input type="checkbox" name="direction_check_block_N" id="direction_check_block_N" checked="checked">
				<label for="direction_check_block_N" title="Направление поиска по статье"></label>
			</div>
			<div class="item_flex">
				<input type="radio" name="before_or_after_N" id="before_or_after_N_1" checked="checked">
				<label for="before_or_after_N_1" class="select_none">Перед</label>
				<input type="radio" name="before_or_after_N" id="before_or_after_N_2">
				<label for="before_or_after_N_2" class="select_none">После</label>
			</div>
			<div class="item_flex">
				<p><input type="text" name="N_counter_N" id="N_counter_N" placeholder="N"> каждых</p>
			</div>
			<div class="item_flex">
				<p>
					<select name="tag_choosen_N" id="tag_choosen_N">
						<option value="p">Параграфов &lt;p&gt;</option>
						<option value="img">Картинок &lt;img&gt;</option>
						<option value="iframe">Видео &lt;iframe&gt;</option>
						<option value="blockquote">Цитат &lt;blockquote&gt;</option>
						<option value="ul">Списков &lt;ul&gt;</option>
						<option value="ol">Списков &lt;ol&gt;</option>
						<option value="h1">H1 &lt;h1&gt;</option>
						<option value="h2">H2 &lt;h2&gt;</option>
						<option value="h3">H3 &lt;h3&gt;</option>
						<option value="h4">H4 &lt;h4&gt;</option>
						<option value="h5">H5 &lt;h5&gt;</option>
						<option value="h6">H6 &lt;h6&gt;</option>
					</select>
					<br>&nbsp;&nbsp;или укажите свой селектор&nbsp;&nbsp;<br>
					<input type="text" name="selector_choosen_N" id="selector_choosen_N" placeholder="tag.class#id[attr=&quot;attr&quot;]" title="tag&#013;.class&#013;#id&#013;[attr=&quot;attr&quot;]">
				</p>
			</div>
			<div class="item_flex">
				<input type="checkbox" name="find_at_all_page_N" id="find_at_all_page_N">
				<label for="find_at_all_page_N" class="select_none" title="Поиск не только по статье, а по всей странице">скать<br>по всему документу</label>
			</div>
		</div>
	</div>
	<div class="view_2_level_sub_4 pseudo2">
		<div class="flex_flat">
			<div class="item_flex">
				<input type="checkbox" name="cross_check_block_1" id="cross_check_block_1" checked="checked">
				<label for="cross_check_block_1" class="select_none">ыводить крестик</label>
			</div>
			<div class="item_flex">
				<p style="padding-left:5px">Выводить через 
					<input type="text" name="after_px_vs_s_block_1" id="after_px_vs_s_block_1">
					<input type="checkbox" name="px_vs_s_check_block_1" id="px_vs_s_check_block_1" checked="checked">
					<label for="px_vs_s_check_block_1" class="select_none"></label>
				</p>
			</div>
		</div>
	</div>
	<div class="view_2_level_sub_5 pseudo3">
		<div class="flex_flat">
			<div class="item_flex">
				<input type="checkbox" name="cross_check_block_2" id="cross_check_block_2" checked="checked">
				<label for="cross_check_block_2" class="select_none">ыводить крестик</label>
			</div>
			<div class="item_flex">
				<input type="radio" name="whence_radio_block" id="whence_radio_block_1" checked="checked">
				<label for="whence_radio_block_1" class="select_none">Сверху по центру</label>
				<input type="radio" name="whence_radio_block" id="whence_radio_block_2">
				<label for="whence_radio_block_2" class="select_none">Снизу по центру</label>
				<input type="radio" name="whence_radio_block" id="whence_radio_block_3">
				<label for="whence_radio_block_3" class="select_none">Слева, отступ снизу <input type="text" name="whence_radio_block_3_px" id="whence_radio_block_3_px" placeholder="px"></label>
				<input type="radio" name="whence_radio_block" id="whence_radio_block_4">
				<label for="whence_radio_block_4" class="select_none">Справа, отступ снизу <input type="text" name="whence_radio_block_4_px" id="whence_radio_block_4_px" placeholder="px"></label>
			</div>
			<div class="item_flex">
				<p style="padding-left:5px">Выводить через 
					<input type="text" name="after_px_vs_s_block_2" id="after_px_vs_s_block_2">
					<input type="checkbox" name="px_vs_s_check_block_2" id="px_vs_s_check_block_2" checked="checked">
					<label for="px_vs_s_check_block_2" class="select_none"></label>
				</p>
			</div>
		</div>
	</div>
</div>