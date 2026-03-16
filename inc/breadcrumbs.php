<?php
if (is_404()) {
	get_template_part('inc/page-header/breadcrumbs-404');
} elseif (is_singular('post')) {
	get_template_part('inc/page-header/breadcrumbs-single');
} elseif (class_exists('WooCommerce') && is_product()) {
	get_template_part('inc/page-header/breadcrumbs-shop-single');
} elseif (is_page() || is_singular()) {
	get_template_part('inc/page-header/breadcrumbs');
} elseif (is_home()) {
	get_template_part('inc/page-header/breadcrumbs-blog');
} elseif (is_archive()) {
	if (class_exists('WooCommerce') && (is_shop() || is_product_category() || is_product_tag())) {
		get_template_part('inc/page-header/breadcrumbs-shop');
	} else {
		get_template_part('inc/page-header/breadcrumbs-archive');
	}
} elseif (is_search()) {
	get_template_part('inc/page-header/breadcrumbs-search');
}
?>