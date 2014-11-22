<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<div class="row fadein">

	<div class="eight columns sidebar-right">

	<div class="entry-content-media">
		<?php woocommerce_show_product_sale_flash(); ?>
		<?php woocommerce_show_product_images(); ?>
	</div><!-- END .entry-content-media -->

		<?php if ( post_password_required() ) {
			 	echo get_the_password_form();
			 	return;
			 }
		?>

		<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="four columns meta hide">

				<?php woocommerce_template_single_add_to_cart(); ?>

				<?php
				/**
				 * woocommerce_before_single_product hook
				 *
				 * @hooked wc_print_notices - 10
				 */
				 do_action( 'woocommerce_before_single_product' );
				 ?>

			</div><!-- END .four.columns -->

			<div class="eight columns">
			
				<?php woocommerce_template_single_title(); ?>
				<?php woocommerce_template_single_price(); ?>
				<?php woocommerce_template_single_excerpt(); ?>
				<?php woocommerce_template_single_meta(); ?>
				<?php woocommerce_output_product_data_tabs(); ?>

				<div class="mobile-cart">
					<?php woocommerce_template_single_add_to_cart(); ?>
				</div><!-- END .mobile.cart -->

			</div><!-- END .eight.columns -->


			<?php
				/**
				 * woocommerce_before_single_product_summary hook
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				//do_action( 'woocommerce_before_single_product_summary' );
			?>
	

			<?php
				/**
				 * woocommerce_after_single_product_summary hook
				 *
				 * @hooked woocommerce_output_product_data_tabs - 10
				 * @hooked woocommerce_output_related_products - 20
				 */
				//do_action( 'woocommerce_after_single_product_summary' );
			?>

			

			<meta itemprop="url" content="<?php the_permalink(); ?>" />

		</div><!-- #product-<?php the_ID(); ?> -->

		<?php do_action( 'woocommerce_after_single_product' ); ?>

	</div><!-- END .six.columns.sidebar-right -->	

	
	<?php //SIDEBAR STYLE
	$theme_style = get_theme_mod( 'theme_style');
	if ($theme_style == 'theme_style_2') { $theme_style = 'dark'; } 
	else { $theme_style = ''; }
	?>

	<div class="four columns <?php echo $theme_style; ?> sidebar">

		<?php dynamic_sidebar( 'Shop Sidebar' ); ?>
		
	</div><!-- END .four.columns.sidebar -->

</div><!-- END .row -->

<?php woocommerce_related_products(); ?>