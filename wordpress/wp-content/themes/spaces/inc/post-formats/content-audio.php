<?php
/**
 *The template for displaying posts in the audio post format.
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

//ADD CLASS IF NO IMAGE IS UPLOADED
if ($fullwidth_image) {
	$image = '';
} else {
	$image = 'no-img';
}
?>

<?php if( is_singular() ) { ?>

	<?php if ($fullwidth_image) { ?>

		<div class="entry-content-media fadein <?php echo $image ?>">
			<?php echo '<img src='.$fullwidth_image.'>'; ?>
			<?php bean_audio($post->ID); ?>
		</div><!-- END .entry-content-media -->

	<?php } //END  if ($fullwidth_image) ?>

<?php } else { ?>

	<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
		<a title="<?php printf(__('Permanent Link to %s', 'bean'), get_the_title()); ?>" href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail('post-feat'); ?>
		</a>
		<?php bean_audio($post->ID); ?>
	<?php } //END if ( (function_exists('has_post_thumbnail')) ?>

<?php } ?>