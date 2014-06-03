<?php get_header();                 
?>

<div id="content" class="site-content" role="main">

    <?php if ( have_posts() ) { ?>

    <header class="archive-header">
        <h1 class="archive-title"><?php printf( __( 'All posts by %s', ZEETEXTDOMAIN ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
    </header><!-- .archive-header -->

    <?php if ( get_the_author_meta( 'description' ) ) { ?>
    <?php get_template_part( 'author-bio' ); ?>
    <?php } ?>

    <?php /* The loop */ ?>
    <?php while ( have_posts() ) { the_post(); ?>
    <?php get_template_part( 'post-templates/content', get_post_format() ); ?>
    <?php } ?>

    <?php echo zee_pagination(); ?>

    <?php } else { ?>
    <?php get_template_part( 'post-templates/content', 'none' ); ?>
    <?php } ?>

</div><!-- #content -->

<?php get_footer();