<?php
class Related_Posts extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'related_posts_widget', // Base ID
			'Related Posts', // Name
			array( 'description' => __( 'Related Posts Widget', 'text_domain' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Related Posts','qode') : $instance['title'], $instance, $this->id_base);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
 			$number = 10; 

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title; ?>

		<?php
		
			$tags = wp_get_post_tags(get_the_ID());
			
 			if ($tags) {
				
 				$tag_ids = array();
				foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
				$args = array(
					'tag__in' => $tag_ids,
					'post__not_in' => array(get_the_ID()),
					'posts_per_page'=>$number // Number of related posts to display.
				);
 				$related_query = new WP_Query($args);
				if ($related_query->have_posts()) {
			?>
			
 
            <?php
            while ($related_query->have_posts()) : $related_query->the_post();
            ?>
				<div class="post no_image">
                <div class="text">
                    <a href="<?php the_permalink() ?>" > <?php the_title();?> </a>
                </div>
				</div>
            <?php
            endwhile;
            ?>
 
        
 
<?php }
    wp_reset_query(); 
}
?>
	<?php	echo $after_widget;
	}

	
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number']; 
		return $instance;
	}

	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5; 
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','qode'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Number of posts:','qode' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
		</p>
		<?php 
	}

} 
add_action( 'widgets_init', create_function( '', 'register_widget( "Related_Posts" );' ) );
?>