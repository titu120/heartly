<?php

global $heartly_option;
$post_id      = get_the_id();
//checking page layout 
$page_layout = get_post_meta($post->ID, 'layout', true);
$col_side = '';
$col_letf = '';

if ($page_layout == '2left' && is_active_sidebar('sidebar-portfolio')) {
    $col_side = '8';
    $col_letf = 'left-sidebar';
} else if ($page_layout == '2right' && is_active_sidebar('sidebar-portfolio')) {
    $col_side = '8';
    $col_letf = 'right-sidebar';
} else {
    $col_side = '12';
    $col_letf = 'full-width';
}

$selected_layout = get_post_meta(get_the_ID(), 'custom_sidebar', true);

if ($selected_layout == 'top_carousel_center' && !is_active_sidebar('sidebar-portfolio')) {
    $container_class = 'container-fluid';
} elseif ($selected_layout == 'top_carousel_center' && is_active_sidebar('sidebar-portfolio') && ($page_layout !== '2left' && $page_layout !== '2right')) {
    $container_class = 'container-fluid';
} else {
    $container_class = 'container';
}

?>

<div class="<?php echo esc_attr($container_class); ?>">
    <div class="themephi-portfolio-details">
        <div class="row padding-<?php echo esc_attr($col_letf) ?>">
            <div class="col-lg-<?php echo esc_attr($col_side); ?> <?php echo esc_attr($col_letf); ?> ">
                <div class="themephi-portfolio-details-inner-left <?php echo esc_attr($selected_layout); ?> ">
                    <?php while (have_posts()) : the_post();

                        if (empty($selected_layout)) {
                            $selected_layout = 'portfolio_default';
                        }

                        $tp_portfolio_options = array(
                            'portfolio_default' => esc_html__('Portfolio Default', 'heartly'),
                            'top_image_carousel' => esc_html__('Top Image Carousel', 'heartly'),
                            'top_carousel_center' => esc_html__('Top Carousel Center', 'heartly'),
                            'left_gallery_image' => esc_html__('Left Gallery Image', 'heartly'),
                            'left_gallery_grid' => esc_html__('Left Gallery Grid', 'heartly'),
                            'bottom_gallery_grid' => esc_html__('Bottom Gallery Grid', 'heartly'),
                            'top_gallery_carousel' => esc_html__('Top Gallery Carousel', 'heartly'),
                        );

                        // Include the appropriate template part based on the selected layout
                        switch ($selected_layout) {
                            case 'top_image_carousel':
                                get_template_part('inc/portfolio/portfolio-parts/portfolio', 'top_image_carousel');
                                break;

                            case 'top_carousel_center':
                                get_template_part('inc/portfolio/portfolio-parts/portfolio', 'top_carousel_center');
                                break;

                            case 'left_gallery_image':
                                get_template_part('inc/portfolio/portfolio-parts/portfolio', 'left_gallery_image');
                                break;

                            case 'left_gallery_grid':
                                get_template_part('inc/portfolio/portfolio-parts/portfolio', 'left_gallery_grid');
                                break;

                            case 'bottom_gallery_grid':
                                get_template_part('inc/portfolio/portfolio-parts/portfolio', 'bottom_gallery_grid');
                                break;

                            case 'top_gallery_carousel':
                                get_template_part('inc/portfolio/portfolio-parts/portfolio', 'top_gallery_carousel');
                                break;

                            case 'portfolio_default':
                            default:
                                get_template_part('inc/portfolio/portfolio-parts/portfolio', 'portfolio_default');
                                break;
                        }

                    ?>

                    <?php endwhile;
                    wp_reset_query(); ?>



                    <?php if ($selected_layout == 'top_carousel_center') : ?> <div class="container"> <?php endif; ?>

                        <?php
                        $next_post = get_next_post();
                        $previous_post = get_previous_post();
                        if (!empty($next_post) || !empty($previous_post)): ?>
                            <div class="service-navigation">
                                <?php
                                $url_next = is_object($next_post) ? get_permalink($next_post->ID) : '';
                                $title    = is_object($next_post) ? get_the_title($next_post->ID) : '';
                                ?>
                                <section class="portfolio-previus-achevment">
                                    <div class="container">
                                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 py-xxl-15 py-xl-12 py-lg-10 py-md-8 py-7">
                                            <a href="<?php echo esc_url($url_next) ?>" class="d-flex align-items-center gap-2 black-clr fs-seven">
                                                <i class="tp-arrow-left"></i>
                                                <?php echo esc_attr__('Previous Show Case', 'heartly') ?>
                                            </a>
                                            <?php $url_previous = is_object($previous_post) ? get_permalink($previous_post->ID) : '';
                                            $title = is_object($previous_post) ? get_the_title($previous_post->ID) : ''; ?>
                                            <?php if ($previous_post): ?>
                                                <a href="<?php echo esc_url($url_previous) ?>" class="d-flex align-items-center gap-2 black-clr fs-seven">
                                                    <?php echo esc_attr__('Next Show Case', 'heartly') ?> <i class="tp-arrow-right"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </section>

                            </div>
                        <?php endif; ?>

                        <?php if ($selected_layout == 'top_carousel_center') : ?>
                        </div> <?php endif; ?>

                </div>
            </div>

            <?php
            if (($page_layout == '2left' || $page_layout == '2right') && is_active_sidebar('sidebar-portfolio')) {
            ?>
                <div class="col-xxl-4 col-xl-4 col-lg-4">
                    <aside id="secondary" class="widget-area">
                        <div class="themephi-sideabr dynamic-sidebar">
                            <?php
                            dynamic_sidebar('sidebar-portfolio');
                            ?>
                        </div>
                    </aside>
                </div>
            <?php
            } ?>

        </div>
    </div>
</div>
<?php if (($selected_layout == 'top_image_carousel') || ($selected_layout == 'top_carousel_center') || ($selected_layout == 'top_gallery_carousel')) {

    if ($selected_layout == 'top_image_carousel') {
        $effect = 'effect: "creative",
        creativeEffect: {
            prev: {
            shadow: true,
            origin: "left center",
            translate: ["-5%", 0, -80],
            rotate: [0, 40, 0],
            },
            next: {
            origin: "right center",
            translate: ["5%", 0, -80],
            rotate: [0, -40, 0],
            },
        },
        ';

        $slidesPerView = 'slidesPerView: 1,';
    } elseif ($selected_layout == 'top_gallery_carousel') {
        $effect = 'effect: "",';
        $slidesPerView = 'slidesPerView: 3,';
    } else {
        $effect = 'effect: "",';
        $slidesPerView = 'slidesPerView: 2,';
    }

?>

    <script type="text/javascript">
        jQuery(document).ready(function() {
            var swiper = new Swiper(".tp-portfolio-inner-content-slider ", {
                loop: true,
                spaceBetween: 30,
                <?php echo esc_attr($effect); ?>
                <?php echo esc_attr($slidesPerView); ?>
                // centeredSlides: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: true,
                },
                navigation: {
                    nextEl: ".portfolio-inner-next",
                    prevEl: ".portfolio-inner-prev",
                },
            });
        });
    </script>

<?php }
?>