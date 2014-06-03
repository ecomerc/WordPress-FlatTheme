<?php get_header(); 

$col= 'col-md-12';
if ( is_active_sidebar( 'sidebar' ) ) {
    $col = 'col-md-8';
} 
?>
<div class="row">
    <div id="content" class="site-content <?php echo $col ?>" role="main">
        <?php if ( have_posts() ) { ?>
        
        <header class="archive-header">
            <h1 class="archive-title"><?php printf( __( 'Tag Archives: %s', ZEETEXTDOMAIN ), single_tag_title( '', false ) ); ?></h1>
            <?php if ( tag_description() ) { // Show an optional tag description ?>
            <div class="archive-meta"><?php echo tag_description(); ?></div>
            <?php } ?>
        </header><!-- .archive-header -->

        <?php 
        while ( have_posts() ) { 
            the_post();  get_template_part( 'post-templates/content', get_post_format() ); 
        } 

        echo zee_pagination();

    } else { 
        get_template_part( 'post-templates/content', 'none' ); 
    } ?>
</div><!-- #content -->

<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>