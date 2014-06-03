<?php get_header(); 

$col= 'col-md-12';
if ( is_active_sidebar( 'sidebar' ) ) {
    $col = 'col-md-8';
} 

?>
<div class="row">

    <div id="content" class="site-content <?php echo $col; ?>" role="main">
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'image-attachment' ); ?>>
            <header class="entry-header">
                <h1 class="entry-title">
                    <?php the_title(); ?>
                    <?php edit_post_link( __( 'Edit', ZEETEXTDOMAIN ), '<span class="edit-link">', '</span>' ); ?>
                </h1>

                <?php
                $published_text = __( '<span class="attachment-meta">Published on <time class="entry-date" datetime="%1$s">%2$s</time> in <a href="%3$s" title="Return to %4$s" rel="gallery">%5$s</a></span>', ZEETEXTDOMAIN );
                $post_title = get_the_title( $post->post_parent );
                if ( empty( $post_title ) || 0 == $post->post_parent ) {
                    $published_text = '<span class="attachment-meta"><time class="entry-date" datetime="%1$s">%2$s</time></span>';                  
                }

                $published_text =   sprintf( $published_text,
                    esc_attr( get_the_date( 'c' ) ),
                    esc_html( get_the_date() ),
                    esc_url( get_permalink( $post->post_parent ) ),
                    esc_attr( strip_tags( $post_title ) ),
                    $post_title
                    );

                $metadata = wp_get_attachment_metadata();

                $size_link = sprintf( '<span class="attachment-meta full-size-link"><a href="%1$s" title="%2$s">%3$s (%4$s &times; %5$s)</a></span>',
                    esc_url( wp_get_attachment_url() ),
                    esc_attr__( 'Link to full-size image', ZEETEXTDOMAIN ),
                    __( 'Full resolution', ZEETEXTDOMAIN ),
                    $metadata['width'],
                    $metadata['height']
                    );
                    ?>

                    <div class="entry-meta">
                        <ul>                                                
                            <li><?php echo $published_text; ?></li>                     
                            <li><?php echo $size_link; ?></li>                     
                        </ul>
                    </div><!-- .entry-meta -->

                </header><!--/.entry-header -->

                <div class="entry-content">

                    <div class="entry-attachment">
                        <div class="attachment">
                            <?php zee_the_attached_image(); ?>

                            <?php if ( has_excerpt() ) { ?>
                            <div class="entry-caption">
                                <?php the_excerpt(); ?>
                            </div>
                            <?php } ?>
                        </div><!-- .attachment -->
                    </div><!-- .entry-attachment -->

                    <?php if ( ! empty( $post->post_content ) ) { ?>
                    <div class="entry-description">
                        <?php the_content(); ?>
                        <?php zee_link_pages(); ?>
                    </div><!-- .entry-description -->
                    <?php } ?>
                </div><!-- .entry-content -->
            </article><!-- #post -->

            <ul class="navigation image-navigation pager" role="navigation">
                <li class="previous"><?php previous_image_link( false, __( '<span class="meta-nav">&larr;</span> Previous', ZEETEXTDOMAIN ) ); ?></li>
                <li class="next"><?php next_image_link( false, __( 'Next <span class="meta-nav">&rarr;</span>', ZEETEXTDOMAIN ) ); ?></li>
            </ul><!--/#image-navigation -->

            <?php comments_template(); ?>

        </div><!-- #content -->
        <?php get_sidebar(); ?>
    </div>
    <?php get_footer(); ?>