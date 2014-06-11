<?php
/**
* Template Name: Archive
*/

get_header();
$col= 'col-md-12';
if ( is_active_sidebar( 'sidebar' ) ) {
    $col = 'col-md-8';
} 
?>

			
<section id="page">
    <div class="container">
    <div id="content" class="site-content <?php echo $col; ?>" role="main">

	
<?php 

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$new_query = new WP_Query();
$new_query->query( 'showposts=10&paged='.$paged );

//The Loop
if ( $new_query->have_posts() ) { 
	while ($new_query->have_posts()) {
		$new_query->the_post();
		get_template_part( 'post-templates/content', get_post_format() );
	}
    echo zee_pagination();
} else { 
	get_template_part( 'post-templates/content', 'none' ); 
} 
?>

    </div><!-- #content -->
    <?php get_sidebar(); ?>

</div>
</section>
<?php get_footer();