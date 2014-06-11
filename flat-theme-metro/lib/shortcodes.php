<?php

add_action( 'after_setup_theme', 'my_ag_child_theme_setup' );

function get_the_pre_more_text_custom ($text)
{
	global $post; 
	$moreTag = '<!--more';

	 $morePos = stripos($text, $moreTag);
   if ($morePos !== FALSE || $morePos > -1)
      return privateConditionContent(substr($text, 0, $morePos));
   else
      return FALSE;
}


function my_ag_child_theme_setup() {
   remove_shortcode( 'zee_portfolio' );
   remove_shortcode( 'zee_team' );
   remove_shortcode( 'zee_recent_works' );
   
   
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
				<a class="preview btn btn-danger"  href="<?php echo get_permalink( $value->ID ); ?>">Read more</a>   
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
			<?php //array(300,300)
			echo get_the_post_thumbnail( $value->ID, 'height=100&crop=1' , array( 
			  'class' => "img-responsive", 
			  'alt' => trim(strip_tags( $value->post_title )),
			  'title' => trim(strip_tags( $value->post_title ))
			  )); 
			  ?> 
			  <a href="<?php echo get_permalink( $value->ID ); ?>"><h5><?php echo $value->post_title; ?></h5></a>
			  <div class="overlay">
				<?php 
				//$full_img = wp_get_attachment_image_src( get_post_thumbnail_id($value->ID), 'full');
				//$img_src= $full_img[0];
				?>
				<a class="preview btn btn-danger"  href="<?php echo get_permalink( $value->ID ); ?>">Read more</a>              
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
		<div  class="col-md-3 col-sm-6 col-xs-12">
		  <div class="center team-member">
		  <?php

				$background_image_url = wpthumb(zee_get_thumb_url($value->ID), array(
			'width' 				    => 200,
			'height'				    => 200,
			'crop'					    => true)) ;
			if ($background_image_url != "") { ?>
			<p>
			  <a href="<?php echo get_permalink( $value->ID ); ?>"><img class="img-circle img-thumbnail" src="<?php
			echo $background_image_url ?>" alt="<?php echo $value->post_title; ?>"></a></p><?php
			}
			?>
			<h4>
			  
			  <a href="<?php echo get_permalink( $value->ID ); ?>"><?php echo $value->post_title; ?></a>
			  <?php if(get_post_meta($value->ID, 'team_designation', true)!=''){ ?>
			  <br><small class="designation muted"><?php echo get_post_meta($value->ID, 'team_designation', true)   ?></small>
			  <?php } ?>
			</h4>

			<div class="text-left"><?php 
			
			
			   $returnVal = get_the_pre_more_text_custom ($value->post_content);
			   if ($returnVal !== FALSE)
				  echo $returnVal;
			   else
				  ""; ?></div>
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
	   
}
