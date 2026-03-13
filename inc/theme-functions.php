<?php
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function heartly_body_classes( $classes ) {
  // Adds a class of hfeed to non-singular pages.
  if ( ! is_singular() ) {
    $classes[] = 'hfeed';
  }

  return $classes;
}
add_filter( 'body_class', 'heartly_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function heartly_pingback_header() {
  if ( is_singular() && pings_open() ) {
    echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
  }
}

add_action( 'wp_head', 'heartly_pingback_header' );
/**  kses_allowed_html */
function heartly_prefix_kses_allowed_html($tags, $context) {
  switch($context) {
    case 'heartly': 
      $tags = array( 
        'a' => array('href' => array()),
        'b' => array()
      );
      return $tags;
    default: 
      return $tags;
  }
}
add_filter( 'wp_kses_allowed_html', 'heartly_prefix_kses_allowed_html', 10, 2);

/*
Register Fonts theme google font
*/
function heartly_studio_fonts_url() {
    $font_url = '';
    
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'heartly' ) ) {
        $font_url = 'https://fonts.googleapis.com/css2?' . urlencode('family=Outfit:wght@100;200;300;400;500;600;700;800;900&display=swap');
    }
    return $font_url;
}

function heartly_studio_scripts() {
    wp_enqueue_style( 'heartly-fonts', heartly_studio_fonts_url(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'heartly_studio_scripts' );
//excerpt for specific section
function heartly_wpex_get_excerpt( $args = array() ) {
  // Defaults
  $defaults = array(
    'post'            => '',
    'length'          => 48,
    'readmore'        => false,
    'readmore_text'   => esc_html__( 'Read More', 'heartly' ),
    'readmore_after'  => '',
    'custom_excerpts' => true,
    'disable_more'    => false,
  );
  // Apply filters
  $defaults = apply_filters( 'heartly_wpex_get_excerpt_defaults', $defaults );
  // Parse args
  $args = wp_parse_args( $args, $defaults );
  // Apply filters to args
  $args = apply_filters( 'heartly_wpex_get_excerpt_args', $defaults );
  // Extract
  extract( $args );
  // Get global post data
  if ( ! $post ) {
    global $post;
  }

  $post_id = $post->ID;
  if ( $custom_excerpts && has_excerpt( $post_id ) ) {
    $output = $post->post_excerpt;
  } 
  else { 
    $readmore_link = '<a href="' . get_permalink( $post_id ) . '" class="readmore">' . $readmore_text . $readmore_after . '</a>';    
    if ( ! $disable_more && strpos( $post->post_content, '<!--more-->' ) ) {
      $output = apply_filters( 'the_content', get_the_content( $readmore_text . $readmore_after ) );
    }    
    else {     
      $output = wp_trim_words( strip_shortcodes( $post->post_content ), $length );      
      if ( $readmore ) {
        $output .= apply_filters( 'heartly_wpex_readmore_link', $readmore_link );
      }
    }
  }
  // Apply filters and echo
  return apply_filters( 'heartly_wpex_get_excerpt', $output );
}

//Demo content file include here
function heartly_import_files() {
  return array(
    array(
      'import_file_name'           => 'heartly Default Demo',
      'categories'                 => array( 'Main Demo' ),
      'import_file_url'            => 'https://pixelaxis.net/accupay/wp-content/themes/heartly/sample-data/contents-demo.xml', 
             
      'import_redux'               => array(
        array(
          'file_url'               => 'https://pixelaxis.net/accupay/wp-content/themes/heartly/sample-data/widget-settings.json',
          'option_name'            => 'heartly_option',
        ),
      ),

      'import_preview_image_url'   => 'https://pixelaxis.net/accupay/wp-content/themes/heartly/sample-data/img/demo.png',
     'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'heartly' ),
      'preview_url'                => 'https://pixelaxis.net/accupay/',     
      
    ),

  );
}

add_filter( 'pt-ocdi/import_files', 'heartly_import_files' );

function heartly_after_import_setup($selected_import) {
  // Assign menus to their locations.
	$main_menu     = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
  $menu_single     = get_term_by( 'name', 'Onepage Menu', 'nav_menu' );
	set_theme_mod( 'nav_menu_locations', array(
      'menu-1' => $main_menu->term_id, 
      'menu-2' => $menu_single->term_id,      
    )
  );
  if ( 'heartly Default Demo' == $selected_import['import_file_name'] ) {

    $front_page_id = get_page_by_title('Main Home');

  }




  $blog_page_id  = get_page_by_title( 'News & Media' );
  update_option( 'show_on_front', 'page' );
  update_option( 'page_on_front', $front_page_id->ID );
  update_option( 'page_for_posts', $blog_page_id->ID ); 




  // Elementor settings fix — enable all CPTs
  $cpts = get_post_types(array('public' => true), 'names');
  update_option('elementor_cpt_support', array_values($cpts));
  update_option('elementor_disable_color_schemes', 'yes');
  update_option('elementor_disable_typography_schemes', 'yes');

  
}
add_action( 'pt-ocdi/after_import', 'heartly_after_import_setup' );

add_filter( 'use_widgets_block_editor', '__return_false' );
