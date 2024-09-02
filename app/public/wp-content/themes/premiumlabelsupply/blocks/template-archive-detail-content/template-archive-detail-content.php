<?php

/**
 * Template Archive Detail Content Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param  ( int|string ) $post_id The post ID this block is saved to.
 */
// Create id attribute allowing for custom "anchor" value.
$id = 'template-detail-content-' . $block['id'];
$title = get_field('template_name');


$term = get_the_ID();
$template_details = get_field('template_details', $term);
$design_link = get_field('design_link', $term);
$design_link_word = get_field('download_for_word', $term);
$design_link_pdf = get_field('download_for_pdf', $term);
//object-position:50% 100%
?>

<div class="label-template-content-archive">
    <div class="ltc-detail"><?php echo $template_details ?></div>
    <!-- <a target="_blank" href="<?php // echo $design_link ?>" class="button ltc-design">DESIGN ONLINE</a>
    <p style="text-align:center;"><em>You will be redirected to Canva.com. Free sign up is required</em></p>
    <a target="_blank" href="<?php // echo $design_link_word ?>" class="button ltc-word">DOWNLOAD FOR WORD</a>
    <a target="_blank" href="<?php // echo $design_link_pdf  ?>" class="button ltc-pdf">DOWNLOAD FOR PDF</a> -->
</div>

