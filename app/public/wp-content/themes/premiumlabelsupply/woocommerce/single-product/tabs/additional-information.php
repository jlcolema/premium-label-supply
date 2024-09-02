<?php
/**
 * Additional Information tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/additional-information.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

defined( 'ABSPATH' ) || exit;

global $product, $post;

//$heading = apply_filters( 'woocommerce_product_additional_information_heading', __( 'Additional information', 'woocommerce' ) );
$heading = apply_filters( 'woocommerce_product_description_heading', __( 'Description', 'woocommerce' ) );
$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

if ( ! $short_description ) {
	return;
}

?>

<?php if ( $heading && 0 ) : ?>
	<h2><?php echo esc_html( $heading ); ?></h2>
<?php endif; ?>

<?php echo $short_description; // WPCS: XSS ok. ?>
<?php //do_action( 'woocommerce_product_additional_information', $product ); ?>
