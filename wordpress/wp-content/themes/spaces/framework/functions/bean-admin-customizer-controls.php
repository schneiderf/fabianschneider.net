<?php 
/**
 * Admin functions for core framework features.
 * This file is the same contents as all themes using our framework
 *
 *
 * @package WordPress
 * @subpackage Bean Framework
 * @author ThemeBeans
 * @since Bean Framework 2.0.3
 */
 
 
 
 
/*===================================================================*/         	
/*  TEXTAREA CONTROL		                							
/*===================================================================*/	
class Bean_Customize_Textarea_Control extends WP_Customize_Control 
{
    public $type = 'textarea'; 
    
    //OUTPUT
    public function render_content() { ?>
        <label><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span></label>
        <textarea rows="4" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
    <?php
	} //END public function render_content()
} //END class Bean_Customize_Textarea_Control




/*===================================================================*/         	
/*  SLIDER CONTROL		                							
/*===================================================================*/	
class Bean_Customize_Slider_Control extends WP_Customize_Control 
{
    public $type = 'slider';

    //ENQUEUE SCRIPTS
    public function enqueue() 
    {
       wp_enqueue_script( 'jquery-ui-core' );
       wp_enqueue_script( 'jquery-ui-slider' );
    }

	//OUTPUT
    public function render_content() 
    { ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <input style="width: 13%; margin-right: 3%; float: left; text-align: center;" type="text" id="input_<?php echo $this->id; ?>" value="<?php echo $this->value(); ?>" <?php $this->link(); ?>/>
        </label>
        <div style="width: 82%; float: left;" id="slider_<?php echo $this->id; ?>" class="bean_slider"></div>

        <script>
        jQuery(document).ready(function($) {
            $( "#slider_<?php echo $this->id; ?>" ).slider({
                value: <?php echo $this->value(); ?>,
                min: <?php echo $this->choices['min']; ?>,
                max: <?php echo $this->choices['max']; ?>,
                step: <?php echo $this->choices['step']; ?>,
                slide: function( event, ui ) {
                    $( "#input_<?php echo $this->id; ?>" ).val(ui.value).keyup();
                }
            });
            $( "#input_<?php echo $this->id; ?>" ).val( $( "#slider_<?php echo $this->id; ?>" ).slider( "value" ) );
        });
        </script>
	<?php
    } // END public function render_content()
} //END class Bean_Customize_Textarea_Control