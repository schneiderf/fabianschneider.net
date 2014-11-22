<?php
/**
 * Widget Name: Bean Flickr Widget
 * Widget URI: http://themebeans.com
 * Description:  A custom widget that displays your Flickr photos.
 * Author: ThemeBeans
 * Author URI: http://themebeans.com
 *  
 *   
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */

// ADD FUNTION TO WIDGETS_INIT 
add_action( 'widgets_init', 'reg_bean_flickr' );

// REGISTER WIDGET
function reg_bean_flickr() {
	register_widget( 'Bean_Flickr_Widget' );
}

// WIDGET CLASS
class Bean_Flickr_Widget extends WP_Widget 
{


	
	
	/*===================================================================*/
	/*	WIDGET SETUP
	/*===================================================================*/
	public function __construct() 
	{
		parent::__construct(
	 		'bean_flickr', // BASE ID
			'Flickr Photos', // NAME
			array( 'description' => __( 'Add a Flickr feed widget.', 'bean' ), )
		);
	}
	
	
	
	
	/*===================================================================*/
	/*	DISPLAY WIDGET
	/*===================================================================*/	
	function widget( $args, $instance ) 
	{
		extract( $args );
	
		// WIDGET VARIABLES
		$title = apply_filters('widget_title', $instance['title'] );
		$flickrID = $instance['flickrID'];
		$type = $instance['type'];
		$display = $instance['display'];
		$desc = $instance['desc'];
	
		// BEFORE WIDGET
		echo $before_widget;
	
		if ( $title ) echo $before_title . $title . $after_title;
	
		//SELECT VARIABLE
		if( $type != '' ) {
		    switch ( $type ) {
		        case 'User': 
		        	$type = 'user';
		        	break;
		        case 'Group': 
		        	$type = 'group';
		       		break;
			}
		}
		
		if( $display != '' ) {
		    switch ( $display ) {
		        case 'Random': 
		        	$display = 'random';
		        	break;
		        case 'Latest': 
		        	$display = 'latest';
		       		break;
			}
		}
		?>
		
		<?php if($desc != '') : ?><p><?php echo $desc; ?></p><?php endif; ?>
		
		<div class="flickr-image-wrapper">
	
			<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=8&amp;display=<?php echo $display ?>&amp;size=s&amp;layout=x&amp;source=<?php echo $type ?>&amp;<?php echo $type ?>=<?php echo $flickrID ?>"></script>
			
		</div><!-- END .flickr-image-wrapper --> 
		
		<?php
	
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
		$instance['flickrID'] = strip_tags( $new_instance['flickrID'] );
		$instance['desc'] = stripslashes( $new_instance['desc'] );
		
		// NO NEED TO STRIP TAGS
		$instance['type'] = $new_instance['type'];
		$instance['display'] = $new_instance['display'];
	
		return $instance;
	}
	
	
	
	
	/*===================================================================*/
	/*	WIDGET SETTINGS (FRONT END PANEL)
	/*===================================================================*/	 
	function form( $instance ) 
	{
		// WIDGET DEFAULTS
		$defaults = array(
			'title' => 'Flickr',
			'flickrID' => '57576577@N02',
			'type' => 'User',
			'desc' => 'Good news! Show off your recent Flickr and/or Instagram pics.',
			'display' => 'Latest',
			
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title / Intro:', 'bean') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p style="margin-top: -8px;">
		<textarea class="widefat" rows="5" cols="15" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>"><?php echo $instance['desc']; ?></textarea>
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'flickrID' ); ?>"><?php _e('Flickr ID:', 'bean') ?> (<a target="_blank" href="http://idgettr.com/">idGettr</a>)</label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'flickrID' ); ?>" name="<?php echo $this->get_field_name( 'flickrID' ); ?>" value="<?php echo $instance['flickrID']; ?>" />
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e('Type:', 'bean') ?></label>
		<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat">
			<option <?php if ( 'User' == $instance['type'] ) echo 'selected="selected"'; ?>>User</option>
			<option <?php if ( 'Group' == $instance['type'] ) echo 'selected="selected"'; ?>>Group</option>
		</select>
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'display' ); ?>"><?php _e('Display:', 'bean') ?></label>
		<select id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>" class="widefat">
			<option <?php if ( 'Random' == $instance['display'] ) echo 'selected="selected"'; ?>>Random</option>
			<option <?php if ( 'Latest' == $instance['display'] ) echo 'selected="selected"'; ?>>Latest</option>
		</select>
		</p>
		
	
	<?php
	} // END FORM
	
} // END CLASS
?>