<?php
    global $heartly_option;    
    $header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom', true);
    if ($header_width_meta != ''){
        $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
    }else{
        $header_width = !empty($heartly_option['header-grid']) ? $heartly_option['header-grid'] : '';
        $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
    }
    $post_meta_data = get_post_meta(get_the_ID(), 'banner_image', true); 
    $post_menu_type = get_post_meta(get_the_ID(), 'menu-type', true); 
    $content_banner = get_post_meta(get_the_ID(), 'content_banner', true); 
    $intro_content_banner = get_post_meta(get_the_ID(), 'intro_content_banner', true);
    
    // Get bottom shape image
    $bottom_shape_image = !empty($heartly_option['breadcrumb_bottom_shape']['url']) ? $heartly_option['breadcrumb_bottom_shape']['url'] : '';
?>

<div class="breadcrumb-wrapper bg-cover">

<?php if($post_meta_data !='') { ?>
    <div style="background-image: url('<?php echo esc_url($post_meta_data); ?>');">
        <div class="<?php echo esc_attr($header_width);?>">
            <div class="page-heading">
                <?php 
                    $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true);?>
                    <?php if( $post_meta_title != 'hide' ){ ?>
                        <div class="breadcrumb-sub-title">
                            <h1 class="text-white split-title">
                                <?php if($content_banner !=''){
                                   echo esc_html($content_banner);
                                    } else {
                                       the_title();
                                    }
                                ?>
                            </h1>
                        </div>
                    <?php } 
                    if(!empty($heartly_option['off_breadcrumb'])){
                        $rs_breadcrumbs = get_post_meta(get_the_ID(), 'select-bread', true);
                        if( $rs_breadcrumbs != 'hide' ):        
                            if(function_exists('bcn_display')){?>
                                <ul class="breadcrumb-items">
                                    <?php
                                    if(function_exists('bcn_display_list')){
                                        $breadcrumb_output = bcn_display_list(true, true, false, false);
                                        if(!empty($breadcrumb_output)) {
                                            $breadcrumb_output = preg_replace('/^<ul[^>]*>/', '', $breadcrumb_output);
                                            $breadcrumb_output = preg_replace('/<\/ul>$/s', '', $breadcrumb_output);
                                            if (strpos($breadcrumb_output, 'fa-house') === false) {
                                                $home_li = '<li><a href="' . esc_url(home_url('/')) . '"><i class="fa-solid fa-house"></i> ' . esc_html__('Home', 'heartly') . '</a></li>';
                                                $breadcrumb_output = preg_replace('/^<li[^>]*>.*?<\/li>/s', $home_li, $breadcrumb_output, 1);
                                            } else {
                                                $breadcrumb_output = preg_replace(
                                                    '/(<li[^>]*><a[^>]*>)(?:<i class="fa-solid fa-house"><\/i> )?[^<]*(<\/a><\/li>)/',
                                                    '$1<i class="fa-solid fa-house"></i> ' . esc_html__('Home', 'heartly') . '$2',
                                                    $breadcrumb_output,
                                                    1
                                                );
                                            }
                                            $breadcrumb_output = preg_replace('/<\/li>\s*(?=<li[^>]*>)/', '</li><li class="separator">/</li>', $breadcrumb_output);
                                            echo wp_kses_post( $breadcrumb_output );
                                        } else {
                                            echo '<li><a href="' . esc_url(home_url('/')) . '"><i class="fa-solid fa-house"></i> ' . esc_html__('Home', 'heartly') . '</a></li><li class="separator">/</li><li>' . esc_html(get_the_title()) . '</li>';
                                        }
                                    } else {
                                        echo '<li><a href="' . esc_url(home_url('/')) . '"><i class="fa-solid fa-house"></i> ' . esc_html__('Home', 'heartly') . '</a></li><li class="separator">/</li><li>' . esc_html(get_the_title()) . '</li>';
                                    }
                                    ?>
                                </ul>
                            <?php } 
                        endif;
                    }
                ?>    
            </div>
        </div>
    </div>
<?php }

elseif (!empty($heartly_option['service_single_image']['url'])) {?>
<div style="background-image: url('<?php echo esc_url( $heartly_option['service_single_image']['url'] );?>')">
    <div class="<?php echo esc_attr($header_width);?>">
        <div class="page-heading">
            <?php 
                $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true);?>
                <?php if( $post_meta_title != 'hide' ){ ?>
                    <div class="breadcrumb-sub-title">
                        <h1 class="text-white split-title">
                            <?php if($content_banner !=''){
                               echo esc_html($content_banner);
                                } else {
                                   the_title();
                                }
                            ?>
                        </h1>
                    </div>
                <?php } 
                if(!empty($heartly_option['off_breadcrumb'])){
                    $rs_breadcrumbs = get_post_meta(get_the_ID(), 'select-bread', true);
                    if( $rs_breadcrumbs != 'hide' ):        
                        if(function_exists('bcn_display')){?>
                            <ul class="breadcrumb-items">
                                <?php
                                global $breadcrumb_navxt;
                                if($breadcrumb_navxt !== null) {
                                    $breadcrumb_navxt->breadcrumb_trail->fill();
                                    $breadcrumbs = $breadcrumb_navxt->breadcrumb_trail->breadcrumbs;
                                    $count = count($breadcrumbs);
                                    $i = 0;
                                    foreach($breadcrumbs as $breadcrumb) {
                                        $i++;
                                        if($breadcrumb instanceof bcn_breadcrumb) {
                                            $is_last = ($i == $count);
                                            ?>
                                            <li>
                                                <?php if(!$is_last && $breadcrumb->get_url()): ?>
                                                    <a href="<?php echo esc_url($breadcrumb->get_url()); ?>">
                                                        <?php if($i == 1): ?>
                                                            <i class="fa-solid fa-house"></i>
                                                        <?php endif; ?>
                                                        <?php echo esc_html($breadcrumb->get_title()); ?>
                                                    </a>
                                                <?php else: ?>
                                                    <?php echo esc_html($breadcrumb->get_title()); ?>
                                                <?php endif; ?>
                                            </li>
                                            <?php if(!$is_last): ?>
                                                <li>/</li>
                                            <?php endif; ?>
                                        <?php
                                        }
                                    }
                                } else {
                                    echo '<li><a href="' . esc_url(home_url('/')) . '"><i class="fa-solid fa-house"></i> ' . esc_html__('Home', 'heartly') . '</a></li>';
                                    echo '<li>/</li>';
                                    echo '<li>' . esc_html(get_the_title()) . '</li>';
                                }
                                ?>
                            </ul>
                        <?php } 
                    endif;
                }
            ?>
        </div>
    </div>
</div>
    
<?php }else{?>
    <div style="background-color: <?php echo esc_attr($heartly_option['breadcrumb_bg_color']);?>;">
        <div class="<?php echo esc_attr($header_width);?>">
            <div class="page-heading">
                <?php 
                    $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true);?>
                    <?php if( $post_meta_title != 'hide' ){ ?>
                        <div class="breadcrumb-sub-title">
                            <h1 class="text-white split-title">
                                <?php if($content_banner !=''){
                                   echo esc_html($content_banner);
                                    } else {
                                       the_title();
                                    }
                                ?>
                            </h1>
                        </div>
                    <?php } 
                     if(!empty($heartly_option['off_breadcrumb'])){
                        $rs_breadcrumbs = get_post_meta(get_the_ID(), 'select-bread', true);
                        if( $rs_breadcrumbs != 'hide' ):        
                            if(function_exists('bcn_display')){?>
                                <ul class="breadcrumb-items">
                                    <?php
                                    if(function_exists('bcn_display_list')){
                                        $breadcrumb_output = bcn_display_list(true, true, false, false);
                                        if(!empty($breadcrumb_output)) {
                                            $breadcrumb_output = preg_replace('/^<ul[^>]*>/', '', $breadcrumb_output);
                                            $breadcrumb_output = preg_replace('/<\/ul>$/s', '', $breadcrumb_output);
                                            if (strpos($breadcrumb_output, 'fa-house') === false) {
                                                $home_li = '<li><a href="' . esc_url(home_url('/')) . '"><i class="fa-solid fa-house"></i> ' . esc_html__('Home', 'heartly') . '</a></li>';
                                                $breadcrumb_output = preg_replace('/^<li[^>]*>.*?<\/li>/s', $home_li, $breadcrumb_output, 1);
                                            } else {
                                                $breadcrumb_output = preg_replace(
                                                    '/(<li[^>]*><a[^>]*>)(?:<i class="fa-solid fa-house"><\/i> )?[^<]*(<\/a><\/li>)/',
                                                    '$1<i class="fa-solid fa-house"></i> ' . esc_html__('Home', 'heartly') . '$2',
                                                    $breadcrumb_output,
                                                    1
                                                );
                                            }
                                            $breadcrumb_output = preg_replace('/<\/li>\s*(?=<li[^>]*>)/', '</li><li class="separator">/</li>', $breadcrumb_output);
                                            echo wp_kses_post( $breadcrumb_output );
                                        } else {
                                            echo '<li><a href="' . esc_url(home_url('/')) . '"><i class="fa-solid fa-house"></i> ' . esc_html__('Home', 'heartly') . '</a></li><li class="separator">/</li><li>' . esc_html(get_the_title()) . '</li>';
                                        }
                                    } else {
                                        echo '<li><a href="' . esc_url(home_url('/')) . '"><i class="fa-solid fa-house"></i> ' . esc_html__('Home', 'heartly') . '</a></li><li class="separator">/</li><li>' . esc_html(get_the_title()) . '</li>';
                                    }
                                    ?>
                                </ul>
                            <?php } 
                        endif;
                    }
                ?>             
            </div>
        </div>
    </div>
<?php } ?>
    <?php if(!empty($bottom_shape_image)): ?>
        <div class="bottom-shape d-none d-xl-block">
            <img src="<?php echo esc_url($bottom_shape_image); ?>" alt="<?php echo esc_attr__('bottom shape', 'heartly'); ?>">
        </div>
    <?php endif; ?>
</div>
