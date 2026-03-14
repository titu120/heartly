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
?>

<?php 
    $post_meta_data = '';
    if(!empty($heartly_option['page_banner_main']['url'])):
      $post_meta_data = $heartly_option['page_banner_main']['url'];
    endif;
 
if($post_meta_data !=''){   
?>
<div class="breadcrumb-wrapper bg-cover" style="background-image: url('<?php echo esc_url($post_meta_data); ?>');">
    <div class="<?php echo esc_attr($header_width);?>">
        <div class="page-heading">
            <div class="breadcrumb-sub-title">
                <h1 class="text-white split-title"><?php echo esc_html__("404 Page",'heartly');?></h1>
            </div>
        </div>
    </div>
    <?php if(!empty($bottom_shape_image)): ?>
        <div class="bottom-shape d-none d-xl-block">
            <img src="<?php echo esc_url($bottom_shape_image); ?>" alt="<?php echo esc_attr__('bottom shape', 'heartly'); ?>">
        </div>
    <?php endif; ?>
</div>
<?php }
else{
?>
<div class="breadcrumb-wrapper bg-cover" style="background-color: <?php echo esc_attr($heartly_option['breadcrumb_bg_color']);?>;">
    <div class="<?php echo esc_attr($header_width);?>">
        <div class="page-heading">
            <div class="breadcrumb-sub-title">
                <h1 class="text-white split-title"><?php echo esc_html__("404 Page",'heartly');?></h1>
            </div>
        </div>
    </div>
    <?php if(!empty($bottom_shape_image)): ?>
        <div class="bottom-shape d-none d-xl-block">
            <img src="<?php echo esc_url($bottom_shape_image); ?>" alt="<?php echo esc_attr__('bottom shape', 'heartly'); ?>">
        </div>
    <?php endif; ?>
</div>
<?php } ?>
