<?php
  add_action( 'init', 'register_acf_blocks' );

	if ( ! function_exists( 'register_acf_blocks' ) ) :
		function register_acf_blocks() {
			
			// Product Category Subtitle
			acf_register_block_type(array(
				'name'              => 'product-category-subtitle',
				'title'             => __('Product Category Subtitle'),
				'description'       => __(''),
				'mode'				=> 'preview',
				'render_template'   => 'blocks/product-category-subtitle/product-category-subtitle.php',
				'category'          => 'text',
				'icon' 				=> 'columns',
				'align'				=> 'full'
			));

			// Product Category Cover
			acf_register_block_type(array(
				'name'              => 'product-category-cover',
				'title'             => __('Product Category Cover'),
				'description'       => __(''),
				'mode'				=> 'preview',
				'render_template'   => 'blocks/product-category-cover/product-category-cover.php',
				'category'          => 'text',
				'icon' 				=> 'columns',
				'align'				=> 'full',
				'enqueue_assets' => function () {
					wp_enqueue_style('product-category-cover', get_template_directory_uri() . '/blocks/product-category-cover/product-category-cover.css');
				},
			));

			// Template Detail Content
			acf_register_block_type(array(
				'name'              => 'template-detail-content',
				'title'             => __('Template Detail Content'),
				'description'       => __(''),
				'mode'				=> 'preview',
				'render_template'   => 'blocks/template-detail-content/template-detail-content.php',
				'category'          => 'text',
				'icon' 				=> 'columns',
				'align'				=> 'full',
				'enqueue_assets' => function () {
					wp_enqueue_style('template-detail-content', get_template_directory_uri() . '/blocks/template-detail-content/template-detail-content.css');
				},
			));

			// Template Archive Detail Content
			acf_register_block_type(array(
				'name'              => 'template-archive-detail-content',
				'title'             => __('Template Archive Detail Content'),
				'description'       => __(''),
				'mode'				=> 'preview',
				'render_template'   => 'blocks/template-archive-detail-content/template-archive-detail-content.php',
				'category'          => 'text',
				'icon' 				=> 'columns',
				'align'				=> 'full',
				'enqueue_assets' => function () {
					wp_enqueue_style('template-archive-detail-content', get_template_directory_uri() . '/blocks/template-archive-detail-content/template-archive-detail-content.css');
				},
			));

			// Custom Material Category Content
			acf_register_block_type(array(
				'name'              => 'custom-material-template-content',
				'title'             => __('Custom Material Template Content'),
				'description'       => __(''),
				'mode'				=> 'preview',
				'render_template'   => 'blocks/custom-material-template-content/custom-material-template-content.php',
				'category'          => 'text',
				'icon' 				=> 'columns',
				'align'				=> 'full',
				'enqueue_assets' => function () {
					wp_enqueue_style('custom-material-template-content', get_template_directory_uri() . '/blocks/custom-material-template-content/custom-material-template-content.css');
				},
			));
		}
	endif;
?>