<?php
/**
 * Widget Name: Bean Portfolio Taxonomy Widget
 *  
 *   
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */

// ADD FUNTION TO WIDGETS_INIT
add_action( 'widgets_init', 'reg_bean_portfolio_taxonomy_widget' );

// REGISTER WIDGET
function reg_bean_portfolio_taxonomy_widget() {
	register_widget( 'Bean_Portfolio_Taxonomy_Widget' );
}

// WIDGET CLASS
class Bean_Portfolio_Taxonomy_Widget extends WP_Widget 
{



	
	/*===================================================================*/
	/*	WIDGET SETUP
	/*===================================================================*/
	public function __construct() 
	{
		parent::__construct(
	 		'bean_portfolio_tax', // BASE ID
			'Portfolio Taxonomy', // NAME
			array( 'description' => __( 'A cloud of portfolio tags or categories.', 'bean' ), )
		);
	}
		
		
		
		
	/*===================================================================*/
	/*	DISPLAY WIDGET
	/*===================================================================*/
	function widget( $args, $instance ) 
	{
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$tax = $instance['tax'];

		// BEFORE WIDGET
		echo $before_widget;

		if ( $title ) echo $before_title . $title . $after_title;

		//SELECT VARIABLE
		if( $tax != '' ) {
		    switch ( $tax ) {
		        case 'Portfolio Tags': 
		        	$tax_term = 'portfolio_tag';
		        	break;
		        case 'Portfolio Categories': 
		        	$tax_term = 'portfolio_category';
		       	break;
			}
		}

		$taxonomy = $tax_term;
		$terms = get_terms($taxonomy);

		if ( $terms && !is_wp_error( $terms ) ) :
		?>
		    <div class="tagcloud">
		        <?php foreach ( $terms as $term ) { ?>
		            <a href="<?php echo get_term_link($term->slug, $taxonomy); ?>"><?php echo $term->name; ?></a>
		        <?php } ?>
		    </div>
		<?php endif; wp_reset_query(); 

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
		$instance['tax'] = $new_instance['tax'];
	
		return $instance;
	}
		
	
	
		
	/*===================================================================*/
	/*	WIDGET SETTINGS (FRONT END PANEL)
	/*===================================================================*/ 
	function form( $instance ) 
	{
		// WIDGET DEFAULTS
		$defaults = array(
			'title' => 'Skills',
			'tax' => 'Portfolio Categories',
			);
			
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<?php
		// WIDGET NOTIFICATION WHEN PLUGIN IS NOT INSTALLED 
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if (!is_plugin_active('bean-portfolio/bean-portfolio.php')) { ?>
			<div class="bean-widget-notification">
				<p><?php _e('Please download and install the <b>Bean Portfolio Plugin</b> (free) to display this widget.', 'bean') ?><br /><br />
				<a href="<?php echo BEAN_PORTFOLIO_PLUGIN_URL; ?>" target="_blank" ><?php _e('Free Download &rarr;', 'bean') ?></a></p>
			</div>
		<?php } // END is_plugin_active ?>

		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'bean') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'tax' ); ?>"><?php _e('Taxonomy:', 'bean') ?></label>
		<select id="<?php echo $this->get_field_id( 'tax' ); ?>" name="<?php echo $this->get_field_name( 'tax' ); ?>" class="widefat">
			<option <?php if ( 'Portfolio Tags' == $instance['tax'] ) echo 'selected="selected"'; ?>>Portfolio Tags</option>
			<option <?php if ( 'Portfolio Categories' == $instance['tax'] ) echo 'selected="selected"'; ?>>Portfolio Categories</option>	
		</select>
		</p>
	
	<?php
	} // END FORM

} // END CLASS
?>