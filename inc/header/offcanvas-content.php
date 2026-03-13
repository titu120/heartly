<?php 

global $heartly_option;
if(!empty($heartly_option['facebook']) || !empty($heartly_option['twitter']) || !empty($heartly_option['rss']) || !empty($heartly_option['pinterest']) || !empty($heartly_option['google']) || !empty($heartly_option['instagram']) || !empty($heartly_option['vimeo']) || !empty($heartly_option['tumblr']) ||  !empty($heartly_option['youtube'])){
?>

    <ul class="offcanvas_social">  
        <?php
        if(!empty($heartly_option['facebook'])) { ?>
        <li> 
        <a href="<?php echo esc_url($heartly_option['facebook'])?>" target="_blank"><span><i class="fa fa-facebook"></i></span></a> 
        </li>
        <?php } ?>
        <?php if(!empty($heartly_option['twitter'])) { ?>
        <li> 
        <a href="<?php echo esc_url($heartly_option['twitter']);?> " target="_blank"><span><i class="fa fa-twitter"></i></span></a> 
        </li>
        <?php } ?>
        <?php if(!empty($heartly_option['rss'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($heartly_option['rss']);?> " target="_blank"><span><i class="fa fa-rss"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($heartly_option['pinterest'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($heartly_option['pinterest']);?> " target="_blank"><span><i class="fa fa-pinterest-p"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($heartly_option['linkedin'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($heartly_option['linkedin']);?> " target="_blank"><span><i class="fa fa-linkedin"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($heartly_option['google'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($heartly_option['google']);?> " target="_blank"><span><i class="fa fa-google-plus-square"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($heartly_option['instagram'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($heartly_option['instagram']);?> " target="_blank"><span><i class="fa fa-instagram"></i></span></a> 
        </li>
        <?php } ?>
        <?php if(!empty($heartly_option['vimeo'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($heartly_option['vimeo'])?> " target="_blank"><span><i class="fa fa-vimeo"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($heartly_option['tumblr'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($heartly_option['tumblr'])?> " target="_blank"><span><i class="fa fa-tumblr"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($heartly_option['youtube'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($heartly_option['youtube'])?> " target="_blank"><span><i class="fa fa-youtube"></i></span></a> 
        </li>
        <?php } ?>     
    </ul>
<?php }

