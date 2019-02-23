<div class="news">
	<p class="row_news">Новости от разработчика</p>
	<?php
	$ch = curl_init("https://mehanoid.pro/news.html");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
	$content = curl_exec($ch);
	curl_close($ch);
	echo $content;
	?>
</div>