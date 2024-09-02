<?php

/**
 * Template Detail Content Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param  ( int|string ) $post_id The post ID this block is saved to.
 */
// Create id attribute allowing for custom "anchor" value.
$id = 'template-detail-content-' . $block['id'];
$title = get_field('template_name');


$term = get_queried_object();
$template_details = get_field('template_details', $term);
$template_description = get_field('template_description', $term);
$shop_product = get_field('product_link', $term);
$design_link = get_field('design_link', $term);
$design_link_word = get_field('download_for_word', $term);
$design_link_pdf = get_field('download_for_pdf', $term);
$predesigned_template = get_field('predesigned_template', $term);
//object-position:50% 100%
?>

<div id="label-template-content">
    <h1 class="ltc-title"><?php echo $title ?></h1>
    <div class="ltc-detail"><?php echo $template_details ?></div>
    <div class="ltc-description"><?php echo $template_description ?></div>
    <a target="_blank" href="<?php echo $shop_product ?>" class="button ltc-shop">SHOP PRODUCT</a>
    <p class="faux-h5">Download Template</p>
    <a target="_blank" href="<?php echo $design_link_word ?>" class="button ltc-word">DOWNLOAD FOR WORD</a>
    <a href="<?php echo $design_link_pdf  ?>" class="button ltc-pdf" download>DOWNLOAD FOR PDF</a>
    <a target="_blank" href="<?php echo $design_link ?>" class="button ltc-design">DESIGN ONLINE</a>
    <a href="<?php echo $predesigned_template ?>" class="button ltc-design predesign">PREDESIGNED TEMPLATE</a>
    <p style="text-align:center;"><em>You will be redirected to Canva.com. Free sign up is required</em></p>
    <p><strong>Need Help?</strong> <a class="needhelp" href="#learnTemplate">Learn more about using the templates here.</a></p>
</div>

