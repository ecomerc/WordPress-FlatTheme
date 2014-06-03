<?php

//Defined Textdomain
define('ZEETEXTDOMAIN', wp_get_theme()->get( 'TextDomain' ));

define('ZEETHEMENAME', wp_get_theme()->get( 'Name' ));

// metaboxes directory constant
define( 'CUSTOM_METABOXES_DIR', get_template_directory_uri() . '/admin/metaboxes' );


// registaring menu
register_nav_menus( array(
    'primary'   => __('Primary', ZEETEXTDOMAIN),
    'footer'    => __('Footer', ZEETEXTDOMAIN)
    ));


// fontawesome icons list
require_once( get_template_directory()  . '/admin/fontawesome-icons.php');

// css classes
require_once( get_template_directory()  . '/admin/css-color-classes.php');

//Google Fonts
require_once( get_template_directory()  . '/admin/themeoptions/functions/googlefonts.php');

// MCE Buttons
require_once( get_template_directory()  . '/admin/shortcodes/tinymce.button.php');

// Meta boxes
require_once( get_template_directory()  . '/admin/metaboxes/meta_box.php');

// Theme Option Settings
require_once( get_template_directory()  . '/admin/themeoptions/index.php');

// Shortcodes
require_once( get_template_directory()  . '/lib/shortcodes.php');

//Theme Functions
require_once( get_template_directory()  . '/lib/theme-functions.php');

// nav walker
require_once( get_template_directory()  . '/lib/navwalker.php');

require_once( get_template_directory()  . '/lib/mobile-navwalker.php');

// widgets
require_once( get_template_directory()  . '/lib/widgets.php');

require_once( get_template_directory()  . '/admin/plugin-setup.php');

// 
add_action('after_setup_theme', function(){

    // load textdomain
    load_theme_textdomain(ZEETEXTDOMAIN, get_template_directory() . '/languages');


    // post format support
    add_theme_support( 
        'post-formats', array(
          'audio', 'gallery', 'image', 'video'
          ) 
        );


    // post thumbnail support
    add_theme_support('post-thumbnails');

    add_theme_support( 'automatic-feed-links' );

});

if ( is_singular() && get_option( 'thread_comments' ) ){
    wp_enqueue_script( 'comment-reply' );
}


if ( ! function_exists( 'zee_option' ) ) {

    /**
     * Getting theme option
     * @param  boolean $index  [first index of theme array]
     * @param  boolean $index2 [second index of first index array]
     * @return string          [return option data]
     */
    
    function zee_option($index=false, $index2=false ){

        global $data;

        if( $index2 ){
            return ( isset($data[$index]) and isset($data[$index][$index2]) ) ?  $data[$index][$index2] : '';
        } else {
            return isset( $data[$index] ) ?  $data[$index] : '';
        }
    }
}

// adding scripts at admin panel
add_action( 'admin_enqueue_scripts', function(){
    wp_enqueue_script( 'zee_admin_js', get_template_directory_uri() . '/admin/js/admin.js', false, '1.0.0' );
});

// decativate default gallery css
add_filter( 'use_default_gallery_style', '__return_false' );

// adding prettyPhoto each gallery item
add_filter( 'wp_get_attachment_link', function( $content, $id, $size, $permalink ){

    if( !$permalink ){
        $content = preg_replace("/<a/","<a rel=\"prettyPhoto[gallery]\"",$content,1); // >
        return $content;
    }
}, 10, 5); 



// Content width 

if ( ! isset( $content_width ) ) {
    $content_width = 600;   
}

//  Set title
add_filter( 'wp_title', function( $title, $sep ) {

    global $paged, $page;

    if ( is_feed() ){
        return $title;
    }

    $title .= get_bloginfo( 'name' );

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );

    if ( $site_description and ( is_home() or is_front_page() ) ){
        $title = "$title $sep $site_description";
    }

    // Add a page number if necessary.
    if ( $paged >= 2 || $page >= 2 ){
        $title = "$title $sep " . sprintf( __( 'Page %s', ZEETEXTDOMAIN ), max( $paged, $page ) );
    }

    return $title;
}, 10, 2 );



// add shortcode tinymce button
add_filter('mce_buttons', function ($mce_buttons) {

    $pos = array_search('wp_more', $mce_buttons, true);

    if ($pos !== false) {
        $buttons = array_slice($mce_buttons, 0, $pos + 1);
        $buttons[] = 'wp_page';    
        $mce_buttons = array_merge($buttons, array_slice($mce_buttons, $pos + 1));
    }
    return $mce_buttons;
});

/**
 * Getting post thumbnail url
 * @param  [int]                $pots_ID [Post ID]
 * @return [string]             [Return thumbail source url]
 */
function zee_get_thumb_url($pots_ID){
    return wp_get_attachment_url( get_post_thumbnail_id( $pots_ID ) );
}


if( ! function_exists('zee_scripts') ){

// adding scripts
    add_action('wp_enqueue_scripts', 'zee_scripts');

    function zee_scripts() {

    // Javascripts
        wp_enqueue_script('bootstrap-js',   get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'));
        wp_enqueue_script('prettyPhoto',    get_template_directory_uri() . '/assets/js/jquery.prettyPhoto.js');
        wp_enqueue_script('isotope',        get_template_directory_uri() . '/assets/js/jquery.isotope.min.js');
        wp_enqueue_script('main-js',        get_template_directory_uri() . '/assets/js/main.js');

    // Stylesheet
        wp_enqueue_style('bootstrap-min',   get_template_directory_uri() . '/assets/css/bootstrap.min.css');
        wp_enqueue_style('prettyPhoto',     get_template_directory_uri() . '/assets/css/prettyPhoto.css');
        wp_enqueue_style('animate',         get_template_directory_uri() . '/assets/css/animate.css');
        wp_enqueue_style('fontawesome',     get_template_directory_uri() . '/assets/css/font-awesome.min.css');    
        wp_enqueue_style('style',           get_template_directory_uri() . '/style.css');
    // Inline css
        wp_add_inline_style( 'style',       zee_style_options() );
    }
}

    // Post type: Sliders 
add_action('init', function(){

    $labels = array(
        'name'                  => __( 'Slider',                ZEETEXTDOMAIN ),
        'singular_name'         => __( 'Slider',                ZEETEXTDOMAIN ),
        'menu_name'             => __( 'Sliders',               ZEETEXTDOMAIN ),
        'all_items'             => __( 'All Sliders',           ZEETEXTDOMAIN ),
        'add_new'               => __( 'Add New',               ZEETEXTDOMAIN ),
        'add_new_item'          => __( 'Add New Slider',        ZEETEXTDOMAIN ),
        'edit_item'             => __( 'Edit Slider',           ZEETEXTDOMAIN ),
        'new_item'              => __( 'New Slider',            ZEETEXTDOMAIN ),
        'view_item'             => __( 'View Slider',           ZEETEXTDOMAIN ),
        'search_items'          => __( 'Search Portfolios',     ZEETEXTDOMAIN ),
        'not_found'             => __( 'No item found',         ZEETEXTDOMAIN ),
        'not_found_in_trash'    => __( 'No item found in Trash',ZEETEXTDOMAIN )
        );

    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'menu_icon'             => get_template_directory_uri() . '/admin/images/icon-slider.png',
        'rewrite'               => true,
        'capability_type'       => 'post',
        'supports'              => array('title', 'page-attributes', 'editor', 'thumbnail') 
        );
    register_post_type('zee_slider', $args);
    flush_rewrite_rules();
});

    // slider metaboxes

$prefix = 'slider_';
$fields = array(
    array( 
        'label'                     => __('Background Image',          ZEETEXTDOMAIN),
        'desc'                      => __('Show background image in slider', ZEETEXTDOMAIN), 
        'id'                        => $prefix . 'background_image',
        'type'                      => 'image'
        ),



    array( 
        'label'                     => __('Button Text',          ZEETEXTDOMAIN),
        'desc'                      => __('Show Slider Button and Button Text', ZEETEXTDOMAIN), 
        'id'                        => $prefix . 'button_text',
        'type'                      => 'text'
        ),   

    array( 
        'label'                     => __('Button URL',       ZEETEXTDOMAIN),
        'desc'                      => __('Slider URL link.', ZEETEXTDOMAIN), 
        'id'                        => $prefix . 'button_url',
        'type'                      => 'text'
        ),

    array( 
        'label'                     => __('Boxed Style',       ZEETEXTDOMAIN),
        'desc'                      => __('Show boxed Style.', ZEETEXTDOMAIN), 
        'id'                        => $prefix . 'boxed',
        'type'                      => 'select',
        'options'                   => array(

            array(
                'value'=>'no',
                'label'=>__('No', ZEETEXTDOMAIN)
                ),   

            array(
                'value'=>'yes',
                'label'=>__('Yes', ZEETEXTDOMAIN)
                )
            )
        ),
    array( 
        'label'                     => __('Position',       ZEETEXTDOMAIN),
        'desc'                      => __('Show slider Position.', ZEETEXTDOMAIN), 
        'id'                        => $prefix . 'position',
        'type'                      => 'select',
        'options'                   => array(

            array(
                'value'=>'left',
                'label'=>__('Left', ZEETEXTDOMAIN)
                ),   

            array(
                'value'=>'center',
                'label'=>__('Center', ZEETEXTDOMAIN)
                ),          

            array(
                'value'=>'right',
                'label'=>__('Right', ZEETEXTDOMAIN)
                ),
            )
        )
    );



$fields_video = array(

    array( 
        'label'                     => __('Video Type',       ZEETEXTDOMAIN),
        'desc'                      => __('Select video type.', ZEETEXTDOMAIN), 
        'id'                        => $prefix . 'video_type',
        'type'                      => 'radio',
        'options'                   => array(

            array(
                'value'=>'',
                'label'=>__('None', ZEETEXTDOMAIN)
                ),

            array(
                'value'=>'youtube',
                'label'=>__('Youtube', ZEETEXTDOMAIN)
                ),   

            array(
                'value'=>'vimeo',
                'label'=>__('Vimeo', ZEETEXTDOMAIN)
                )
            )
        ),

    array( 
        'label'                     => __('Video Link',          ZEETEXTDOMAIN),
        'desc'                      => __('Video link', ZEETEXTDOMAIN), 
        'id'                        => $prefix . 'video_link',
        'type'                      => 'text'
        ), 
    );


new Custom_Add_Meta_Box( 'zee_slider_box', __('Slider Settings', ZEETEXTDOMAIN), $fields, 'zee_slider', true );
new Custom_Add_Meta_Box( 'zee_slider_box_video', __('Video Settings', ZEETEXTDOMAIN), $fields_video, 'zee_slider', true );


// Post type:  Team

add_action('init', function(){

    $labels = array(
        'name'                  => __( 'Team',                      ZEETEXTDOMAIN ),
        'singular_name'         => __( 'Team',                      ZEETEXTDOMAIN ),
        'menu_name'             => __( 'Team',                      ZEETEXTDOMAIN ),
        'all_items'             => __( 'Team Members',              ZEETEXTDOMAIN ),
        'add_new'               => __( 'Add New',                   ZEETEXTDOMAIN ),
        'add_new_item'          => __( 'Add New Member',            ZEETEXTDOMAIN ),
        'edit_item'             => __( 'Edit Member',               ZEETEXTDOMAIN ),
        'new_item'              => __( 'New Member',                ZEETEXTDOMAIN ),
        'view_item'             => __( 'View Member',               ZEETEXTDOMAIN ),
        'search_items'          => __( 'Search Member',             ZEETEXTDOMAIN ),
        'not_found'             => __( 'No Member found',           ZEETEXTDOMAIN ),
        'not_found_in_trash'    => __( 'No Member found in Trash',  ZEETEXTDOMAIN )
        );

$args = array(
    'labels'                => $labels,
    'public'                => true,
    'has_archive'           => false,
    'exclude_from_search'   => true,
    'menu_icon'             => get_template_directory_uri() . '/admin/images/icon-team.png',
    'rewrite'               => true,
    'capability_type'       => 'post',
    'supports'              => array('title', 'editor', 'thumbnail')
    );
register_post_type('zee_team', $args);
flush_rewrite_rules();
});


    // team metaboxes

$prefix = 'team_';

$fields = array(

    array( 
        'label' => __('Designation',                    ZEETEXTDOMAIN), 
        'id'    => $prefix.'designation',
        'type'  => 'text'
        ),

    array( 
        'label' => __('Facebook',                       ZEETEXTDOMAIN), 
        'desc'  => __('Facebook link of team member',   ZEETEXTDOMAIN), 
        'id'    => $prefix.'facebook', 
        'type'  => 'text'
        ),

    array( 
        'label' => __('Twitter', ZEETEXTDOMAIN), 
        'desc'  => __('Twitter link of team member',    ZEETEXTDOMAIN), 
        'id'    => $prefix.'twitter', 
        'type'  => 'text'
        ),

    array( 
        'label' => __('Google Plus', ZEETEXTDOMAIN), 
        'desc'  => __('Google Plus link of team member', ZEETEXTDOMAIN), 
        'id'    => $prefix.'gplus', 
        'type'  => 'text'
        ),

    array( 
        'label' => __('Pinterest', ZEETEXTDOMAIN), 
        'desc'  => __('Pinterest link of team member',   ZEETEXTDOMAIN), 
        'id'    => $prefix.'pinterest', 
        'type'  => 'text'
        ),

    array( 
        'label' => __('Linkedin', ZEETEXTDOMAIN), 
        'desc'  => __('Linkedin link of team member',    ZEETEXTDOMAIN), 
        'id'    => $prefix.'linkedin', 
        'type'  => 'text'
        )
    );
new Custom_Add_Meta_Box( 'zee_team_box', __('Team Social Settings', ZEETEXTDOMAIN), $fields, 'zee_team', true );





/** 
* Post type: Portfolio
*/

add_action('init', function(){
    $labels = array(
        'name'                      => __( 'Portfolio',                         ZEETEXTDOMAIN ),
        'singular_name'             => __( 'Portfolio',                         ZEETEXTDOMAIN ),
        'menu_name'                 => __( 'Portfolios',                        ZEETEXTDOMAIN ),
        'all_items'                 => __( 'All Portfolios',                    ZEETEXTDOMAIN ),
        'add_new'                   => __( 'Add New',                           ZEETEXTDOMAIN ),
        'add_new_item'              => __( 'Add New Portfolio',                 ZEETEXTDOMAIN ),
        'edit_item'                 => __( 'Edit Portfolio',                    ZEETEXTDOMAIN ),
        'new_item'                  => __( 'New Portfolio',                     ZEETEXTDOMAIN ),
        'view_item'                 => __( 'View Portfolio',                    ZEETEXTDOMAIN ),
        'search_items'              => __( 'Search Portfolios',                 ZEETEXTDOMAIN ),
        'not_found'                 => __( 'No Portfolio item found',           ZEETEXTDOMAIN ),
        'not_found_in_trash'        => __( 'No Portfolio item found in Trash',  ZEETEXTDOMAIN )
        );

$args = array(
    'labels'                        => $labels,
    'public'                        => true,
    'has_archive'                   => false,
    'exclude_from_search'           => true,
    'menu_icon'                     => get_template_directory_uri() . '/admin/images/icon-portfolio.png',
    'rewrite'                       => array( 'slug' => 'portfolio'),
    'capability_type'               => 'post',
    'supports'                      => array('title', 'editor', 'thumbnail', 'revisions')
    );

register_post_type('zee_portfolio', $args);

flush_rewrite_rules();

});

register_taxonomy('cat_portfolio',
    array('zee_portfolio'), 
    array(
        'label'                     => __('Categories',             ZEETEXTDOMAIN), 
        'hierarchical'              => false,
        'singular_label'            => __('Portfolio Categories',   ZEETEXTDOMAIN), 
        'rewrite'                   => true
        )
    );






/* Pricing Tables */
add_action('init', function(){

    $labels = array(
        'name'                      => __( 'Pricing Tables',            ZEETEXTDOMAIN ),
        'singular_name'             => __( 'Pricing Tables',            ZEETEXTDOMAIN ),
        'menu_name'                 => __( 'Pricing Tables',            ZEETEXTDOMAIN ),
        'all_items'                 => __( 'All Items',                 ZEETEXTDOMAIN ),
        'add_new'                   => __( 'Add New',                   ZEETEXTDOMAIN ),
        'add_new_item'              => __( 'Add New Item',              ZEETEXTDOMAIN ),
        'edit_item'                 => __( 'Edit Item',                 ZEETEXTDOMAIN ),
        'new_item'                  => __( 'New Item',                  ZEETEXTDOMAIN ),
        'view_item'                 => __( 'View Item',                 ZEETEXTDOMAIN ),
        'search_items'              => __( 'Search Items',              ZEETEXTDOMAIN ),
        'not_found'                 => __( 'No item found',             ZEETEXTDOMAIN ),
        'not_found_in_trash'        => __( 'No item found in Trash',    ZEETEXTDOMAIN )
        );

$args = array(
    'labels'                    => $labels,
    'public'                    => true,
    'has_archive'               => false,
    'exclude_from_search'       => true,
    'menu_icon'                 => get_template_directory_uri() . '/admin/images/icon-pricing.png',
    'rewrite'                   => true,
    'capability_type'           => 'post',
    'supports'                  => array('title', 'page-attributes', 'editor', 'revisions')
    );

register_post_type('zee_pricing', $args);
flush_rewrite_rules();
});



register_taxonomy('cat_pricing',
    array('zee_pricing'), 
    array(
        'label'                 => __('Categories', ZEETEXTDOMAIN), 
        'hierarchical'          =>    true,
        'singular_label'        => __('Category', ZEETEXTDOMAIN)
        )
    );


$prefix = 'pricing_';
$fields = array(

    array( 
        'label' => __('Featured', ZEETEXTDOMAIN), 
        'id'    => $prefix.'featured',
        'type'  => 'checkbox'
        ),

    array( 
        'label' => __('Price', ZEETEXTDOMAIN), 
        'desc'  => __('Price with currency symbol. eg. $49', ZEETEXTDOMAIN), 
        'id'    => $prefix.'price', 
        'type'  => 'text'
        ),

    array( 
        'label' => __('Price duration', ZEETEXTDOMAIN), 
        'desc'  => __('Pricing duration. eg. Moth, Day, Year etc.', ZEETEXTDOMAIN), 
        'id'    => $prefix.'duration', 
        'type'  => 'text' 
        ),

    array( 
        'label' => __('Button Text', ZEETEXTDOMAIN), 
        'desc'  => __('Pricing table button text, eg. Sign up', ZEETEXTDOMAIN), 
        'id'    => $prefix.'button_text', 
        'type'  => 'text' 
        ),

    array( 
        'label' => __('Button URL', ZEETEXTDOMAIN),
        'desc'  => __('Pricing table button url, eg. http://www.zeetheme.com/buy-now', ZEETEXTDOMAIN),
        'id'    => $prefix.'button_url', 
        'type'  => 'text' 
        )
    );


new Custom_Add_Meta_Box( 'zee_pricing_box', __('Price Settings', ZEETEXTDOMAIN), $fields, 'zee_pricing', true );



/* Faq */
add_action('init', function(){

    $labels = array(
        'name'                  => __( 'Faq',                       ZEETEXTDOMAIN ),
        'singular_name'         => __( 'Faq',                       ZEETEXTDOMAIN ),
        'menu_name'             => __( 'Faq',                       ZEETEXTDOMAIN ),
        'all_items'             => __( 'All Items',                 ZEETEXTDOMAIN ),
        'add_new'               => __( 'Add New',                   ZEETEXTDOMAIN ),
        'add_new_item'          => __( 'Add New Item',              ZEETEXTDOMAIN ),
        'edit_item'             => __( 'Edit Item',                 ZEETEXTDOMAIN ),
        'new_item'              => __( 'New Item',                  ZEETEXTDOMAIN ),
        'view_item'             => __( 'View Item',                 ZEETEXTDOMAIN ),
        'search_items'          => __( 'Search Items',              ZEETEXTDOMAIN ),
        'not_found'             => __( 'No item found',             ZEETEXTDOMAIN ),
        'not_found_in_trash'    => __( 'No item found in Trash',    ZEETEXTDOMAIN )
        );

$args = array(
    'labels'                => $labels,
    'public'                => true,
    'has_archive'           => false,
    'exclude_from_search'   => true,
    'menu_icon'             => get_template_directory_uri() . '/admin/images/icon-faq.png',
    'rewrite'               => true,
    'capability_type'       => 'post',
    'supports'              => array('title', 'page-attributes', 'editor', 'revisions')
    );
register_post_type('zee_faq', $args);
flush_rewrite_rules();

});



/* Service  */
add_action('init', function(){

    $labels = array(
        'name'                  => __( 'Services',                  ZEETEXTDOMAIN ),
        'singular_name'         => __( 'Service',                   ZEETEXTDOMAIN ),
        'menu_name'             => __( 'Services',                  ZEETEXTDOMAIN ),
        'all_items'             => __( 'All Items',                 ZEETEXTDOMAIN ),
        'add_new'               => __( 'Add New',                   ZEETEXTDOMAIN ),
        'add_new_item'          => __( 'Add New Item',              ZEETEXTDOMAIN ),
        'edit_item'             => __( 'Edit Item',                 ZEETEXTDOMAIN ),
        'new_item'              => __( 'New Item',                  ZEETEXTDOMAIN ),
        'view_item'             => __( 'View Item',                 ZEETEXTDOMAIN ),
        'search_items'          => __( 'Search Items',              ZEETEXTDOMAIN ),
        'not_found'             => __( 'No item found',             ZEETEXTDOMAIN ),
        'not_found_in_trash'    => __( 'No item found in Trash',    ZEETEXTDOMAIN )
        );

$args = array(
    'labels'                => $labels,
    'public'                => true,
    'has_archive'           => false,
    'exclude_from_search'   => true,
    'menu_icon'             => get_template_directory_uri() . '/admin/images/icon-services.png',
    'rewrite'               => true,
    'capability_type'       => 'post',
    'supports'              => array('title', 'page-attributes', 'editor')
    );
register_post_type('zee_service', $args);
flush_rewrite_rules();

});

register_taxonomy('cat_service',
    array('zee_service'), 
    array(
        'label'                 => __('Categories', ZEETEXTDOMAIN), 
        'hierarchical'          =>    true,
        'singular_label'        => __('Category',   ZEETEXTDOMAIN)
        )
    );



$prefix = 'service_';
$fields = array(

    array( 
        'label' => __('Icon', ZEETEXTDOMAIN), 
        'id'    => $prefix.'icon',
        'type'  => 'icons',
        'options'=>$fontawesome_icons
        ),  

    array( 
        'label' => __('Icon Color', ZEETEXTDOMAIN), 
        'id'    => $prefix.'color',
        'type'  => 'color'
        ),  
    );

new Custom_Add_Meta_Box( 'zee_service_box', __('Styling Options', ZEETEXTDOMAIN), $fields, 'zee_service', true );



// page subtitle

$prefix = 'page_';
$fields = array(

    array( 
        'label' => __('Subtitle', ZEETEXTDOMAIN), 
        'id'    => $prefix.'subtitle',
        'type'  => 'text'
        ) 
    );

new Custom_Add_Meta_Box( 'zee_page_box', __('Subtitle Options', ZEETEXTDOMAIN), $fields, 'page', true );



/* Tabs */
add_action('init', function(){

    $labels = array(
        'name'                  => __( 'Tabs',                      ZEETEXTDOMAIN ),
        'singular_name'         => __( 'Tabs',                      ZEETEXTDOMAIN ),
        'menu_name'             => __( 'Tabs',                      ZEETEXTDOMAIN ),
        'all_items'             => __( 'All Items',                 ZEETEXTDOMAIN ),
        'add_new'               => __( 'Add New',                   ZEETEXTDOMAIN ),
        'add_new_item'          => __( 'Add New Item',              ZEETEXTDOMAIN ),
        'edit_item'             => __( 'Edit Item',                 ZEETEXTDOMAIN ),
        'new_item'              => __( 'New Item',                  ZEETEXTDOMAIN ),
        'view_item'             => __( 'View Item',                 ZEETEXTDOMAIN ),
        'search_items'          => __( 'Search Items',              ZEETEXTDOMAIN ),
        'not_found'             => __( 'No item found',             ZEETEXTDOMAIN ),
        'not_found_in_trash'    => __( 'No item found in Trash',    ZEETEXTDOMAIN )
        );

$args = array(
    'labels'                => $labels,
    'public'                => true,
    'has_archive'           => false,
    'exclude_from_search'   => true,
    'menu_icon'             => get_template_directory_uri() . '/admin/images/icon-tab.png',
    'rewrite'               => true,
    'capability_type'       => 'post',
    'supports'              => array('title', 'editor', 'revisions')
    );
register_post_type('zee_tab', $args);
flush_rewrite_rules();

});

register_taxonomy('cat_tabs',
    array('zee_tab'), 
    array(
        'label'                 => __('Categories', ZEETEXTDOMAIN), 
        'hierarchical'          => true,
        'singular_label'        => __('Category',   ZEETEXTDOMAIN)
        )
    );




/* Accordion */
add_action('init', function(){

    $labels = array(
        'name'                  => __( 'Accordions',                ZEETEXTDOMAIN ),
        'singular_name'         => __( 'Accordion',                 ZEETEXTDOMAIN ),
        'menu_name'             => __( 'Accordions',                ZEETEXTDOMAIN ),
        'all_items'             => __( 'All Items',                 ZEETEXTDOMAIN ),
        'add_new'               => __( 'Add New',                   ZEETEXTDOMAIN ),
        'add_new_item'          => __( 'Add New Item',              ZEETEXTDOMAIN ),
        'edit_item'             => __( 'Edit Item',                 ZEETEXTDOMAIN ),
        'new_item'              => __( 'New Item',                  ZEETEXTDOMAIN ),
        'view_item'             => __( 'View Item',                 ZEETEXTDOMAIN ),
        'search_items'          => __( 'Search Items',              ZEETEXTDOMAIN ),
        'not_found'             => __( 'No item found',             ZEETEXTDOMAIN ),
        'not_found_in_trash'    => __( 'No item found in Trash',    ZEETEXTDOMAIN )
        );

$args = array(
    'labels'                => $labels,
    'public'                => true,
    'has_archive'           => false,
    'exclude_from_search'   => true,
    'menu_icon'             => get_template_directory_uri() . '/admin/images/icon-accordion.png',
    'rewrite'               => true,
    'capability_type'       => 'post',
    'supports'              => array('title', 'editor', 'revisions')
    );
register_post_type('zee_accordion', $args);
flush_rewrite_rules();

});

register_taxonomy('cat_accordions',
    array('zee_accordion'), 
    array(
        'label'                 => __('Categories', ZEETEXTDOMAIN), 
        'hierarchical'          => true,
        'singular_label'        => __('Category',   ZEETEXTDOMAIN), 
        'rewrite'               => true
        )
    );

/* Testimonial */
add_action('init', function(){

    $labels = array(
        'name'                  => __( 'Testimonials',              ZEETEXTDOMAIN ),
        'singular_name'         => __( 'Testimonial',               ZEETEXTDOMAIN ),
        'menu_name'             => __( 'Testimonials',              ZEETEXTDOMAIN ),
        'all_items'             => __( 'All Items',                 ZEETEXTDOMAIN ),
        'add_new'               => __( 'Add New',                   ZEETEXTDOMAIN ),
        'add_new_item'          => __( 'Add New Item',              ZEETEXTDOMAIN ),
        'edit_item'             => __( 'Edit Item',                 ZEETEXTDOMAIN ),
        'new_item'              => __( 'New Item',                  ZEETEXTDOMAIN ),
        'view_item'             => __( 'View Item',                 ZEETEXTDOMAIN ),
        'search_items'          => __( 'Search Items',              ZEETEXTDOMAIN ),
        'not_found'             => __( 'No item found',             ZEETEXTDOMAIN ),
        'not_found_in_trash'    => __( 'No item found in Trash',    ZEETEXTDOMAIN )
        );

$args = array(
    'labels'                => $labels,
    'public'                => true,
    'has_archive'           => false,
    'exclude_from_search'   => true,
    'menu_icon'             => get_template_directory_uri() . '/admin/images/icon-testimonial.png',
    'capability_type'       => 'post',
    'supports'              => array('title', 'editor')
    );

register_post_type('zee_testimonial', $args);
flush_rewrite_rules();
});



$prefix = 'testimonial_';
$fields = array(
    array( 
        'label' => __('Designation', ZEETEXTDOMAIN), 
        'id'    => $prefix.'designation',
        'type'  => 'text'
        )
    );

new Custom_Add_Meta_Box( 'zee_testimonial_meta', __('Testimonial Settings', ZEETEXTDOMAIN), $fields, 'zee_testimonial', true );

/**
* Add common scripts and stylesheets
*/

if( ! function_exists('zee_pagination') ){

/**
 * Display pagination
 * @return [string] [pagination]
 */
function zee_pagination() {
    global $wp_query;
    if ($wp_query->max_num_pages > 1) {
            $big = 999999999; // need an unlikely integer
            $items =  paginate_links( array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'prev_next'    => true,
                'current' => max( 1, get_query_var('paged') ),
                'total' => $wp_query->max_num_pages,
                'type'=>'array'
                ) );

            $pagination ="<ul class='pagination'>\n\t<li>";
            $pagination .=join("</li>\n\t<li>", $items);
            $pagination ."</li>\n</ul>\n";
            
            return $pagination;
        }
        return;
    }   

}



if ( ! function_exists( 'zee_post_nav' ) ) {


/**
 * Display post nav
 * @return [type] [description]
 */

function zee_post_nav() {
    global $post;

    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next and ! $previous ){
        return;
    } 
    ?>
    <nav class="navigation post-navigation" role="navigation">
        <div class="pager">
            <?php if ( $previous ) { ?>
            <li class="previous">
                <?php previous_post_link( '%link', _x( '<i class="icon-long-arrow-left"></i> %title', 'Previous post link', ZEETEXTDOMAIN ) ); ?>
            </li>
            <?php } ?>

            <?php if ( $next ) { ?>
            <li class="next"><?php next_post_link( '%link', _x( '%title <i class="icon-long-arrow-right"></i>', 'Next post link', ZEETEXTDOMAIN ) ); ?></li>
            <?php } ?>

        </div><!-- .nav-links -->
    </nav><!-- .navigation -->
    <?php
}
}


if( ! function_exists('zee_link_pages') ){

    function zee_link_pages($args = '') {
        $defaults = array(
            'before' => '' ,
            'after' => '',
            'link_before' => '', 
            'link_after' => '',
            'next_or_number' => 'number', 
            'nextpagelink' => __('Next page', ZEETEXTDOMAIN),
            'previouspagelink' => __('Previous page', ZEETEXTDOMAIN), 
            'pagelink' => '%',
            'echo' => 1
            );

        $r = wp_parse_args( $args, $defaults );
        $r = apply_filters( 'wp_link_pages_args', $r );
        extract( $r, EXTR_SKIP );

        global $page, $numpages, $multipage, $more, $pagenow;

        $output = '';
        if ( $multipage ) {
            if ( 'number' == $next_or_number ) {
                $output .= $before . '<ul class="pagination">';
                $laquo = $page == 1 ? 'class="disabled"' : '';
                $output .= '<li ' . $laquo .'>' . _wp_link_page($page -1) . '&laquo;</li>';
                for ( $i = 1; $i < ($numpages+1); $i = $i + 1 ) {
                    $j = str_replace('%',$i,$pagelink);

                    if ( ($i != $page) || ((!$more) && ($page==1)) ) {
                        $output .= '<li>';
                        $output .= _wp_link_page($i) ;
                    }
                    else{
                        $output .= '<li class="active">';
                        $output .= _wp_link_page($i) ;
                    }
                    $output .= $link_before . $j . $link_after ;

                    $output .= '</li>';
                }
                $raquo = $page == $numpages ? 'class="disabled"' : '';
                $output .= '<li ' . $raquo .'>' . _wp_link_page($page +1) . '&raquo;</li>';
                $output .= '</ul>' . $after;
            } else {
                if ( $more ) {
                    $output .= $before . '<ul class="pager">';
                    $i = $page - 1;
                    if ( $i && $more ) {
                        $output .= '<li class="previous">' . _wp_link_page($i);
                        $output .= $link_before. $previouspagelink . $link_after . '</li>';
                    }
                    $i = $page + 1;
                    if ( $i <= $numpages && $more ) {
                        $output .= '<li class="next">' .  _wp_link_page($i);
                        $output .= $link_before. $nextpagelink . $link_after . '</li>';
                    }
                    $output .= '</ul>' . $after;
                }
            }
        }

        if ( $echo ){
            echo $output;
        } else {
            return $output;
        } 
    }
}



if( ! function_exists('zee_get_avatar_url') ){
/**
 * Get avatar url
 * @param  [string] $get_avatar [Avater image link]
 * @return [string]             [image link]
 */
function zee_get_avatar_url($get_avatar){
    preg_match("/src='(.*?)'/i", $get_avatar, $matches);
    return $matches[1];
}
}




if( ! function_exists("zee_comments_list") ){

/**
 * Comments link
 * @param   $comment [comments]
 * @param   $args    [arguments]
 * @param   $depth   [depth]
 * @return void          
 */
function zee_comments_list($comment, $args, $depth) {

    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) {
        case 'pingback' :
        case 'trackback' :
        // Display trackbacks differently than normal comments.
        ?>
        <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <p><?php _e( 'Pingback:', ZEETEXTDOMAIN ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', ZEETEXTDOMAIN ), '<span class="edit-link">', '</span>' ); ?></p>
            <?php
            break;
            default :
            // Proceed with normal comments.
            global $post;
            ?>
            <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                <div id="comment-<?php comment_ID(); ?>" class="comment media">
                    <div class="pull-left comment-author vcard">
                        <?php 
                        $get_avatar = get_avatar( $comment, 48 );
                        $avatar_img = zee_get_avatar_url($get_avatar);
                             //Comment author avatar 
                        ?>
                        <img class="avatar img-circle" src="<?php echo $avatar_img ?>" alt="">
                    </div>

                    <div class="media-body">

                        <div class="well">

                            <div class="comment-meta media-heading">
                                <span class="author-name">
                                    <?php _e('By', ZEETEXTDOMAIN); ?> <strong><?php echo get_comment_author(); ?></strong>
                                </span>
                                -
                                <time datetime="<?php echo get_comment_date(); ?>">
                                    <?php echo get_comment_date(); ?> <?php echo get_comment_time(); ?>
                                    <?php edit_comment_link( __( 'Edit', ZEETEXTDOMAIN ), '<small class="edit-link">', '</small>' ); //edit link ?>
                                </time>

                                <span class="reply pull-right">
                                    <?php comment_reply_link( array_merge( $args, array( 'reply_text' =>  sprintf( __( '%s Reply', ZEETEXTDOMAIN ), '<i class="icon-repeat"></i> ' ) , 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                                </span><!-- .reply -->
                            </div>

                            <?php if ( '0' == $comment->comment_approved ) {  //Comment moderation ?>
                            <div class="alert alert-info"><?php _e( 'Your comment is awaiting moderation.', ZEETEXTDOMAIN ); ?></div>
                            <?php } ?>

                            <div class="comment-content comment">
                                <?php comment_text(); //Comment text ?>
                            </div><!-- .comment-content -->

                        </div><!-- .well -->


                    </div>
                </div><!-- #comment-## -->
                <?php
                break;
} // end comment_type check

}

}

// registering sidebar

register_sidebar(array(
  'name' => __( 'Sidebar', ZEETEXTDOMAIN ),
  'id' => 'sidebar',
  'description' => __( 'Widgets in this area will be shown on right side.', ZEETEXTDOMAIN ),
  'before_title' => '<h3>',
  'after_title' => '</h3>',
  'before_widget' => '<div>',
  'after_widget' => '</div>'
  )
);

register_sidebar(array(
  'name' => __( 'Bottom', ZEETEXTDOMAIN ),
  'id' => 'bottom',
  'description' => __( 'Widgets in this area will be shown before Footer.' , ZEETEXTDOMAIN),
  'before_title' => '<h3>',
  'after_title' => '</h3>',
  'before_widget' => '<div class="col-sm-3 col-xs-6">',
  'after_widget' => '</div>'
  )
);

if( ! function_exists('zee_comment_form') ){

/**
 * Comment form
 */

function zee_comment_form($args = array(), $post_id = null ){


    if ( null === $post_id )
        $post_id = get_the_ID();
    else
        $id = $post_id;

    $commenter = wp_get_current_commenter();
    $user = wp_get_current_user();
    $user_identity = $user->exists() ? $user->display_name : '';

    if ( ! isset( $args['format'] ) )
        $args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';


    $req      = get_option( 'require_name_email' );

    $aria_req = ( $req ? " aria-required='true'" : '' );

    $html5    = 'html5' === $args['format'];

    $fields   =  array(
        'author' => '
        <div class="form-group">
        <div class="col-sm-6 comment-form-author">
        <input   class="form-control"  id="author" 
        placeholder="' . __( 'Name', ZEETEXTDOMAIN ) . '" name="author" type="text" 
        value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' />
        </div>',


        'email'  => '<div class="col-sm-6 comment-form-email">
        <input id="email" class="form-control" name="email" 
        placeholder="' . __( 'Email', ZEETEXTDOMAIN ) . '" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' 
        value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' />
        </div>
        </div>',
        

        'url'    => '<div class="form-group">
        <div class=" col-sm-12 comment-form-url">' .
        '<input  class="form-control" placeholder="'. __( 'Website', ZEETEXTDOMAIN ) .'"  id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '"  />
        </div></div>',

        );

$required_text = sprintf( ' ' . __('Required fields are marked %s', ZEETEXTDOMAIN), '<span class="required">*</span>' );

$defaults = array(
    'fields'               => apply_filters( 'comment_form_default_fields', $fields ),

    'comment_field'        => '
    <div class="form-group comment-form-comment">
    <div class="col-sm-12">
    <textarea class="form-control" id="comment" name="comment" placeholder="' . _x( 'Comment', 'noun', ZEETEXTDOMAIN ) . '" rows="8" aria-required="true"></textarea>
    </div>
    </div>
    ',

    'must_log_in'          => '


    <div class="alert alert-danger must-log-in">' 
    . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) 
    . '</div>',

    'logged_in_as'         => '<div class="alert alert-info logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', ZEETEXTDOMAIN ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</div>',

    'comment_notes_before' => '<div class="alert alert-info comment-notes">' . __( 'Your email address will not be published.', ZEETEXTDOMAIN ) . ( $req ? $required_text : '' ) . '</div>',

    'comment_notes_after'  => '<div class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', ZEETEXTDOMAIN ), ' <code>' . allowed_tags() . '</code>' ) . '</div>',

    'id_form'              => 'commentform',

    'id_submit'            => 'submit',

    'title_reply'          => __( 'Leave a Reply', ZEETEXTDOMAIN ),

    'title_reply_to'       => __( 'Leave a Reply to %s', ZEETEXTDOMAIN ),

    'cancel_reply_link'    => __( 'Cancel reply', ZEETEXTDOMAIN ),

    'label_submit'         => __( 'Post Comment', ZEETEXTDOMAIN ),

    'format'               => 'xhtml',
    );


$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

if ( comments_open( $post_id ) ) { ?>

<?php do_action( 'comment_form_before' ); ?>

<div id="respond" class="comment-respond">

    <h3 id="reply-title" class="comment-reply-title">
        <?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> 
        <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small>
    </h3>

    <?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) { ?>

    <?php echo $args['must_log_in']; ?>

    <?php do_action( 'comment_form_must_log_in_after' ); ?>

    <?php } else { ?>

    <form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" 
        class="form-horizontal comment-form"<?php echo $html5 ? ' novalidate' : ''; ?> role="form">
        <?php do_action( 'comment_form_top' ); ?>

        <?php if ( is_user_logged_in() ) { ?>

        <?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>

        <?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>

        <?php } else { ?>

        <?php echo $args['comment_notes_before']; ?>

        <?php

        do_action( 'comment_form_before_fields' );

        foreach ( (array) $args['fields'] as $name => $field ) {
            echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
        }

        do_action( 'comment_form_after_fields' );

    } 

    echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); 

    echo $args['comment_notes_after']; ?>

    <div class="form-submit">
        <input class="btn btn-danger btn-lg" name="submit" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
        <?php comment_id_fields( $post_id ); ?>
    </div>

    <?php do_action( 'comment_form', $post_id ); ?>

</form>

<?php } ?>

</div><!-- #respond -->
<?php do_action( 'comment_form_after' ); ?>
<?php } else { ?>
<?php do_action( 'comment_form_comments_closed' ); ?>
<?php } ?>
<?php


}

}


if( ! function_exists('zee_post_password_form') ){

/**
 * post password form
 */

function zee_post_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );

    $o = '
    <div class="row">
    <form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    <div class="col-lg-6">
    ' . __( "To view this protected post, enter the password below:", ZEETEXTDOMAIN ) . '
    <div class="input-group">
    <input class="form-control" name="post_password" placeholder="' . __( "Password:", ZEETEXTDOMAIN ) . '" id="' . $label . '" type="password" /><span class="input-group-btn"><button class="btn btn-info" type="submit" name="Submit">' . esc_attr__( "Submit", ZEETEXTDOMAIN ) . '</button></span>
    </div><!-- /input-group -->
    </div><!-- /.col-lg-12 -->
    </form>
    </div>';
    return $o;
}

add_filter( 'the_password_form', 'zee_post_password_form' );
}



if ( ! function_exists( 'zee_the_attached_image' ) ) {
/**
 * Prints the attached image with a link to the next attached image.
 *
 *
 * @return void
 */
function zee_the_attached_image() {
    $post                = get_post();
    $attachment_size     = array( 724, 724 );
    $next_attachment_url = wp_get_attachment_url();

    /**
     * Grab the IDs of all the image attachments in a gallery so we can get the URL
     * of the next adjacent image in a gallery, or the first image (if we're
     * looking at the last image in a gallery), or, in a gallery of one, just the
     * link to that image file.
     */
    $attachment_ids = get_posts( array(
        'post_parent'    => $post->post_parent,
        'fields'         => 'ids',
        'numberposts'    => -1,
        'post_status'    => 'inherit',
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'order'          => 'ASC',
        'orderby'        => 'menu_order ID'
        ) );

    // If there is more than 1 attachment in a gallery...
    if ( count( $attachment_ids ) > 1 ) {
        foreach ( $attachment_ids as $attachment_id ) {
            if ( $attachment_id == $post->ID ) {
                $next_id = current( $attachment_ids );
                break;
            }
        }

        // get the URL of the next image attachment...
        if ( $next_id )
            $next_attachment_url = get_attachment_link( $next_id );

        // or get the URL of the first image attachment.
        else
            $next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
    }

    printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
        esc_url( $next_attachment_url ),
        the_title_attribute( array( 'echo' => false ) ),
        wp_get_attachment_image( $post->ID, $attachment_size )
        );
}
}

