<?php
//Button
add_shortcode( 'zee_button', function( $atts, $content= null ){

  $atts = shortcode_atts(
    array(
      'text'  => 'Button',
      'type'  => 'default',
      'size'  => '',
      'url'   => '#',
      'class' => '',
      'icon'  => '',
      'target'=>'_self'
      ), $atts);

  extract($atts);

  $classes  = 'btn';
  $output   = $text;

  if($type) $classes .= ' btn-'. $type;
  if($size) $classes .= ' btn-'. $size;
  if($class) $classes .= ' '. $class;

  if($icon) $output = '<i class="' . $icon . '"></i> ' . $text;

  return '<a target="' . $target . '" href="' . $url . '" class="' . $classes . '">' .  do_shortcode($output)  . '</a>';
});

//Alert
add_shortcode( 'zee_alert', function( $atts, $content= null ){

  $atts = shortcode_atts(
    array(
      "type" => 'info',
      "close" => 'no',
      "title" => '',
      ), $atts);

  //extract($atts);

  $output = '<div class="alert' 
  .  (($atts['type']=='none' ) ? '':' alert-'.$atts['type']) 
  .  (($atts['close']=='no' ) ? '':' alert-dismissable')  
  .' fade in">';

  if($atts['close']=='yes' ){
    $output .='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
  }

  if( $atts['title']!='' ){
    $output .='<h4>'. $atts['title']. '</h4>';
  }

  $output .= do_shortcode($content);

  $output .='</div>';

  return $output;

});

//divider
add_shortcode( 'zee_divider', function( $atts, $content= null ){

  $atts = shortcode_atts(
    array(
      'size'  => 'default'
      ), $atts);

  extract($atts);

  return '<div class="clearfix ' . $size . ' "></div>';
});


//progressbar
add_shortcode( 'zee_progressbar', function( $atts, $content= null ) {
  return '<div>' . do_shortcode( $content ) . '</div>';

});

add_shortcode( 'zee_bar', function( $atts, $content= null ) {

  $atts = shortcode_atts(
    array(
      "style"        => '',
      "width"        => '70%',
      "min"        => '0',
      "max"        => '100',
      "default"        => '70'
      ), $atts);

  extract($atts);


  return '<div class="progress">
  <div class="progress-bar ' . $style . '" role="progressbar" aria-valuenow="' . $default . '" aria-valuemin="'. $min .'" aria-valuemax="'. $max .'" style="width: ' . $width . '%">
  <span>' . do_shortcode( $content ) . '</span>
  </div></div>
  ';  

});

//container
add_shortcode( 'zee_container', function( $atts, $content = null ) {
  $atts = shortcode_atts(
    array(
      "class"        => '',
      'id'           => ''
      ), $atts);
  
  extract($atts);

  if($id!='') $id = 'id=' . $id;

  return '<section ' . $id . ' class="' . $class . '"><div class="container">' . do_shortcode( $content ) . '</div></section>';
});


// faq
add_shortcode( 'zee_faq', function( $atts=null, $content= null ){

  ob_start();

  $args = array(  
    'posts_per_page' => -1, 
    'post_type'=>'zee_faq', 
    'orderby' => 'menu_order',
    'order' => 'ASC'
    );

  $posts = get_posts( $args ); ?>
  <div class="row">
    <ul>
      <?php 
      foreach ($posts as $key => $post) {
        ?>
        <li class="faq">
          <div class="media">
            <span class="number pull-left"><?php echo $key + 1;?></span>
            <div class="media-body">
              <h4><?php echo $post->post_title; ?></h4>
              <p><?php echo do_shortcode( $post->post_content ); ?></p>
            </div>
          </div>
        </li>
        <?php } ?>
      </ul>
    </div>
    <?php
    return ob_get_clean();
  });


// Service
add_shortcode( 'zee_service', function( $atts, $content= null ){

  $atts = shortcode_atts(
    array(
      "category"    => 0,
      "column"     => 3,
      "number"      => 3
      ), $atts);

  extract($atts);

  ob_start();


  $args = array(   

    'post_type'=>'zee_service', 
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'numberposts' => $number,
    );


  if(  $category > 0 ){
    $args['tax_query'] = array(
      array(
        'posts_per_page' => -1,
        'taxonomy' => 'cat_service',
        'field' => 'term_id',
        'terms' => $category
        )
      );
  }

    $posts = get_posts( $args ); ?>
    <div class="row">
      <?php foreach ($posts as $key => $post) {
        $icon = get_post_meta( $post->ID, 'service_icon', true );
        $color = get_post_meta($post->ID, 'service_color', true);
        ?>
        <div class="col-sm-<?php echo (12/$column); ?>">
          <div class="media services">
            <?php if( $icon ) { ?>
            <div class="pull-left">
              <i style="background-color:<?php echo  $color ?>;" class="<?php echo $icon; ?> icon-md"></i>
            </div>
            <?php } ?>
            <div class="media-body">
              <h3 class="media-heading"><?php echo $post->post_title; ?></h3>
              <?php echo do_shortcode( $post->post_content ); ?>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
      <?php
      return ob_get_clean();
    });


// Testimonial
add_shortcode( 'zee_testimonial', function( $atts, $content= null ){

  $atts = shortcode_atts(
    array(
      "count"        => ''
      ), $atts);

  extract($atts);

  ob_start();

  $args = array(
    'posts_per_page' => -1,
    'post_type'=>'zee_testimonial', 
    'numberposts' => $count, 
    'orderby' => 'menu_order',
    'order' => 'ASC'
    );

  $posts = get_posts( $args ); ?>
  <div class="row">
    <?php foreach ($posts as $key => $post) {

      ?>
      <div class="col-sm-6">
        <blockquote>
          <?php echo do_shortcode( $post->post_content ); ?>
          <small class="designation"><?php echo get_post_meta($post->ID, 'testimonial_designation',true)   ?></small>
        </blockquote>
      </div>
      <?php } ?>
    </div>
    <?php
    return ob_get_clean();
  });


/**
 * Portfolio Shortcode
 * @param  [type] $atts
 * @param  string $content
 * @return [type]
 */

add_shortcode( 'zee_portfolio', function( $atts, $content = null ){
 $atts = shortcode_atts(
  array(
    'column' => '3'
    ), $atts);

 extract($atts);

 $args = array(
    'posts_per_page' => -1,
    'post_type'      =>  'zee_portfolio'
  );

 $portfolios = get_posts( $args );

 ob_start();

 if(count($portfolios)>0){ ?>
 <div id="portfolio" class="clearfix">

  <ul class="portfolio-filter">
    <li><a class="btn btn-default active" href="#" data-filter="*"><?php _e('All', ZEETEXTDOMAIN); ?></a></li>
    <?php 
    $terms = get_terms('cat_portfolio', array('hide_empty'=> true));
    foreach ($terms as $term) {
      ?>
      <li><a class="btn btn-default" href="#" data-filter=".<?php echo $term->slug; ?>"><?php echo $term->name; ?></a></li>
      <?php
    }
    ?>
  </ul>

  <ul class="portfolio-items col-<?php echo $column; ?>">
    <?php foreach ($portfolios as $key => $value) { ?>
    <?php 
    $terms = wp_get_post_terms( $value->ID, 'cat_portfolio' );
    $new_terms = array();
    foreach ($terms as $term) $new_terms[] = $term->slug;
    $slugs = implode(' ', $new_terms);
    ?>
    <li class="portfolio-item <?php echo $slugs; ?>">
      <div class="item-inner">
        <?php 
        echo get_the_post_thumbnail( $value->ID, array(300,300), array( 
          'class' => "img-responsive", 
          'alt' => trim(strip_tags( $value->post_title )),
          'title' => trim(strip_tags( $value->post_title ))
          )); 
          ?> 
          <a href="<?php echo get_permalink( $value->ID ); ?>"><h5><?php echo $value->post_title; ?></h5></a>
          <div class="overlay">
            <?php 
            $full_img = wp_get_attachment_image_src( get_post_thumbnail_id($value->ID), 'full');
            $img_src= $full_img[0];
            ?>
            <a class="preview btn btn-danger" href="<?php echo $img_src; ?>" rel="prettyPhoto"><i class="icon-eye-open"></i></a>              
          </div>           
        </div>
      </li>
      <?php } ?>
    </ul>
  </div>
  <?php } else { ?>
  <div class="alert alert-danger fade in">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php _e('No portfolio item found!', ZEETEXTDOMAIN); ?>
  </div>
  <?php
}
return ob_get_clean();

});


/**
 * Team Shortcode
 * @param  [type] $atts
 * @param  string $content
 * @return [type]
 */

add_shortcode( 'zee_team', function( $atts, $content = null ){

  ob_start();


  $args = array(
    'posts_per_page' => -1,
   'post_type'      =>  'zee_team'
   );


  $data = get_posts( $args );
  if(count($data)>0){ ?>
  <div class="team row">
    <?php foreach ($data as $key => $value) { ?>
    <div  class="col-md-3 col-sm-4 col-xs-6">
      <div class="center team-member">
        <p><img class="img-circle img-thumbnail" src="<?php echo zee_get_thumb_url($value->ID) ?>" alt="?php echo $value->post_title; ?>"></p>
        <h4>
          <?php echo $value->post_title; ?>
          <?php if(get_post_meta($value->ID, 'team_designation', true)!=''){ ?>
          <br><small class="designation muted"><?php echo get_post_meta($value->ID, 'team_designation', true)   ?></small>
          <?php } ?>
        </h4>

        <p><?php echo $value->post_content; ?></p>
        <div class="social-btns clearfix">
          <?php if(get_post_meta($value->ID, 'team_facebook', true)!=''){ ?>
          <a class="btn btn-social btn-facebook" href="<?php echo  get_post_meta($value->ID, 'team_facebook', true)   ?>"><i class="icon-facebook"></i></a>
          <?php } ?>
          <?php if(get_post_meta($value->ID, 'team_twitter', true)!=''){ ?>
          <a class="btn btn-social btn-twitter" href="<?php echo get_post_meta($value->ID, 'team_twitter', true)?>"><i class="icon-twitter"></i></a>
          <?php } ?>        
          <?php if(get_post_meta($value->ID, 'team_gplus', true)!=''){ ?>
          <a class="btn btn-social btn-google-plus" href="<?php echo get_post_meta($value->ID, 'team_gplus', true)?>"><i class="icon-google-plus"></i></a>
          <?php } ?>
          <?php if(get_post_meta($value->ID, 'team_linkedin', true)!=''){ ?>
          <a class="btn btn-social btn-linkedin" href="<?php echo get_post_meta($value->ID, 'team_linkedin', true)?>"><i class="icon-linkedin"></i></a>
          <?php } ?>                
          <?php if(get_post_meta($value->ID, 'team_pinterest', true)!=''){ ?>
          <a class="btn btn-social btn-pinterest" href="<?php echo get_post_meta($value->ID, 'team_pinterest', true)?>"><i class="icon-pinterest"></i></a>
          <?php } ?>    
        </div>
      </div>
    </div><!--/.col-->
    <?php } ?>
  </div><!--/.team-->

  <?php } else { ?>
  <div class="alert alert-danger fade in">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php _e('No Team found!', ZEETEXTDOMAIN); ?>
  </div>
  <?php
}
return ob_get_clean();

});


/**
 * Accordion Shortcode
 * @param  [type] $atts
 * @param  string $content
 * @return [type]
 */

add_shortcode( 'zee_accordion', function( $atts, $content = null ){

  ob_start();

  $atts = shortcode_atts(
    array(
      'category' => 0
      ), $atts);

  extract($atts);

  $args = array(   

    'post_type'=>'zee_accordion', 
    'orderby' => 'menu_order',
    'order' => 'ASC'
    );


  if(  $category > 0 ){
    $args['tax_query'] = array(
      array(
        'posts_per_page' => -1,
        'taxonomy' => 'cat_accordions',
        'field' => 'term_id',
        'terms' => $category
        )
      );
  }

  $id = $category;
  $accordions = get_posts( $args );
  if(count($accordions)>0){ ?>
  <div class="panel-group" id="panel-<?php echo $id; ?>">
    <?php foreach ($accordions as $key => $value) { ?>

    <div class="panel panel-default">

      <div class="panel-heading">
        <h3 class="panel-title">
          <a class="accordion-toggle <?php echo ($key==0)? '':'collapsed'; ?>" data-toggle="collapse" data-parent="#panel-<?php echo $id ?>" href="#accordion-<?php echo $value->ID . $category; ?>">
            <?php echo do_shortcode( $value->post_title ); ?>
          </a>
        </h3>
      </div>

      <div id="accordion-<?php echo $value->ID . $category; ?>" class="panel-collapse <?php echo ($key==0)? 'collapse in':'collapse'; ?>">
        <div class="panel-body">
          <?php echo do_shortcode( $value->post_content ); ?>
        </div>
      </div>

    </div>
    <?php } ?>
  </div>

  <?php } else { ?>
  <div class="alert alert-danger fade in">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php _e('No accordion item found!', ZEETEXTDOMAIN); ?>
  </div>
  <?php
}
return ob_get_clean();

});

//columns
add_shortcode( 'zee_columns', function( $atts=array(), $content=null ){

  $output = '<div class="row">';
  $output .= do_shortcode( str_replace('<p></p>', '', $content) );
  $output .= '</div>';
  return $output;
});

//column
add_shortcode( 'zee_column', function( $atts, $content=null ){
 $atts = shortcode_atts(
  array(
    'size' => '1'
    ), $atts);


 $output = '<div class="col-md-'.$atts['size'].'">';
 $output .= do_shortcode( str_replace('<p></p>', '', $content) );
 $output .= '</div>';
 return $output;

});

//Tab
add_shortcode( 'zee_tab', function( $atts, $content = null ){

  ob_start();

  $atts = shortcode_atts(
    array(
      'category' => '0'
      ), $atts);

  extract($atts);

  $args = array(   

    'post_type'=>'zee_tab', 
    'orderby' => 'menu_order',
    'order' => 'ASC'
    );


  if(  $category > 0 ){
    $args['tax_query'] = array(
      array(
        'posts_per_page' => -1,
        'taxonomy' => 'cat_tabs',
        'field' => 'term_id',
        'terms' => $category
        )
      );
  }

  $tabs = get_posts( $args );

  if(count($tabs)>0) {
    ?>
    <ul class="nav nav-tabs">
      <?php foreach ($tabs as $key => $value) { ?>
      <li class="<?php echo ($key==0)?'active':''; ?>" ><a href="#tab-<?php echo $value->ID . $category; ?>" data-toggle="tab"><?php echo do_shortcode( $value->post_title ); ?></a></li>
      <?php } ?>
    </ul>

    <div class="tab-content">
      <?php foreach ($tabs as $key => $value) { ?>
      <div class="tab-pane fade<?php echo ($key==0)?' active in':''; ?>" id="tab-<?php echo $value->ID . $category; ?>"><?php echo do_shortcode( $value->post_content ); ?></div>
      <?php } ?>
    </div>

    <?php
  } else {
    ?>
    <div class="alert alert-danger fade in">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <?php _e( 'No Tab Item found!', ZEETEXTDOMAIN ); ?>
    </div>
    <?php
  }

  wp_reset_postdata();

  return ob_get_clean();
});


//Pricing
add_shortcode( 'zee_pricing', function( $atts, $content = null ){
  ob_start();
  $atts = shortcode_atts(
    array(
      'category' => '0'
      ), $atts);

  extract($atts);


  $args = array(
    'post_type'=>'zee_pricing', 
    'orderby' => 'menu_order',
    'order' => 'ASC'
    );


  if(  $category > 0 ){
    $args['tax_query'] = array(
      array(
        'posts_per_page' => -1,
        'taxonomy' => 'cat_pricing',
        'field' => 'term_id',
        'terms' => $category
        )
      );
  }

  $pricings = get_posts( $args );

  if(count($pricings)>0) {
    ?>
    <div class="row pricing-tables">
      <?php foreach ($pricings as $key => $value) { ?>
      <?php $featured = get_post_meta($value->ID, 'pricing_featured',true); ?>

      <div class="col-lg-<?php echo round(12/count($pricings)); ?>">

        <ul class="plan<?php echo ($featured==1)? ' featured' : ''; ?>">
          <li class="plan-name">
            <h3><?php echo $value->post_title; ?></h3>
          </li>
          <li class="plan-price">
            <div>
              <span class="price"><?php echo get_post_meta($value->ID, 'pricing_price',true) ?></span>
              <small><?php echo get_post_meta($value->ID, 'pricing_duration',true) ?></small>
            </div>
          </li>
          <li class="plan-details"><?php echo $value->post_content; ?></li>
          <li class="plan-button-box">
            <a class="btn btn-primary" href="<?php echo get_post_meta($value->ID, 'pricing_button_url',true) ?>"><?php echo get_post_meta($value->ID, 'pricing_button_text',true) ?></a>
          </li>
        </ul>
      </div>
      <?php } ?>
    </div>
    <?php
  } else {
    ?>
    <div class="alert alert-danger fade in">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <?php _e( 'No pricing table found!', ZEETEXTDOMAIN ); ?>
    </div>
    <?php
  }
  
  wp_reset_postdata();

  return ob_get_clean();
});




//Icon
add_shortcode( 'zee_icon', function( $atts, $content=null ){
  $atts = shortcode_atts(array(
    'image' => 'icon-home',
    'size' => ''
    ), $atts);

  extract($atts);

  $icon = $image . ' ' . $size;

  return '<i class="' . $icon . '"></i>';

});

//Dropcap


add_shortcode( 'zee_dropcap',  function( $atts, $content="" ) {
  return '<p class="dropcap">' . do_shortcode( $content ) .'</p>';
} );


//Block Numbers
add_shortcode( 'zee_blocknumber', function( $atts, $content="" ) {
  extract(shortcode_atts(array(
    'number' => '01',
    'background' => '#333',
    'color' => '#999',
    'borderradius'=>'2px'
    ), $atts));

  return '<p class="blocknumber"><span style="background:'.$background.';color:'.$color.';border-radius:'.$borderradius.'">' . $number . '</span> ' . do_shortcode( $content ) . '</p>';
} );


//Block
add_shortcode( 'zee_block', function( $atts, $content="" ) {
  extract(shortcode_atts(array(
    'background' => 'transparent',
    'color' => '#666',
    'borderradius'=>'2px',
    'padding' => '15px'
    ), $atts));

  return '<div class="block" style="background:'.$background.';color:'.$color.';border-radius:'.$borderradius.';padding:'.$padding.'">'.$content.'</div>';
} );

//Recent Works
add_shortcode( 'zee_recent_works', function( $atts, $content= null ){
  ob_start();

  $atts = shortcode_atts(array(
    'slides'        => 2,
    'title'         => '',
    'description'   => ''
    ), $atts);

  extract($atts);

  $item_per_slide   = 3;

  $args             =  array(
    'numberposts'   =>  $item_per_slide*$slides,
    'orderby'       =>  'menu_order',
    'order'         =>  'ASC',
    'post_type'     =>  'zee_portfolio'
    );

  $portfolios = get_posts( $args );

  $i      = 1;
  $j      = 1;
  $count  = count($portfolios);

  if ($count>0) {
    ?>
    <div class="col-md-3">
      <h3><?php echo $title; ?></h3>
      <p><?php echo $description; ?></p>
      <div class="btn-group">
        <a class="btn btn-danger" href="#scroller" data-slide="prev"><i class="icon-angle-left"></i></a>
        <a class="btn btn-danger" href="#scroller" data-slide="next"><i class="icon-angle-right"></i></a>
      </div>
    </div>
    <div class="col-md-9">
      <div id="scroller" class="carousel slide">
        <div class="carousel-inner">
          <?php

          foreach( $portfolios as $key=>$value ) {

            if( (($key+1)%($item_per_slide)==0) || $j== $count) {
              $lastContainer= true;
            } else {
              $lastContainer= false;
            }

            if($i==1){
              ?>
              <div class="item <?php echo ($key==0)? 'active': ''; ?>">
                <div class="row">
                  <?php
                }
                ?>
                <div class="col-xs-<?php echo round(12/$item_per_slide) ?>">
                  <div class="portfolio-item">
                  <div class="item-inner">
                    <?php 
                    echo get_the_post_thumbnail( $value->ID, array(400,400), array( 
                      'class' => "img-responsive", 
                      'alt' => trim(strip_tags( $value->post_title )),
                      'title' => trim(strip_tags( $value->post_title ))
                      )); 
                      ?>
                      <h5>
                        <?php echo $value->post_title; ?>
                      </h5>
                      <div class="overlay">
                        <?php 
                        $full_img = wp_get_attachment_image_src( get_post_thumbnail_id($value->ID), 'full');
                        $img_src= $full_img[0];
                        ?>
                        <a class="preview btn btn-danger" title="<?php echo $value->post_title; ?>" href="<?php echo $img_src; ?>" rel="prettyPhoto"><i class="icon-eye-open"></i></a>   
                      </div>
                    </div><!--.item-inner-->
                    </div><!--.portfolio-item-->
                  </div>    
                  <?php
                  if(($i == $item_per_slide) || $lastContainer) {
                    ?>
                  </div><!--/.row-->
                </div><!--/.col-xs-->
                <?php
                $i=0;
              }
              $i++;
              $j++;
            }
            ?>
          </div>
        </div>
      </div><!--/.col-md-9-->
      <?php
    }

    return ob_get_clean();
  });

//fontawesome font list
add_shortcode( 'zee_fontawesome', function( $atts, $content = null ) {
  global $fontawesome_icons;

  $output = '<h1>Total ' . count($fontawesome_icons) . ' Awesome Icons</h1><div class="divider-sm"></div>';

  $output .= '<div class="row">';
  foreach ($fontawesome_icons as $key => $value) {
    $output .='<div class="col-sm-3 col-sx-6"><p><i style="display: inline-block; margin-right: 10px;" class="' . $value . '"></i> ' . $value . '</p></div>';
  }
  $output .='</div>';
  return $output;
});
