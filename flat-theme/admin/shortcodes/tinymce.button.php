<?php


#-----------------------------------------------------------------#
# Register TinyMCE Shortcode Buttons
#-----------------------------------------------------------------#
function zee_tinymce_js() {

    //make sure the user has correct permissions
    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
        return;
    }
    
    //only add to visual mode
    if ( get_user_option('rich_editing') == 'true' ) {
        add_filter( 'mce_external_plugins', 'add_js_plugin' );
        add_filter( 'mce_buttons', 'register_zee_tinymce_button' );
    }

}

add_action('init', 'zee_tinymce_js');


function add_js_plugin( $plugin_array ) {
    $plugin_array['zee_buttons'] = get_template_directory_uri() . '/admin/shortcodes/zee.tinymce.js';
    return $plugin_array;
}

#-----------------------------------------------------------------
# Create Button
#-----------------------------------------------------------------
function register_zee_tinymce_button( $buttons ) {
    array_push( $buttons, "zeescgenerator" );  // "zeescgenerator"  from tinymce.js
    return $buttons; 
}

