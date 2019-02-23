<?php
$flat_block_ID = $_GET['block_id'];
$flat_pm_block = get_post($flat_block_ID);
?>
<div class="flat_pm_wrap">
	<h1>Редактировать блок рекламы <?php if(!flat_do_some()){ ?> - <a href="http://wp-pro.online/" target="_blank">Купить <span>PRO</span> версию</a><?php } ?></h1>
	<?php
	if(isset($flat_pm_block) && $flat_pm_block != null && $flat_pm_block->post_type == 'flat_pm_block'){
	?>
	<form onsubmit="return false;" action="options.php">
		<div class="block_form_wrapper">
			<input type="text" name="block_name" id="block_name" placeholder="Название блока" value="<?php echo $flat_pm_block->post_title; ?>">
		</div>
		<div class="block_form_wrapper item_counter">
			<input type="radio" name="block_checkbox" id="block_checkbox_html"<?php if(!isset($_GET['tab']) || $_GET['tab'] == 'html') echo ' checked="checked"'; ?>>
			<label class="select_none" for="block_checkbox_html"><span style="position:relative;z-index:3">HTML</span></label>
			<input type="radio" name="block_checkbox" id="block_checkbox_view"<?php if($_GET['tab'] == 'view') echo ' checked="checked"'; ?>>
			<label class="select_none" for="block_checkbox_view"><span style="position:relative;z-index:3">Параметры вывода</span></label>
			<input type="radio" name="block_checkbox" id="block_checkbox_date"<?php if($_GET['tab'] == 'date') echo ' checked="checked"'; ?><?php if(!flat_do_some()){ ?> disabled="disabled"<?php } ?>>
			<label class="select_none" for="block_checkbox_date"<?php if(!flat_do_some()){ ?> title="Доступно в PRO версии"<?php } ?>><span style="position:relative;z-index:3">Время / Дата</span></label>
			<input type="radio" name="block_checkbox" id="block_checkbox_geo"<?php if($_GET['tab'] == 'geo') echo ' checked="checked"'; ?><?php if(!flat_do_some()){ ?> disabled="disabled"<?php } ?>>
			<label class="select_none" for="block_checkbox_geo"<?php if(!flat_do_some()){ ?> title="Доступно в PRO версии"<?php } ?>><span style="position:relative;z-index:3">ГЕО</span></label>
			<input type="radio" name="block_checkbox" id="block_checkbox_referer"<?php if($_GET['tab'] == 'referer') echo ' checked="checked"'; ?><?php if(!flat_do_some()){ ?> disabled="disabled"<?php } ?>>
			<label class="select_none" for="block_checkbox_referer"><span style="position:relative;z-index:3">REFERER</span></label>
			<input type="radio" name="block_checkbox" id="block_checkbox_os"<?php if($_GET['tab'] == 'os') echo ' checked="checked"'; ?><?php if(!flat_do_some()){ ?> disabled="disabled"<?php } ?>>
			<label class="select_none" for="block_checkbox_os"<?php if(!flat_do_some()){ ?> title="Доступно в PRO версии"<?php } ?>><span style="position:relative;z-index:3">ОС</span></label>
			<input type="radio" name="block_checkbox" id="block_checkbox_browser"<?php if($_GET['tab'] == 'browser') echo ' checked="checked"'; ?><?php if(!flat_do_some()){ ?> disabled="disabled"<?php } ?>>
			<label class="select_none" for="block_checkbox_browser"<?php if(!flat_do_some()){ ?> title="Доступно в PRO версии"<?php } ?>><span style="position:relative;z-index:3">Браузер</span></label>
			<input type="radio" name="block_checkbox" id="block_checkbox_role" disabled="disabled">
			<label class="select_none" for="block_checkbox_role" title="Временно недоступно"><span style="position:relative;z-index:3">Роли</span></label>
			<?php include_once 'edit_block_inc/block_checkbox_html.php'; ?>
			<?php include_once 'edit_block_inc/block_checkbox_view.php'; ?>
			<?php include_once 'edit_block_inc/block_checkbox_date.php'; ?>
			<?php include_once 'edit_block_inc/block_checkbox_geo.php'; ?>
			<?php include_once 'edit_block_inc/block_checkbox_role.php'; ?>
			<?php include_once 'edit_block_inc/block_checkbox_referer.php'; ?>
			<?php include_once 'edit_block_inc/block_checkbox_os.php'; ?>
			<?php include_once 'edit_block_inc/block_checkbox_browser.php'; ?>
			<div class="block_save_form">
				<a class="update_create_block" data-id="<?php echo $_GET['block_id']; ?>"><span style="position:relative;z-index:3">Сохранить рекламный блок</span></a>
			</div>
		</div>
	</form>
	<?php
	}
	?>
	<?php require ABSPATH.'wp-content/plugins/flat_pm/inc/news.php'; ?>
</div>