<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>
<li <?php post_class( $classes ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
		
		<div class="portfolio">
		
			<a class="entry-link" title="<?php printf(__('Permanent Link to %s', 'bean'), get_the_title()); ?>" href="<?php the_permalink(); ?>"></a> 
			
			<?php

			//SALE BADGE
			wc_get_template( 'loop/sale-flash.php' ); 

			//GRID IMAGE
			$product_grid_image = get_post_meta($post->ID, '_bean_product_grid_image', true); ?>
			
			<?php if ($product_grid_image) { ?>
				<img src="<?php echo $product_grid_image;?>" />
			<?php } else { ?>
				<?php the_post_thumbnail('shop-grid'); ?>
			<?php } ?>

			<div class="overlay">
				<h5><?php _e( 'View More', 'bean' ); ?></h5>
			</div>

		</div><!-- END .portfolio -->

		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			//do_action( 'woocommerce_before_shop_loop_item_title' );
		?>

	<div class="product-content">
		
		<h2><a title="<?php printf(__('Permanent Link to %s', 'bean'), get_the_title()); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		
		<?php 
		$product_excerpt = get_post_meta($post->ID, '_bean_product_excerpt', true); 

		if ($product_excerpt) { echo '<p> '.$product_excerpt.'</p>'; } 
		?>

		<div class="subtext">
			<?php
				/**
				 * woocommerce_after_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_template_loop_rating - 5
				 * @hooked woocommerce_template_loop_price - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
			?>

		</div><!-- END .subtext -->

		<div class="product-btn">
			<?php do_action( 'woocommerce_after_shop_loop_item' );  ?>
		</div><!-- END .product-btn -->

	</div><!-- END .product-content -->

</li>