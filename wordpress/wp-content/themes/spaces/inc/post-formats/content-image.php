<?php
/**
 * The template for displaying posts in the Image post format.
 *
 *
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans 
 * @since Spaces 1.0
 */

//POST META
$fullwidth_caption = get_post_meta($post->ID, '_bean_fullwidth_caption', true);

$orderby = get_post_meta($post->ID, '_bean_post_randomize', true);
$orderby = ( $orderby == 'off' ) ? 'post__in' : 'rand';
?>

<div class="entry-content-media fadein">

	<?php bean_gallery($post->ID, '', 'post-lightbox' , $orderby , true); ?>

	<?php if ($fullwidth_caption) { ?>
		<span class="bean-image-caption"><?php echo $fullwidth_caption ?></span>
	<?php } ?>
		
</div><!-- END .entry-content-media -->