<?php 
//breadcrumb
function zee_breadcrumb(){

ob_start();
 ?>

<ul class="breadcrumb  pull-right">
  <li>
    <a href="<?php home_url(); ?>" class="breadcrumb_home"><?php esc_html_e('Home',ZEETEXTDOMAIN) ?></a> 
  </li>
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
            <?php $category = get_the_category();
                  if ( $category ) { 
                    $catlink = get_category_link( $category[0]->cat_ID );
                    echo ('<a href="'.esc_url($catlink).'">'.esc_html($category[0]->cat_name).'</a> '.'<span class="raquo">/</span> ');
                  }
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
                    $zee_taxonomy_links[] = '<a href="' . esc_url( get_term_link( $zee_current_term, $zee_term_taxonomy ) ) . '" title="' . esc_attr( $zee_current_term->name ) . '">' . esc_html( $zee_current_term->name ) . '</a>';
                    $zee_term_parent_id = $zee_current_term->parent;
                }
                
                if ( !empty( $zee_taxonomy_links ) ) echo implode( ' <span class="raquo">/</span> ', array_reverse( $zee_taxonomy_links ) ) . ' <span class="raquo">/</span> ';
            
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

