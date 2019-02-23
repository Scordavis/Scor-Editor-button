<?php
/**
 * Adds RecentPosts_Morkovin_Widget widget.
 */
class RecentPosts_Morkovin_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'recentpost_morkovin_widget', // Base ID
            __( 'Свежие публикации Морковина', 'text_domain' ), // Name
            array('description' => __( 'Свежие публикации без цилических ссылок от Морковина.', 'text_domain' ), ) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        global $excerpt_or_content, $show_comments_number, $show_date;
        $show_not_home = esc_attr($instance['show_not_home']);
        $show_image = esc_attr($instance['show_image']);
        $show_description = esc_attr($instance['show_description']);

        $not_show = false;
        if(is_front_page() and $show_not_home) $not_show = true;
        
        if(!$not_show){
            $number_morkovin_rec_posts = esc_attr($instance['number_morkovin_rec_posts']);

            if(is_single()){
                wp_reset_postdata();
                $page_id = get_the_ID();

                $args_morkovin = array(
                    'posts_per_page' => $number_morkovin_rec_posts,
                    'post__not_in' => array($page_id),
                );
            }
            else{
                $args_morkovin = array(
                    'posts_per_page' => $number_morkovin_rec_posts,
                );  
            }

            $loop = new WP_Query($args_morkovin);

            $rec_morkovin_posts = "";
            
            if ( $loop->have_posts() ) {
                while ( $loop->have_posts() ) {
                    $loop->the_post();
                    $permalink = get_permalink();
                    $post_title= get_the_title();

                    $image = '';
                    if ($show_image) {
                        $w = 300; $h = 180;
                        if ( kama_thumb_src() ) {
                            $image = '<img src="'.kama_thumb_src('w='.$w.'&h='.$h).'" width="'.$w.'" height="'.$h.'" class="section-posts__item-img" alt="'.get_the_title().'" />';    
                        } else {
                            $image = '<img src="'.get_stylesheet_directory_uri().'/images/no-photo.jpg" width="'.$w.'" height="'.$h.'" class="section-posts__item-img" alt="Изображение для публикации не задано">';
                        }    
                    }

                    $description = '';
                    if ($show_description) {
                        if ( has_excerpt() ) {
                            $description = wp_trim_words( get_the_excerpt(), 10, '...' ); 
                        } else {
                            if ($excerpt_or_content == 1) {
                                global $more;
                                $more = 0;
                                $description = wp_trim_words(get_the_content(), 10, '...');
                            }
                            else {
                                if ( get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true) ) {
                                    $description = wp_trim_words(get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true), 10, '...');
                                }
                                else {
                                    $description = wp_trim_words(get_the_content(), 10, '...');
                                }
                            }
                        }
                    
                        $description = '<div class="section-posts__item-text">'.$description.'</div>';
                    }
                    
                    $margin_class = '';
                    if (!$show_image) {
                        $margin_class = ' section-posts__item_margin';
                    }

                    $comments_date = '';
                    if ($show_comments_number or $show_date) {
                        ob_start();
                        ?>
                        <div class="post-info section-posts__item-info">
                            <?php if ($show_comments_number) { ?>
                                <div class="post-info__comment"><?php echo get_comments_number(); ?></div>
                            <?php } ?>
                            <?php if ($show_date) { ?>
                                <time class="post-info__time post-info__time_popular" datetime="<?php the_time('Y-m-d') ?>"><?php the_time('d.m.Y') ?></time>
                            <?php } ?>
                        </div>
                        <?php
                        
                        $comments_date = ob_get_clean();
                    }

                    $rec_morkovin_posts .= "<li class=\"section-posts__item$margin_class\">$image<div class=\"section-posts__item-title\"><a href=\"$permalink\">$post_title</a></div>$description$comments_date</li>";
                }
            }

            wp_reset_postdata();

            $rec_morkovin_posts = "<ul>".$rec_morkovin_posts."</ul>";

            echo $args['before_widget'];
            
            if ( ! empty( $instance['title'] )) {
                echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
            }
            echo __( $rec_morkovin_posts, 'text_domain' );
            echo $args['after_widget'];
        }
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Свежие публикации', 'text_domain' );
        $number_morkovin_rec_posts = ! empty( $instance['number_morkovin_rec_posts'] ) ? $instance['number_morkovin_rec_posts'] : __( '6', 'text_domain' );
        $show_not_home = isset( $instance['show_not_home'] ) ? (bool) $instance['show_not_home'] : false;
        $show_image = isset( $instance['show_image'] ) ? (bool) $instance['show_image'] : false;
        $show_description = isset( $instance['show_description'] ) ? (bool) $instance['show_description'] : false;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'number_morkovin_rec_posts' ); ?>">Количество записей:</label> 
            <input id="<?php echo $this->get_field_id( 'number_morkovin_rec_posts' ); ?>" name="<?php echo $this->get_field_name( 'number_morkovin_rec_posts' ); ?>" type="text" size="3" value="<?php echo esc_attr( $number_morkovin_rec_posts ); ?>">
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $show_not_home ); ?> id="<?php echo $this->get_field_id( 'show_not_home' ); ?>" name="<?php echo $this->get_field_name( 'show_not_home' ); ?>" />
            <label for="<?php echo $this->get_field_id( 'show_not_home' ); ?>">Не показывать на главной</label>
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $show_image ); ?> id="<?php echo $this->get_field_id( 'show_image' ); ?>" name="<?php echo $this->get_field_name( 'show_image' ); ?>" />
            <label for="<?php echo $this->get_field_id( 'show_image' ); ?>">С картинками</label>
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $show_description ); ?> id="<?php echo $this->get_field_id( 'show_description' ); ?>" name="<?php echo $this->get_field_name( 'show_description' ); ?>" />
            <label for="<?php echo $this->get_field_id( 'show_description' ); ?>">С описанием</label>
        </p>
        <?php 
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['number_morkovin_rec_posts'] = ( ! empty( $new_instance['number_morkovin_rec_posts'] ) ) ? strip_tags( $new_instance['number_morkovin_rec_posts'] ) : '';
        $instance['show_not_home'] = isset( $new_instance['show_not_home'] ) ? (bool) $new_instance['show_not_home'] : false;
        $instance['show_image'] = isset( $new_instance['show_image'] ) ? (bool) $new_instance['show_image'] : false;
        $instance['show_description'] = isset( $new_instance['show_description'] ) ? (bool) $new_instance['show_description'] : false;

        return $instance;
    }

} // class RecentPosts_Morkovin_Widget

// register RecentPosts_Morkovin_Widget widget
function register_morkovin_widget() {
    register_widget( 'RecentPosts_Morkovin_Widget' );
}
add_action( 'widgets_init', 'register_morkovin_widget' );