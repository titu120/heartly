<?php
/**
 * Sidebar – WordPress widget area (ThemeForest: sidebar must use widgets).
 */
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
    return;
}
// On blog index, column wrapper is output by index.php (with order classes).
if ( ! is_home() ) {
    echo '<div class="col-lg-4">';
}
?>
<aside id="secondary" class="widget-area">
    <div class="themephi-sideabr dynamic-sidebar">
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
    </div>
</aside>
<?php
if ( ! is_home() ) {
    echo '</div>';
}
