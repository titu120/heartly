<?php
  global $heartly_option;
  $header_trans = '';
    if(!empty($heartly_option['header_layout'])){               
        $header_style = $heartly_option['header_layout'];               
        if($header_style == 'style2'){       
            $header_trans = 'heads_trans';    
        }
    }
    
    // Get bottom shape image
    $bottom_shape_image = !empty($heartly_option['breadcrumb_bottom_shape']['url']) ? $heartly_option['breadcrumb_bottom_shape']['url'] : '';
    
    // Get header width
    $header_width = 'container';
?>
<?php 
  $post_meta_data = get_post_meta(get_the_ID(), 'banner_image', true);
  $post_meta_data2 = '';
    //theme option checking
  if($post_meta_data == ''){
    if(!empty($heartly_option['page_banner_main']['url'])):
      $post_meta_data = $heartly_option['page_banner_main']['url'];
    
    else: {
      // Show breadcrumb section even if bg_color is not set (use empty or transparent)
      $post_meta_data2 = !empty($heartly_option['breadcrumb_bg_color'])? $heartly_option['breadcrumb_bg_color'] : 'transparent';
    }
    endif;
  }  

  $banner_hide = get_post_meta(get_the_ID(), 'banner_hide', true);
  if( 'show' == $banner_hide ||  $banner_hide == '' ){  
    $post_meta_data = $post_meta_data;
    $post_meta_data2 = $post_meta_data2;
  }else{
    $post_meta_data = '';
    $post_meta_data2 = '';
  }
  $post_menu_type = get_post_meta(get_the_ID(), 'menu-type', true);
  $content_banner = get_post_meta(get_the_ID(), 'content_banner', true); 
  $intro_content_banner = get_post_meta(get_the_ID(), 'intro_content_banner', true); 
?>

<div class="breadcrumb-wrapper bg-cover <?php echo esc_attr($header_trans);?>" <?php if(!empty($post_meta_data)): ?>style="background-image: url('<?php echo esc_url($post_meta_data); ?>');"<?php elseif(!empty($post_meta_data2)): ?>style="background-color: <?php echo esc_attr($post_meta_data2);?>;"<?php endif; ?>>
    <?php  
    if(is_post_type_archive('events')){
        $archive_banner = !empty($heartly_option['event_banner_main']['url']) ? $heartly_option['event_banner_main']['url'] : '';
    }
    else{
        $archive_banner = !empty($heartly_option['blog_banner_main']['url']) ? $heartly_option['blog_banner_main']['url'] : '';
    }

    if(!empty($heartly_option['show_banner__course'])):
      $archive_banner = $heartly_option['show_banner__course'];
    endif;

   if(!empty($archive_banner)) { ?>
    <div class="<?php echo esc_attr($header_width);?>">
        <div class="page-heading">
            <?php if (empty($heartly_option['show_banner__course'])) {
                if(!empty($heartly_option['event_info']) && is_post_type_archive('events')){
                    echo '<div class="breadcrumb-sub-title"><h1 class="text-white split-title">'.esc_html($heartly_option['event_info']).'</h1></div>';
                    if( !empty($heartly_option['off_breadcrumb_event'])){
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
                                        echo $breadcrumb_output;
                                    }
                                }
                                ?>
                            </ul>
                        <?php } 
                    }                 
                }
                elseif(!empty($heartly_option['notice_info']) && is_post_type_archive('notices')){
                    echo '<div class="breadcrumb-sub-title"><h1 class="text-white split-title">'.esc_html($heartly_option['notice_info']).'</h1></div>';  
                    if(!empty($heartly_option['off_breadcrumb_notice'])){
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
                                        echo $breadcrumb_output;
                                    }
                                }
                                ?>
                            </ul>
                        <?php } 
                    }                 
                } else {
                    $archive_title = get_the_archive_title();
                    echo '<div class="breadcrumb-sub-title"><h1 class="text-white split-title">' . $archive_title . '</h1></div>';
                } 
            }          
            ?>   
            <?php if(!empty($heartly_option['off_breadcrumb'])){
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
                                                    <i class="fa-solid fa-house"></i> <?php echo esc_html__('Home', 'heartly'); ?>
                                                <?php else: ?>
                                                    <?php echo esc_html($breadcrumb->get_title()); ?>
                                                <?php endif; ?>
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
                        }
                        ?>
                    </ul>
                <?php } 
            }   ?>
        </div>
    </div>
  <?php }
  else{   
  ?>
    <div class="<?php echo esc_attr($header_width);?>">
        <div class="page-heading">
            <?php if (empty($heartly_option['show_banner__course'])) {
                if(!empty($heartly_option['event_info']) && is_post_type_archive('events')){
                    echo '<div class="breadcrumb-sub-title"><h1 class="text-white split-title">'.esc_html($heartly_option['event_info']).'</h1></div>';
                    if( !empty($heartly_option['off_breadcrumb_event'])){
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
                                        echo $breadcrumb_output;
                                    }
                                }
                                ?>
                            </ul>
                        <?php } 
                    }                 
                }
                elseif(!empty($heartly_option['notice_info']) && is_post_type_archive('notices')){
                    echo '<div class="breadcrumb-sub-title"><h1 class="text-white split-title">'.esc_html($heartly_option['notice_info']).'</h1></div>';  
                    if(!empty($heartly_option['off_breadcrumb_notice'])){
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
                                        echo $breadcrumb_output;
                                    }
                                }
                                ?>
                            </ul>
                        <?php } 
                    }                 
                } else {
                    $archive_title = get_the_archive_title();
                    echo '<div class="breadcrumb-sub-title"><h1 class="text-white split-title">' . $archive_title . '</h1></div>';
                } 
            }          
            ?>   
            <?php if(!empty($heartly_option['off_breadcrumb'])){
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
                                                    <i class="fa-solid fa-house"></i> <?php echo esc_html__('Home', 'heartly'); ?>
                                                <?php else: ?>
                                                    <?php echo esc_html($breadcrumb->get_title()); ?>
                                                <?php endif; ?>
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
                        }
                        ?>
                    </ul>
                <?php } 
            }   ?>
        </div>
    </div>
  <?php
  }
?>  
    <?php if(!empty($bottom_shape_image)): ?>
        <div class="bottom-shape d-none d-xl-block">
            <img src="<?php echo esc_url($bottom_shape_image); ?>" alt="<?php echo esc_attr__('bottom shape', 'heartly'); ?>">
        </div>
    <?php endif; ?>
</div>
