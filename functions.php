<?php

if ( ! function_exists( 'heartly_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */ 



function heartly_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on heartly, use a find and replace
	 * to change 'heartly' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'heartly', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );	
	add_theme_support( 'woocommerce' );	

	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	

	add_action( 'init', function() {
		load_textdomain( 'breadcrumb-navxt', get_template_directory() . '/languages/breadcrumb-navxt.mo' );
	});
	

	function heartly_change_excerpt( $text )
	{
		$pos = strrpos( $text, '[');
		if ($pos === false)
		{
			return $text;
		}
		
		return rtrim (substr($text, 0, $pos) ) . '...';
	}
	add_filter('get_the_excerpt', 'heartly_change_excerpt');


	// Limit Excerpt Length by number of Words
	function heartly_custom_excerpt( $limit ) {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
		} else {
		$excerpt = implode(" ",$excerpt);
		}
		$excerpt = preg_replace('`[[^]]*]`','',$excerpt);
		return $excerpt;
		}
		function content($limit) {
		$content = explode(' ', get_the_content(), $limit);
		if (count($content)>=$limit) {
		array_pop($content);
		$content = implode(" ",$content).'...';
		} else {
		$content = implode(" ",$content);
		}
		$content = preg_replace('/[.+]/','', $content);
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		return $content;
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary Menu', 'heartly' ),		
		'menu-2' => esc_html__( 'Single Menu', 'heartly' ),
		
	) );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'heartly_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	//add support posts format
	add_theme_support( 'post-formats', array( 
		'aside', 
		'gallery',
		'audio',
		'video',
		'image',
		'quote',
		'link',
	) );

	add_theme_support( 'align-wide' );	

	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );

}
endif;
add_action( 'after_setup_theme', 'heartly_setup' );

function my_theme_register_block_patterns() {
    register_block_pattern( 'my-theme/my-pattern', array(
        'title'       => __( 'My Pattern', 'heartly' ),
        'description' => _x( 'A custom pattern for my theme.', 'Block pattern description', 'heartly' ),
        'content'     => "<!-- wp:paragraph --><p>" . __( 'Hello world!', 'heartly' ) . "</p><!-- /wp:paragraph -->",
    ));
}
add_action( 'init', 'my_theme_register_block_patterns' );

function my_theme_register_block_styles() {
    register_block_style( 'core/quote', array(
        'name'  => 'fancy-quote',
        'label' => __( 'Fancy Quote', 'heartly' ),
    ));
}
add_action( 'init', 'my_theme_register_block_styles' );

/**
*Custom Image Size
*/
add_image_size( 'heartly-team-slider', 358, 415, true );
add_image_size( 'heartly-portfolio-slider', 648, 500, true );
add_image_size( 'heartly-portfolio-slider-2', 800, 510, true );
add_image_size( 'heartly-blog-slider', 420, 365, true );
add_image_size( 'heartly-portfolio-grid', 600, 700, true );
add_image_size( 'heartly-blog-sideabr', 87, 87, true );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function heartly_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'heartly_content_width', 640 );
}
add_action( 'after_setup_theme', 'heartly_content_width', 0 );


/**
 * Implement the Custom Header feature.
 */
require_once get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 *  Enqueue scripts and styles.
 */
require_once get_template_directory() . '/inc/theme-scripts.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/theme-functions.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/theme-sidebar.php';

/**
 * Customizer additions.
 */
require_once get_template_directory() . '/inc/customizer.php';

/**
 * Custom Style
 */
require_once get_template_directory() . '/inc/dyanamic-css.php';
require_once get_template_directory() . '/libs/theme-option/config.php';
require_once get_template_directory() . '/inc/tgm/tgm-config.php';


//----------------------------------------------------------------------
// Remove Redux Framework NewsFlash
//----------------------------------------------------------------------
if ( ! class_exists( 'reduxNewsflash' ) ):
    class reduxNewsflash {
        public function __construct( $parent, $params ) {}
    }
endif;

function heartly_remove_demo_mode_link() { // Be sure to rename this function to something more unique
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
    }
}
add_action('init', 'heartly_remove_demo_mode_link');

/**
 * Registers an editor stylesheet for the theme.
 */
function heartly_theme_add_editor_styles() {
    add_editor_style( 'css/custom-editor-style.css' );
}
add_action( 'admin_init', 'heartly_theme_add_editor_styles' );


//------------------------------------------------------------------------
//Organize Comments form field
//-----------------------------------------------------------------------
function heartly_wpb_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}

add_filter( 'comment_form_fields', 'heartly_wpb_move_comment_field_to_bottom' );	


//adding placeholder text for comment form

function heartly_comment_textarea_placeholder( $args ) {
	$args['comment_field']        = str_replace( '<textarea', '<textarea placeholder="Comment"', $args['comment_field'] );
	return $args;
}
add_filter( 'comment_form_defaults', 'heartly_comment_textarea_placeholder' );

/**
 * Comment Form Fields Placeholder
 *
 */
function heartly_comment_form_fields( $fields ) {
	foreach( $fields as &$field ) {
		$field = str_replace( 'id="author"', 'id="author" placeholder="Name*"', $field );
		$field = str_replace( 'id="email"', 'id="email" placeholder="Email*"', $field );
		$field = str_replace( 'id="url"', 'id="url" placeholder="Website"', $field );
	}
	return $fields;
}
add_filter( 'comment_form_default_fields', 'heartly_comment_form_fields' );


//customize archive tilte
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            $title = '<span class="vcard">' . get_the_author() . '</span>' ;
        }
    return $title;
});

add_filter( 'get_the_archive_title', 'heartly_archive_title_remove_prefix' );
function heartly_archive_title_remove_prefix( $title ) {
	if ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	}
	return $title;
}

function heartly_menu_add_description_to_menu($item_output, $item, $depth, $args) {

   if (strlen($item->description) > 0 ) {
      // append description after link
      $item_output .= sprintf('<span class="description">%s</span>', esc_html($item->description));   
     
   }   
   return $item_output;
}
add_filter('walker_nav_menu_start_el', 'heartly_menu_add_description_to_menu', 10, 4);

add_filter('wp_list_categories', 'heartly_cat_count_span');
function heartly_cat_count_span($links) {
  $links = str_replace('</a> (', '</a> <span>(', $links);
  $links = str_replace(')', ')</span>', $links);
  return $links;
}

function heartly_style_the_archive_count($links) {
    $links = str_replace('</a>&nbsp;(', '</a> <span class="archiveCount">(', $links);
    $links = str_replace(')', ')</span>', $links);
    return $links;
}

add_filter('get_archives_link', 'heartly_style_the_archive_count');

/**
 * Post title array
 */
function heartly_get_postTitleArray($postType = 'post' ){
    $post_type_query  = new WP_Query(
        array (
            'post_type'      => $postType,
            'posts_per_page' => -1,
            'orderby' => 'title',
    		'order'   => 'ASC',
        )
    );
    // we need the array of posts
    $posts_array      = $post_type_query->posts;
    // the key equals the ID, the value is the post_title
    if ( is_array($posts_array) ) {
        $post_title_array = wp_list_pluck($posts_array, 'post_title', 'ID' );
    } else {
        $post_title_array['default'] = esc_html__( 'Default', 'heartly' );
    }
    return $post_title_array;
}


/**
 * Remove WooCommerce breadcrumbs 
 */
add_action( 'init', 'my_remove_breadcrumbs' );
function my_remove_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}
/**
 * Remove WooCommerce Actions 
 */
add_action( 'init', 'woo_remove_actions' );
function woo_remove_actions() {
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
}




// dynamic color support starting
function upsoft_site_custom_color()
{
	global $heartly_option;
	$site_color       = !empty($heartly_option['primary_color']) ? $heartly_option['primary_color'] : '#3368C6';
	$secondary_color  = !empty($heartly_option['secondary_color']) ? $heartly_option['secondary_color'] : '#0F604D';
	$input_bg_color  = !empty($heartly_option['input_bg_color']) ? $heartly_option['input_bg_color'] : '#E6F7F1';
	$hover_color  = !empty($heartly_option['link_hover_text_color']) ? $heartly_option['link_hover_text_color'] : '#EF6820';
    // Primary Color
    $custom_css = '';
    if ($site_color != '') {
        $custom_css .= ":root{
            --primaryColor: $site_color !important;
        }";
    }
	// Secondary Color
	if ($secondary_color != '') {
        $custom_css .= ":root{
            --secondaryColor: $secondary_color !important;
        }";
    }
	// Button Color
	if ($input_bg_color != '') {
        $custom_css .= ":root{
            --inputbgColor: $input_bg_color !important;
        }";
    }
	// Button Hover Color
	if ($hover_color != '') {
        $custom_css .= ":root{
            --hoverColor: $hover_color !important;
        }";
    }
   
    // Enqueue and add inline styles for Primary Color
    wp_register_style('site-custom', false);
    wp_enqueue_style('site-custom', false);
    wp_add_inline_style('site-custom', $custom_css, true);

}
add_action('wp_enqueue_scripts', 'upsoft_site_custom_color');
// dynamic color support ending

function upsoft_site_test()
{ 

	return 'Vat de haramzada mujib';
	die();
}


