<?php
/**
 *The template for displaying posts in the gallery post format.
 *
 *
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans 
 * @since Spaces 1.0
 */

//META
$fullwidth_image = get_post_meta($post->ID, '_bean_fullwidth_image', true);
$fullwidth_caption = get_post_meta($post->ID, '_bean_fullwidth_caption', true);
$orderby = get_post_meta($post->ID, '_bean_post_randomize', true);
$orderby = ( $orderby == 'off' ) ? 'post__in' : 'rand';
$gallery_layout = get_post_meta($post->ID, '_bean_gallery_layout', true);
$portfolio_url = get_post_meta($post->ID, '_bean_portfolio_url', true); 

?>

<?php if( is_singular() ) { ?>

	<?php if ($fullwidth_image) { ?>

		<div class="entry-content-media fadein">
			<?php echo '<img src='.$fullwidth_image.'>'; ?>
			<?php if ($fullwidth_caption) { ?>
				<span class="bean-image-caption"><?php echo $fullwidth_caption ?></span>
			<?php } ?>
		</div><!-- END .entry-content-media -->

	<?php } //END  if ($fullwidth_image) ?>

<?php } else { ?>

	<?php bean_gallery($post->ID, '', 'slider' , $orderby , true ); ?>

<?php } ?>