<div class="content">
	
	<?php
		$term = get_queried_object();
		$taxonomy = get_taxonomy( $term->taxonomy );
	?>
	
	<?php if ( !empty( $term->description ) ): ?>
		<div class="theme-description float-right"><?php echo $term->description; ?></div>
	<?php endif; ?>
	
	<h2><?php echo $term->name; ?></h2>
	
<?php if ( have_posts() ) : ?>
	
<?php while (have_posts()) : the_post(); ?>
	
	<div class="post">				
	
	<h3><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
			
		<div class="entry">
			<?php the_excerpt(); ?>
		</div>
		
		<div class="meta bottom-meta">By <span class="author"><?php if ( function_exists( 'coauthors_posts_link' ) ) { coauthors_posts_link(); } else { the_author_posts_link(); } ?></span> <span class="date"><?php the_time( 'F j, Y' ); ?></span></div>
	
	</div><!-- END .post -->
	
<?php endwhile; ?>

<?php else: ?>
	
	<div class="message info">There aren't any pieces published here yet.</div>

<?php endif; ?>			

</div><!-- END .content -->