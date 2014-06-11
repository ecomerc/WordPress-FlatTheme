<?php
/**
* Template Name: Frontpage
*/
get_header();

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
				
				
                $bg_image_location =   get_post_meta($slider->ID, 'slider_image_location', true );
                $bg_image_copyright =   get_post_meta($slider->ID, 'slider_image_copyright', true );

				$background_image_url = wpthumb(wp_get_attachment_url($bg_image_url), array(
			'width' 				    => 1500,
			'height'				    => 600,
			'crop'					    => true)) ;
//			1500, 600, true);
                $background_image   =   'background-image: url('.$background_image_url.')';

				
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
					<?php
					if ($bg_image_copyright != "") {
						?>
						<div class="slider-copyright"><?php echo $bg_image_location; ?><br /><?php echo $bg_image_copyright; ?></div>
						<?php
					}
					?>


                            <div class="<?php echo ($columns) ? 'col-sm-6' : 'col-sm-12'  ?>">
                                <div class="carousel-content centered <?php echo $slider_position ?>">
                                    <h2 class="<?php echo $boxed ?> animation animated-item-1">
                                        <?php echo $slider->post_title ?>
                                    </h2>

                                    <div class="<?php echo $boxed ?> animation animated-item-2">
                                        <?php echo do_shortcode( $slider->post_content ) ?>
                                    </div>
                                    
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