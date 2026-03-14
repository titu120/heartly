<?php
    global $heartly_option;    
    $header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom', true);
    if ($header_width_meta != ''){
        $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
    }else{
        $header_width = !empty($heartly_option['header-grid']) ? $heartly_option['header-grid'] : '';
        $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
    }
    
    // Get bottom shape image
    $bottom_shape_image = !empty($heartly_option['breadcrumb_bottom_shape']['url']) ? $heartly_option['breadcrumb_bottom_shape']['url'] : '';
    
    // Get banner image
    $banner_image = '';
    if(!empty($heartly_option['blog_banner_main']['url'])) {
        $banner_image = $heartly_option['blog_banner_main']['url'];
    } elseif(!empty($heartly_option['page_banner_main']['url'])) {
        $banner_image = $heartly_option['page_banner_main']['url'];
    }
?>

<div class="breadcrumb-wrapper bg-cover" <?php if(!empty($banner_image)): ?>style="background-image: url('<?php echo esc_url($banner_image); ?>');"<?php elseif(!empty($heartly_option['breadcrumb_bg_color'])): ?>style="background-color: <?php echo esc_attr($heartly_option['breadcrumb_bg_color']);?>;"<?php endif; ?>>
    <div class="<?php echo esc_attr($header_width);?>">
        <div class="page-heading">
            <div class="breadcrumb-sub-title">
                <h1 class="text-white split-title"><?php printf( __( 'Search Results for: %s', 'heartly' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
            </div>
            <?php if(!empty($heartly_option['off_breadcrumb'])){
                if(function_exists('bcn_display')){?>
                    <ul class="breadcrumb-items">
                        <?php
                            if(function_exists('bcn_display_list')){
                                $breadcrumb_output = bcn_display_list(true, true, false, false);
                                if(!empty($breadcrumb_output)) {
                                    $breadcrumb_output = preg_replace('/(<li[^>]*><a[^>]*>)([^<]+)(<\/a><\/li>)/', '$1<i class="fa-solid fa-house"></i> $2$3', $breadcrumb_output, 1);
                                    $breadcrumb_output = preg_replace('/<\/li>\s*(?=<li[^>]*><a)/', '</li><li>/</li>', $breadcrumb_output);
                                    $breadcrumb_output = preg_replace('/^<ul[^>]*>/', '', $breadcrumb_output);
                                    $breadcrumb_output = preg_replace('/<\/ul>$/s', '', $breadcrumb_output);
                                    echo $breadcrumb_output;
                                } else {
                                    echo '<li><a href="' . esc_url(home_url('/')) . '"><i class="fa-solid fa-house"></i> ' . esc_html__('Home', 'heartly') . '</a></li><li>/</li><li>' . esc_html__('Search', 'heartly') . '</li>';
                                }
                            } else {
                                echo '<li><a href="' . esc_url(home_url('/')) . '"><i class="fa-solid fa-house"></i> ' . esc_html__('Home', 'heartly') . '</a></li><li>/</li><li>' . esc_html__('Search', 'heartly') . '</li>';
                            }
                        ?>
                    </ul>
                <?php } 
            } ?>
        </div>
    </div>
    <?php if(!empty($bottom_shape_image)): ?>
        <div class="bottom-shape d-none d-xl-block">
            <img src="<?php echo esc_url($bottom_shape_image); ?>" alt="<?php echo esc_attr__('bottom shape', 'heartly'); ?>">
        </div>
    <?php endif; ?>
</div>
