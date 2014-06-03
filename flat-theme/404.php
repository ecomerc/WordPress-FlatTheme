<?php get_header(); ?>
<div id="content" class="site-content" role="main">
    <div id="error" class="container">
        <h1><?php _e( '404, Page not found', ZEETEXTDOMAIN );?> </h1>
        <p><?php _e( 'The Page you are looking for doesnt exist or an other error occurred', ZEETEXTDOMAIN );?> </p>
        <a class="btn btn-success" href="<?php echo home_url(); ?>"><?php _e( 'GO BACK TO THE HOMEPAGE', ZEETEXTDOMAIN );?></a>
    </div><!--/#error-->
</div><!-- #content -->
<?php get_footer();