<?php
function heartly_scripts() {
	//register styles
	global $heartly_option;
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() .'/assets/css/bootstrap.min.css' );	
	wp_enqueue_style( 'swiper-bundle-css', get_template_directory_uri() .'/assets/css/swiper-bundle.min.css' );	
	wp_enqueue_style( 'tp-icons', get_template_directory_uri() .'/assets/css/tp-icons.css');	
    wp_enqueue_style( 'magnific-popup', get_template_directory_uri() .'/assets/css/magnific-popup.css');
	wp_enqueue_style( 'nice-select', get_template_directory_uri().'/assets/css/nice-select.css' );
	wp_enqueue_style( 'animate', get_template_directory_uri().'/assets/css/animate.css' );
	wp_enqueue_style( 'meanmenu', get_template_directory_uri().'/assets/css/meanmenu.css' );
	wp_enqueue_style( 'offcanvas-sideslide', get_template_directory_uri().'/assets/css/offcanvas_sideslide.css' );
	wp_enqueue_style( 'all-min', get_template_directory_uri().'/assets/css/all.min.css' );
	wp_enqueue_style( 'main-css', get_template_directory_uri().'/assets/css/main.css' );
	wp_enqueue_style( 'heartly-theme', get_template_directory_uri().'/assets/css/theme.css', array(), time() );
	wp_enqueue_style( 'heartly-responsive', get_template_directory_uri().'/assets/css/responsive.css', array(), time() );
	wp_enqueue_style( 'heartly-style', get_stylesheet_uri() ,array(), time());	

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), '5.2.0', true );
	wp_enqueue_script( 'swiper-js', get_template_directory_uri().'/assets/js/swiper-bundle.min.js', array('jquery'), '8.2.3', true);
	wp_enqueue_script( 'wow', get_template_directory_uri().'/assets/js/wow.min.js', array('jquery'), '1.1.2', true);
	wp_enqueue_script( 'jquery-waypoints', get_template_directory_uri() . '/assets/js/jquery.waypoints.js', array('jquery'), '2.0.3', true );
	wp_enqueue_script( 'jquery-counterup', get_template_directory_uri() . '/assets/js/jquery.counterup.min.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'jquery-magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array('jquery'), '1.1.0', true );	
	wp_enqueue_script( 'jquery-nice-select', get_template_directory_uri() . '/assets/js/jquery.nice-select.min.js', array('jquery'), '1.1.0', true );
	wp_enqueue_script( 'jquery-meanmenu', get_template_directory_uri() . '/assets/js/jquery.meanmenu.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'gsap', get_template_directory_uri() . '/assets/js/gsap.min.js', array(), '3.12.0', true );
	wp_enqueue_script( 'scroll-trigger', get_template_directory_uri() . '/assets/js/ScrollTrigger.min.js', array('gsap'), '3.12.0', true );
	wp_enqueue_script( 'scroll-smoother', get_template_directory_uri() . '/assets/js/ScrollSmoother.min.js', array('gsap'), '3.12.0', true );
	wp_enqueue_script( 'scroll-to-plugin', get_template_directory_uri() . '/assets/js/ScrollToPlugin.min.js', array('gsap'), '3.12.0', true );
	wp_enqueue_script( 'text-plugin', get_template_directory_uri() . '/assets/js/TextPlugin.js', array('gsap'), '3.12.0', true );
	wp_enqueue_script( 'split-text', get_template_directory_uri() . '/assets/js/SplitText.min.js', array('gsap'), '3.12.0', true );
	wp_enqueue_script( 'split-type', get_template_directory_uri() . '/assets/js/split-type.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'tween-max', get_template_directory_uri() . '/assets/js/tween-max.js', array(), '1.0.0', true );
	wp_enqueue_script( 'parallaxie', get_template_directory_uri() . '/assets/js/parallaxie.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'viewport-jquery', get_template_directory_uri() . '/assets/js/viewport.jquery.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'chroma', get_template_directory_uri() . '/assets/js/chroma.min.js', array(), '2.4.0', true );
	wp_enqueue_script( 'three', get_template_directory_uri() . '/assets/js/three.js', array(), '1.0.0', true );
	wp_enqueue_script( 'webgl', get_template_directory_uri() . '/assets/js/webgl.js', array('three'), '1.0.0', true );
	wp_enqueue_script('heartly-theme', get_template_directory_uri() . '/assets/js/theme.js', array('jquery'), wp_get_theme()->get( 'Version' ), true);	
	wp_enqueue_script('heartly-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), wp_get_theme()->get( 'Version' ), true);	
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'heartly_scripts' );  

add_action( 'admin_enqueue_scripts', 'heartly_load_admin_styles' );
function heartly_load_admin_styles($screen) {
	wp_enqueue_style( 'heartly-admin-style', get_template_directory_uri() . '/assets/css/admin-style.css', array(), '1.0.0' );
	wp_enqueue_script( 'heartly-admin-script', get_template_directory_uri() . '/assets/js/admin-script.js', array('jquery'), '1.0.0', true );
} 


// Elementor Editor styles - Load admin CSS and add inline CSS for widget icons
add_action('elementor/editor/after_enqueue_styles', 'heartly_elementor_editor_styles');

function heartly_elementor_editor_styles()
{
	// Load admin-style.css in Elementor editor
	wp_enqueue_style('heartly-elementor-editor', get_template_directory_uri() . '/assets/css/admin-style.css', array(), time());
	wp_enqueue_style('heartly-elementor-tp-icons', get_template_directory_uri() . '/assets/css/tp-icons.css', array(), time());
	
	// Add inline CSS for widget icon with full URL path
	$custom_css = "
		.elementor-panel .elementor-element .icon i.tp-icon::after {
			width: 30px !important;
			height: 30px !important;
			content: '' !important;
			display: inline-block !important;
			border-radius: 5px !important;
			background: url('" . get_template_directory_uri() . "/assets/images/brand-icon.png') no-repeat center center/cover !important;
		}
	";
	wp_add_inline_style('heartly-elementor-editor', $custom_css);
} 