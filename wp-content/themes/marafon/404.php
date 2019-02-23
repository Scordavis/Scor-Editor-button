<?php 
require('header.php'); ?>
<div class="content-wrapper">
	<main class="content">
		<article class="post single">
			<h1>Страница 404</h1>
			<p>Такой страницы не существует. Возможно, Вы некорректно набрали адрес страницы или перешли по неправильной ссылке на наш сайт.</p>
			<p>В любом случае не расстраивайтесь, у нас много полезной и актуальной информации. Посетите интересующий Вас раздел сайта:</p>
			<ul>
				<?php wp_list_categories('use_desc_for_title=0&title_li=0'); ?>
			</ul>
		</article>
	</main>	
	<?php 
	require('sidebar.php'); ?>
</div><!-- /.content-wrapper -->
<?php require('footer.php'); ?>