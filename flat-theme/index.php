<?php get_header();

$col= 'col-md-12';
if ( is_active_sidebar( 'sidebar' ) ) {
    $col = 'col-md-8';
}
?>
<div class="row">
    <div id="content" class="site-content <?php echo $col; ?>" role="main">
        <?php if ( have_posts() ) { ?>

        <?php /* The loop */ ?>
        <?php while ( have_posts() ) { the_post(); ?>
        <?php get_template_part( 'post-templates/content', get_post_format() ); ?>
        <?php } ?>

        <?php echo zee_pagination(); ?>

        <?php } else { ?>
        <?php get_template_part( 'post-templates/content', 'none' ); ?>
        <?php } ?>
    </div><!-- #content -->
    <?php get_sidebar(); ?>
</div>
<?php get_footer();