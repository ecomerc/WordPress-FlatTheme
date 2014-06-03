<?php if(!is_page()) { ?>
</div><!--/#primary-->
</div><!--/.col-lg-12-->
</div><!--/.row-->
</div><!--/.container.-->
</section><!--/#main-->
<?php } ?>

<section id="bottom" class="wet-asphalt">
  <div class="container">
    <div class="row">
      <?php dynamic_sidebar('bottom'); ?>
    </div>
  </div>
</section>

<footer id="footer" class="midnight-blue">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <?php show_footer();?>
      </div>
      <div class="col-sm-6">
        <ul class="pull-right">
          <?php 
          wp_nav_menu( array(
            'theme_location' => 'footer',
            'container'  => false,
            'menu_class' => '',
            'items_wrap'=>'%3$s'
            )
          );
          ?>
          <li>
            <a id="gototop" class="gototop" href="#"><i class="icon-chevron-up"></i></a><!--#gototop-->
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer><!--/#footer-->

  <?php if(zee_option('zee_theme_layout')=='boxed'){ ?>
    </div><!--/#boxed-->
  <?php } ?>

<?php google_analytics();?>

<?php wp_footer(); ?>

</body>
</html>