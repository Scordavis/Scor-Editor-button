# Scor-Editor-button
<img src="http://dl3.joxi.net/drive/2019/02/23/0026/3320/1727736/36/a3c818f2a0.png" alt="">
<br>
<p>В function.php добавил</p>
<pre>
function wpb_mce_buttons_2($buttons) {
  array_unshift($buttons, 'styleselect');
  return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');

function my_mce_before_init_insert_formats( $init_array ) {
    $style_formats = array(
        array(
            'title' => 'Жирный',
            'inline' => 'span',
            'classes' => 'scor-bold-text',
            'wrapper' => false,
        ),
        array(
            'title' => 'Выделенный',
            'inline' => 'span',
            'classes' => 'scor-marked-text',
            'wrapper' => true,
        ),
    );
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );
    return $init_array;
}
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );
</pre>

<p>Затем создал в корне темы доп стили для редактора <strong>custom-editor-style.css</strong> и добавил в них правила:</p>
<pre>
.scor-bold-text{
	display: inline;
	font-weight: bold;
}
.scor-marked-text{
	display: inline;
	background-color: #C1D6CEFF;
	padding: 2px 6px;
}
</pre>
<p>Эти же стили добавил в основной файл стилей <strong>style.css</strong></p>
<p>Далее инициировал <strong>custom-editor-style.css</strong> в function.php</p>
<pre>
function my_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );
</pre>


