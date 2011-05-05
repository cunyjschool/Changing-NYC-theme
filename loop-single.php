<div class="content">
	
<?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>
	
	<div class="post">				
	
	<h2><?php the_title() ?></h2>
			
		<div class="meta">By <?php if ( function_exists( 'co_authors' ) ) { co_authors(); } else { the_author(); } ?>, <?php the_date(); ?> <a href="<?php the_permalink(); ?>">&#8734;</a></div>
			
		<div class="entry">
			<?php the_content(); ?>
		</div>
	
	</div><!-- END .post -->
	
<?php endwhile ; endif; ?>			

</div><!-- END .content -->