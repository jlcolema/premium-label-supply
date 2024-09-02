<?php
/**
 * Search & Filter Pro
 *
 * Results Template
 *
 * @package   Search_Filter
 * @author    Ross Morsali
 * @link      https://searchandfilter.com
 * @copyright 2018 Search & Filter
 *
 * Note: these templates are not full page templates, rather
 * just an encaspulation of the your results loop which should
 * be inserted in to other pages by using a shortcode - think
 * of it as a template part
 *
 * This template is an absolute base example showing you what
 * you can do, for more customisation see the WordPress docs
 * and using template tags -
 *
 * http://codex.wordpress.org/Template_Tags
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="label-listing-container">
<?php


if ( $query->have_posts() ) {
	?>
	
	<ul>
	<?php
	while ( $query->have_posts() ) {
		$query->the_post();
		$term = get_queried_object_id();
		$template_details = get_field('template_details', $term);
		$listing_image = get_field('listing_image', $term);
		?>
		<li class="label-item">
			<figure class="wp-block-post-featured-image">
			<a href="<?php the_permalink(); ?>">
			<img src="<?php echo $listing_image ?>" alt="<?php the_title(); ?>" />
			</a>
		</figure>
            <h2 class="wp-block-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<div class="label-template-content-archive"><div class="ltc-detail"><?php echo $template_details ?></div></div>
			
		</li>

		<?php
	}
	?>
	</ul>
	<?php
} else {
	echo 'No Results Found';
}
?>
</div>