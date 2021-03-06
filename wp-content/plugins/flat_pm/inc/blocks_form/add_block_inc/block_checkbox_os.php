<div class="block_checkbox_os">
	<div class="flat_settings">
		<div class="item_geo_block">
			<input type="checkbox" name="os_check_setting" id="os_check_setting">
			<label for="os_check_setting" class="select_none">Блок настроек </label>
		</div>
		<div class="item_geo_block">
			<div class="notice_me" style="text-align:center"><span style="color:red">!Важно</span> вводить каждую ОС с новой строки</div>
			<div class="float_left">
				<h3 style="text-align:center">Для каких ОС показывать</h3>
				<textarea name="flat_os_enabled" id="flat_os_enabled" placeholder="Например: Windows"></textarea>
			</div>
			<div class="float_right">
				<h3 style="text-align:center">Для каких ОС <span>не</span> показывать</h3>
				<textarea name="flat_os_disabled" id="flat_os_disabled" placeholder="Например: Windows"></textarea>
			</div>
			<p class="notice" style="text-align:center;padding:10px 0 0;clear:both"><span style="color:red">Список всех ОС</span>: Windows, Mac, iPhone, Linux.<br><br><span style="color:red">!Важно</span> Поиск будет происходить из навигатора: <span style="color:red">navigator.platform.indexOf</span></p>
		</div>
	</div>
</div>