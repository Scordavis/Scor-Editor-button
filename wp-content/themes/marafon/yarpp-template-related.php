<?php
/*
YARPP Template: Simple
Author: mitcho (Michael Yoshitaka Erlewine)
Description: A simple example YARPP template.
*/
if (have_posts()) { 
    ?>
    <div class="title">Похожие публикации</div>
    <ul class="related">
        <?php while (have_posts()) { the_post(); ?>
            <li class="related__item">
                <div class="related__item-img">
                    <?php
                    $w = 150; $h = 95;
                    if ( kama_thumb_src() ) {
                        echo '<img src="'.kama_thumb_src('w='.$w.'&h='.$h).'" width="'.$w.'" height="'.$h.'" alt="'.get_the_title().'" />';    
                    } else {
                        echo '<img src="'.get_stylesheet_directory_uri().'/images/no-photo.jpg" width="'.$w.'" height="'.$h.'" alt="Изображение для публикации не задано">';
                    } ?>
                    <?php
                    $post_cat = get_the_category(); 
                    $post_cat = $post_cat[0]->cat_ID;
                    ?>
                </div>
                <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
            </li>
        <?php } ?>
    </ul>
    <?php 
} ?>