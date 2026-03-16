<?php
/**
 * Sidebar – WordPress widget area (ThemeForest: sidebar must use widgets).
 */
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
    return;
}
// Column wrapper: skip when blog index (index.php) or page templates that already wrap sidebar in a column output it.
$skip_wrapper = is_home()
	|| is_page_template( 'template-blog-left-sidebar.php' )
	|| is_page_template( 'template-blog-grid-left-sidebar.php' )
	|| is_page_template( 'template-blog-grid-right-sidebar.php' );
if ( ! $skip_wrapper ) {
    echo '<div class="col-lg-4">';
}
?>
<aside id="secondary" class="widget-area">
    <div class="themephi-sideabr dynamic-sidebar">
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
    </div>
</aside>
<?php
if ( ! $skip_wrapper ) {
    echo '</div>';
}
