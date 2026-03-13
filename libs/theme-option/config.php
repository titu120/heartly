<?php

/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if (!class_exists('Redux')) {
    return;
}

// This is your option name where all the Redux data is stored.
$opt_name = "heartly_option";

// This line is only for altering the demo. Can be easily removed.
$opt_name = apply_filters('heartly/opt_name', $opt_name);

/*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'             => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'         => $theme->get('Name'),
    // Name that appears at the top of your panel
    'display_version'      => $theme->get('Version'),
    // Version that appears at the top of your panel
    'menu_type'            => 'menu',
    'page_priority'        => 8,
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'       => true,
    // Show the sections below the admin menu item or not
    'menu_title'           => esc_html__('heartly Options', 'heartly'),
    'page_title'           => esc_html__('heartly Options', 'heartly'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key'       => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => true,
    // Use a asynchronous font on the front end or font string
    // Disable this in case you want to create your own google fonts loader
    'admin_bar'            => false,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-portfolio',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => 20,
    // Choose an priority for the admin bar menu
    'global_variable'      => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => false,
    'forced_dev_mode_off' => true,
    // Show the time the page took to load, etc
    'update_notice'        => true,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => true,
    'compiler' => true,

    // OPTIONAL -> Give you extra features
    'page_priority'        => 20,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => '',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => '',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    'force_output' => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn'              => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    // HINTS
    'hints'                => array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => array(
            'color'   => 'red',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ),
        'tip_position'  => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect'    => array(
            'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ),
            'hide' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ),
        ),
    )
);

// Panel Intro text -> before the form
if (!isset($args['global_variable']) || $args['global_variable'] !== false) {
    if (!empty($args['global_variable'])) {
        $v = $args['global_variable'];
    } else {
        $v = str_replace('-', '_', $args['opt_name']);
    }
    $args['intro_text'] = sprintf(esc_html__('heartly Theme', 'heartly'), $v);
} else {
    $args['intro_text'] = esc_html__('heartly Theme', 'heartly');
}

Redux::setArgs($opt_name, $args);

/*
     * ---> END ARGUMENTSheartly
      
     */
// -> START General Settings
Redux::setSection(
    $opt_name,
    array(
        'title'            => esc_html__('General Settings', 'heartly'),
        'id'               => 'basic-checkbox',
        'customizer_width' => '450px',
        'fields'           => array(

            array(
                'id'       => 'enable_global',
                'type'     => 'switch',
                'title'    => esc_html__('Enable Global Settings', 'heartly'),
                'subtitle' => esc_html__('If you enable global settings all option will be work only theme option', 'heartly'),
                'default'  => false,
            ),

            array(
                'id'       => 'container_size',
                'title'    => esc_html__('Container Size', 'heartly'),
                'subtitle' => esc_html__('Container Size example(1350px)', 'heartly'),
                'type'     => 'text',
                'default'  => '1320px'
            ),

            array(
                'id'       => 'tp_favicon',
                'type'     => 'media',
                'title'    => esc_html__('Upload Favicon', 'heartly'),
                'subtitle' => esc_html__('Upload your faviocn here', 'heartly'),
                'url' => true
            ),

            array(
                'id'       => 'off_sticky',
                'type'     => 'switch',
                'title'    => esc_html__('Enable Sticky Menu', 'heartly'),
                'subtitle' => esc_html__('You can show or hide sticky menu here', 'heartly'),
                'default'  => false,
            ),  
            array(
                'id'       => 'show_top_bottom',
                'type'     => 'switch', 
                'title'    => esc_html__('Scroll to Top', 'heartly'),
                'subtitle' => esc_html__('You can show or hide here', 'heartly'),
                'default'  => false,
            ),         
        )
    )
);


//Preloader settings
Redux::setSection(
    $opt_name,
    array(
        'title'  => esc_html__('Preloader Style', 'heartly'),
        'desc'   => esc_html__('Preloader Style Here', 'heartly'),
        'fields' => array(
            array(
                'id'       => 'show_preloader',
                'type'     => 'switch',
                'title'    => esc_html__('Show Preloader', 'heartly'),
                'subtitle' => esc_html__('You can show or hide preloader', 'heartly'),
                'default'  => false,
            ),

            array(
                'id'        => 'preloader_bg_color',
                'type'      => 'color',
                'title'     => esc_html__('Preloader Background Color', 'heartly'),
                'subtitle'  => esc_html__('Pick color', 'heartly'),
                'validate'  => 'color',
            ),
           

            array(
                'id'        => 'preloader_animate_color2',
                'type'      => 'color',
                'title'     => esc_html__('Preloader Circle Color', 'heartly'),
                'subtitle'  => esc_html__('Pick color', 'heartly'),
                'validate'  => 'color',
                'output'    => array('background' => '.lds-ellipsis div')
            ),

          
            array(
                'id'    => 'preloader_img',
                'url'   => true,
                'title' => esc_html__('Preloader Image', 'heartly'),
                'type'  => 'media',
            ),
        )
    )
);
//End Preloader settings 

// -> START Style Section
Redux::setSection($opt_name, array(
    'title'            => esc_html__('Style', 'heartly'),
    'id'               => 'stle',
    'customizer_width' => '450px',
    'icon' => 'el el-brush',
));

Redux::setSection(
    $opt_name,
    array(
        'title'  => esc_html__('Global Style', 'heartly'),
        'desc'   => esc_html__('Style your theme', 'heartly'),
        'subsection' => true,
        'fields' => array(

            array(
                'id'        => 'body_bg_color',
                'type'      => 'color',
                'title'     => esc_html__('Body Backgroud Color', 'heartly'),
                'subtitle'  => esc_html__('Pick body background color', 'heartly'),
                'validate'  => 'color',
            ),

            array(
                'id'        => 'body_text_color',
                'type'      => 'color',
                'title'     => esc_html__('Text Color', 'heartly'),
                'subtitle'  => esc_html__('Pick text color', 'heartly'),
                'validate'  => 'color',
            ),

            array(
                'id'        => 'primary_color',
                'type'      => 'color',
                'title'     => esc_html__('Primary Color', 'heartly'),
                'subtitle'  => esc_html__('Select Primary Color.', 'heartly'),
                'validate'  => 'color',
            ),

            array(
                'id'        => 'secondary_color',
                'type'      => 'color',
                'title'     => esc_html__('Secondary Color', 'heartly'),
                'subtitle'  => esc_html__('Select Secondary Color.', 'heartly'),
                'validate'  => 'color',
            ),

            array(
                'id'        => 'input_bg_color',
                'type'      => 'color',
                'title'     => esc_html__('Input Background Color', 'heartly'),
                'subtitle'  => esc_html__('Pick Input Background color', 'heartly'),
                'validate'  => 'color',
            ),

            array(
                'id'        => 'link_hover_text_color',
                'type'      => 'color',
                'title'     => esc_html__('Link Hover Color', 'heartly'),
                'subtitle'  => esc_html__('Pick link hover color', 'heartly'),
                'validate'  => 'color',
            ),

        )
    )
);


//Button settings
Redux::setSection(
    $opt_name,
    array(
        'title'      => esc_html__('Button Style', 'heartly'),
        'desc'       => esc_html__('Button Style Here', 'heartly'),
        'subsection' => true,
        'fields' => array(

            array(
                'id'        => 'btn_bg_color',
                'type'      => 'color',
                'title'     => esc_html__('Background Color', 'heartly'),
                'subtitle'  => esc_html__('Pick color', 'heartly'),
                'validate'  => 'color',
                'output'    => array('background-color' => '.themephi-button a')
            ),

            // array(
            //     'id'        => 'btn_bg_hover',
            //     'type'      => 'color',
            //     'title'     => esc_html__('Hover Background', 'heartly'),
            //     'subtitle'  => esc_html__('Pick color', 'heartly'),
            //     'default'   => '',
            //     'validate'  => 'color',
            //     'output'    => array('background' => '.themephi-button a:hover::before')

            // ),          

            array(
                'id'        => 'btn_text_color',
                'type'      => 'color',
                'title'     => esc_html__('Text Color', 'heartly'),
                'subtitle'  => esc_html__('Pick color', 'heartly'),
                'default'   => '',
                'validate'  => 'color',
                'output'    => array('.themephi-button a')
            ),

            array(
                'id'        => 'btn_txt_hover_color',
                'type'      => 'color',
                'title'     => esc_html__('Hover Text Color', 'heartly'),
                'subtitle'  => esc_html__('Pick color', 'heartly'),
                'default'   => '',
                'validate'  => 'color',
                'output'    => array('.themephi-button a:hover')
            ),

            array(
                'id'     => 'notice_critical',
                'type'   => 'info',
                'notice' => true,
                'style'  => 'success',
                'title'  => esc_html__('Seconday Button Style', 'heartly')            
            ),
            array(
                'id'        => 'btn2_bg_color',
                'type'      => 'color',
                'title'     => esc_html__('Background Color', 'heartly'),
                'subtitle'  => esc_html__('Pick color', 'heartly'),
                'validate'  => 'color',
                'output'    => array('background-color' => '.themephi-button.secondary_btn a')
            ),

            array(
                'id'        => 'btn2_bg_hover',
                'type'      => 'color',
                'title'     => esc_html__('Hover Background', 'heartly'),
                'subtitle'  => esc_html__('Pick color', 'heartly'),
                'validate'  => 'color',
                'output'    => array('background' => '.themephi-button.secondary_btn a:after')

            ),
            
            array(
                'id'        => 'btn2_text_color',
                'type'      => 'color',
                'title'     => esc_html__('Text Color', 'heartly'),
                'subtitle'  => esc_html__('Pick color', 'heartly'),
                'validate'  => 'color',
                'output'    => array('.themephi-button.secondary_btn a')
            ),

            array(
                'id'        => 'btn2_txt_hover_color',
                'type'      => 'color',
                'title'     => esc_html__('Hover Text Color', 'heartly'),
                'subtitle'  => esc_html__('Pick color', 'heartly'),
                'validate'  => 'color',
                'output'    => array('.themephi-button.secondary_btn a:after')
            ),
        )
    )
);


//Breadcrumb settings
Redux::setSection(
    $opt_name,
    array(
        'title'  => esc_html__('Breadcrumb Style', 'heartly'),
        'subsection' => true,
        'fields' => array(

            array(
                'id'       => 'off_breadcrumb',
                'type'     => 'switch',
                'title'    => esc_html__('Show off Breadcrumb', 'heartly'),
                'subtitle' => esc_html__('You can show or hide off breadcrumb here', 'heartly'),
                'default'  => true,
            ),

            array(
                'id'      => 'align_breadcrumb',
                'type'    => 'select',
                'title'    => esc_html__('Breadcrumb Alignment', 'heartly'),
                'default'  => 'center',
                'options' => array(
                    'start' => __( 'Left', 'heartly' ),
                    'center'   => __( 'Center', 'heartly' ),
                    'end'     => __( 'Right', 'heartly' ),
                ),
            ),

            array(
                'id'        => 'breadcrumb_bg_color',
                'type'      => 'color',
                'title'     => esc_html__('Background Bg Color', 'heartly'),
                'subtitle'  => esc_html__('Pick color', 'heartly'),
                'validate'  => 'color',
            ),

            array(
                'id'        => 'page_title_color',
                'type'      => 'color',
                'title'     => esc_html__('Banner Title Color', 'heartly'),
                'subtitle'  => esc_html__('Pick color', 'heartly'),
                'validate'  => 'color',               
            ),

            array(
                'id'          => 'opt-typography',
                'type'        => 'typography', 
                'title'       => __('Banner Title Typography', 'heartly'),    
                'output'      => array('.themephi-breadcrumbs .page-title'),
                'units'       =>'px',
                'subtitle'    => __('Typography option with each property can be called individually.', 'heartly'),                
            ),

            array(
                'id'       => 'page_banner_main',
                'type'     => 'media',
                'title'    => esc_html__('Background Banner', 'heartly'),
                'subtitle' => esc_html__('Upload your banner', 'heartly'),
            ),

            array(
                'id'        => 'breadcrumb_top_gap',
                'type'      => 'text',
                'title'     => esc_html__('Top Gap', 'heartly'),
                'desc'    => esc_html__('Type ex: 90px', 'heartly'),

            ),
            array(
                'id'        => 'breadcrumb_bottom_gap',
                'type'      => 'text',
                'title'     => esc_html__('Bottom Gap', 'heartly'),
                'desc'    => esc_html__('Type ex: 80px', 'heartly'),
            ),

            array(
                'id'        => 'mobile_breadcrumb_top_gap',
                'type'      => 'text',
                'title'     => esc_html__('Mobile Top Gap', 'heartly'),
                'default'   => '90px',

            ),
            array(
                'id'        => 'mobile_breadcrumb_bottom_gap',
                'type'      => 'text',
                'title'     => esc_html__('Mobile Bottom Gap', 'heartly'),
                'default'   => '80px',
            ),

            array(
                'id'        => 'breadcrumb_position',
                'type'      => 'text',
                'title'     => esc_html__('Top Bottom Postion', 'heartly'),                
            ),

        )
    )
);
//-> START Typography
Redux::setSection(
    $opt_name,
    array(
        'title'  => esc_html__('Typography', 'heartly'),
        'id'     => 'typography',
        'desc'   => esc_html__('You can specify your body and heading font here', 'heartly'),
        'icon'   => 'el el-font',
        'fields' => array(
            array(
                'id'       => 'opt-typography-body',
                'type'     => 'typography',
                'title'    => esc_html__('Body Font', 'heartly'),
                'subtitle' => esc_html__('Specify the body font properties.', 'heartly'),
                'google'   => true,
                'font-style' => false,
                'default'  => array(
                    'font-size'   => '16px',
                    'font-family' => "Outfit",
                    'font-weight' => '400',
                ),
            ),
            array(
                'id'       => 'opt-typography-menu',
                'type'     => 'typography',
                'title'    => esc_html__('Navigation Font', 'heartly'),
                'subtitle' => esc_html__('Specify the menu font properties.', 'heartly'),
                'google'   => true,
                'font-backup' => true,
                'all_styles'  => true,
                'default'  => array(
                    'color'       => '',
                    'font-family' => '',
                    'google'      => true,
                    'font-size'   => '15px',
                    'font-weight' => '500',
                ),
            ),
            array(
                'id'          => 'opt-typography-h1',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H1', 'heartly'),
                'font-backup' => true,
                'all_styles'  => true,
                'units'       => 'px',
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'heartly'),
                'default'     => array(
                    'font-style'  => '600',
                    'font-family' => '',
                    'google'      => true,
                    

                ),
            ),
            array(
                'id'          => 'opt-typography-h2',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H2', 'heartly'),
                'font-backup' => true,
                'all_styles'  => true,
                'units'       => 'px',
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'heartly'),
                'default'     => array(
                    'font-style'  => '600',
                    'font-family' => '',
                    'google'      => true,
                    

                ),
            ),
            array(
                'id'          => 'opt-typography-h3',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H3', 'heartly'),
                'units'       => 'px',
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'heartly'),
                'default'     => array(
                    'font-style'  => '600',
                    'font-family' => '',
                    'google'      => true,
                    

                ),
            ),
            array(
                'id'          => 'opt-typography-h4',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H4', 'heartly'),
                'font-backup' => false,
                'all_styles'  => true,
                'units'       => 'px',
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'heartly'),
                'default'     => array(
                    'font-style'  => '600',
                    'font-family' => '',
                    'google'      => true,
                   
                ),
            ),
            array(
                'id'          => 'opt-typography-h5',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H5', 'heartly'),
                'font-backup' => false,
                'all_styles'  => true,
                'units'       => 'px',
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'heartly'),
                'default'     => array(
                    'font-style'  => '600',
                    'font-family' => '',
                    'google'      => true,
                    
                ),
            ),
            array(
                'id'          => 'opt-typography-6',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H6', 'heartly'),

                'font-backup' => false,
                'all_styles'  => true,
                'units'       => 'px',
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'heartly'),
                'default'     => array(
                    'font-style'  => '600',
                    'font-family' => '',
                    'google'      => true,
                    
                ),
            ),

        )
    )

);

/*Team Sections*/
Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Team Section', 'heartly' ),
    'id'               => 'team',
    'customizer_width' => '450px',
    'icon' => 'el el-user',
    'fields'           => array(        
    
        array(
                'id'       => 'team_single_image', 
                'url'      => true,     
                'title'    => esc_html__( 'Team Single page banner image', 'heartly' ),                    
                'type'     => 'media',
                
            ), 

        array(
                'id'        => 'team_single_bg_color',
                'type'      => 'color',                           
                'title'     => esc_html__('Sinlge Team Body Backgroud Color','heartly'),
                'subtitle'  => esc_html__('Pick body background color', 'heartly'),
                'validate'  => 'color',                        
            ),
        
        array(
                'id'       => 'team_slug',                               
                'title'    => esc_html__( 'Team Slug', 'heartly' ),
                'subtitle' => esc_html__( 'Enter Team Slug Here', 'heartly' ),
                'type'     => 'text',
                'default'  => esc_html__('teams', 'heartly'),
                
            ),                 
                      
        )
    ) 
);

if (class_exists('WooCommerce')) {
    Redux::setSection(
        $opt_name,
        array(
            'title'  => esc_html__('Woocommerce', 'heartly'),
            'icon'   => 'el el-shopping-cart',
        )
    );

    Redux::setSection(
        $opt_name,
        array(
            'title'            => esc_html__('Shop', 'heartly'),
            'id'               => 'shop_layout',
            'customizer_width' => '450px',
            'subsection' => true,
            'fields'           => array(
                array(
                    'id'       => 'shop_banner',
                    'url'      => true,
                    'title'    => esc_html__('Shop page banner', 'heartly'),
                    'type'     => 'media',
                ),
                array(
                    'id'       => 'shop-long-title',
                    'url'      => true,
                    'title'    => esc_html__('Shop Long Title', 'heartly'),
                    'type'     => 'text',
                ),
                array(
                    'id'       => 'shop-layout',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Select Shop Layout', 'heartly'),
                    'subtitle' => esc_html__('Select your shop layout', 'heartly'),
                    'options'  => array(
                        'full'      => array(
                            'alt'   => esc_html__('Shop Style 1', 'heartly'),
                            'img'   => get_template_directory_uri() . '/libs/img/1c.png'
                        ),
                        'right-col' => array(
                            'alt'   => esc_html__('Shop Style 2', 'heartly'),
                            'img'   => get_template_directory_uri() . '/libs/img/2cr.png'
                        ),
                        'left-col'  => array(
                            'alt'   => esc_html__('Shop Style 3', 'heartly'),
                            'img'   => get_template_directory_uri() . '/libs/img/2cl.png'
                        ),
                    ),
                    'default' => 'full'
                ),

                array(
                    'id'       => 'wc_num_product',
                    'type'     => 'text',
                    'title'    => esc_html__('Number of Products Per Page', 'heartly'),
                    'default'  => '9',
                ),

                array(
                    'id'       => 'wc_num_product_per_row',
                    'type'     => 'text',
                    'title'    => esc_html__('Number of Products Per Row', 'heartly'),
                    'default'  => '3',
                ),

                array(
                    'id'       => 'wc_cart_icon',
                    'type'     => 'switch',
                    'title'    => esc_html__('Cart Icon Show At Menu Area', 'heartly'),
                    'on'       => esc_html__('Enabled', 'heartly'),
                    'off'      => esc_html__('Disabled', 'heartly'),
                    'default'  => false,
                ),

                array(
                    'id'       => 'disable-sidebar',
                    'type'     => 'switch',
                    'title'    => esc_html__('Sidebar Disable For Single Product Page', 'heartly'),
                    'default'  => true,
                ),

                array(
                    'id'       => 'wc_wishlist_icon',
                    'type'     => 'switch',
                    'title'    => esc_html__('Show Wishlist Icon', 'heartly'),
                    'on'       => esc_html__('Enabled', 'heartly'),
                    'off'      => esc_html__('Disabled', 'heartly'),
                    'default'  => true,
                ),
                array(
                    'id'       => 'wc_quickview_icon',
                    'type'     => 'switch',
                    'title'    => esc_html__('Product Quickview Icon', 'heartly'),
                    'on'       => esc_html__('Enabled', 'heartly'),
                    'off'      => esc_html__('Disabled', 'heartly'),
                    'default'  => true,
                ),
                array(
                    'id'       => 'wc_show_new',
                    'type'     => 'switch',
                    'title'    => esc_html__('Show Product New Badge', 'heartly'),
                    'on'       => esc_html__('Enabled', 'heartly'),
                    'off'      => esc_html__('Disabled', 'heartly'),
                    'default'  => true,
                ),

                array(
                    'id'       => 'wc_new_product_days',
                    'type'     => 'select',
                    'title'    => esc_html__('New Days', 'heartly'),
                    'desc'     => esc_html__('Select last day, when uploaded products will show a new badge.', 'heartly'),
                    'options'  => array(
                        '7'     => esc_html__('7 Days', 'heartly'),
                        '10' => esc_html__('10 Days', 'heartly'),
                        '15' => esc_html__('15 Days', 'heartly'),
                        '30' => esc_html__('30 Days', 'heartly'),
                    ),
                    'default'  => '15',

                ),



            )
        )
    );
    Redux::setSection(
        $opt_name,
        array(
            'title'            => esc_html__('Shop Single', 'heartly'),
            'id'               => 'shop_single',
            'customizer_width' => '450px',
            'subsection' => true,
            'fields'           => array(

                array(
                    'id'       => 'single-gallery-layout',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Single Product Gallery Layout', 'heartly'),
                    'subtitle' => esc_html__('Select single page gallery layout', 'heartly'),
                    'options'  => array(
                        'default-thumb'      => array(
                            'alt'   => esc_html__('Style 1', 'heartly'),
                            'img'   => get_template_directory_uri() . '/libs/img/1c.png'
                        ),
                        'right-thumb' => array(
                            'alt'   => esc_html__('Style 2', 'heartly'),
                            'img'   => get_template_directory_uri() . '/libs/img/2cr.png'
                        ),
                        'left-thumb'  => array(
                            'alt'   => esc_html__('Style 3', 'heartly'),
                            'img'   => get_template_directory_uri() . '/libs/img/2cl.png'
                        ),
                    ),
                    'default' => 'default-thumb'
                ),

                array(
                    'id'       => 'single_releted_products',
                    'type'     => 'text',
                    'title'    => esc_html__('Number of Releted Products in Product detail Page', 'heartly'),
                    'default'  => '4',
                ),
                array(
                    'id'       => 'single_releted_products_col',
                    'type'     => 'text',
                    'title'    => esc_html__('Coloumn Number of Releted Products in Product detail Page', 'heartly'),
                    'default'  => '4',
                ),

            )
        )
    );
}
Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Portfolio Section', 'heartly' ),
    'id'               => 'Portfolio',
    'customizer_width' => '450px',
    'icon' => 'el el-align-right',
    'fields'           => array(
    
        array(
                'id'       => 'department_single_image', 
                'url'      => true,     
                'title'    => esc_html__( 'Portfolio Single page banner image', 'heartly' ),                    
                'type'     => 'media',
                
        ),  

         array(
                'id'       => 'portfolio_slug',                               
                'title'    => esc_html__( 'Portfolio Slug', 'heartly' ),
                'subtitle' => esc_html__( 'Enter Portfolio Slug Here', 'heartly' ),
                'type'     => 'text',
                'default'  => 'tp-portfolios',                
            ), 
            array(
                'id'       => 'portfolio_cat_slug',                               
                'title'    => esc_html__( 'Portfolio Category Slug', 'heartly' ),
                'subtitle' => esc_html__( 'Enter Portfolio Cat Slug Here', 'heartly' ),
                'type'     => 'text',
                'default'  => '',                    
            ), 

            array(
                'id'        => 'portfolio_bg_color',
                'type'      => 'color',
                'title'     => esc_html__('Project Information Area Background', 'heartly'),
                'subtitle'  => esc_html__('Pick color', 'heartly'),
                'validate'  => 'color',
                'output'    => array('background' => '.big-bg-porduct-details .project-info')
            ),
            array(
                'id'        => 'portfolio_bg_border_color',
                'type'      => 'color_rgba',
                'title'     => esc_html__('Project Information Border Color', 'heartly'),
                'subtitle'  => esc_html__('Pick color', 'heartly'),
              
                'output'    => array('border-color' => '.big-bg-porduct-details .project-info .info-body .single-info')
            ),
        )
     ) 
);

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Service Section', 'heartly' ),
    'id'               => 'Service',
    'customizer_width' => '450px',
    'icon' => 'el el-align-right',
    'fields'           => array(
    
        array(
                'id'       => 'service_single_image', 
                'url'      => true,     
                'title'    => esc_html__( 'Service Single page banner image', 'heartly' ),                    
                'type'     => 'media',
                
        ),  

         array(
                'id'       => 'service_slug',                               
                'title'    => esc_html__( 'Service Slug', 'heartly' ),
                'subtitle' => esc_html__( 'Enter Service Slug Here', 'heartly' ),
                'type'     => 'text',
                'default'  => 'services',                
            ), 
            array(
                'id'       => 'service_cat_slug',                               
                'title'    => esc_html__( 'Service Category Slug', 'heartly' ),
                'subtitle' => esc_html__( 'Enter Service Cat Slug Here', 'heartly' ),
                'type'     => 'text',
                'default'  => '',                    
            ), 

            array(
                'id'        => 'service_bg_color',
                'type'      => 'color',
                'title'     => esc_html__('Project Information Area Background', 'heartly'),
                'subtitle'  => esc_html__('Pick color', 'heartly'),
                'validate'  => 'color',
                'output'    => array('background' => '.big-bg-service-details .service-info')
            ),
            array(
                'id'        => 'service_bg_border_color',
                'type'      => 'color_rgba',
                'title'     => esc_html__('Service Information Border Color', 'heartly'),
                'subtitle'  => esc_html__('Pick color', 'heartly'),
              
                'output'    => array('border-color' => '.big-bg-service-details .service-info .info-body .single-info')
            ),
        )
     ) 
);

/*Blog Sections*/
Redux::setSection(
    $opt_name,
    array(
        'title'            => esc_html__('Blog', 'heartly'),
        'id'               => 'blog',
        'customizer_width' => '450px',
        'icon' => 'el el-comment',
    )
);

Redux::setSection(
    $opt_name,
    array(
        'title'            => esc_html__('Blog Settings', 'heartly'),
        'id'               => 'blog-settings',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'    => 'blog_banner_main',
                'url'   => true,
                'title' => esc_html__('Blog Page Banner', 'heartly'),
                'type'  => 'media',
            ),

            array(
                'id'        => 'blog_bg_color',
                'type'      => 'color',
                'title'     => esc_html__('Body Backgroud Color', 'heartly'),
                'subtitle'  => esc_html__('Pick body background color', 'heartly'),
                'validate'  => 'color',
            ),

            array(
                'id'       => 'blog_title',
                'title'    => esc_html__('Blog  Title', 'heartly'),
                'subtitle' => esc_html__('Enter Blog  Title Here', 'heartly'),
                'type'     => 'text',
            ),

            array(
                'id'       => 'blog_long_title',
                'title'    => esc_html__('Blog  Long Title', 'heartly'),
                'subtitle' => esc_html__('Enter Blog  Long Title Here', 'heartly'),
                'type'     => 'text',
            ),

            array(
                'id'               => 'blog-layout',
                'type'             => 'image_select',
                'title'            => esc_html__('Select Blog Layout', 'heartly'),
                'subtitle'         => esc_html__('Select your blog layout', 'heartly'),
                'options'          => array(
                    'full'             => array(
                        'alt'              => esc_html__('Blog Style 1', 'heartly'),
                        'img'              => get_template_directory_uri() . '/libs/img/1c.png'
                    ),
                    '2right'           => array(
                        'alt'              => esc_html__('Blog Style 2', 'heartly'),
                        'img'              => get_template_directory_uri() . '/libs/img/2cr.png'
                    ),
                    '2left'            => array(
                        'alt'              => esc_html__('Blog Style 3', 'heartly'),
                        'img'              => get_template_directory_uri() . '/libs/img/2cl.png'
                    ),
                ),
                'default'          => '2right'
            ),

            array(
                'id'               => 'blog-grid',
                'type'             => 'select',
                'title'            => esc_html__('Select Blog Gird', 'heartly'),
                'desc'             => esc_html__('Select your blog gird layout', 'heartly'),
                'options'          => array(
                    '12'               => esc_html__('1 Column', 'heartly'),
                    '6'                => esc_html__('2 Column', 'heartly'),
                    '4'                => esc_html__('3 Column', 'heartly'),
                    '3'                => esc_html__('4 Column', 'heartly'),
                ),
                'default'          => '12',
            ),

            array(
                'id'               => 'blog-author-post',
                'type'             => 'select',
                'title'            => esc_html__('Show Author Info ', 'heartly'),
                'desc'             => esc_html__('Select author info show or hide', 'heartly'),
                'options'          => array(
                    'show'             => esc_html__('Show', 'heartly'),
                    'hide'             => esc_html__('Hide', 'heartly'),
                ),
                'default'          => 'show',

            ),

            array(
                'id'               => 'blog-category',
                'type'             => 'select',
                'title'            => esc_html__('Show Category', 'heartly'),
                'options'          => array(
                    'show'             => esc_html__('Show', 'heartly'),
                    'hide'             => esc_html__('Hide', 'heartly'),
                ),
                'default'          => 'show',

            ),

            array(
                'id'               => 'blog-date',
                'type'             => 'switch',
                'title'            => esc_html__('Show Date', 'heartly'),
                'desc'             => esc_html__('You can show/hide date at blog page', 'heartly'),
                'default'          => true,
            ),
            array(
                'id'               => 'blog_readmore',
                'title'            => esc_html__('Blog Read More Text', 'heartly'),
                'subtitle'         => esc_html__('Enter Blog Read More Here', 'heartly'),
                'type'             => 'text',
                'default'          => esc_html__('Read More', 'heartly'),
            ),

        )
    )

);

/*Single Post Sections*/
Redux::setSection(
    $opt_name,
    array(
        'title'            => esc_html__('Single Post', 'heartly'),
        'id'               => 'spost',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(

            array(
                'id'       => 'single_blog_title',
                'title'    => esc_html__('Single Blog  Title', 'heartly'),
                'subtitle' => esc_html__('Enter Title Here', 'heartly'),
                'type'     => 'text',
            ),
            array(
                'id'       => 'blog_banner',
                'url'      => true,
                'title'    => esc_html__('Blog Single page banner', 'heartly'),
                'type'     => 'media',

            ),

            array(
                'id'       => 'blog-comments',
                'type'     => 'select',
                'title'    => esc_html__('Show Comment Form', 'heartly'),
                'desc'     => esc_html__('Select comments show or hide', 'heartly'),
                'options'  => array(
                    'show' => esc_html__('Show', 'heartly'),
                    'hide' => esc_html__('Hide', 'heartly'),
                ),
                'default'  => 'show',

            ),

            array(
                'id'       => 'blog-author-meta',
                'type'     => 'select',
                'title'    => esc_html__('Show Meta Info', 'heartly'),
                'desc'     => esc_html__('Select meta info show or hide', 'heartly'),
                'options'  => array(
                    'show' => esc_html__('Show', 'heartly'),
                    'hide' => esc_html__('Hide', 'heartly'),
                ),
                'default'  => 'show',

            ),

        )
    )


);


Redux::setSection(
    $opt_name,
    array(
        'title'  => esc_html__('404 Error Page', 'heartly'),
        'desc'   => esc_html__('404 details  here', 'heartly'),
        'icon'   => 'el el-error-alt',
        'fields' => array(

            array(
                'id'       => 'title_404',
                'type'     => 'text',
                'title'    => esc_html__('Title', 'heartly'),
                'subtitle' => esc_html__('Enter title for 404 page', 'heartly'),
                'default'  => esc_html__('404', 'heartly')
            ),
            array(
                'id'       => 'text_404',
                'type'     => 'text',
                'title'    => esc_html__('Text', 'heartly'),
                'subtitle' => esc_html__('Enter text for 404 page', 'heartly'),
                'default'  => esc_html__('Page Not Found', 'heartly')
            ),
            array(
                'id'       => 'back_home',
                'type'     => 'text',
                'title'    => esc_html__('Back to Home Button Label', 'heartly'),
                'subtitle' => esc_html__('Enter label for "Back to Home" button', 'heartly'),
                'default'  => esc_html__('Back to Home', 'heartly')

            ),
            array(
                'id'       => '404_bg',
                'type'     => 'media',
                'title'    => esc_html__('404 page Image', 'heartly'),
                'subtitle' => esc_html__('Upload your image', 'heartly'),
                'url' => true
            ),


        )
    )
);

if (!function_exists('compiler_action')) {
    function compiler_action($options, $css, $changed_values)
    {
        echo '<h1>The compiler hook has run!</h1>';
        echo "<pre>";
        print_r($changed_values); // Values that have changed since the last save
        echo "</pre>";
    }
}

/**
 * Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')) {
    function redux_validate_callback_function($field, $value, $existing_value)
    {
        $error   = false;
        $warning = false;

        //do your validation
        if ($value == 1) {
            $error = true;
            $value = $existing_value;
        } elseif ($value == 2) {
            $warning = true;
            $value   = $existing_value;
        }

        $return['value'] = $value;

        if ($error == true) {
            $field['msg']    = 'your custom error message';
            $return['error'] = $field;
        }

        if ($warning == true) {
            $field['msg']      = 'your custom warning message';
            $return['warning'] = $field;
        }

        return $return;
    }
}

/**
 * Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')) {
    function redux_my_custom_field($field, $value)
    {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
}

/**
 * Custom function for filtering the sections array. Good for child themes to override or add to the sections.     
 * */
if (!function_exists('dynamic_section')) {
    function dynamic_section($sections)
    {
        $sections[] = array(
            'title'  => esc_html__('Section via hook', 'heartly'),
            'desc'   => esc_html__('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'heartly'),
            'icon'   => 'el el-paper-clip',
            'fields' => array()
        );
        return $sections;
    }
}

/**
 * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
 * */
if (!function_exists('change_arguments')) {
    function change_arguments($args)
    {
        return $args;
    }
}

/**
 * Filter hook for filtering the default value of any given field. Very useful in development mode.
 * */
if (!function_exists('change_defaults')) {
    function change_defaults($defaults)
    {
        $defaults['str_replace'] = 'Testing filter hook!';
        return $defaults;
    }
}

/**
 * Removes the demo link and the notice of integrated demo from the redux-framework plugin
 */
if (!function_exists('remove_demo')) {
    function remove_demo()
    {
        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if (class_exists('ReduxFrameworkPlugin')) {
            remove_action('plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2);
            remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
        }
    }
}
