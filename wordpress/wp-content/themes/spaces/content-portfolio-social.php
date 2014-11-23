<?php
/**
 * The template for displaying the portfolio sharing.
 * 
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */

get_header();

//SHARING
$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$twitter_profile = get_theme_mod( 'twitter_profile' );

//LAYOUT
//WE ARE USING THE GLOBAL THEME CUSTOMIZER VALUE AS PRIORITY HERE, BUT IF THE PORTFOLIO LAYOUT 
//FROM THE PORTFOLIO POST META IS NOT "DEFAULT", THEN WE PULL THAT.
$portfolio_layout = get_post_meta($post->ID, '_bean_portfolio_layout', true);
if ($portfolio_layout == 'default') {
	if 	  ( get_theme_mod( 'theme_version') == 'theme_version_fullscreen') { $portfolio_layout = 'fullscreen'; } 
	elseif ( get_theme_mod( 'theme_version') == 'theme_version_fullwidth') { $portfolio_layout = 'fullwidth'; }
	elseif ( get_theme_mod( 'theme_version') == 'theme_version_carousel') { $portfolio_layout = 'carousel'; }
	elseif ( get_theme_mod( 'theme_version') == 'theme_version_grid') { $portfolio_layout = 'grid'; }
	else   { $portfolio_layout = 'std'; }
}
?>

<div class="portfolio-wrap social">

	<ul class="portfolio-social">
		<li><a href="http://twitter.com/share?text=<?php the_title(); ?> <?php if ($twitter_profile !=''){ echo 'via @'. $twitter_profile.''; } ?>" target="_blank" class="twitter"><?php _e( 'Tweet', 'bean' ); ?></a></lil>
		<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="facebook even"><?php _e( 'Share', 'bean' ); ?></a></li>
		<li><a href="http://pinterest.com/pin/create/bookmarklet/?media=<?php echo $feat_image; ?>&url=<?php the_permalink(); ?>&is_video=false&description=<?php the_title(); ?>" class="pinterest"><?php _e( 'Pin', 'bean' ); ?></a></li>
		<li><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" class="google even"><?php _e( 'Send', 'bean' ); ?></a></li>

		<?php if ($portfolio_layout != 'std') { ?>
		<?php if( get_theme_mod( 'post_likes' ) == true) { ?>
				<li><?php Bean_PrintLikes($post->ID); ?></li>
			<?php } //END if get_theme_mod( 'post_likes' ) ?> 

<?php } //END if get_theme_mod( 'post_likes' ) ?>


	</ul><!-- END .portfolio.social -->

</div><!-- END .portfolio-wrap.social -->