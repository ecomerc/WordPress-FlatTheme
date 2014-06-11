<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
	<?php
	$id = get_the_ID();
	echo $id;
                $has_button         =   (get_post_meta($id, 'slider_button_text', true )=='') ? false : true;

                $button             =   get_post_meta($id, 'slider_button_text', true );

                $button_url         =   get_post_meta($id, 'slider_button_url', true );

                $video_url          =   get_post_meta($id, 'slider_video_link', true );

                $video_type         =   get_post_meta($id, 'slider_video_type', true );

                $bg_image_url       =   get_post_meta($id, 'slider_background_image', true );
				
				
                $bg_image_location =   get_post_meta($id, 'slider_image_location', true );
                $bg_image_copyright =   get_post_meta($id, 'slider_image_copyright', true );

				$background_image_url = wpthumb(wp_get_attachment_url($bg_image_url), array(
			'width' 				    => 1500,
			'height'				    => 600,
			'crop'					    => true)) ;
//			1500, 600, true);
                $background_image   =   'background-image: url('.$background_image_url.')';

	
	?>

        <div class="entry-thumbnail">
            <img src="<?php $background_image_url; ?>" />
			
						<div class="slider-copyright"><?php echo $bg_image_location; ?><br /><?php echo $bg_image_copyright; ?></div>
        </div>
		

        <?php if ( is_single() ) { ?>
        <h1 class="entry-title">
            <?php the_title(); ?>
        </h1>
        <?php } else { ?>
        <h2 class="entry-title">
            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
        </h2>
        <?php } //.entry-title ?>

    </header><!--/.entry-header -->

   
    <div class="entry-content">
        <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', ZEETEXTDOMAIN ) ); ?>
    </div>

    <footer>
        <?php zee_link_pages(); ?>
    </footer>

</article><!--/#post-->
