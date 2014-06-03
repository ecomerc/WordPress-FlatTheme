<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">

        <?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
        <div class="entry-thumbnail">
            <?php the_post_thumbnail(); ?>
        </div>
        <?php } //.entry-thumbnail ?>

        <?php if ( is_single() ) { ?>
        <h1 class="entry-title">
            <?php the_title(); ?>
            <?php edit_post_link( __( 'Edit', ZEETEXTDOMAIN ), '<small class="edit-link pull-right">', '</small>' ); ?>
        </h1>
        <?php } else { ?>
        <h2 class="entry-title">
            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
            <?php edit_post_link( __( 'Edit', ZEETEXTDOMAIN ), '<small class="edit-link pull-right">', '</small>' ); ?>
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

<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) { ?>
<?php get_template_part( 'author-bio' ); ?>
<?php } ?>