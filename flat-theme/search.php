<?php get_header(); 
$col= 'col-md-12';
if ( is_active_sidebar( 'sidebar' ) ) {
    $col = 'col-md-8';
} 
?>
<div class="row">
    <div id="content" class="site-content <?php echo $col ?>" role="main">
        <?php if ( have_posts() ) { ?>
        <header class="page-header">
            <h1 class="page-title"><?php printf( __( 'Search Results for: %s', ZEETEXTDOMAIN ), get_search_query() ); ?></h1>
        </header>
        <?php /* The loop */ ?>
        <?php while ( have_posts() ) { the_post(); 
            ?>
            <?php get_template_part( 'post-templates/content', 'search' ); ?>
            <?php } ?>
            <?php echo zee_pagination(); ?>
            <?php } else { ?>
            <?php get_template_part( 'post-templates/content', 'none' ); ?>
            <?php } ?>
        </div><!-- #content -->
        <?php get_sidebar(); ?>
    </div>
    <?php get_footer(); ?>