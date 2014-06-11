<?php
    /**
    * Template Name: Contact Form
    */
    get_header();
    $col= 'col-md-12';
    if ( is_active_sidebar( 'sidebar' ) ) {
        $col = 'col-md-8';
    }
the_post();
    ?>

    <section id="contact-us">
        <div class="container">
            <div class="row">
                <div id="content" class="site-content <?php echo $col; ?>" role="main">
                    <header class="entry-header">
                        <h4 class="entry-title">
                            <?php the_title(); ?>
                        </h4>
                    </header>

                    <form id="contact-form2" class="contact-form2" data-target="contact-status" name="contact-form" method="post" action="<?php echo get_stylesheet_directory_uri(); ?>/lib/sendemail.php">

                        <div class="row">
						
							<div class="col-lg-12">
								<?php the_content(); ?>
							</div>
                            <div class="col-lg-6 form-group">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" required="required" placeholder="<?php _e('Name', ZEETEXTDOMAIN); ?>">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" required="required" placeholder="<?php _e('Email', ZEETEXTDOMAIN); ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="subject" placeholder="<?php _e('Subject', ZEETEXTDOMAIN); ?>">
                                </div>    
                                 <button class="btn btn-primary btn-lg"><?php _e('Send Message', ZEETEXTDOMAIN); ?></button>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <textarea rows="10" class="form-control"  name="message" placeholder="Message" required="required"></textarea>
                                </div>
                            </div>
                        </div>
                       
                    </form>
                </div><!--/#content-->
                <div class="col-md-4">
                        <h4><?php _e('Our Location', ZEETEXTDOMAIN); ?></h4>
                        <iframe width="100%" height="<?php echo zee_option('zee_contact_map_height');?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                         src="https://maps.google.com.au/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo zee_option('zee_contact_map_location');?>&amp;aq=0&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo zee_option('zee_contact_map_location');?>&amp;t=m&amp;output=embed"></iframe>
                </div>
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#contact-us-->
	<script>
	jQuery(function($) {

	$(window).load(function(){
		var form = $('.contact-form2');
		form.submit(function () {
			$('form button').attr('disabled','disabled');
			$this = $(this);
			$.post($(this).attr('action'), function(data) {
				form.fadeOut("slow", function(){
					var div = $("<div id='foo'>" + data.message + "</div>").hide();
					form.replaceWith(div);
					$('#foo').fadeIn("slow");
				});
				//$(this).prev().text(data.message).fadeIn().delay(3000).fadeOut();
			},'json');
			return false;
		});
	});
});
	</script>
    <?php get_footer(); ?>