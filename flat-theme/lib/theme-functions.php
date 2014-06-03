<?php
/*
* Theme Option Functions
*/

//Favicon Image
if (!function_exists("zee_favicon")) {
    function zee_favicon(){
        if(zee_option('zee_favicon') == ""){
            echo '<link rel="shortcut icon" href="' . get_template_directory_uri() . '/favicon.png" >';
        } else {
            echo '<link rel="shortcut icon" href="' . zee_option('zee_favicon') .'" >';
        }
        if (zee_option('zee_show_apple_logo')) {
            echo zee_option('zee_apple_iphone_icon') != "" ? ('<link rel="apple-touch-icon" href="' . zee_option('zee_apple_iphone_icon') . '"/>') : '';
            echo zee_option('zee_apple_iphone_retina_icon') != "" ? ('<link rel="apple-touch-icon" sizes="114x114" href="' . zee_option('zee_apple_iphone_retina_icon') . '"/>') : '';
            echo zee_option('zee_apple_ipad_icon') != "" ? ('<link rel="apple-touch-icon" sizes="72x72" href="' . zee_option('zee_apple_ipad_icon') . '"/>') : '';
            echo zee_option('zee_apple_ipad_retina_icon') != "" ? ('<link rel="apple-touch-icon" sizes="144x144" href="' . zee_option('zee_apple_ipad_retina_icon') . '"/>') : '';
        }
    }
}

//Comments On Pages
if (!function_exists("comments_page")) {
    function comments_page(){
        if(zee_option('zee_blog_comments') && is_page()){
            comments_template();
        }
    }
}

//Logo Option
if (!function_exists("logo")) {
    function logo(){
        if( zee_option( 'zee_show_logo' ) == 0 ){ ?> 
        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><i class="icon-cloud"></i> <?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></a>
        <?php } else{ ?>            
        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" >
            <img src="<?php echo zee_option( 'site_logo' );?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
        </a>
        <?php 
    }
}
}

//Copyright Text 
if( !function_exists('show_footer')){
    function show_footer(){
        if(zee_option( 'zee_footer_text_info' ) == 1){
            echo zee_option( 'zee_copyright_text' );
        }
    }
}

//Google Analytics
if( !function_exists('google_analytics') ){
    function google_analytics(){
        echo zee_option('zee_google_analytics');
    }
}

//Blog Sidebar Position
if(!function_exists('blog_date')){
    function blog_date(){
        if(zee_option('zee_blog_date')){
            echo zee_option('zee_blog_date');
        //the_time('$time');
        }
    }
}


//Featured Image on Single Post
if( !function_exists('featured_image_single_post')){
    function featured_image_single_post(){
        if(zee_option( 'zee_single_featured_image' ) == 1){
            the_post_thumbnail();
        } 
    }
}

//Post Author Section
if( !function_exists('zee_author_bio')){
    function zee_author_bio(){
        if( zee_option('zee_single_post_author') ){
            echo zee_option('zee_single_post_author');
        }
    }
}


//Comments On Blog
if (!function_exists("blog_comments")) {
    function blog_comments(){
        if(zee_option('zee_blog_comments') == 1 && is_single()){
            comments_template();
        }
    }
}

//Excerp Length
function zee_excerpt_length($length) {
    return zee_option('zee_excerpt_len');
}
add_filter('excerpt_length', 'zee_excerpt_length');


//Styling Options

function zee_style_options(){

    ob_start();


    if( zee_option('zee_body_text_font','face') ){ 

        echo '@import url(http://fonts.googleapis.com/css?family='. str_replace(' ','+',zee_option('zee_body_text_font','face')) .':400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic);';

    } else {
        echo '@import url(http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic);
        ';
    }


    if( zee_option('zee_heading_font','face') and ( zee_option('zee_body_text_font','face')!=zee_option('zee_heading_font','face') ) ){  

        echo "\n" . '@import url(http://fonts.googleapis.com/css?family='.str_replace(' ','+',zee_option('zee_heading_font','face')).':400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic);';
    }
    ?>

    /* Body Style */

    body{
    <?php

    if( zee_option('zee_body_background') ){  
        echo  'background: ' . zee_option('zee_body_background') . ';';
    } 


    if( zee_option('zee_body_text_font','color') ){  
        echo  'color: ' . zee_option('zee_body_text_font','color') . ';';
    } 

    if( zee_option('zee_body_text_font','face') ){  


        echo  'font-family: \'' . zee_option('zee_body_text_font','face') . '\';';
    }  else {
        echo  'font-family: \'Roboto\', sans-serif;';
    }

    if( zee_option('zee_body_text_font','size') ){  
        echo  'size: ' . zee_option('zee_body_text_font','size') . ';';
    } 

    ?>
}   

 /* Heading Style */

h1, h2, h3, h4, h5, h6{ 
<?php
if( zee_option('zee_heading_font','face') ){  
    echo  'font-family: \'' . zee_option('zee_heading_font','face') . '\';';
} else {
    echo 'font-family: \'Roboto\', sans-serif;';
}
?>
}



/*Link Color*/

a {
<?php  
if( zee_option('zee_link_color') ){  
    echo  'color: ' . zee_option('zee_link_color') . ';';
}
?>
}


/*Link Hover Color*/

a:hover {
<?php  
if( zee_option('zee_link_color') ){  
    echo  'color: ' . zee_option('zee_link_hover_color') . ';';
}
?>
}  

   /* Header Style */

#header {
<?php  
if( zee_option('zee_header_background') ){  
    echo  'background-color: ' . zee_option('zee_header_background') . ';';
}
?>
}  



/* Custom CSS */
<?php echo zee_option('zee_custom_css');?>


<?php 
return ob_get_clean();
}



//Social Sharing
function zee_social_share(){
    global $zee_socials;
    foreach ($zee_socials as $key => $value) {
        # code...
        if(zee_option($value['name']) !=""){    
            echo '<a href="' . str_replace('*', zee_option($value['name']), $value['link']) . '" target="_blank" title="' . $key . '" class="' . $key . '"><span class="icon-'. $key . '"></span></a>';
        }
    }

}

global $zee_socials;
$zee_socials = array(
    'facebook' => array(
        'name' => 'zee_facebook_username',
        'link' => 'http://www.facebook.com/*',
        ),
    'google-plus' => array(
        'name' => 'zee_googleplus_username',
        'link' => 'https://plus.google.com/u/0/*'
        ),
    'twitter' => array(
        'name' => 'zee_twitter_username',
        'link' => 'http://twitter.com/*',
        ),
    'youtube-play' => array(
        'name' => 'zee_youtube_username',
        'link' => 'http://www.youtube.com/user/*',
        )
    );

//Show Admin Bar
if(!function_exists('zee_adminbar')){
    function zee_adminbar(){
        if(zee_option('zee_admin_bar')==1){
            if(current_user_can( 'manage_options' ))
                return true;
            else 
                return false;
        }

        add_filter('show_admin_bar','zee_adminbar');
    }
}

if(!function_exists('zee_admin_logo')){
    function zee_admin_logo(){
        if(zee_option('zee_logo_login')){
            ?>
            <style type="text/css">
            body.login div#login h1 a {
                background-image: url(<?php echo zee_option('zee_logo_login');?>);
                padding-bottom: 30px;
            }
            </style>

            <?php } else { ?>

            <style type="text/css">
            body.login div#login h1 a {
                background-image: url(<?php echo admin_url('/images/wordpress-logo.png');?>);
                padding-bottom: 30px;
            }
            </style>

            <?php }
        }
        add_action( 'login_enqueue_scripts', 'zee_admin_logo' );
    }


    if(!function_exists('zee_logo_login_url')){
        function zee_logo_login_url(){
            return site_url();
        }
        add_filter( 'login_headerurl', 'zee_logo_login_url' );
    }



    
//
    function zee_exclude_search_pages($query) {
        if(zee_option('zee_exclude_search_page')==1){
          if ( $query->is_search ) {
            $query->set('post_type', 'post');

        }
        return $query;
    }
}
add_filter('pre_get_posts','zee_exclude_search_pages');
//}




function get_video_ID($link){

    if( empty($link) ) return false;

    $path  =  trim(parse_url($link, PHP_URL_PATH), '/');

    $query_string = parse_url($link, PHP_URL_QUERY);

    parse_str($query_string, $output);

    if( empty($output) ){
        return $path;
    } else {
        return $output['v'];
    }
}
