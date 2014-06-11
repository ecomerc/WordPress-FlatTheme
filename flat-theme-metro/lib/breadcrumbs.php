<?php 
//breadcrumb
function zee_breadcrumb(){
global $post;
	

ob_start();


$type = get_post_type( );


 ?>

<ul class="breadcrumb  pull-right">
  <li>
    <a href="<?php echo home_url(); ?>" class="breadcrumb_home"><?php esc_html_e('Home',ZEETEXTDOMAIN) ?></a> 
  </li>
  <?php
  
	if ($type == "zee_portfolio") {
        echo ('<li><a href="'.home_url().'/portfolio">References</a> </li> ');
	} elseif ($type == "zee_team") {
        echo ('<li><a href="'.home_url().'/about-us">About us</a> </li> ');
		$post->post_parent = 94;
	} elseif ($type == "page") {
		$parent_id  = $post->post_parent;
		$breadcrumbs = array();
		while ($parent_id) {
			$page = get_page($parent_id);
			$breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
			$parent_id  = $page->post_parent;
		}
		  $breadcrumbs = array_reverse($breadcrumbs);
		  foreach ($breadcrumbs as $crumb) {
			echo $crumb;
		}
	} elseif(is_single()) {
	/*
		$category = get_the_category();
		if ( $category ) { 
			$catlink = get_category_link( $category[0]->cat_ID );
			echo ('<li><a href="'.esc_url($catlink).'">'.esc_html($category[0]->cat_name).'ff</a></li>');
		}*/
        echo ('<li><a href="'.home_url().'/news">News</a> </li> ');
		
	}
  ?>
  <li class="active">
  
        <?php if( is_tag() ) { ?>
                <?php esc_html_e('Posts Tagged ',ZEETEXTDOMAIN) ?><span class="raquo">/</span><?php single_tag_title(); echo('/'); ?>
        <?php } elseif (is_day()) { ?>
            <?php esc_html_e('Posts made in',ZEETEXTDOMAIN) ?> <?php the_time('F jS, Y'); ?>
        <?php } elseif (is_month()) { ?>
            <?php esc_html_e('Posts made in',ZEETEXTDOMAIN) ?> <?php the_time('F, Y'); ?>
        <?php } elseif (is_year()) { ?>
            <?php esc_html_e('Posts made in',ZEETEXTDOMAIN) ?> <?php the_time('Y'); ?>
        <?php } elseif (is_search()) { ?>
            <?php esc_html_e('Search results for',ZEETEXTDOMAIN) ?> <?php the_search_query() ?>
        <?php } elseif (is_single()) { ?>
            <?php 
                echo get_the_title(); ?>
        <?php } elseif (is_category()) { ?>
            <?php single_cat_title(); ?>
        <?php } elseif (is_tax()) { ?>
            <?php 
                $zee_taxonomy_links = array();
                $zee_term = get_queried_object();
                $zee_term_parent_id = $zee_term->parent;
                $zee_term_taxonomy = $zee_term->taxonomy;
                
                while ( $zee_term_parent_id ) {
                    $zee_current_term = get_term( $zee_term_parent_id, $zee_term_taxonomy );
                    $zee_taxonomy_links[] = '<li><a href="' . esc_url( get_term_link( $zee_current_term, $zee_term_taxonomy ) ) . '" title="' . esc_attr( $zee_current_term->name ) . '">' . esc_html( $zee_current_term->name ) . '</a></li>';
                    $zee_term_parent_id = $zee_current_term->parent;
                }
                
                if ( !empty( $zee_taxonomy_links ) ) echo implode( '', array_reverse( $zee_taxonomy_links ) ) ;
            
                echo esc_html( $zee_term->name ); 
             } elseif (is_author()) { 
                global $wp_query;
                $curauth = $wp_query->get_queried_object();

             esc_html_e('Posts by ',ZEETEXTDOMAIN); echo ' ',$curauth->nickname; 
              } elseif (is_page()) { 
               echo get_the_title(); 
                } elseif (is_home()) { 
               esc_html_e('Blog',ZEETEXTDOMAIN);
                } ?>  
  </li>
</ul>
<?php
return ob_get_clean();
}

