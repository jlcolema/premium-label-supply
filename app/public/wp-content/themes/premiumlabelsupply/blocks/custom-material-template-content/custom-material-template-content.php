<?php

/**
 * Custom Material Content Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param  ( int|string ) $post_id The post ID this block is saved to.
 */
// Create id attribute allowing for custom "anchor" value.
$id = 'custom-material-template-content-' . $block['id'];
$term = get_queried_object();
$customh1 = get_field( 'custom_h1', $term);
$subheading = get_field( 'sub_heading', $term);
$banner = get_field( 'banner_image', $term);
$topcontent = get_field( 'top_content', $term);
$bottomcontent = get_field( 'bottom_content', $term);
?>

<div class="custom-category-banner" style="background:url(<?php echo $banner; ?>);">
    <div class="content-area">
        <?php 
        if( $customh1 ) { ?>
            <h1><?php echo $customh1; ?></h1><?php
        } else {
            echo '';
        }
    ?>
    <?php 
        if( $subheading ) { ?>
            <p class="sub-heading pl-generic-banner"><?php echo $subheading ?></p><?php
        } else {
            echo '';
        }
    ?>
    </div>
</div>

<div class="obx-top-content">
    <div class="content-area">
        <?php 
            if( $topcontent ) { 
                echo $topcontent;
            } else {
                echo '';
            }
        ?>
    </div>
</div>

<div class="all-product-container stretch-to-vw-wrap">


    <div class="stretch-to-vw">
        <div class="content-area">
            <div class="products columns-5">
                <div class="custom-material-listing-container flex-row">


                <?php 
                    $material = get_field('material', $term);
                    $rows = get_field('product_loop', $term);
                    if( $rows ) {
                        
                        foreach( $rows as $row ) {
                            echo '<div class="flex-item material-product">';
                            $image = $row['product_image'];
                            $link = $row['product_url'];
                            $name = $row['product_name'];
                            $merge = $link . $material;
                            echo '<a href="';
                            echo $merge;
                            echo '">';
                                echo '<img src="';
                                echo $image;
                                echo '"/>';
                                echo '<span class="prod-name">';
                                echo $name;
                                echo '</span>';
                            echo '</div>';
                        }
                        
                    }
                ?>


                </div>
            </div>
        </div>
    </div>
</div>

<div class="obx-bottom-content">
    <div class="content-area">
        <?php if( $bottomcontent ) {
            echo $bottomcontent; 
            } else {
            echo '';
            }
        ?>
    </div>
</div>