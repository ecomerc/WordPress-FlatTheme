<?php 
// Access WordPress 
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];

require_once( $path_to_wp . '/wp-load.php' );


//Shortcodes Definitions
require_once( 'define.php' );

//Shortcodes Definitions
require_once( 'generate.shortcode.php' );



//Shortcode html
$html_options = null;

$shortcode_html = '

<div id="shortcode-generator">
                        
    <div class="shortcode-content">     
        <div class="label"><strong>Starter Shortcodes</strong></div>            
        <div class="content"><select id="zee-shortcodes" data-placeholder="' . __("Choose a shortcode", ZEETEXTDOMAIN) .'">
        <option value=""> - Select a shortcode - </option>';
        
        foreach( $zee_shortcodes as $shortcode => $options ){
            
            if(strpos($shortcode,'header') !== false) {
                $shortcode_html .= '<optgroup label="'.$options['title'].'">';
            }
            else {
                $shortcode_html .= '<option value="'.$shortcode.'">'.$options['title'].'</option>';
                $html_options .= '<div class="shortcode-options" id="options-'.$shortcode.'" data-name="'.$shortcode.'" data-type="'.$options['type'].'">';
                
                if( !empty($options['attr']) ){
                     foreach( $options['attr'] as $name => $attr_option ){
                        $html_options .= zee_option_element( $name, $attr_option, $options['type'], $shortcode );
                     }
                }

                $html_options .= '</div>'; 
            }
            
        } 

$shortcode_html .= '</select></div> <div class="hr"></div>'; ?><!DOCTYPE html>
<html>
<head>
<title></title>

<!--style-->

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/admin/shortcodes/css/font-awesome.min.css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/admin/shortcodes/css/style.css" />

<!--scripts-->
<script src="<?php echo get_template_directory_uri(); ?>/admin/shortcodes/js/popup.js"></script>


</head>

<body>  
<?php echo $shortcode_html . $html_options;  ?>

    <div id="shortcode-content">
        
        <div class="label"><label id="option-label" for="shortcode-content"><strong><?php echo __( 'Content: ', ZEETEXTDOMAIN ); ?></strong> </label></div>
        <div class="content"><textarea id="content"></textarea></div>
    
        <div class="hr"></div>
        
    </div>

    <code class="shortcode_storage">
        <span id="shortcode-storage-o" style=""></span>
        <span id="shortcode-storage-d"></span>
        <span id="shortcode-storage-c" style=""></span>
    </code>
    <a class="btn" id="add-shortcode"><?php echo __( 'Add Shortcode', ZEETEXTDOMAIN ); ?></a>
    
</div>

</div>
</body>
</html>