<?php
/******************************************
 Recent Posts Widget
 ******************************************/
class cyberchimps_recent_posts extends WP_Widget {
    /** constructor */
//  function cyberchimps_recent_posts() {
    function __construct() { // 2017-12-08 WRL Updated constructor name.
        parent::__construct(false, $name = 'Recent Posts With Thumbnails');	// 2017-12-08 WRL Call generic parent constructor rather than WP_Widget()
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
							<ul class="widget-recent-posts clearfix">
                                <?php
                                $args = array(
                                    'posts_per_page' => 5,
                                    'orderby' => 'date',
                                    'order' => 'DESC',                                        
                                    'ignore_sticky_posts' => 1
                                );
                                $cyberchimp_recent_posts = new WP_Query($args);
                                while($cyberchimp_recent_posts->have_posts()): $cyberchimp_recent_posts->the_post();
                                ?>
                                    <li class="widget-post">
                                        <div class="tab-image widget-img" >
                                            <a href="<?php the_permalink() ?>">
                                                <?php 
												$post_id = get_the_ID();
                                                $post_thumbnail_id = get_post_thumbnail_id( $post_id );
                                                /* Get the attachment image source - returns an array */
                                                $image_attributes = wp_get_attachment_image_src( $post_thumbnail_id, array(45,45) );
                                                if($image_attributes != null) {
                                                ?>
                                                    <img src="<?php echo $image_attributes[0]; ?>" style="width: 45px; height: 45px;"/> 
                                                <?php 
                                                }
                                                ?>
                                            </a>
                                        </div>

                                        <div class="details">
                                            <h5 class="tabbed-title">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h5>
                                        </div>
                                        <hr />
                                    </li>
                                <?php
                                endwhile;
                                ?> 
							</ul>
              <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        $title = esc_attr($instance['title']);
        ?>
        
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if ( $title ): echo $title; else: echo 'Recent Posts'; endif; ?>" />
        </p>        
        
        <?php 
    }


} // class cyberchimps_recent_posts
// register Recent Posts widget
add_action('widgets_init', create_function('', 'return register_widget("cyberchimps_recent_posts");'));
add_image_size('ifeature-tabbed', 45, 45, true);
?>
