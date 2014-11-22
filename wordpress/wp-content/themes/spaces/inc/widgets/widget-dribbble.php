<?php
/**
 * Widget Name: Bean Dribbble Widget
 * Widget URI: http://themebeans.com
 * Description:  A custom widget that displays your Dribbble shots.
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
add_action( 'widgets_init', 'reg_bean_dribbble_feed' );

// REGISTER WIDGET
function reg_bean_dribbble_feed() {
	register_widget( 'Bean_Dribbble_Widget' );
}

// WIDGET CLASS
class Bean_Dribbble_Widget extends WP_Widget 
{



	
	/*===================================================================*/
	/*	WIDGET SETUP
	/*===================================================================*/
	public function __construct()
	{
		parent::__construct(
	 		'bean_dribbble', // BASE ID
			'Dribbble Shots', // NAME
			array( 'description' => __( 'Add a Dribbble feed widget.', 'bean' ), )
		);
	}
		
		
		
		
	/*===================================================================*/
	/*	DRIBBBLE API FUNCTIONS
	/*===================================================================*/
	function do_bean_dribbbler( $account, $shots ) 
	{
		// CHECK FOR CACHED VERSION
		$key = 'bean_widget_dribbbler_' . $account;
		$shots_cache = get_transient($key);
	
		if( $shots_cache === false ) {
		
			$url 		= 'http://api.dribbble.com/players/' . $account . '/shots/?per_page=12';
			$response 	= wp_remote_get( $url );
	
			if( is_wp_error( $response ) ) 
				return;
	
			$xml = wp_remote_retrieve_body( $response );
	
			if( is_wp_error( $xml ) )
				return;
	
			if( $response['headers']['status'] == 200 ) {
	
				$json = json_decode( $xml );
				$dribbble_shots = $json->shots;
	
				set_transient($key, $dribbble_shots, 60*5);
			}
			
		} else {
			
			$dribbble_shots = $shots_cache;
		
		}
	
		if( $dribbble_shots ) {
			
			$i = 0;
			$output = '<div class="bean-dribbble-shots">';
			
			foreach( $dribbble_shots as $dribbble_shot ) {
			
				if( $i == $shots )
					break;
				
				$output .= '<div class="bean-shot">';
	
				$output .= '<a href="' . $dribbble_shot->url . '" target="blank">';
				$output .= '<img height="' . $dribbble_shot->height . '" width="' . $dribbble_shots[$i]->width . '" src="' . $dribbble_shot->image_url . '" alt="" />';
				$output .= '</a>';
				$output .= '</div>';
				
				
				$i++;
			}
	
			$output .= '</div>';
	
		?>
		
		<?php
		} else { $output = '' . __('Womp. Could not connect to Dribbble.', 'bean') . '</div>'; }
	
		return $output;
	}
	
	
	
		 	
	/*===================================================================*/
	/*	WIDGET API FUNCTIONS
	/*===================================================================*/	 	
	function widget( $args, $instance ) 
	{
		extract( $args, EXTR_SKIP );
	
	    // WIDGET VARIABLES
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$account = $instance['account'];
		$shots = $instance['shots'];
		$desc = $instance['desc'];
	
		echo $before_widget;
			
		if ( !empty( $title ) ) echo $before_title . $title . $after_title;
		
		if($desc != '') : ?><p><?php echo $desc; ?></p><?php endif;
		
		echo $this -> do_bean_dribbbler($account, $shots);
		
		echo $after_widget;
		
	} // END WIDGET
	
	
	
	
	/*===================================================================*/
	/*	UPDATE WIDGET
	/*===================================================================*/
	function update( $new_instance, $old_instance ) 
	{
		// STRIP TAGS TO REMOVE HTML - IMPORTANT FOR TEXT IMPUTS
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['desc'] = strip_tags($new_instance['desc']);
		
		$instance['account'] = trim($new_instance['account']);
		$instance['shots'] = trim($new_instance['shots']);
		
		return $instance;
		
	}
	
	
	
	
	/*===================================================================*/
	/*	WIDGET SETTINGS (FRONT END PANEL)
	/*===================================================================*/ 
	function form( $instance ) 
	{
		// WIDGET DEFAULTS
		$defaults = array(
			'title' => 'Dribbble',
			'account' => 'richtabor',
			'desc' => 'Get in the game. Use our Dribbble widget to display your shots.',
			'shots' => 4
		);
	
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$account = $instance['account'];
		$shots = $instance['shots'];
		?>
		
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title/Intro:', 'bean'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p style="margin-top: -8px;">
		<textarea class="widefat" rows="5" cols="15" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>"><?php echo $instance['desc']; ?></textarea>
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id('account'); ?>"><?php _e('<a href="http://www.dribbble.com/themebeans">Dribbble</a> account:', 'bean'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('account'); ?>" name="<?php echo $this->get_field_name('account'); ?>" type="text" value="<?php echo $account; ?>" />
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id('shots'); ?>"><?php _e('Number of Shots:', 'bean'); ?></label>
		<select name="<?php echo $this->get_field_name('shots'); ?>">
			<?php for( $i = 1; $i <= 12; $i++ ) { ?>
				<option value="<?php echo $i; ?>" <?php selected( $i, $shots ); ?>><?php echo $i; ?></option>
			<?php } ?>
		</select>
		</p>
	
	<?php
		
	} // END FORM

} // END CLASS