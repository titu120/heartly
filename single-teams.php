<?php
    get_header();
    global $heartly_option;
	//take metafield value            

    $designation     = get_post_meta( get_the_ID(), 'designation', true );               
    $experience      = get_post_meta( get_the_ID(), 'experience', true );               
    $location        = get_post_meta( get_the_ID(), 'location', true );               
    $phone           = get_post_meta( get_the_ID(), 'phone', true );
    $phone_no_space  = str_replace(' ', '', $phone);
    $email           = get_post_meta( get_the_ID(), 'email', true );               
    $facebook        = get_post_meta( get_the_ID(), 'facebook', true );
    $twitter         = get_post_meta( get_the_ID(), 'twitter', true );
    $google_plus     = get_post_meta( get_the_ID(), 'google_plus', true );
    $linkedin        = get_post_meta( get_the_ID(), 'linkedin', true );
    $team_desination = get_post_meta( get_the_ID(), 'designation', true );  
    $short_desc      = get_post_meta( get_the_ID(), 'shortbio', true );
    $getin           = get_post_meta( get_the_ID(), 'getin', true );
    $getinurl        = get_post_meta( get_the_ID(), 'getinurl', true );

    // Get the group field values
    $group_field_values = get_post_meta( get_the_ID(), 'member_skill', true );
    $member_skill_subtitle  = get_post_meta( get_the_ID(), 'member_skill_subtitle', true ); 
    $member_skill_title  = get_post_meta( get_the_ID(), 'member_skill_title', true ); 
    $member_skill_description  = get_post_meta( get_the_ID(), 'member_skill_description', true ); 
    
    ?>

<div class="container">
    <?php while ( have_posts() ) : the_post(); ?>

    <div class="row justify-content-between align-items-center pb-95">
        <div class="col-xxl-5 col-lg-6">
            <div class="zq_team_details-img mb-40 mb-lg-0">
                <?php the_post_thumbnail(); ?>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="zq_team_details-content">
                <span class="zq_team_details-content-subtitle"><?php echo esc_html__('About me', 'heartly'); ?></span>
                <h2 class="zq_team_details-content-title"><?php the_title(); ?></h2>
                <p class="zq_team_details-content-text"><?php echo esc_html($short_desc); ?></p>

                <div class="zq_team_details-contact">

                    <?php if($designation) : ?>
                    <div class="zq_team_details-contact-item">
                        <span><?php echo esc_html__( 'Designation', 'heartly' ); ?></span>
                        <p><?php echo esc_html( $designation ); ?></p>
                    </div>
                    <?php endif; ?>

                    <?php if($experience) : ?>
                    <div class="zq_team_details-contact-item">
                        <span><?php echo esc_html__( 'Experience', 'heartly' ); ?></span>
                        <p><?php echo esc_html( $experience ); ?></p>
                    </div>
                    <?php endif; ?>

                    <?php if($email) : ?>
                    <div class="zq_team_details-contact-item">
                        <span><?php echo esc_html__( 'Email:', 'heartly' ); ?></span>
                        <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                    </div>
                    <?php endif; ?>
                    <?php if($phone) : ?>
                    <div class="zq_team_details-contact-item">
                        <span><?php echo esc_html__( 'Phone:', 'heartly' ); ?></span>
                        <a href="tel:<?php echo esc_attr($phone_no_space); ?>"><?php echo esc_html($phone); ?></a>
                    </div>
                    <?php endif; ?>
                    <?php if($location) : ?>
                    <div class="zq_team_details-contact-item">
                        <span><?php echo esc_html__( 'Location:', 'heartly' ); ?></span>
                        <a href="#"><?php echo esc_html( $location );?></a>
                    </div>
                    <?php endif; ?>

                </div>
                <?php if(!empty($getin)): ?>
                    <a href="<?php echo esc_url( $getinurl );?>" class="zq_theme-btn theme_btn"><?php echo esc_html($getin);?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row justify-content-between">
        <div class="col-xxl-4 col-xl-5 col-lg-6">
            <div class="zq_section-area">
                <span class="zq_section-subtitle mb-20">Contact Me</span>
                <h2 class="zq_section-title mb-20">Let's Win Together</h2>
                <p class="zq_section-text mb-30">Lorem ipsum dolor sit amet consectetur adipiscing elit Ut et massa  Aliquam in hendrerit urna.</p>
            </div>
        </div>

        <?php if( !empty( $group_field_values ) ) : ?>
        <div class="col-lg-6">
            <div class="zq_skill-content">

                <?php foreach ( $group_field_values as $group_item ) : 
                    $info_title = $group_item['skill_title'];
                    $info_value = $group_item['skill_level'];
                ?>
                <div class="zq_skill-content-progress">
                    <div class="progress-title">
                        <p><?php echo esc_html( $info_title ); ?></p>
                        <span><?php echo esc_html( $info_value ); ?></span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar w-<?php echo esc_attr( $info_value ); ?> wow fadeInLeft" role="progressbar" aria-label="Basic example" aria-valuenow="<?php echo esc_attr( $info_value ); ?>" aria-valuemin="0" aria-valuemax="100" data-wow-duration="2s" data-wow-delay=".1s"></div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>
        <?php endif; ?>

    </div>

    <?php endwhile; ?>

    <?php the_content();?>
<!-- Single Team End -->
</div>
<?php
get_footer();