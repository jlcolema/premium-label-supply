<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post, $woocommerce;

$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
$shipping_methods = $woocommerce->shipping->load_shipping_methods();

if ( ! $short_description ) {
	return;
}

?>
<div class="woocommerce-product-details__short-description">
	<?php //echo $short_description; // WPCS: XSS ok. ?>
	
	<?php if ( $short_description ) { ?> 
		<div class="woocommerce-product-details__short-description--readmore">
			<?php echo $short_description; ?>
		</div>
	<?php } else { ?>
		<div class="woocommerce-product-details__short-description--readmore">
			<?php the_content(); ?>
		</div>
	<?php } ?>

	<div class="woocommerce-product-details__short-description--readmore-link">
			<a href="#wc-tabs">Learn more</a>
	</div>

	<?php 
		$_product = wc_get_product();
		$shipclass = $_product->get_shipping_class();
	?>
	
	<?php if($shipclass == "free-shipping"): ?>
	<div class="woocommerce-product-details__short-description--freeshipping">
		<img src="/wp-content/uploads/2022/12/free-shipping-icon.png" alt="Free Shipping">
		<div>Free Shipping On All Orders</div>
	</div>
	<?php endif; ?>
</div>
