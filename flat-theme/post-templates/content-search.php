<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
	<header class="entry-header">
		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h2>
	</header><!--/.entry-header -->
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
</article><!--/#post-->