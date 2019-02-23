<?php 
if ($selection_search_site == 1) {
	?>
	<!--noindex-->
	<div class="search-form">
	    <form method="get" action="<?php bloginfo('url') ?>/">
	        <input type="text" value="<?php the_search_query() ?>" name="s" placeholder="Поиск по сайту" class="search-form__field">
	        <input type="submit" value="" class="search-form__button">
	    </form>
	</div>
	<!--/noindex-->
	<?php
} else {
	?>
	<div class="search-form ya-site-form ya-site-form_inited_no" onclick="return {'bg': 'transparent', 'publicname': '\u041f\u043e\u0438\u0441\u043a \u043f\u043e site.ru', 'target': '_self', 'language': 'ru', 'suggest': true, 'tld': 'ru', 'site_suggest': true, 'action': '<?php bloginfo('url'); ?>/search', 'webopt': false, 'arrow': false, 'fg': '#000000', 'searchid': '123123123', 'logo': 'rb', 'websearch': false, 'type': 2}">
	    <form action="<?php bloginfo('url') ?>/search" method="get" target="_self">
	        <input type="hidden" name="searchid" value="123123123">
	        <input type="hidden" name="l10n" value="ru">
	        <input type="hidden" name="reqenc" value="">
	        <input type="text" name="text" placeholder="Поиск по сайту" class="search-form__field" value="">
	        <input type="submit" value="" class="search-form__button">
	    </form>
	</div>
	<?php
} ?>