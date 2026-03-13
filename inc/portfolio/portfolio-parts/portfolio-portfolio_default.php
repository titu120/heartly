<?php
$post_id      = get_the_id();
$excerpt = get_the_excerpt();
$cats_show = get_the_term_list($post_id, 'tp-portfolio-category', ' ', '<span class="separator">,</span> ');
$post_date = get_the_date('F j, Y', $post_id);
$author_name = get_the_author_meta('display_name');
$group_field_values = get_post_meta($post_id, 'pf_details', true);

$gallery_images = get_post_meta(get_the_ID(), 'tp_gallery_images', true);
$video_thumbnail = get_post_meta(get_the_ID(), 'video_thumbnail', true);
$video_url_field = get_post_meta(get_the_ID(), 'video_url_field', true);
$details_excerpt = get_post_meta(get_the_ID(), 'details_excerpt', true);
$quoute_img = get_post_meta(get_the_ID(), 'quoute_img', true);
$quote_title = get_post_meta(get_the_ID(), 'quote_title', true);

?>
<?php if (has_post_thumbnail()) :  ?>
    <section class="blog-breadcrumd position-relative">
        <?php echo get_the_post_thumbnail(get_the_ID(), '', array('class' => 'post-thumbnail')); ?>
    </section>
<?php endif; ?>
<section class="portfolio-single-section pt-120 pb-120">
    <div class="container">
        <div class="row g-6 justify-content-between">
            <div class="row g-lg-6 g-6 justify-content-between mb-xxl-14 mb-xl-12 mb-lg-9 mb-md-8 mb-6">
                <div class="col-md-8">
                    <div class="d">
                        <h2 class="black-clr mb-2 visible-slowly-right">
                            <?php the_title(); ?>
                        </h2>
                        <span class="n10-clr"><?php echo wp_kses_post($cats_show); ?></span>
                        <p class="n10-clr mb-xl-7 mb-md-6 mb-5 mt-xxl-8 mt-xl-7 mt-md-6 mt-4 wow fadeInUp" data-wow-delay=".3s">
                            <?php echo get_the_content(); ?>
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="single-project-info d-grid gap-lg-8 gap-md-6 gap-5">
                        <div class="single-project-item wow fadeInUp" data-wow-delay="0.3s">
                            <span class="fw-mid fs-six black-clr mb-0 d-block"><?php echo esc_html__('Client', 'heartly'); ?></span>
                            <span class="n10-clr"><?php echo wp_kses_post($author_name); ?></span>
                        </div>
                        <div class="single-project-item wow fadeInUp" data-wow-delay="0.5s">
                            <span class="fw-mid fs-six black-clr mb-0 d-block"><?php echo esc_html__('Date', 'heartly'); ?></span>
                            <span class="n10-clr"><?php echo wp_kses_post($post_date); ?></span>
                        </div>
                        <div class="single-project-item wow fadeInUp" data-wow-delay="0.6s">
                            <span class="fw-mid fs-six black-clr mb-0 d-block"><?php echo esc_html__('Services', 'heartly'); ?></span>
                            <span class="n10-clr"><?php echo wp_kses_post($cats_show); ?></span>
                        </div>
                        <div class="single-project-item wow fadeInUp" data-wow-delay="0.7s">
                            <span class="fw-mid fs-six black-clr mb-0 d-block"><?php echo esc_html__('Share Now', 'heartly'); ?></span>
                            <ul class="d-center justify-content-start gap-3 social-area mt-2 porfotio-social">
                                <?php
                                // Get the current URL
                                $current_url = urlencode(get_permalink());

                                // Social URLs with dynamic links
                                $facebook_url = "https://www.facebook.com/sharer/sharer.php?u=$current_url";
                                $twitter_url = "https://twitter.com/intent/tweet?url=$current_url";
                                $instagram_url = "https://www.instagram.com/?url=$current_url"; // Instagram doesn't have native sharing for links.
                                $dribbble_url = "https://dribbble.com/share?url=$current_url"; // Example for Dribbble, adjust if needed.
                                ?>
                                <li>
                                    <a href="<?php echo esc_url($facebook_url); ?>" aria-label="Facebook" class="d-center" target="_blank" rel="noopener noreferrer">
                                        <i class="fab fa-facebook-f fs-six"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url($twitter_url); ?>" aria-label="Twitter" class="d-center" target="_blank" rel="noopener noreferrer">
                                        <i class="fab fa-twitter fs-six"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url($instagram_url); ?>" aria-label="Instagram" class="d-center" target="_blank" rel="noopener noreferrer">
                                        <i class="fab fa-instagram fs-six"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url($dribbble_url); ?>" aria-label="Dribbble" class="d-center" target="_blank" rel="noopener noreferrer">
                                        <i class="fa-solid fa-basketball fs-six"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <?php if (!empty($video_url_field) && !empty($video_thumbnail)) : ?>
                <div class="portfolio-diversifed d-center position-relative w-100 mb-xxl-6 mb-xl-5 mb-lg-4 mb-3 wow fadeInUp" data-wow-delay=".5s">
                    <img src="<?php echo esc_url($video_thumbnail); ?>" alt="<?php esc_attr__('Thumbnail', 'heartly'); ?>" class="w-100">
                    <a href="<?php echo esc_url($video_url_field); ?>" class="portfolio-video rounded-circle d-center popup-video">
                        <i class="fa-solid fa-play"></i>
                    </a>
                </div>
            <?php endif; ?>
            <p class="n10-clr  mb-xxl-10 mb-xl-8 mb-lg-7 mb-4 wow fadeInUp" data-wow-delay=".4s">
                <?php echo wp_kses_post($details_excerpt); ?>
            </p>
            <?php if (!empty($quote_title) && !empty($quoute_img)) : ?>
                <div class="mb-xxl-12 mb-xl-10 mb-lg-9 mb-md-7 mb-sm-5 mb-2 text-center wow fadeInUp" data-wow-delay=".4s">
                    <img src="<?php echo esc_url($quoute_img); ?>" alt="<?php esc_attr__('Quote', 'heartly'); ?>" class="mb-4">
                    <h4 class="black-clr">
                        <?php echo wp_kses_post($quote_title); ?>
                    </h4>
                </div>
            <?php endif; ?>
            <p class="n10-clr wow fadeInUp" data-wow-delay=".4s">
                <?php echo wp_kses_post($excerpt); ?>
            </p>
        </div>
    </div>
</section>

<section class="portfolio-previus-achevment mb-10">
    <?php if (!empty($gallery_images) && is_array($gallery_images)) :
        $count_img = count($gallery_images);
    ?>
        <div class="container-fluid p-0">
            <div class="row g-0">
                <?php foreach ($gallery_images as $image_id => $image_url) : ?>
                    <div class="col-sm-6 wow fadeInUp" data-wow-delay=".3s">
                        <div class="d-block w-100">
                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_id); ?>" class="w-100">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</section>