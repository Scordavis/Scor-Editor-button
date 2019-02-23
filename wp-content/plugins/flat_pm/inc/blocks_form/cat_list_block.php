<div class="flat_pm_wrap">
	<?php
	$current_cat_ID = $_GET['block_cat_ID'];
	?>
	<h1>Папка: <?php echo get_term($current_cat_ID)->name; ?> <?php if(!flat_do_some()){ ?> - <a href="http://wp-pro.online/" target="_blank">Купить <span>PRO</span> версию</a><?php } ?></h1>
	<div class="list_block">
		<div class="row_panel">
			<a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=add_blocks_form&block_cat_ID=<?php echo $current_cat_ID; ?>" class="add_block_new">Добавить новый блок</a>
			<a href="" class="drop_cat_selectable">Переместить в папку</a>
			<a href="" class="enable_selectable">Активировать</a>
			<a href="" class="disable_selectable">Деактивировать</a>
			<a href="" class="delete_selectable">Удалить</a>
			<span class="count_selected_blocks">1</span>
		</div>
		<div class="row_cat">
			<a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=blocks_form" class="cat_flat_pm">
				<span class="name">......</span>
			</a>
			<?php
			$args_flat_pm = array(
				'taxonomy' => 'flat_pm_block_folders',
				'hide_empty' => false,
			);
			$terms_flat_pm = get_terms( $args_flat_pm );
			foreach ($terms_flat_pm as $term) {
			?>
			<a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=blocks_form&block_cat_ID=<?php echo $term->term_id; ?>" class="cat_flat_pm<?php if($term->term_id == $current_cat_ID){ ?> active<?php } ?>" data-id="<?php echo $term->term_id; ?>">
				<span class="delete folder_remove"></span>
				<span class="rename folder_rename"></span>
				<span class="name"><?php echo $term->name; ?></span>
			</a>
			<?php
			}
			unset($term);
			?>
			<a href="" class="cat_new_flat_pm" title="Добавить папку"></a>
		</div>
		<div class="row_list">
			<?php
			$args_flat_pm = array(
				'flat_pm_block_folders' => get_term($current_cat_ID)->slug,
				'posts_per_page'        => -1,
				'post_type'             => 'flat_pm_block',
				'order'                 => 'ASC',
				'orderby'               => 'meta_value_num',
				'meta_key'              => 'flat_pm_order_ID',
			);
			$query = new WP_Query( $args_flat_pm );
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					$block_id = get_the_ID();
					$flat_pm_view    = get_post_meta($block_id, 'flat_pm_view', true);
					$flat_pm_date    = get_post_meta($block_id, 'flat_pm_date', true);
					$flat_pm_geo     = get_post_meta($block_id, 'flat_pm_geo', true);
					$flat_pm_referer = get_post_meta($block_id, 'flat_pm_referer', true);
					$flat_pm_os      = get_post_meta($block_id, 'flat_pm_os', true);
					$flat_pm_role    = get_post_meta($block_id, 'flat_pm_role', true);
					switch (true) {
						case isset($flat_pm_view['how']['simple']):
							$type_block_view = 'Простой';
							break;
						case isset($flat_pm_view['how']['onсe']):
							$type_block_view = 'Один раз';
							break;
						case isset($flat_pm_view['how']['iterable']):
							$type_block_view = 'Каждые N';
							break;
						case isset($flat_pm_view['how']['popup']):
							$type_block_view = 'Всплывающий';
							break;
						case isset($flat_pm_view['how']['outgoing']):
							$type_block_view = 'Выезжающий';
							break;
					}
			?>
			<div class="item_flat_block" data-block-id="<?php echo $block_id; ?>">
				<div class="top_of_block">
					<input type="checkbox" name="check_block_id_<?php echo $block_id; ?>" id="check_block_id_<?php echo $block_id; ?>"><label for="check_block_id_<?php echo $block_id; ?>"></label>
					<a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=blocks_form&block_id=<?php echo $block_id; ?>" class="name_of_block"><?php echo get_the_title(); ?></a>
					<div class="float_right">
						<a href="" class="to_top_block"></a>
						<a href="" class="to_bottom_block"></a>
					</div>
					<div class="float_right">
						<a href="" class="delete_this_block" title="Удалить блок"></a>
						<a href="" class="copy_this_block" title="Копировать блок"></a>
						<a href="" class="disable_this_block" title="Активировать?" data-enabled="<?php echo get_post_meta($block_id, 'flat_pm_block_enabled', true); ?>"></a>
					</div>
					<a class="more_of_this"></a>
				</div>
				<div class="bottom_of_block flat_clear">
					<div class="some_stat_block" style="margin:0">
						<table style="margin:0">
							<tbody>
								<tr>
									<td>Тип : </td>
									<td><input style="width:150px" type="text" name="count_sub_flat_block" id="count_sub_flat_block" readonly="readonly" value="<?php echo $type_block_view; ?>"></td>
									<td>Браузер : </td>
									<td><input style="width:150px" type="text" name="count_sub_flat_block" id="count_sub_flat_block" readonly="readonly" value="<?php echo (($flat_pm_browser['enabled'] != 'true') ? 'Выключено' : 'Включено'); ?>"></td>
								</tr>
								<tr>
									<td>Ограничение контента : </td>
									<td><input style="width:150px" type="text" name="count_sub_flat_block" id="count_sub_flat_block" readonly="readonly" value="<?php echo (($flat_pm_view['chapter_limit'] != '') ? 'N = '.$flat_pm_view['chapter_limit'] : 'Отсутствует'); ?>"></td>
									<td>ОС : </td>
									<td><input style="width:150px" type="text" name="count_sub_flat_block" id="count_sub_flat_block" readonly="readonly" value="<?php echo (($flat_pm_os['enabled'] != 'true') ? 'Выключено' : 'Включено'); ?>"></td>
								</tr>
								<tr>
									<td>Дата / время : </td>
									<td><input style="width:150px" type="text" name="count_sub_flat_block" id="count_sub_flat_block" readonly="readonly" value="<?php echo (($flat_pm_date['date_enabled'] != 'true') ? 'Выключено' : 'Включено'); ?>"></td>
									<td>Роли : </td>
									<td><input style="width:150px" type="text" name="count_sub_flat_block" id="count_sub_flat_block" readonly="readonly" value="<?php echo (($flat_pm_role['enabled'] != 'true') ? 'Выключено' : 'Включено'); ?>"></td>
								</tr>
								<tr>
									<td>ГЕО : </td>
									<td><input style="width:150px" type="text" name="count_sub_flat_block" id="count_sub_flat_block" readonly="readonly" value="<?php echo (($flat_pm_geo['geo_enabled'] != 'true') ? 'Выключено' : 'Включено'); ?>"></td>
									<td>Referer : </td>
									<td><input style="width:150px" type="text" name="count_sub_flat_block" id="count_sub_flat_block" readonly="readonly" value="<?php echo (($flat_pm_referer['enabled'] != 'true') ? 'Выключено' : 'Включено'); ?>"></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="some_stat_block">
						<table>
							<tbody>
								<tr>
									<td>Количество подблоков : </td>
									<td><input type="text" name="count_sub_flat_block" id="count_sub_flat_block" readonly="readonly" value="<?php echo get_post_meta($block_id, 'flat_pm_count_sub', true); ?>"></td>
								</tr>
								<tr>
									<td>Порядок : </td>
									<td><input type="text" name="order_flat_block" id="order_flat_block" value="<?php echo get_post_meta($block_id, 'flat_pm_order_ID', true); ?>"></td>
								</tr>
								<tr>
									<td>Включен ли A/B тест : </td>
									<td><input type="text" name="AB_flat_block" id="AB_flat_block" readonly="readonly" value="<?php echo get_post_meta($block_id, 'flat_pm_AB', true); ?>"></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<?php
				}
			}
			wp_reset_postdata();
			?>
		</div>
		<div class="hidden_flat">
			<div class="move_to_cat flat_pm_wrap cat_style">
				<div class="btn_close"></div>
				<h4>Переместить в папку</h4>
				<p>Выберите папку: 
					<select id="cat_select">
						<option value="0">......</option>
						<?php
						foreach ($terms_flat_pm as $term) {
							if($term->term_id != $current_cat_ID){
						?>
						<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
						<?php
							}
						}
						unset($term);
						?>
					</select>
					<button class="move_to_folder">1</button>
				</p>
			</div>
			<div class="create_cat flat_pm_wrap cat_style">
				<div class="btn_close"></div>
				<h4>Создать папку</h4>
				<p>Название папки: 
					<input type="text" name="create_cat_name" id="create_cat_name">
					<button class="folder_add">1</button>
				</p>
			</div>
			<div class="rename_cat flat_pm_wrap cat_style">
				<div class="btn_close"></div>
				<h4>Переименовать папку</h4>
				<p>Новое название: 
					<input type="text" name="rename_cat_name" id="rename_cat_name">
					<input type="hidden" name="rename_cat_name_hidden" id="rename_cat_name_hidden" value="">
					<button class="folder_rename">1</button>
				</p>
			</div>
		</div>
	</div>
	<?php require ABSPATH.'wp-content/plugins/flat_pm/inc/news.php'; ?>
</div>