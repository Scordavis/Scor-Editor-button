<?php
$flat_block_ID = $_GET['block_id'];
?>
<div class="block_checkbox_role">
	<?php
	$flat_pm_role = get_post_meta($flat_block_ID, 'flat_pm_role', true);
	?>
	<div class="flat_settings">
		<div class="item_geo_block">
			<input type="checkbox" name="role_check_setting" id="role_check_setting"<?php if($flat_pm_role != '' && $flat_pm_role['enabled'] == 'true') echo ' checked="checked"'; ?>>
			<label for="role_check_setting" class="select_none">Блок настроек </label>
		</div>
		<div class="item_geo_block">
			<?php
			$div_hidden = array();
			global $wp_roles;
			foreach ($wp_roles->get_names() as $key => $value) {
				$div_hidden []= array($key,translate_user_role($value));
			}
			unset($value);
			unset($key);
			?>
			<div class="flex_flat">
				<div class="item_flex" style="align-self:flex-start">
					<h3 style="text-align:center">Для каких ролей показывать рекламу?</h3>
					<div class="flat_search_role_enabled"><?php
						if($flat_pm_role != '' && !empty($flat_pm_role['role_enabled'])){
							foreach ($flat_pm_role['role_enabled'] as $key => $value) {
								echo '<div class="item" data-id="'.$key.'" data-type="'.$value.'">'.$value.'<span class="delete_me_pls"></span></div>';
							}
							unset($value);
							unset($key);
						}
					?></div>
					<label for="flat_search_role_enabled" class="title select_none">Быстрый поиск:</label>
					<input type="text" name="flat_search_role_enabled" id="flat_search_role_enabled" placeholder="Начните вводить название роли">
					<ul class="role_flat_enabled"></ul>
				</div>
				<div class="item_flex" style="align-self:flex-start">
					<h3 style="text-align:center">Для каких ролей <span>не</span> показывать рекламу?</h3>
					<div class="flat_search_role_disabled"><?php
						if($flat_pm_role != '' && !empty($flat_pm_role['role_disabled'])){
							foreach ($flat_pm_role['role_disabled'] as $key => $value) {
								echo '<div class="item" data-id="'.$key.'" data-type="'.$value.'">'.$value.'<span class="delete_me_pls"></span></div>';
							}
							unset($value);
							unset($key);
						}
					?></div>
					<label for="flat_search_role_disabled" class="title select_none">Быстрый поиск:</label>
					<input type="text" name="flat_search_role_disabled" id="flat_search_role_disabled" placeholder="Начните вводить название роли">
					<ul class="role_flat_disabled"></ul>
				</div>
			</div>
			<script>
			var roles_flat = <?php echo json_encode($div_hidden); ?>;
			</script>
			<p class="notice" style="text-align:center;clear:both">Введите <span style="color:red">all</span> для отображения полного списка</p>
			<p class="notice" style="text-align:center"><span style="color:red">!Важно</span> Если ничего не выбрано, то реклама будет показываться всем ролям или в зависимости от глобальной настройки</p>
		</div>
	</div>
</div>