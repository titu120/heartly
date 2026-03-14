<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="//gmpg.org/xfn/11">
    <?php global $heartly_option; ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div class="close-button body-close"></div>
    <!--Preloader start here-->
    <?php get_template_part('inc/header/preloader'); ?>
    <!--Preloader area end here-->

  <!-- Start Custom Cursor -->
    <div class="mouse-follower">
        <span class="cursor-outline"></span>
        <span class="cursor-dot"></span>
    </div>
    <!-- End Custom Cursor -->

    <?php
    if (! function_exists('wp_body_open')) {
        function wp_body_open()
        {
            do_action('wp_body_open');
        }
    }
    ?>
    <?php
    $gap = '';
    if (is_active_sidebar('footer_top')) {
        $gap = 'footer-bottom-gaps';
    } ?>
    <?php
    $extrapadding = !empty($heartly_option['show_call_btns']) ? '' : 'lesspadding';
    ?>
    <div id="page" class="site <?php echo esc_attr($gap); ?> <?php echo esc_attr($extrapadding); ?>">
        <?php
        get_template_part('inc/header/header');
        ?>
        <!-- End Header Menu End -->
        <?php
        // Use correct page ID: on Blog (Posts page) get_the_ID() is 0, so use page_for_posts
        $page_id = get_the_ID();
        if (is_home() && !is_front_page()) {
            $page_id = (int) get_option('page_for_posts');
        }
        if (!$page_id && is_front_page() && get_option('show_on_front') === 'page') {
            $page_id = (int) get_option('page_on_front');
        }

        $page_bg = $page_id ? get_post_meta($page_id, 'page_bg', true) : '';
        $primary_colors = $page_id ? get_post_meta($page_id, 'primary-colors', true) : '';

        $main_contain_style = '';
        if (!empty($page_bg)) {
            $main_contain_style = "background-image: url('" . esc_url($page_bg) . "');";
        } elseif (!empty($primary_colors)) {
            $main_contain_style = 'background-color: ' . esc_attr($primary_colors) . ';';
        }
        ?>
            <div class="main-contain offcontents"<?php echo $main_contain_style ? ' style="' . $main_contain_style . '"' : ''; ?>>
                <div id="content">