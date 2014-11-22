<?php
/**
 * The content loop file for the team members grid.
 *
 *
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */

//META
$role = get_post_meta($post->ID, '_bean_team_role', true);
$quote = get_post_meta($post->ID, '_bean_team_quote', true);
$url = get_post_meta($post->ID, '_bean_team_url', true);
?>

<?php if ( ( function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>

	<li id="portfolio-<?php the_ID(); ?>" class="item masonry-item grid-masonry <?php if ($quote) { echo 'quoted'; } ?>">

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php the_post_thumbnail('grid-feat'); ?>

			<?php if ($quote) { ?>
				<div class="overlay">
					<span class="quote-icon"></span>
					<h4><?php echo $quote; ?></h4>
				</div>
			<?php } ?>

		</div>

		<div class="team-content">
			
			<?php if ($url) { ?>
				<h3><a href="<?php echo $url; ?>" target="_blank"><?php the_title(); ?></a><span> &rarr;</span></h3>
			<?php } else { ?>
				<h3><?php the_title(); ?></h3>
			<?php } ?>

			<span class="subtext">
				<?php if ($role) { echo $role ; } ?>
			</span>

			<p><?php the_content(); ?></p>

			<?php edit_post_link( __( '[Edit]', 'bean' ), '<span class="subtext edit">', '</span>'); ?>
			
		</div><!-- END .team-content -->

	</li>

<?php } //END if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) )