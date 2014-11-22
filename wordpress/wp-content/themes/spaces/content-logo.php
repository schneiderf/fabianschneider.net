<?php
/**
 * The file for displaying the uploaded branding.
 * Utilize the theme customizer for displaying either the text logo or uploaded logo.
 *
 *  
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */
 ?>
 
<div class="logo">
	
	<?php 
	//WITH LOGO IMAGE
	if( get_theme_mod( 'img-upload-logo' )) { // CUSTOMIZER LOGO ?>  
	  	<a href="<?php echo home_url(); ?>" title="<?php echo bloginfo( 'name' ); ?>" rel="home"><img src="<?php echo get_theme_mod( 'img-upload-logo' )?>" class="logo-uploaded" alt="logo"/></a>
	<?php }
	
	//WITHOUT LOGO IMAGE 
	else { ?>  
	  	<a href="<?php echo home_url(); ?>" title="<?php echo bloginfo( 'name' ); ?>" rel="home"><h1 class="logo_text"><?php bloginfo( $name ); ?></h1></a>
	<?php } ?>

</div><!-- END .logo -->