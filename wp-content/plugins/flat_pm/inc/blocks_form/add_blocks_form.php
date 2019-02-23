<div class="flat_pm_wrap">
	<h1>Добавить новый блок рекламы <?php if(!flat_do_some()){ ?> - <a href="http://wp-pro.online/" target="_blank">Купить <span>PRO</span> версию</a><?php } ?></h1>
	<form onsubmit="return false;" action="options.php">
		<div class="block_form_wrapper">
			<input type="text" name="block_name" id="block_name" placeholder="Название блока">
		</div>
		<div class="block_form_wrapper item_counter">
			<input type="radio" name="block_checkbox" id="block_checkbox_html" checked="checked">
			<label class="select_none" for="block_checkbox_html"><span style="position:relative;z-index:3">HTML</span></label>
			<input type="radio" name="block_checkbox" id="block_checkbox_view">
			<label class="select_none" for="block_checkbox_view"><span style="position:relative;z-index:3">Параметры вывода</span></label>
			<input type="radio" name="block_checkbox" id="block_checkbox_date"<?php if(!flat_do_some()){ ?> disabled="disabled"<?php } ?>>
			<label class="select_none" for="block_checkbox_date"<?php if(!flat_do_some()){ ?> title="Доступно в PRO версии"<?php } ?>><span style="position:relative;z-index:3">Время / Дата</span></label>
			<input type="radio" name="block_checkbox" id="block_checkbox_geo"<?php if(!flat_do_some()){ ?> disabled="disabled"<?php } ?>>
			<label class="select_none" for="block_checkbox_geo"<?php if(!flat_do_some()){ ?> title="Доступно в PRO версии"<?php } ?>><span style="position:relative;z-index:3">ГЕО</span></label>
			<input type="radio" name="block_checkbox" id="block_checkbox_referer"<?php if(!flat_do_some()){ ?> disabled="disabled"<?php } ?>>
			<label class="select_none" for="block_checkbox_referer"<?php if(!flat_do_some()){ ?> title="Доступно в PRO версии"<?php } ?>><span style="position:relative;z-index:3">REFERER</span></label>
			<input type="radio" name="block_checkbox" id="block_checkbox_os"<?php if(!flat_do_some()){ ?> disabled="disabled"<?php } ?>>
			<label class="select_none" for="block_checkbox_os"<?php if(!flat_do_some()){ ?> title="Доступно в PRO версии"<?php } ?>><span style="position:relative;z-index:3">ОС</span></label>
			<input type="radio" name="block_checkbox" id="block_checkbox_browser"<?php if(!flat_do_some()){ ?> disabled="disabled"<?php } ?>>
			<label class="select_none" for="block_checkbox_browser"<?php if(!flat_do_some()){ ?> title="Доступно в PRO версии"<?php } ?>><span style="position:relative;z-index:3">Браузер</span></label>
			<input type="radio" name="block_checkbox" id="block_checkbox_role" disabled="disabled">
			<label class="select_none" for="block_checkbox_role" title="Временно недоступно"><span style="position:relative;z-index:3">Роли</span></label>
			<?php include_once 'add_block_inc/block_checkbox_html.php'; ?>
			<?php include_once 'add_block_inc/block_checkbox_view.php'; ?>
			<?php include_once 'add_block_inc/block_checkbox_date.php'; ?>
			<?php include_once 'add_block_inc/block_checkbox_geo.php'; ?>
			<?php include_once 'add_block_inc/block_checkbox_role.php'; ?>
			<?php include_once 'add_block_inc/block_checkbox_referer.php'; ?>
			<?php include_once 'add_block_inc/block_checkbox_os.php'; ?>
			<?php include_once 'add_block_inc/block_checkbox_browser.php'; ?>
			<div class="block_save_form">
				<a class="save_create_block"><span style="position:relative;z-index:3">Создать рекламный блок</span></a>
			</div>
		</div>
	</form>
	<?php require ABSPATH.'wp-content/plugins/flat_pm/inc/news.php'; ?>
</div>