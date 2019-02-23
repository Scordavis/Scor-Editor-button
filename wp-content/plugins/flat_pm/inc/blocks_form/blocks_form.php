<?php
if(!isset($_GET['block_cat_ID']) && isset($_GET['block_id']) && $_GET['block_id'] != ''){
	require_once 'edit_block.php';
}elseif(!isset($_GET['block_id']) && isset($_GET['block_cat_ID']) && $_GET['block_cat_ID'] != '' && get_term($_GET['block_cat_ID'])->name != ''){
	require_once 'cat_list_block.php';
}else{
	require_once 'list_block.php';
}
?>