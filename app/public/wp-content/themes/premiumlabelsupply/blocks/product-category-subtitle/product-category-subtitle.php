<?php

/**
 * Product Category Subtitle Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param  ( int|string ) $post_id The post ID this block is saved to.
 */
// Create id attribute allowing for custom "anchor" value.
$id = 'product-subtitle-' . $block['id'];
$title = get_field('title');
$cover_image = get_field('cover_image');

$term = get_queried_object();
$cover_image = get_field('cover_image', $term);
$subtitle = get_field('subtitle', $term);

?>

<section class="product-subtitle_wrap" id="<?php echo esc_attr($id); ?>">

  <p class="has-custom-blue-color has-text-color has-montserrat-font-family" style="margin-bottom:50px;font-size:35px;font-style:normal;font-weight:700">
    <?=$subtitle?>   
  </p>

  <!--
  TEST: <?=$subtitle?>   
  <?php //echo single_cat_title(); ?> 
  <?php //echo category_description(); ?> 
  
  <?=$cover_image?>
  -->
</section>