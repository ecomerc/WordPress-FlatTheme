<?php get_header(); 

$col= 'col-sm-12';
if ( is_active_sidebar( 'sidebar-page' ) ) {
    $col = 'col-md-10 col-md-pull-2 col-sm-9 col-sm-pull-3';
}

?>
<section id="page">
    <div class="container">
    <?php get_sidebar("page"); ?>
        <div id="content" class="site-content <?php echo $col; ?>" role="main">
            <?php /* The loop */ ?>
            <?php while ( have_posts() ) { the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php edit_post_link( __( 'Edit', ZEETEXTDOMAIN ), '<small class="edit-link pull-right ">', '</small><div class="clearfix"></div>' ); ?>
                <?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
                <div class="entry-thumbnail">
                    <?php 
					
				$background_image_url = wpthumb(zee_get_thumb_url(get_the_ID()), array(
			'height'				    => 400,
			'crop'					    => false)) ;
			
					 ?> <img src="<?php echo $background_image_url; ?>" class="attachment-post-thumbnail wp-post-image"  />          
                    
                </div>
                <?php } ?>
                <div class="entry-content">
                    <?php the_content(); ?>
                    <?php zee_link_pages(); ?>
                </div>
            </article>
            <?php comments_page(); ?>
            <?php } ?>
        </div><!--/#content-->
    </div>
</section><!--/#page-->
<?php get_footer();