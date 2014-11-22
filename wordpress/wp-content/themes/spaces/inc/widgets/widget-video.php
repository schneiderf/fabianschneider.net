<?php
/**
 * Widget Name: Bean Video Widget
 *  
 *   
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */

// ADD FUNTION TO WIDGETS_INIT
add_action( 'widgets_init', 'reg_bean_video' );

// REGISTER WIDGET
function reg_bean_video() {
	register_widget( 'Bean_Video_Widget' );
}

// WIDGET CLASS
class Bean_Video_Widget extends WP_Widget 
{



	
	/*===================================================================*/
	/*	WIDGET SETUP
	/*===================================================================*/
	public function __construct() 
	{
		parent::__construct(
	 		'bean_video', // BASE ID
			'Embedded Video', // NAME
			array( 'description' => __( 'Displays embedded video content.', 'bean' ), )
		);
	}
		
		
		
		
	/*===================================================================*/
	/*	DISPLAY WIDGET
	/*===================================================================*/
	function widget( $args, $instance ) 
	{
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
	
		// WIDGET VARIABLES
		$desc = $instance['desc'];
		$embed = $instance['embed'];
		
		// BEFORE WIDGET
		echo $before_widget;
		
		if ( $title ) { 
			echo $before_title . $title . $after_title; 
		}
		
		if($desc != '') {
			echo '<p>' . $desc . '</p>';
		}
	
		echo '<div class="video-frame fadein">';
	   	echo $embed;
		echo '</div>';

		// AFTER WIDGET
		echo $after_widget;
	}
	
	
	
	
	/*===================================================================*/
	/*	UPDATE WIDGET
	/*===================================================================*/
	function update( $new_instance, $old_instance ) 
	{
		$instance = $old_instance;
		
		// STRIP TAGS TO REMOVE HTML - IMPORTANT FOR TEXT IMPUTS
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['desc'] = stripslashes( $new_instance['desc'] );
		$instance['embed'] = stripslashes( $new_instance['embed']);
	
		return $instance;
	}
		
	
	
		
	/*===================================================================*/
	/*	WIDGET SETTINGS (FRONT END PANEL)
	/*===================================================================*/ 
	function form( $instance ) 
	{
		// WIDGET DEFAULTS
		$defaults = array(
			'title' => 'Video',
			'desc' => 'This is a simple and classic custom video widget included in Spaces.',
			'embed' => stripslashes('<iframe src="//player.vimeo.com/video/42411918?title=0&byline=0&portrait=0&color=ffffff" width="300" height="169" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>'),
			);
			
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'bean') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p style="margin-top: -8px;">
		<textarea class="widefat" rows="5" cols="15" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>"><?php echo $instance['desc']; ?></textarea>
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'embed' ); ?>"><?php _e('Video Embed Code:', 'bean') ?></label>
		<textarea class="widefat" rows="5" cols="15" id="<?php echo $this->get_field_id( 'embed' ); ?>" name="<?php echo $this->get_field_name( 'embed' ); ?>"><?php echo $instance['embed']; ?></textarea>
		</p>

	

	<?php
	} // END FORM

} // END CLASS
?>