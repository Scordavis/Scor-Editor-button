<?php
$flat_block_ID = $_GET['block_id'];
?>
<div class="view_1_level_sub_2">
	<?php
	$flat_pm_view_where = get_post_meta($flat_block_ID, 'flat_pm_view', true)['where'];
	$args = array(
		'public'   => true
	);
	$post_types = array_diff(array_values(get_post_types( $args, 'names', 'and' )), array('flat_pm_block','attachment'));
	$terms_flat = get_terms(array(
		'taxonomy' => get_object_taxonomies($post_types)
	));
	$tax_flat_bool = array();
	$tax_flat = array();
	foreach ($terms_flat as $value) {
		if(!isset($tax_flat_bool[$value->taxonomy])){
			$tax_flat_bool[$value->taxonomy] = true;
			$tax_flat []= get_taxonomy($value->taxonomy);
		}
	}
	unset($value);
	?>
	<div class="item_flex" style="padding-bottom:20px;margin-bottom:50px;border-bottom:2px dashed #8590c3">
		<h2>Ваши типы записей (<span title="Как пример">записи, страницы</span>):</h2>
		<?php
		$div_hidden = array();
		foreach ($post_types as $value) {
			$value = get_post_type_object($value);
			echo '<input type="checkbox" name="checkbox_block_post_type_'.$value->name.'" id="checkbox_block_post_type_'.$value->name.'" '.((in_array($value->name, $flat_pm_view_where['type_of_posts'])) ? 'checked="checked"' : '' ).'><label for="checkbox_block_post_type_'.$value->name.'" class="select_none">'.$value->labels->name.'</label>';
		}
		unset($value);
		$flat_post = get_posts(array(
			'post_type'   => $post_types,
			'numberposts' => -1,
			'fields'      => 'ids'
		));
		foreach ($flat_post as $value) {
			$f_post = get_post($value);
			$div_hidden [] = array($f_post->post_title,$f_post->post_type,strval($value));
			unset($f_post);
			wp_cache_delete( $value, 'posts' );
		}
		unset($value);
		?>
		<div class="flex_flat">
			<div class="item_flex" style="align-self:flex-start">
				<h3>В каких записях выводить?</h3>
				<div class="flat_search_post_types_enabled"><?php
					if(!empty($flat_pm_view_where['posts_enabled'])){
						foreach ($flat_pm_view_where['posts_enabled'] as $key => $value) {
							for ($i=0; $i < count($value); $i++) {
								echo '<div class="item" data-id="'.$value[$i].'" data-type="'.$key.'">'.get_the_title($value[$i]).'<span class="delete_me_pls"></span></div>';
							}
							unset($i);
						}
						unset($value);
						unset($key);
					}
				?></div>
				<label for="flat_search_post_types_enabled" class="title select_none">Быстрый поиск:</label>
				<input type="text" name="flat_search_post_types_enabled" id="flat_search_post_types_enabled" placeholder="Начните вводить название или id">
				<ul class="post_types_flat_enabled"></ul>
			</div>
			<div class="item_flex" style="align-self:flex-start">
				<h3>В каких записях <span>не</span> выводить?</h3>
				<div class="flat_search_post_types_disabled"><?php
					if(!empty($flat_pm_view_where['posts_disabled'])){
						foreach ($flat_pm_view_where['posts_disabled'] as $key => $value) {
							for ($i=0; $i < count($value); $i++) {
								echo '<div class="item" data-id="'.$value[$i].'" data-type="'.$key.'">'.get_the_title($value[$i]).'<span class="delete_me_pls"></span></div>';
							}
							unset($i);
						}
						unset($value);
						unset($key);
					}
				?></div>
				<label for="flat_search_post_types_disabled" class="title select_none">Быстрый поиск:</label>
				<input type="text" name="flat_search_post_types_disabled" id="flat_search_post_types_disabled" placeholder="Начните вводить название или id">
				<ul class="post_types_flat_disabled"></ul>
			</div>
		</div>
		<script>
		var post_types_flat = <?php echo json_encode($div_hidden); ?>;
		</script>
		<p class="notice" style="text-align:center">Введите <span style="color:red">all</span> для отображения полного списка</p>
		<p class="notice" style="text-align:center"><span style="color:red">!Важно</span> Если ничего не выбрано, то поиск будет происходить по всем типам записей, отмеченных <span style="color:#fff;background:#0c0;padding:3px 10px 5px;margin:0 0 0 2px">зелёным</span></p>
	</div>
	<div class="item_flex" style="padding-bottom:20px;margin-bottom:50px;border-bottom:2px dashed #8590c3">
		<h2>Ваши таксономии (<span title="Как пример">рубрики, метки</span>):</h2>
		<?php
		$div_hidden = array();
		foreach ($terms_flat as $value) {
			$div_hidden []= array($value->name,$value->taxonomy,strval($value->term_id));
		}
		unset($value);
		?>
		<div class="flex_flat">
			<div class="item_flex" style="align-self:flex-start">
				<h3>В каких таксономиях выводить?</h3>
				<div class="flat_search_term_enabled"><?php
					if(!empty($flat_pm_view_where['tax_enabled'])){
						foreach ($flat_pm_view_where['tax_enabled'] as $key => $value) {
							for ($i=0; $i < count($value); $i++) { 
								echo '<div class="item" data-id="'.$value[$i].'" data-type="'.$key.'">'.get_term( $value[$i], $key )->name.'<span class="delete_me_pls"></span></div>';
							}
							unset($i);
						}
						unset($value);
						unset($key);
					}
				?></div>
				<label for="flat_search_term_enabled" class="title select_none">Быстрый поиск:</label>
				<input type="text" name="flat_search_term_enabled" id="flat_search_term_enabled" placeholder="Начните вводить название или id">
				<ul class="terms_flat_enabled"></ul>
			</div>
			<div class="item_flex" style="align-self:flex-start">
				<h3>В каких таксономиях <span>не</span> выводить?</h3>
				<div class="flat_search_term_disabled"><?php
					if(!empty($flat_pm_view_where['tax_disabled'])){
						foreach ($flat_pm_view_where['tax_disabled'] as $key => $value) {
							for ($i=0; $i < count($value); $i++) { 
								echo '<div class="item" data-id="'.$value[$i].'" data-type="'.$key.'">'.get_term( $value[$i], $key )->name.'<span class="delete_me_pls"></span></div>';
							}
							unset($i);
						}
						unset($value);
						unset($key);
					}
				?></div>
				<label for="flat_search_term_disabled" class="title select_none">Быстрый поиск:</label>
				<input type="text" name="flat_search_term_disabled" id="flat_search_term_disabled" placeholder="Начните вводить название или id">
				<ul class="terms_flat_disabled"></ul>
			</div>
		</div>
		<script>
		var terms_flat = <?php echo json_encode($div_hidden); ?>;
		</script>
		<p class="notice" style="text-align:center">Введите <span style="color:red">all</span> для отображения полного списка</p>
		<p class="notice" style="text-align:center"><span style="color:red">!Важно</span> Если ничего не выбрано, то поиск будет происходить по всем таксономиям, а на архивах самих таксономий вывод будет недоступен</p>
		<p style="text-align:left;font-size:16px;color:#000;width:94%"><span style="color:red">Быстрый поиск</span> будет проходить по этим таксономиям:</p>
		<?php
		echo '<ul class="tax_flat_list">';
		foreach ($tax_flat as $value) {
			echo '<li>'.$value->labels->name.'</li>';
		}
		unset($value);
		echo '</ul>';
		?>
	</div>
	<div class="item_flex" style="padding-bottom:20px;margin-bottom:50px;border-bottom:2px dashed #8590c3">
		<h2>Главная:</h2>
		<div class="flex_flat">
			<div class="item_flex" style="align-self:flex-start">
				<input type="checkbox" name="home_block_enabled" id="home_block_enabled"<?php if($flat_pm_view_where['show_in_home'] == '1' || $flat_pm_view_where['show_in_home'] == '2') echo ' checked="checked"'; ?>>
				<label for="home_block_enabled" class="select_none">ыводить на главной</label>
			</div>
			<div class="item_flex" style="align-self:flex-start">
				<input type="checkbox" name="home_block_enabled_only" id="home_block_enabled_only"<?php if($flat_pm_view_where['show_in_home'] == '0') echo ' disabled="disabled"'; if($flat_pm_view_where['show_in_home'] == '2') echo ' checked="checked"'; ?>>
				<label for="home_block_enabled_only" class="select_none">ыводить ТОЛЬКО на главной</label>
			</div>
		</div>
	</div>
	<div class="item_flex">
		<h2>Архивы и рубрики:</h2>
		<div class="flex_flat">
			<div class="item_flex" style="align-self:flex-start">
				<input type="checkbox" name="archive_block_enabled" id="archive_block_enabled"<?php if($flat_pm_view_where['show_in_cat'] == '1' || $flat_pm_view_where['show_in_cat'] == '2') echo ' checked="checked"'; ?>>
				<label for="archive_block_enabled" class="select_none">ыводить в архивах и рубриках</label>
			</div>
			<div class="item_flex" style="align-self:flex-start">
				<input type="checkbox" name="archive_block_enabled_only" id="archive_block_enabled_only"<?php if($flat_pm_view_where['show_in_cat'] == '0') echo ' disabled="disabled"'; if($flat_pm_view_where['show_in_cat'] == '2') echo ' checked="checked"'; ?>>
				<label for="archive_block_enabled_only" class="select_none">ыводить ТОЛЬКО в архивах и рубриках</label>
			</div>
		</div>
	</div>
</div>