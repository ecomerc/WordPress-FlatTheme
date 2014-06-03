<?php
/**
* Template Name: Frontpage
*/
get_header();
?>

<?php /*
<section id="main-slider-wrapper">
    <div id="main-slider" class="carousel wet-asphalt">
        <?php
        $args = array( 'post_type'=>'zee_slider', 'orderby' => 'menu_order','order' => 'ASC' );
        $sliders = get_posts( $args );
        ?>
        <ol class="carousel-indicators">
            <?php foreach ($sliders as $key => $value) { ?>
            <li data-target="#main-slider" data-slide-to="<?php echo $key; ?>" class="<?php echo ($key==0) ? 'active' : ''; ?>"></li>
            <?php } ?>
        </ol><!--/.carousel-indicators-->
        <div class="carousel-inner">
            <?php foreach ($sliders as $key => $value) { ?>
            <div class="item<?php echo ($key==0) ? ' active' : ''; ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="carousel-content">
                                <h2><?php echo $value->post_title; ?></h2>
                                <p class="lead"><?php echo $value->post_content; ?></p>
                                <a class="btn btn-md btn-danger" href="#"><?php _e( 'Read More', ZEETEXTDOMAIN ); ?></a>
                            </div>
                        </div>
                        <div class="col-sm-6 hidden-xs">
                            <div class="carousel-image">
                                <?php 
                                $full_img = wp_get_attachment_image_src( get_post_thumbnail_id($value->ID), 'full');
                                $img_src= $full_img[0];
                                ?>
                                <img class="img-responsive pull-right" src="<?php echo $img_src; ?>" alt="<?php echo $value->post_title; ?>" />
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
            <?php } ?>
        </div><!--/.carousel-inner-->
    </div><!--/.carousel-->
</section>
*/
?>
<?php
$args = array( 'post_type'=>'zee_slider', 'orderby' => 'menu_order','order' => 'ASC' );
$sliders = get_posts( $args );
$total_sliders = count($sliders);
?>
<section id="main-slider" style="margin: 0; padding: 0;">
    <div class="carousel slide wet-asphalt">
        <ol class="carousel-indicators">

            <?php for($i = 0; $i<$total_sliders; $i++){ ?>
            <li data-target="#main-slider" data-slide-to="<?php echo $i ?>" class="<?php echo ($i==0)?'active':'' ?>"></li>
            <?php } ?>

        </ol>
        <div class="carousel-inner">
            <?php foreach ($sliders as $key => $slider) { 

                $full_img           =   wp_get_attachment_image_src( get_post_thumbnail_id( $slider->ID ), 'full');

                $slider_position    =   get_post_meta($slider->ID, 'slider_position', true );

                $boxed              =   (get_post_meta($slider->ID, 'slider_boxed', true )=='yes') ? 'boxed' : '';

                $has_button         =   (get_post_meta($slider->ID, 'slider_button_text', true )=='') ? false : true;

                $button             =   get_post_meta($slider->ID, 'slider_button_text', true );

                $button_url         =   get_post_meta($slider->ID, 'slider_button_url', true );

                $video_url          =   get_post_meta($slider->ID, 'slider_video_link', true );

                $video_type         =   get_post_meta($slider->ID, 'slider_video_type', true );

                $bg_image_url       =   get_post_meta($slider->ID, 'slider_background_image', true );

                $background_image   =   'background-image: url('.wp_get_attachment_url($bg_image_url).')';

                $columns            =   false;



                if( !empty($image_url) or !empty($video_url) ){

                    $columns        =   true;
                }


                if( $video_type=='youtube' ) {

                    $embed_code = '<iframe width="640" height="480" src="//www.youtube.com/embed/' . get_video_ID( $video_url ) . '?rel=0" frameborder="0" allowfullscreen></iframe>';

                } elseif( $video_type=='vimeo' ) {
                    $embed_code = '<iframe src="//player.vimeo.com/video/' . get_video_ID( $video_url ) . '?title=0&amp;byline=0&amp;portrait=0&amp;color=a22c2f" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>';
                }

                if( $full_img ){

                    $embed_code     = '<img src="' . $full_img[0] . '" alt="">';
                    $columns        =   true;
                }


                ?>

                <div class="item <?php echo ($key==0) ? 'active' : '' ?>" style="<?php echo ( $bg_image_url ) ? $background_image : '' ?>">
                    <div class="container">
                        <div class="row">


                            <div class="<?php echo ($columns) ? 'col-sm-6' : 'col-sm-12'  ?>">
                                <div class="carousel-content centered <?php echo $slider_position ?>">
                                    <h2 class="<?php echo $boxed ?> animation animated-item-1">
                                        <?php echo $slider->post_title ?>
                                    </h2>

                                    <p class="<?php echo $boxed ?> animation animated-item-2">
                                        <?php echo do_shortcode( $slider->post_content ) ?>
                                    </p>
                                    
                                    <?php if( $has_button ){ ?>
                                    <br>
                                    <a class="btn btn-md animation animated-item-3" href="<?php echo $button_url ?>"><?php echo $button ?></a>
                                    <?php } ?>
                                </div>
                            </div>

                            <?php if($columns){ ?>

                            <div class="col-sm-6 hidden-xs animation animated-item-4">
                                <div class="centered" style="margin-top: 129px;">
                                    <div class="embed-container">
                                        <?php echo $embed_code; ?>
                                    </div>
                                </div>
                            </div>

                            <?php } ?>


                        </div>
                    </div>
                </div><!--/.item-->

<!-- 

                <div class="item" style="background-image: url(http://shapebootstrap.net/demo/flat_theme/images/slider/bg2.jpg)">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="carousel-content center centered" style="margin-top: 209px;">
                                    <h2 class="boxed animation animated-item-1">Clean, Crisp, Powerful and Responsie Web Design Theme</h2>
                                    <p class="boxed animation animated-item-2">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                                    <br>
                                    <a class="btn btn-md animation animated-item-3" href="#">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item" style="background-image: url(http://shapebootstrap.net/demo/flat_theme/images/slider/bg3.jpg)">
                    <div class="container">
                        <div class="row">
                            
                            <div class="col-sm-6">
                                <div class="carousel-content centered" style="margin-top: 219.5px;">
                                    <h2 class="animation animated-item-1">Powerful and Responsive Web Design Theme</h2>
                                    <p class="animation animated-item-2">Pellentesque habitant morbi tristique senectus et netus et malesuada fames</p>
                                    <a class="btn btn-md animation animated-item-3" href="#">Learn More</a>
                                </div>
                            </div>

                            <div class="col-sm-6 hidden-xs animation animated-item-4">
                                <div class="centered" style="margin-top: 129px;">
                                    <div class="embed-container">
                                        <iframe src="//player.vimeo.com/video/69421653?title=0&amp;byline=0&amp;portrait=0&amp;color=a22c2f" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div> -->


                <?php } // endforeach ?>

            </div><!--/.carousel-inner-->
        </div><!--/.carousel-->
        <a class="prev hidden-xs" href="#main-slider" data-slide="prev">
            <i class="icon-angle-left"></i>
        </a>
        <a class="next hidden-xs" href="#main-slider" data-slide="next">
            <i class="icon-angle-right"></i>
        </a>
    </section>

    <?php the_post(); ?>
    <?php the_content(); ?>

    <?php
    get_footer();