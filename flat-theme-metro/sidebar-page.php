<?php if ( is_active_sidebar( 'sidebar-page' ) ) { 
global $moresidebar;
 ?>
    <div id="sidebar" class="col-sm-3 col-sm-push-9 col-md-2 col-md-push-10" role="complementary">
        <div class="sidebar-inner">
            <aside class="widget-area">
                <?php // dynamic_sidebar( 'sidebar-page' ); ?>
				<div><?php echo do_shortcode("[sb_child_list parent_id=".$post->post_parent."]"); ?></div>
				<?php
					if (isset($moresidebar)) {
						echo "<div>".$moresidebar."</div>";
					}
				?>
            </aside>
        </div>
    </div>
<?php }