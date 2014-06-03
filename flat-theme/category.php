<?php get_header(); 

$col= 'col-md-12';
if ( is_active_sidebar( 'sidebar' ) ) {
    $col = 'col-md-8';
} 

//get_template_part( 'sub', 'title' ); 

?>
<div class="row">
    <div id="content" class="site-content <?php echo $col; ?>" role="main">
     <?php if ( have_posts() ) { ?>
     <header class="archive-header">
      <h1 class="archive-title"><?php printf( __( 'Category Archives: %s', ZEETEXTDOMAIN ), single_cat_title( '', false ) ); ?></h1>

      <?php if ( category_description() ) : // Show an optional category description ?>
      <div class="archive-meta"><?php echo category_description(); ?></div>
  <?php endif; ?>
</header><!-- .archive-header -->
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
<?php get_footer(); ?>