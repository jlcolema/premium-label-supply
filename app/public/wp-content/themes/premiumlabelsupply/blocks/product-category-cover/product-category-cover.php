<?php

/**
 * Product Category Cover Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param  ( int|string ) $post_id The post ID this block is saved to.
 */
// Create id attribute allowing for custom "anchor" value.
$id = 'product-category-cover-' . $block['id'];
$title = get_field('title');


$term = get_queried_object();
$cover_image = get_field('cover_image', $term);
$subtitle = get_field('subtitle', $term);
$image_css = get_field('image_css', $term);
//object-position:50% 100%
?>

<div id="category-banner" style="background-image: url('<?php echo $cover_image; ?>'); <?php echo $image_css; ?>"  >
  <div class="content-area">
    <div class="category-header">
      <h1><?php echo single_cat_title(); ?></h1>
      <div class="category-subtitle">
        <?php echo category_description(); ?>
      </div>
    </div>
  </div>
</div>