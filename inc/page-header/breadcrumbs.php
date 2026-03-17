<?php
global $heartly_option;

// Custom breadcrumb text for singular post types
$custom_breadcrumb_text = '';
if (is_singular('tp-portfolios')) {
    $custom_breadcrumb_text = esc_html__('Portfolio Details', 'heartly');
} elseif (is_singular('teams')) {
    $custom_breadcrumb_text = esc_html__('Team Details', 'heartly');
} elseif (is_singular('services')) {
    $custom_breadcrumb_text = esc_html__('Service Details', 'heartly');
} elseif (is_singular('causes') || is_singular('tp-causes')) {
    $custom_breadcrumb_text = esc_html__('Causes Details', 'heartly');
} elseif (is_singular('tp-events') || is_singular('events')) {
    $custom_breadcrumb_text = esc_html__('Event Details', 'heartly');
} elseif (is_singular('tp-notices') || is_singular('notices')) {
    $custom_breadcrumb_text = esc_html__('Notice Details', 'heartly');
} elseif (is_singular('courses') || is_singular('sfwd-courses')) {
    $custom_breadcrumb_text = esc_html__('Course Details', 'heartly');
} elseif (is_singular('sfwd-lessons')) {
    $custom_breadcrumb_text = esc_html__('Lesson Details', 'heartly');
} elseif (is_singular('sfwd-topic')) {
    $custom_breadcrumb_text = esc_html__('Topic Details', 'heartly');
} elseif (is_singular('sfwd-quiz')) {
    $custom_breadcrumb_text = esc_html__('Quiz Details', 'heartly');
}
$header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom', true);
if ($header_width_meta != '') {
    $header_width = ($header_width_meta == 'full') ? 'container-fluid' : 'container';
} else {
    $header_width = !empty($heartly_option['header-grid']) ? $heartly_option['header-grid'] : '';
    $header_width = ($header_width == 'full') ? 'container-fluid' : 'container';
}

?>

<?php
$post_meta_data = get_post_meta(get_the_ID(), 'banner_image', true);
$post_meta_data2 = '';
//theme option checking
if ($post_meta_data == '') {
    if (!empty($heartly_option['page_banner_main']['url'])):
        $post_meta_data = $heartly_option['page_banner_main']['url'];
    elseif (is_singular('tp-portfolios') && !empty($heartly_option['department_single_image']['url'])):
        $post_meta_data = $heartly_option['department_single_image']['url'];
    elseif (is_singular('teams') && !empty($heartly_option['team_single_image']['url'])):
        $post_meta_data = $heartly_option['team_single_image']['url'];
    elseif (is_singular('services') && !empty($heartly_option['service_single_image']['url'])):
        $post_meta_data = $heartly_option['service_single_image']['url'];
    elseif ((is_singular('courses') || is_singular('sfwd-lessons')) && !empty($heartly_option['course_banner']['url'])):
        $post_meta_data = $heartly_option['course_banner']['url'];
    else: {
            // Show breadcrumb section even if bg_color is not set (use empty or transparent)
            $post_meta_data2 = !empty($heartly_option['breadcrumb_bg_color']) ? $heartly_option['breadcrumb_bg_color'] : 'transparent';
        }
    endif;
}

$banner_hide = get_post_meta(get_the_ID(), 'banner_hide', true);
if ('show' == $banner_hide || $banner_hide == '') {
    $post_meta_data = $post_meta_data;
    $post_meta_data2 = $post_meta_data2;
} else {
    $post_meta_data = '';
    $post_meta_data2 = '';
}
$post_menu_type = get_post_meta(get_the_ID(), 'menu-type', true);
$content_banner = get_post_meta(get_the_ID(), 'content_banner', true);
$intro_content_banner = get_post_meta(get_the_ID(), 'intro_content_banner', true);

// Get bottom shape image
$bottom_shape_image = !empty($heartly_option['breadcrumb_bottom_shape']['url']) ? $heartly_option['breadcrumb_bottom_shape']['url'] : '';
?>

<?php if ($post_meta_data != '') {
    ?>
    <div class="breadcrumb-wrapper bg-cover" style="background-image: url('<?php echo esc_url($post_meta_data); ?>');">
        <div class="<?php echo esc_attr($header_width); ?>">
            <div class="page-heading">
                <?php $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true); ?>
                <?php if ($post_meta_title != 'hide') { ?>
                    <div class="breadcrumb-sub-title">
                        <h1 class="text-white split-title">
                            <?php if ($content_banner != '') {
                                echo esc_html($content_banner);
                            } else {
                                the_title();
                            }
                            ?>
                        </h1>
                    </div>
                <?php } ?>

                <?php if (!empty($heartly_option['off_breadcrumb'])) {
                    $rs_breadcrumbs = get_post_meta(get_the_ID(), 'select-bread', true);
                    if ($rs_breadcrumbs != 'hide'):
                        if (!empty($custom_breadcrumb_text)) { ?>
                            <ul class="breadcrumb-items">
                                <li><a href="<?php echo esc_url(home_url('/')); ?>"><i class="fa-solid fa-house"></i>
                                        <?php echo esc_html__('Home', 'heartly'); ?></a></li>
                                <li class="separator">/</li>
                                <li><?php echo esc_html( $custom_breadcrumb_text ); ?></li>
                            </ul>
                        <?php } elseif (function_exists('bcn_display_list')) {
                            // Get breadcrumb list output
                            $breadcrumb_output = bcn_display_list(true, true, false, false);

                            if (!empty($breadcrumb_output)) {
                                // Remove the outer <ul> tag first
                                $breadcrumb_output = preg_replace('/^<ul[^>]*>/', '', $breadcrumb_output);
                                $breadcrumb_output = preg_replace('/<\/ul>$/s', '', $breadcrumb_output);

                                // If first item doesn't have home icon (e.g. plugin outputs site name "Heartly"), replace first item with Home + icon
                                if (strpos($breadcrumb_output, 'fa-house') === false) {
                                    $home_li = '<li><a href="' . esc_url(home_url('/')) . '"><i class="fa-solid fa-house"></i> ' . esc_html__('Home', 'heartly') . '</a></li>';
                                    $breadcrumb_output = preg_replace('/^<li[^>]*>.*?<\/li>/s', $home_li, $breadcrumb_output, 1);
                                } else {
                                    // Add home icon to first link when it's already a link
                                    $breadcrumb_output = preg_replace(
                                        '/(<li[^>]*><a[^>]*>)([^<]+)(<\/a><\/li>)/',
                                        '$1<i class="fa-solid fa-house"></i> $2$3',
                                        $breadcrumb_output,
                                        1
                                    );
                                }

                                // Add separators between items (but not after the last one)
                                // Match closing </li> followed by any opening <li> tag
                                $breadcrumb_output = preg_replace('/<\/li>\s*(?=<li[^>]*>)/', '</li><li class="separator">/</li>', $breadcrumb_output);
                            } else {
                                // Fallback
                                $breadcrumb_output = '<li><a href="' . esc_url(home_url('/')) . '"><i class="fa-solid fa-house"></i> ' . esc_html__('Home', 'heartly') . '</a></li><li class="separator">/</li><li>' . esc_html(get_the_title()) . '</li>';
                            }
                            ?>
                            <ul class="breadcrumb-items">
                                <?php echo wp_kses_post( $breadcrumb_output ); ?>
                            </ul>
                        <?php } else { ?>
                            <ul class="breadcrumb-items">
                                <li><a href="<?php echo esc_url(home_url('/')); ?>"><i class="fa-solid fa-house"></i>
                                        <?php echo esc_html__('Home', 'heartly'); ?></a></li>
                                <li class="separator">/</li>
                                <li><?php echo esc_html(get_the_title()); ?></li>
                            </ul>
                        <?php }
                    endif;
                } ?>
            </div>
        </div>
        <?php if (!empty($bottom_shape_image)): ?>
            <div class="bottom-shape d-none d-xl-block">
                <img src="<?php echo esc_url($bottom_shape_image); ?>"
                    alt="<?php echo esc_attr__('bottom shape', 'heartly'); ?>">
            </div>
        <?php endif; ?>
    </div>
<?php } elseif ($post_meta_data2 != '') { ?>
    <div class="breadcrumb-wrapper bg-cover" style="background-color: <?php echo esc_attr($post_meta_data2); ?>;">
        <div class="<?php echo esc_attr($header_width); ?>">
            <div class="page-heading">
                <?php $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true); ?>
                <?php if ($post_meta_title != 'hide') { ?>
                    <div class="breadcrumb-sub-title">
                        <h1 class="text-white split-title">
                            <?php if ($content_banner != '') {
                                echo esc_html($content_banner);
                            } else {
                                the_title();
                            }
                            ?>
                        </h1>
                    </div>
                <?php } ?>

                <?php if (!empty($heartly_option['off_breadcrumb'])) {
                    $rs_breadcrumbs = get_post_meta(get_the_ID(), 'select-bread', true);
                    if ($rs_breadcrumbs != 'hide'):
                        if (!empty($custom_breadcrumb_text)) { ?>
                            <ul class="breadcrumb-items">
                                <li><a href="<?php echo esc_url(home_url('/')); ?>"><i class="fa-solid fa-house"></i>
                                        <?php echo esc_html__('Home', 'heartly'); ?></a></li>
                                <li class="separator">/</li>
                                <li><?php echo esc_html( $custom_breadcrumb_text ); ?></li>
                            </ul>
                        <?php } elseif (function_exists('bcn_display_list')) {
                            // Get breadcrumb list output
                            $breadcrumb_output = bcn_display_list(true, true, false, false);

                            if (!empty($breadcrumb_output)) {
                                // Remove the outer <ul> tag first
                                $breadcrumb_output = preg_replace('/^<ul[^>]*>/', '', $breadcrumb_output);
                                $breadcrumb_output = preg_replace('/<\/ul>$/s', '', $breadcrumb_output);

                                // If first item doesn't have home icon (e.g. plugin outputs site name "Heartly"), replace first item with Home + icon
                                if (strpos($breadcrumb_output, 'fa-house') === false) {
                                    $home_li = '<li><a href="' . esc_url(home_url('/')) . '"><i class="fa-solid fa-house"></i> ' . esc_html__('Home', 'heartly') . '</a></li>';
                                    $breadcrumb_output = preg_replace('/^<li[^>]*>.*?<\/li>/s', $home_li, $breadcrumb_output, 1);
                                } else {
                                    // Add home icon to first link when it's already a link
                                    $breadcrumb_output = preg_replace(
                                        '/(<li[^>]*><a[^>]*>)([^<]+)(<\/a><\/li>)/',
                                        '$1<i class="fa-solid fa-house"></i> $2$3',
                                        $breadcrumb_output,
                                        1
                                    );
                                }

                                // Add separators between items (but not after the last one)
                                // Match closing </li> followed by any opening <li> tag
                                $breadcrumb_output = preg_replace('/<\/li>\s*(?=<li[^>]*>)/', '</li><li class="separator">/</li>', $breadcrumb_output);
                            } else {
                                // Fallback
                                $breadcrumb_output = '<li><a href="' . esc_url(home_url('/')) . '"><i class="fa-solid fa-house"></i> ' . esc_html__('Home', 'heartly') . '</a></li><li class="separator">/</li><li>' . esc_html(get_the_title()) . '</li>';
                            }
                            ?>
                            <ul class="breadcrumb-items">
                                <?php echo wp_kses_post( $breadcrumb_output ); ?>
                            </ul>
                        <?php } else { ?>
                            <ul class="breadcrumb-items">
                                <li><a href="<?php echo esc_url(home_url('/')); ?>"><i class="fa-solid fa-house"></i>
                                        <?php echo esc_html__('Home', 'heartly'); ?></a></li>
                                <li class="separator">/</li>
                                <li><?php echo esc_html(get_the_title()); ?></li>
                            </ul>
                        <?php }
                    endif;
                } ?>
            </div>
        </div>
        <?php if (!empty($bottom_shape_image)): ?>
            <div class="bottom-shape d-none d-xl-block">
                <img src="<?php echo esc_url($bottom_shape_image); ?>"
                    alt="<?php echo esc_attr__('bottom shape', 'heartly'); ?>">
            </div>
        <?php endif; ?>
    </div>
    <?php
} else {
    $post_meta_bread = get_post_meta(get_the_ID(), 'select-bread', true); ?>
    <?php if ($post_meta_bread == 'show' || $post_meta_bread == '') { ?>
        <div class="breadcrumb-wrapper bg-cover">
            <div class="<?php echo esc_attr($header_width); ?>">
                <div class="page-heading">
                    <?php $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true); ?>
                    <?php if ($post_meta_title != 'hide') { ?>
                        <div class="breadcrumb-sub-title">
                            <h1 class="text-white split-title">
                                <?php if ($content_banner != '') {
                                    echo esc_html($content_banner);
                                } else {
                                    the_title();
                                }
                                ?>
                            </h1>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php if (!empty($bottom_shape_image)): ?>
                <div class="bottom-shape d-none d-xl-block">
                    <img src="<?php echo esc_url($bottom_shape_image); ?>"
                        alt="<?php echo esc_attr__('bottom shape', 'heartly'); ?>">
                </div>
            <?php endif; ?>
        </div>
        <?php
    }

}
?>