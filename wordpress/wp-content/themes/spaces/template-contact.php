<?php
/**
 * Template Name: Contact
 * The template for displaying the contact template.
 *
 * 
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */

get_header(); bean_sidebar_loader(); 

//PAGE META
$page_title = get_post_meta($post->ID, '_bean_page_title', true);
$fullwidth_media = get_post_meta($post->ID, '_bean_fullwidth_media', true);
$fullwidth_image = get_post_meta($post->ID, '_bean_fullwidth_image', true);
$fullwidth_caption = get_post_meta($post->ID, '_bean_fullwidth_caption', true);

//ADD CLASS IF NO IMAGE IS UPLOADED
if ($fullwidth_media == 'on' && $fullwidth_image) {
	$image = 'full-img';
} else {
	$image = '';
}

//CONTACT CODE
if(isset($_POST['submitted'])) {
		if(trim($_POST['contactName']) === '') {
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		
		if(trim($_POST['email']) === '')  {
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
			
		if(trim($_POST['comments']) === '') {
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}
			
		if(!isset($hasError)) {
		 	
		 	$site_name = get_bloginfo('name');
			$contactEmail = get_theme_mod( 'admin_custom_email');
			
			if (!isset($contactEmail) || ($contactEmail == '') ){
				$contactEmail = get_option('admin_email');
			}
			
			$subject = '['.$site_name.' Contact Form] ';
			$body = "Name: $name \n\nEmail: $email \n\nMessage: $comments";
			$headers = 'From: '.$name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($contactEmail, $subject, $body, $headers);
			$emailSent = true;
		}
	
} ?>

<div class="row">

	<section id="post-<?php the_ID(); ?>" <?php post_class('fadein'); ?>>

		<?php if( $fullwidth_media == 'on') { ?>

			<?php if ( get_theme_mod( 'google_maps_code') ) { ?>
				<div class="entry-content-media g-map">
					<?php echo get_theme_mod( 'google_maps_code'); ?>
				</div><!-- END .entry-content-media -->
			<?php } else { ?>
				<div class="entry-content-media">
					<?php echo '<img src='.$fullwidth_image.'>'; ?>
					<?php if ($fullwidth_caption) { ?>
						<span class="bean-image-caption"><?php echo $fullwidth_caption ?></span>
					<?php } ?>
				</div><!-- END .entry-content-media -->
		<?php } 
		} //END $fullwidth_media == 'on' && $fullwidth_image ?>

		<div class="<?php echo $bean_content_class; ?> <?php echo $image; ?>">
			
			<div class="entry-content">
				
				<?php if ( $page_title == 'on' ) { ?><h1 class="entry-title"><?php the_title(''); ?></h1><?php } ?>

				<?php while ( have_posts() ) : the_post(); the_content(); endwhile; // THE LOOP ?>	
				
				<?php if( get_theme_mod( 'bean_contact_form' ) == true ) { //IF CONTACT FORM IS TRUE VIA CUSTOMIZER ?>		
					
					<script type="text/javascript">
						jQuery(document).ready(function(){ 
							jQuery("#BeanForm").validate({ errors: { contactName: '', email: { required: '', email: '' }, comments: '' } }); 
						});
					</script>
					
					<?php if(isset($emailSent) && $emailSent == true ) { ?>
						
						<div class="contact-alert success">
						
							<?php _e('Awesome! Your message has been sent!', 'bean') ?>
							
						</div><!-- END .alert alert-success -->
				
					<?php } // END SUCCESS ALERT ?>
			
					<?php if(isset($hasError) || isset($captchaError)) { ?>
					
						<div class="contact-alert fail">
						
							<?php _e('Well now... an error occured. Please try again.', 'bean') ?>
						
						</div><!-- END .alert alert-success -->
						
					<?php } // END FAIL ALERT ?>
					
					<?php $required = '<span class="required">*</span>'; ?>
					
					<form action="<?php the_permalink(); ?>" id="BeanForm" method="post">
						
						<ul class="bean-contactform">
							
							<li class="name">
								<label for="contactName"><?php _e('Name', 'bean'); echo $required ?></label>
								<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField" />
							</li>
							
							<li class="email">
								<label for="email"><?php _e('Email', 'bean'); echo $required ?></label>
								<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" />
							</li>
				
							<li class="textarea"><label for="commentsText"><?php _e('Message', 'bean'); echo $required ?></label>
								<textarea name="comments" id="commentsText" rows="20" cols="30" class="required requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
								
							</li>
							
							<li class="submit">
								<input type="hidden" name="submitted" id="submitted" value="true" />
								<button type="submit" class="button"><?php echo get_theme_mod( 'contact_button_text', 'Send Message', 'bean' ); ?></button>
							</li>
					
						</ul>

					</form><!-- END #BeanForm -->

				<?php } // END if( get_theme_mod( 'bean_contact_form' ) == true ) ?>	
			
			</div><!-- END .entry-content -->
			
		</div><!-- END <?php echo $bean_content_class; ?> -->

		<?php if( $bean_sidebar_location === 'right' ) {
			//SIDEBAR STYLE
			$theme_style = get_theme_mod( 'theme_style');
			if ($theme_style == 'theme_style_2') { $theme_style = 'dark'; } 
			else { $theme_style = ''; }
			?>

			<div class="<?php echo $bean_sidebar_class; ?> <?php echo $theme_style; ?>">
				<?php dynamic_sidebar( 'Internal Sidebar' ); ?>
			</div><!-- END $bean_sidebar_class -->
		<?php } // END $bean_sidebar_location === 'right' ?>

	</section><!-- END #post-<?php the_ID(); ?> -->	

</div><!-- END .row -->

<?php get_footer();