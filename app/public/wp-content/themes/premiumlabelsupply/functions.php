<?php
if ( ! function_exists( 'add_pl_theme_scripts' ) ) :

  function add_pl_theme_scripts() {
    wp_enqueue_style( 'pl-style', get_template_directory_uri().'/style.css', array(), '1.5', 'all');
    wp_enqueue_style( 'pl-style-sass', get_template_directory_uri().'/assets/css/app.css', array(), '1.4', 'all');
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Karla:200,300,regular,500,600,700,800,200italic,300italic,italic,500italic,600italic,700italic,800italic|Roboto:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,900,900italic|Montserrat:100,200,300,regular,500,600,700,800,900,100italic,200italic,300italic,italic,500italic,600italic,700italic,800italic,900italic|Shadows+Into+Light:regular&#038;subset=latin,latin-ext&#038;display=swap', array(), '1.2', 'all');
  }
  add_action( 'wp_enqueue_scripts', 'add_pl_theme_scripts' );
endif;

/*
function github16702_allow_unsafe_urls($args, $url) {
	$args['reject_unsafe_urls'] = false;
	return $args;
}
add_filter('http_request_args', 'github16702_allow_unsafe_urls', 20, 2 );
*/


function ssu_custom_render_product_block( $html, $data, $post ) {
    $productID = url_to_postid( $data->permalink );
    $product = wc_get_product( $productID );

    //<a href="'.$product->get_permalink().'">'.$product->get_image('shop-feature').'</a>
    //<a href="'.$product->get_permalink().'">'.$product->get_price_html().'$'.$product->get_price().'</a>

    return '<li class="wc-block-grid__product">
                <div class="wc-block-grid__product--wrap">
                  <div class="wc-block-grid__product-image">
                    <a href="'.$product->get_permalink().'">'.$product->get_image( array( 250, 320 ) ).'</a>
                  </div>
                  <div class="wc-block-grid__product--title">
                    <a href="'.$product->get_permalink().'">'.$product->get_title().'</a>
                  </div>
                  <div class="wc-block-grid__product--price">
                    <a href="'.$product->get_permalink().'">'.get_woocommerce_currency_symbol().$product->get_price().'</a>
                  </div>
                </div>
            </li>';

    //return $html;
}
add_filter( 'woocommerce_blocks_product_grid_item_html', 'ssu_custom_render_product_block', 10, 3);


add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 5; // 3 products per row
	}
}

require_once( dirname( __FILE__ ) .'/inc/product-page.php');
require_once( dirname( __FILE__ ) .'/inc/acf-blocks.php');

/** OBX adding top content admin field for Category Pages */

add_action( 'product_cat_add_form_fields', 'obx_wp_editor_add', 10, 2 );

function obx_wp_editor_add() {
    ?>
    <div class="form-field">
        <label for="seconddesc"><?php echo __( 'Top Content', 'woocommerce' ); ?></label>

      <?php
      $settings = array(
         'textarea_name' => 'seconddesc',
         'quicktags' => array( 'buttons' => 'em,strong,link' ),
         'tinymce' => array(
            'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
            'theme_advanced_buttons2' => '',
         ),
         'editor_css' => '<style>#wp-excerpt-editor-container .wp-editor-area{height:175px; width:100%;}</style>',
      );

      wp_editor( '', 'seconddesc', $settings );
      ?>

        <p class="description"><?php echo __( 'This is the description that goes ABOVE products on the category page', 'woocommerce' ); ?></p>
    </div>
    <?php
}

add_action( 'product_cat_edit_form_fields', 'obx_wp_editor_edit', 10, 2 );

function obx_wp_editor_edit( $term ) {
    $second_desc = htmlspecialchars_decode( get_woocommerce_term_meta( $term->term_id, 'seconddesc', true ) );
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="second-desc"><?php echo __( 'Top Content', 'woocommerce' ); ?></label></th>
        <td>
            <?php

         $settings = array(
            'textarea_name' => 'seconddesc',
            'quicktags' => array( 'buttons' => 'em,strong,link' ),
            'tinymce' => array(
               'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
               'theme_advanced_buttons2' => '',
            ),
            'editor_css' => '<style>#wp-excerpt-editor-container .wp-editor-area{height:175px; width:100%;}</style>',
         );

         wp_editor( $second_desc, 'seconddesc', $settings );
         ?>

            <p class="description"><?php echo __( 'This is the description that goes ABOVE products on the category page', 'woocommerce' ); ?></p>
        </td>
    </tr>
    <?php
}


add_action( 'edit_term', 'obx_save_wp_editor', 10, 3 );
add_action( 'created_term', 'obx_save_wp_editor', 10, 3 );

function obx_save_wp_editor( $term_id, $tt_id = '', $taxonomy = '' ) {
   if ( isset( $_POST['seconddesc'] ) && 'product_cat' === $taxonomy ) {
      update_woocommerce_term_meta( $term_id, 'seconddesc', esc_attr( $_POST['seconddesc'] ) );
   }
}

add_action( 'woocommerce_before_main_content', 'obx_display_wp_editor_content', 50 );

function obx_display_wp_editor_content() {
    if ( is_product_taxonomy() && 0 === absint( get_query_var( 'paged' ) ) ) {
      $term = get_queried_object();
  }
   if ( is_product_taxonomy() ) {
      $term = get_queried_object();
      if ( $term && ! empty( get_woocommerce_term_meta( $term->term_id, 'seconddesc', true ) ) ) {
         echo '<p class="term-description">' . wc_format_content( htmlspecialchars_decode( get_woocommerce_term_meta( $term->term_id, 'seconddesc', true ) ) ) . '</p>';
      }
   }
}


add_action( 'woocommerce_before_shop_loop', 'inject_above_products', 1 );
function inject_above_products(){
   if ( is_product_taxonomy() ) {
      $term = get_queried_object();
      $heading = get_field('above_products_heading', $term);
      if (!$heading){
         $heading = 'Shop '. single_cat_title('', false);
      }
      echo '<div class="all-product-container stretch-to-vw-wrap"><div class="stretch-to-vw"><div class="content-area"><div class="above-product-heading">' . $heading . '</div>';
   }
}

add_action( 'woocommerce_after_main_content', 'inject_under_products', 1 );
function inject_under_products(){
   if ( is_product_taxonomy() ) {
      echo '</div></div></div>';
   }
}

add_action( 'woocommerce_after_main_content', 'inject_CTA', 2 );
function inject_CTA(){
   if ( is_product_taxonomy() ) {
?>
      <div class="cat-tax-full-width-cta stretch-to-vw-wrap">
         <div class="stretch-to-vw">
            <div class="content-area">
               <div class="cta-flex">
                  <div class="col" style="flex-basis: 60%;">
                     <h2>Not Seeing Your Size?</h2>
                     <p>Contact Us For Custom Sizing Options!</p>
                  </div>
                  <div class="col" style="flex-basis: 40%;">
                     <a href="https://premiumlabelsupply.com/contact-us/" class="white-btn">Talk To Our Team</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
<?php
   }
}

add_action( 'woocommerce_after_main_content', 'inject_product_bottom_content', 3 );
function inject_product_bottom_content(){
   if ( is_product_taxonomy() ) {
      $term = get_queried_object();
      $content = get_field('bottom_content', $term);
      if ($content){
         echo '<div class="bottom_content rte">' . $content . '</div>';
      }
      ?>
      <script>
         var acc = document.getElementsByClassName("accordion-head");
         var i;

         for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function () {
                  this.classList.toggle("active");
                  var content = this.nextElementSibling;
                  if (content.style.maxHeight) {
                     content.style.maxHeight = null;
                  } else {
                     content.style.maxHeight = content.scrollHeight + "px";
                  }
            });
         }
      </script>
   <?php
   }
}

add_action( 'woocommerce_after_main_content', 'inject_product_contact_form', 10 );
function inject_product_contact_form(){
   if ( is_product_taxonomy() ) {
      $term = get_queried_object();
      $form = get_field('product_contact_form', $term);

      $display_form = esc_attr($form['show_contact_form']);
      $form_title = esc_attr($form['contact_form_heading']);
      $form_content = ($form['contact_form_content']);

      if ($display_form){
?>
         <div class="cat-tax-full-width-form stretch-to-vw-wrap">
            <div class="stretch-to-vw">
               <div class="content-area">
                  <div class="flex-row">
                     <div class="content col">
                        <h2 class="cat-form-heading"><?php echo $form_title ?></h2>
                        <?php if($form_content) {
                           echo '<div class="cat-form-content">' . $form_content . '</div>';
                        } ?>
                     </div>
                     <div class="form col">
                        <?php echo do_shortcode( '[contact-form-7 id="318" title="Generic Contact Form"]' ); ?>
                     </div>
                  </div>
               </div>
            </div>
      </div>
<?php
      }
   }
}

// Remove WooCommerce H1 from category pages so that there's no duplicate H1s
add_filter( 'woocommerce_show_page_title', 'remove_category_title_from_product_archive' );

function remove_category_title_from_product_archive( $title ) {
   if ( is_product_category() ) {
      $title = false;
   }
   return $title;
}

/* Templates Custom Post Type */


function obx_templates_custom_post_type_init() {
   $labels = array(
       'name'                  => _x( 'Templates', 'Post type general name', 'template' ),
       'singular_name'         => _x( 'Template', 'Post type singular name', 'template' ),
       'menu_name'             => _x( 'Templates', 'Admin Menu text', 'template' ),
       'name_admin_bar'        => _x( 'Template', 'Add New on Toolbar', 'template' ),
       'add_new'               => __( 'Add New', 'template' ),
       'add_new_item'          => __( 'Add New template', 'template' ),
       'new_item'              => __( 'New template', 'template' ),
       'edit_item'             => __( 'Edit template', 'template' ),
       'view_item'             => __( 'View template', 'template' ),
       'all_items'             => __( 'All templates', 'template' ),
       'search_items'          => __( 'Search templates', 'template' ),
       'parent_item_colon'     => __( 'Parent templates:', 'template' ),
       'not_found'             => __( 'No templates found.', 'template' ),
       'not_found_in_trash'    => __( 'No templates found in Trash.', 'template' ),
       'featured_image'        => _x( 'Template Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'template' ),
   );
   $args = array(
       'labels'             => $labels,
       'description'        => 'Template custom post type.',
       'public'             => true,
       'show_ui'            => true,
       'show_in_menu'       => true,
       'query_var'          => true,
       'rewrite'            => array( 'slug' => 'templates' ),
       'capability_type'    => 'post',
       'has_archive'        => true,
       'hierarchical'       => false,
       'menu_position'      => 20,
       'supports'           => array( 'title', 'editor', 'thumbnail' ),
       'taxonomies'         => array( 'category', 'post_tag' ),
       'show_in_rest'       => true,
       'template'
   );

   register_post_type( 'template', $args );
}
add_action( 'init', 'obx_templates_custom_post_type_init' );

?>
