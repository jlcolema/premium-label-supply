<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) : ?>

<div class="u-clear-both"></div>

<div class="ks-row wc-productabs">
	<div class="ks-col-6">
		<div class="ks-feature-img">
			<?php 
				global $product;
				$attachment_ids = $product->get_gallery_image_ids();
			?>
			<?php if( count($attachment_ids) ): ?>
			<?php 
				foreach( $attachment_ids as $attachment_id ) {
					$image_link = wp_get_attachment_url( $attachment_id );
				}
			?>
			<div class="ks-img-bg"></div>
			<div class="ks-img-wrap">
				<img src="<?php  echo $image_link; ?>" data-id="<?php echo $loop->post->ID; ?>">
			</div>			
			
			<?php endif; ?>
		</div>
	</div>
	<div class="ks-col-6 tabs-col">

	<?php
			$post_id = get_queried_object_id();
			$materials_heading = get_field('material_comparison_tab_heading', $post_id);
			$materials_content = get_field('material_comparison_tab_content', $post_id);
		?>

		<div id="wc-tabs" class="woocommerce-tabs wc-tabs-wrapper">
			<ul class="tabs wc-tabs" role="tablist">
				<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
					<li class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
						<a href="#tab-<?php echo esc_attr( $key ); ?>">
							<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
						</a>
					</li>
				<?php endforeach; ?>
				<?php if($materials_content != '') { ?>
					<li class="<?php echo 'material-comparison'; ?>_tab" id="tab-title-<?php echo 'material-comparison'; ?>" role="tab" aria-controls="tab-<?php echo 'material-comparison'; ?>">
						<a href="#tab-<?php echo "material-comparison"; ?>">
						<?php if($materials_heading) { echo $materials_heading; } else { echo "Materials Comparison"; } ?>
						</a>
					</li>
				<?php } ?>
			</ul>
			<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
				<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
					<?php
					if ( isset( $product_tab['callback'] ) ) {
						call_user_func( $product_tab['callback'], $key, $product_tab );
					}
					?>
				</div>
			<?php endforeach; ?>

			<?php if($materials_content != '') { ?>
				<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo "material-comparison"; ?> panel entry-content wc-tab" id="tab-<?php echo "material-comparison"; ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
					<?php echo $materials_content ?>
				</div>
			<?php } ?>
			
			<?php do_action( 'woocommerce_product_after_tabs' ); ?>
		</div>

	</div>
</div>


	

<?php endif; ?>
