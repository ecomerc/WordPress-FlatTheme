<?php
add_action('init','of_options');

if (!function_exists('of_options'))
{
    function of_options()
    {
        global $of_options, $zee_googlefonts;

        $of_options     = array();

    // General Settings

        $of_options[]   = array(  
            "name"      => __('General Settings',ZEETEXTDOMAIN),
            "type"      => "heading"
            );

        $of_options[]   = array(  
            "name"      => __("Favicon",ZEETEXTDOMAIN),
            "desc"      => __("Upload favicon image", ZEETEXTDOMAIN),
            "id"        => "zee_favicon",
            "folds"     => "favicon",
            "type"      => "upload",
            "mod"       => "min"
            );

        $of_options[]   = array(  
            "name"      => __("Logo option heading",ZEETEXTDOMAIN),
            "desc"      => "",
            "id"        => "zee_logo_opt_info",
            "std"       => "<h3 style=\"margin: 3px;\">Logo options</h3>",
            "icon"      => true,
            "type"      => "info"
            );

        $of_options[]   = array(  
            "name"      => __("Show Logo",ZEETEXTDOMAIN),
            "desc"      => __("Show or hide site logo",ZEETEXTDOMAIN),
            "id"        => "zee_show_logo",
            "std"       => 0,
            "folds"     => 1,
            "type"      => "switch"
            );

        $of_options[]   = array(  
            "name"      => __("Upload Standard Logo",ZEETEXTDOMAIN),
            "desc"      => __("Upload logo and select from media manager.",ZEETEXTDOMAIN),
            "id"        => "site_logo",
            "std"       => "",
            "type"      => "upload",
            "fold"      => "zee_show_logo", /* the switch hook */
            "mod"       => "min"                        
            );

        $of_options[]   = array(  
            "name"      => __("Logo Margin from Top",ZEETEXTDOMAIN),
            "desc"      => __("Note: You need to insert only numeric value",ZEETEXTDOMAIN),
            "id"        => "zee_logo_margin_top",
            "std"       => 0,
            "fold"      => "zee_show_logo",
            "type"      => "text"
            );

        $of_options[]   = array(  
            "name"      => __("Logo Margin from Bottom",ZEETEXTDOMAIN),
            "desc"      => __("Note: You need to insert only numeric value",ZEETEXTDOMAIN),
            "id"        => "zee_logo_margin_bottom",
            "std"       => 0,
            "fold"      => "zee_show_logo",
            "type"      => "text"
            );

        $of_options[]   = array(  
            "name"      => __("Apple Icon options",ZEETEXTDOMAIN),
            "desc"      => "",
            "id"        => "zee_apple_logo",
            "std"       => "<h3 style=\"margin: 3px;\">Apple Icon options</h3>",
            "icon"      => true,
            "type"      => "info",
            );

        $of_options[]   = array(  
            "name"      => __("Apple Icon",ZEETEXTDOMAIN),
            "desc"      => __("Show or hide Apple Icon",ZEETEXTDOMAIN),
            "id"        => "zee_show_apple_logo",
            "std"       => 0,
            "folds"     => 1,
            "type"      => "switch"
            );

        $of_options[]   = array(  
            "name"      => __("iPhone icon",ZEETEXTDOMAIN),
            "desc"      => __("Upload iPhone icon",ZEETEXTDOMAIN),
            "id"        => "zee_apple_iphone_icon",
            "type"      => "upload",
            "mod"       => "min",
            "fold"      => "zee_show_apple_logo"
            );

        $of_options[]   = array(  
            "name"      => __("iPhone retina icon", ZEETEXTDOMAIN),
            "desc"      => __("Upload 114x114 px iPhone retina icon",ZEETEXTDOMAIN),
            "id"        => "zee_apple_iphone_retina_icon",
            "type"      => "upload",
            "mod"       => "min",
            "fold"      => "zee_show_apple_logo"
            );

        $of_options[]   = array(  
            "name"      => __("iPad icon",ZEETEXTDOMAIN),
            "desc"      => __("Upload 72x72 px iPad icon",ZEETEXTDOMAIN),
            "id"        => "zee_apple_ipad_icon",
            "type"      => "upload",
            "mod"       => "min",
            "fold"      => "zee_show_apple_logo"
            );

        $of_options[]   = array(  
            "name"      => __("iPad retina icon",ZEETEXTDOMAIN),
            "desc"      => __("Upload 144x144 px iPad retina icon",ZEETEXTDOMAIN),
            "id"        => "zee_apple_ipad_retina_icon",
            "type"      => "upload",
            "mod"       => "min",
            "fold"      => "zee_show_apple_logo"
            );

        $of_options[]   = array(  
            "name"      => __("Theme Layout",ZEETEXTDOMAIN),
            "desc"      => "",
            "id"        => "zee_theme_layout_settings",
            "std"       => "<h3 style=\"margin: 3px;\">Theme Layout</h3>",
            "icon"      => true,
            "type"      => "info"
            );

        $of_options[]   = array(  
            "name"      => __("Theme Layout Style",ZEETEXTDOMAIN),
            "desc"      => __("Choose the Theme layout style.",ZEETEXTDOMAIN),
            "id"        => "zee_theme_layout",
            "std"       => 1,
            "folds"     => 1,
            "type"      => "select",
            "options"   => array("fullwidth" => "Full Width","boxed" => "Boxed Layout")
            );

    // Header Options

        $of_options[]   = array(  
            "name"      => __("Header and Footer", ZEETEXTDOMAIN),
            "type"      => "heading",
            "icon"      => ZEE_IMAGES . "header-and-footer.png"
            );

        $of_options[]   = array(  
            "name"      => __("Header", ZEETEXTDOMAIN),
            "desc"      => "",
            "id"        => "zee_header",
            "std"       => "<h3 style=\"margin: 3px;\">Header</h3>",
            "icon"      => true,
            "type"      => "info"
            );

        $of_options[]   = array(  
            "name"      => __("Header Background", ZEETEXTDOMAIN),
            "desc"      => __("Header background color (default: #34495e).",ZEETEXTDOMAIN),
            "id"        => "zee_header_background",
            "std"       => "#34495e",
            "type"      => "color"
            );

        $of_options[]   = array(  
            "name"      => __("Footer section", ZEETEXTDOMAIN),
            "desc"      => "",
            "id"        => "zee_footer_section_info",
            "std"       => "<h3 style=\"margin: 3px;\">Footer section</h3>",
            "icon"      => true,
            "type"      => "info"
            );

        $of_options[]   = array(  
            "name"      => __("Show Copyright", ZEETEXTDOMAIN),
            "desc"      => "",
            "id"        => "zee_footer_text_info",
            "std"       => 1,
            "folds"     => 1,
            "type"      => "switch"
            );

        $of_options[]   = array(  
            "name"      => __("Copyright Text", ZEETEXTDOMAIN),
            "desc"      => __("Insert Copyright Text.",ZEETEXTDOMAIN),
            "id"        => "zee_copyright_text",
            "fold"      => "zee_footer_text_info",
            "std"       => '&copy; 2013 <a target="_blank" href="http://shapebootstrap.net/" title="Free Twitter Bootstrap based WordPress Themes and HTML templates">ShapeBootstrap</a>. All Rights Reserved.',
            "type"      => "textarea"
            );  


        $of_options[]   = array(  
            "name"      => __("Google Analytics Code", ZEETEXTDOMAIN),
            "desc"      => __("Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",ZEETEXTDOMAIN),
            "id"        => "zee_google_analytics",
            "std"       => "",
            "type"      => "textarea"
            );


// Blog Options

        $of_options[]   = array(  
            "name"      => __("Blog",ZEETEXTDOMAIN),
            "type"      => "heading",
            "icon"      => ZEE_IMAGES . "pencil.png"
            );

        $of_options[]   = array(  
            "name"      => __("Blog Title",ZEETEXTDOMAIN),
            "desc"      => __("Blog Title",ZEETEXTDOMAIN),
            "id"        => "zee_blog_title",
            "std"       => "Blog",
            "folds"     => 1,
            "type"      => "text"               
            );
        $of_options[]   = array(  
            "name"      => __("Blog Sub Title",ZEETEXTDOMAIN),
            "desc"      => __("Blog Sub Title",ZEETEXTDOMAIN),
            "id"        => "zee_blog_subtitle",
            "std"       => "Blog Sub Title",
            "folds"     => 1,
            "type"      => "text"               
            );


        $of_options[]   = array(  
            "name"      => __("Author BIO on Single Post?",ZEETEXTDOMAIN),
            "desc"      => __("Whether to show or hide the Author BIO from single post",ZEETEXTDOMAIN),
            "id"        => "zee_single_post_author",
            "std"       => "",
            "type"      => "switch"                 
            );

        $of_options[]   = array(  
            "name"      => __("Show Comments On Page",ZEETEXTDOMAIN),
            "desc"      => __("On / Off comments from all pages",ZEETEXTDOMAIN),
            "id"        => "zee_blog_comments",
            "std"       => 1,
            "folds"     => 1,
            "type"      => "switch"                 
            );


        $of_options[]   = array(  
            "name"      => __("Excerpt Length",ZEETEXTDOMAIN),
            "id"        => "zee_excerpt_len",
            "std"       => "",
            "type"      => "text"   
            );


// Styling Options

        $of_options[]   = array(  
            "name"      => __("Styling Options",ZEETEXTDOMAIN),
            "type"      => "heading"
            );

        $of_options[]   = array(  
            "name"      => __("General",ZEETEXTDOMAIN),
            "desc"      => "",
            "id"        => "zee_colors_and_styling_info",
            "std"       => "<h3 style=\"margin: 3px;\">General</h3>",
            "icon"      => true,
            "type"      => "info"
            );

        $of_options[]   = array(  
            "name"      => __("Link Color",ZEETEXTDOMAIN),
            "desc"      => __("Pick a link color (default: #428bca).",ZEETEXTDOMAIN),
            "id"        => "zee_link_color",
            "std"       => "#428bca",
            "type"      => "color"
            );
        $of_options[]   = array(  
            "name"      => __("Link Hover Color",ZEETEXTDOMAIN),
            "desc"      => __("Pick a link hover color (default: #d9534f).",ZEETEXTDOMAIN),
            "id"        => "zee_link_hover_color",
            "std"       => "#d9534f",
            "type"      => "color"
            );

        $of_options[]   = array(  
            "name"      => __("Body Section",ZEETEXTDOMAIN),
            "desc"      => "",
            "id"        => "zee_body_section",
            "std"       => "<h3 style=\"margin: 3px;\">Body Section</h3>",
            "icon"      => true,
            "type"      => "info"
            );
        $of_options[]   = array(  
            "name"      => __("Body Background Color",ZEETEXTDOMAIN),
            "desc"      => __("Pick a background color for the theme (default: #f5f5f5).",ZEETEXTDOMAIN),
            "id"        => "zee_body_background",
            "std"       => "#f5f5f5",
            "type"      => "color"
            );

        $of_options[]   = array(  
            "name"      => __("Body Font Style",ZEETEXTDOMAIN),
            "desc"      => __("Default color #34495e, font: Roboto, font-size:14px",ZEETEXTDOMAIN),
            "id"        => "zee_body_text_font",
            "std"       => array('size' => '14px', 'color' =>"#34495e", 'google_fonts'=>array( 'fonts'=>$zee_googlefonts, 'preview_size'=>'16px', 'face' => 'Roboto' ) ), 
            "type"      => "typography",                    
            );
        
        $of_options[]   = array(  
            "name"      => __("Heading Font",ZEETEXTDOMAIN),
            "desc"      => __("Default font: Roboto.",ZEETEXTDOMAIN),
            "id"        => "zee_heading_font",
            "std"       => array('google_fonts'=>array( 'fonts'=>$zee_googlefonts, 'face' => 'Roboto' ) ), 
            "type"      => "typography"
            );

// Contact Options
        $of_options[]   = array(    
            "name"      => __("Contact",ZEETEXTDOMAIN),
            "type"      => "heading",                       
            "icon"      => ZEE_IMAGES . "folder_contact.png"
            );
        $of_options[]   = array(    
            "name"      => __("Contact Details",ZEETEXTDOMAIN),
            "desc"      => "",
            "id"        => "zee_contact_details",
            "std"       => "<h3 style=\"margin: 3px;\">Social Links</h3>",
            "icon"      => true,
            "type"      => "info"
            );
        $of_options[]   = array(    
            "name"      => __("Google Map Location",ZEETEXTDOMAIN),
            "desc"      => __("(State,Country)",ZEETEXTDOMAIN),
            "id"        => "zee_contact_map_location",
            "std"       => "",
            "type"      => "text"
            );
        $of_options[]   = array(    
            "name"      => __("Google Map Height",ZEETEXTDOMAIN),
            "desc"      => __("(In pixels or percentage, e.g.:100px or 100%",ZEETEXTDOMAIN),
                "id"        => "zee_contact_map_height",
                "std"       => "400px",
                "type"      => "text"
                );


        $of_options[]   = array(    
            "name"      => __("Contact Email Address",ZEETEXTDOMAIN),
            "desc"      => "Example: admin@example.com",
            "id"        => "zee_contact_email",
            "std"       => "",
            "type"      => "text"
            );



//Advanced Settings

        $of_options[]   = array(  
            "name"      => __("Advanced Settings",ZEETEXTDOMAIN),
            "type"      => "heading",
            "icon"      => ZEE_IMAGES . "icon-settings.png"
            );

        $of_options[]   = array(  
            "name"      => __("Exclude Pages from Search",ZEETEXTDOMAIN),
            "desc"      => __("This will enable or disable Breadcrumbs.",ZEETEXTDOMAIN),
            "id"        => "zee_exclude_search_page",
            "std"       => 1,
            "type"      => "switch"                 
            );

        $of_options[]   = array(  
            "name"      => __("Breadcrumbs",ZEETEXTDOMAIN),
            "desc"      => __("This will enable or disable Breadcrumbs.",ZEETEXTDOMAIN),
            "id"        => "zee_breadcumbs",
            "std"       => "",
            "type"      => "switch"                 
            );

        $of_options[]   = array(  
            "name"      => __("Login Logo",ZEETEXTDOMAIN),
            "desc"      => __("Change Login Logo.",ZEETEXTDOMAIN),
            "id"        => "zee_logo_login",
            "type"      => "upload",
            "mod"       => "min"
            );

// Custom CSS
        $of_options[]   = array(  
            "name"      => __("Custom CSS",ZEETEXTDOMAIN),
            "type"      => "heading", 
            "icon"      => ZEE_IMAGES . "custom-css.png"
            );
        $of_options[]   = array(  
            "name"      => __("Custom CSS",ZEETEXTDOMAIN),
            "desc"      => "",
            "id"        => "zee_custom_css_info",
            "std"       => "<h3 style=\"margin: 3px;\">Enter the Custom CSS of your custom Modify.</h3>",
            "icon"      => true,
            "type"      => "info"
            );

        $of_options[]   = array(  
            "name"      => __("Custom CSS",ZEETEXTDOMAIN),
            "id"        => "zee_custom_css",
            "std"       => "",
            "type"      => "textarea"
            );

// Backup Options
        $of_options[]   = array(  
            "name"      => __("Backup Options",ZEETEXTDOMAIN),
            "type"      => "heading",
            "icon"      => ADMIN_IMAGES . "icon-slider.png"
            );

        $of_options[]   = array(  
            "name"      => __("Backup and Restore Options",ZEETEXTDOMAIN),
            "id"        => "zee_of_backup",
            "std"       => "",
            "type"      => "backup",
            "desc"      => __('You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',ZEETEXTDOMAIN),
            );

        $of_options[]   = array(  
            "name"      => __("Transfer Theme Options Data",ZEETEXTDOMAIN),
            "id"        => "zee_of_transfer",
            "std"       => "",
            "type"      => "transfer",
            "desc"      => __('You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',ZEETEXTDOMAIN),
            );

    } //End function: of_options()
} //End chack if function exists: of_options()