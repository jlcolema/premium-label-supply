<?php 

add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
if ( ! function_exists( 'woo_rename_tabs' ) ) :
  function woo_rename_tabs( $tabs ) {
    $tabs['additional_information']['title'] = __( 'Details' );	// Rename the additional information tab
    return $tabs;
  }
endif;

add_action( 'woocommerce_before_quantity_input_field', 'wp_qty_woocommerce_before_quantity_input_field_action' );
if ( ! function_exists( 'wp_qty_woocommerce_before_quantity_input_field_action' ) ) :
  function wp_qty_woocommerce_before_quantity_input_field_action(){
    echo '<span class="qty-label">QTY</span>';
  }
endif;

?>