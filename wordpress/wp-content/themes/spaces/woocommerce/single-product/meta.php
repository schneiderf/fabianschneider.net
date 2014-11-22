<?php
/**
 * Single Product Meta
 *
 * @author 	WooThemes
 * @package 	WooCommerce/Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>
<div class="product_meta subtext">

<ul class="entry-meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<li><span class="sku_wrapper"><?php _e( 'SKU:', 'woocommerce' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'n/a', 'woocommerce' ); ?></span></span></li>

	<?php endif; ?>

	<?php echo $product->get_categories( ', ', '<li><span class="posted_in">' . _n( 'Category:', 'Categories:', sizeof( get_the_terms( $post->ID, 'product_cat' ) ), 'woocommerce' ) . ' ', '</span></li>' ); ?>

	<?php echo $product->get_tags( ', ', '<li><span class="tagged_as">' . _n( 'Tag:', 'Tags:', sizeof( get_the_terms( $post->ID, 'product_tag' ) ), 'woocommerce' ) . ' ', '</span></li>' ); ?>

	<li><?php Bean_PrintLikes($post->ID); ?></li>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</ul>

</div>