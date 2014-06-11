<?php

add_theme_support( 'post-thumbnails' );

update_option('thumbnail_crop', 1);
add_image_size( 'portfolio_thumb', 400, 400, true ); // 220 pixels wide by 180 pixels tall, hard crop mode

register_sidebar(array('name'=>'Bottom Right', 'id' => "bottom-right",));
register_sidebar(array('name'=>'Sidebar Page', 'id' => 'sidebar-page',
  'before_title' => '<h3>',
  'after_title' => '</h3>',
  'before_widget' => '<div>',
  'after_widget' => '</div>'));
	
if( ! function_exists('metro_scripts') ){

// adding scripts
    add_action('wp_enqueue_scripts', 'metro_scripts', 11);

    function metro_scripts() {

	wp_enqueue_style( 'metro-style', get_stylesheet_directory_uri() . '/style.css', array(), '1.0.0' );
    }
}

	
	
	//Logo Option
if (!function_exists("logo")) {
    function logo(){
        if( zee_option( 'zee_show_logo' ) == 0 ){ ?> 
        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><i class="icon-cloud"></i> <?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></a>
        <?php } else{ ?>            
        <span  class="navbar-brand">
            <a class=""  href="<?php echo esc_url( home_url( '/' ) ); ?>" ><img src="<?php echo zee_option( 'site_logo' );?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /><span class="logotitle">EcoMerc</span></a>
        </span>
        <?php 
    }
}
}


	
// metaboxes directory constant
define( 'CUSTOM_METABOXES_DIR', get_template_directory_uri() . '/admin/metaboxes' );

// Meta boxes
require_once( get_template_directory() . '/admin/metaboxes/meta_box.php');

$prefix = 'portfolio_';
$fields = array(

    array( 
        'label' => __('Featured', ZEETEXTDOMAIN), 
        'id'    => $prefix.'featured',
        'type'  => 'checkbox'
        ),

    array( 
        'label' => __('Location', ZEETEXTDOMAIN), 
        'desc'  => __('Physical location of the client', ZEETEXTDOMAIN), 
        'id'    => $prefix.'location', 
        'type'  => 'text' 
        ),
		
    array( 
        'label' => __('Button Text', ZEETEXTDOMAIN), 
        'desc'  => __('Portfolio popup button text, eg. Read more', ZEETEXTDOMAIN), 
        'id'    => $prefix.'button_text', 
        'type'  => 'text' 
        ),

    array( 
        'label' => __('Button URL', ZEETEXTDOMAIN),
        'desc'  => __('Portfolio popup button url, eg. http://www.zeetheme.com/case1', ZEETEXTDOMAIN),
        'id'    => $prefix.'button_url', 
        'type'  => 'text' 
        )
    );

new Custom_Add_Meta_Box( 'zee_portfolio_box', __('Portfolio Settings', ZEETEXTDOMAIN), $fields, 'zee_portfolio', true );



$prefix = 'slider_';
$fields = array(
    array( 
        'label'                     => __('Image Location',          ZEETEXTDOMAIN),
        'desc'                      => __('Text for image location', ZEETEXTDOMAIN), 
        'id'                        => $prefix . 'image_location',
        'type'                      => 'text'
        ),   
    array( 
        'label'                     => __('Image Copyright',          ZEETEXTDOMAIN),
        'desc'                      => __('Text for image copyright', ZEETEXTDOMAIN), 
        'id'                        => $prefix . 'image_copyright',
        'type'                      => 'text'
        ),  

    );



new Custom_Add_Meta_Box( 'zee_slider_extra', __('Additional Slider Settings', ZEETEXTDOMAIN), $fields, 'zee_slider', true );




function array_splice_assoc(&$input, $offset, $length, $replacement) {
    $replacement = (array) $replacement;
    $key_indices = array_flip(array_keys($input));
    if (isset($input[$offset]) && is_string($offset)) {
            $offset = $key_indices[$offset];
    }
    if (isset($input[$length]) && is_string($length)) {
            $length = $key_indices[$length] - $offset;
    }

    $input = array_slice($input, 0, $offset, TRUE)
            + $replacement
            + array_slice($input, $offset + $length, NULL, TRUE); 
}


function modify_types() {
    if ( post_type_exists( 'zee_team' ) ) {

        /* Give products hierarchy (for house plans) */
        global $wp_post_types, $wp_rewrite;
        $wp_post_types['zee_team']->rewrite['slug'] = 'team';
        //$wp_post_types['zee_team']->supports['excerpt'] = true;
		add_post_type_support( 'zee_team', 'excerpt' );
		
		
        $args = $wp_post_types['zee_team'];
        $wp_rewrite->add_rewrite_tag("%team%", '(.+?)', $args->query_var ? "{$args->query_var}=" : "post_type=zee_team&name=");
		
		    // First, try to load up the rewrite rules. We do this just in case
		// the default permalink structure is being used.
		if( ($current_rules = get_option('rewrite_rules')) ) {

			// Next, iterate through each custom rule adding a new rule
			// that replaces 'movies' with 'films' and give it a higher
			// priority than the existing rule.
			foreach($current_rules as $key => $val) {
				if(strpos($key, 'zee_team') !== false) {
					add_rewrite_rule(str_ireplace('zee_team', 'team', $key), $val, 'top');   
				} // end if
			} // end foreach

		} // end if/else
		
		$wp_rewrite->extra_permastructs["zee_team"]["struct"] = "/team/%zee_team%";
		/*
		$wp_rewrite->extra_permastructs["zee_team"]["struct"] = "/team/%zee_team%";
		
		
		
		$i = 0;
		$start = -1;
		$replacements = array();
		
		foreach ($wp_rewrite->extra_rules_top as $key => $value) {
			if (strpos($key, 'zee_team') !== FALSE) {
				if ($start == -1) {
					$start = $i;
				}
				$newkey = str_replace("zee_team","team",$key);
				$replacements[$newkey] = $value;
			} elseif ($start > -1) {
				array_splice_assoc($wp_rewrite->extra_rules_top, $start, ($i - $start), $replacements);
				$start = -1;
			}
			$i++;
		}
		
		$i = 0;
		$start = -1;
		$replacements = array();
		foreach ($wp_rewrite->rules as $key => $value) {
			if (strpos($key, 'zee_team') !== FALSE) {
				if ($start == -1) {
					$start = $i;
				}
				$newkey = str_replace("zee_team","team",$key);
				$replacements[$newkey] = $value;
			} elseif ($start > -1) {
				array_splice_assoc($wp_rewrite->rules, $start, ($i - $start), $replacements);
				$start = -1;
			}
			$i++;
		}*/
		
		//print_r($wp_rewrite);
		//$wp_rewrite->rewrite_rules() ;
		//flush_rewrite_rules( true );
		//print_r($wp_rewrite);
		//print_r($wp_post_types['zee_team']);
		//die("hello world");
		flush_rewrite_rules();
        //add_post_type_support('zee_team','page-attributes');
    }
}
add_action( 'init', 'modify_types', 100 );





// Override certain shortcodes:

require_once ( get_stylesheet_directory() . '/lib/shortcodes.php' );


