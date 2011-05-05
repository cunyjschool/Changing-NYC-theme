<div class="content">
	
<?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>
	
	<div class="post">				
	
	<h2><?php the_title() ?></h2>
			
		<div class="meta top-meta">By <span class="author"><?php if ( function_exists( 'coauthors_posts_link' ) ) { coauthors_posts_link(); } else { the_author_posts_link(); } ?></span> <span class="date"><?php the_time( 'F j, Y' ); ?></span> <span class="permalink"><a href="<?php the_permalink(); ?>">&#8734;</a></span></div>
			
		<div class="entry">
			<?php the_content(); ?>
		</div>
	
	</div><!-- END .post -->
	
<?php endwhile ; endif; ?>			

</div><!-- END .content -->