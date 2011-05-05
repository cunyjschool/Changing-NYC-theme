<div class="content">
	
	<?php
		$term = get_queried_object();
		$taxonomy = get_taxonomy( $term->taxonomy );
	?>
	<h2><?php echo $taxonomy->labels->singular_name; ?>: <?php echo $term->name; ?></h2>
	
<?php if ( have_posts() ) : ?>
	
<?php while (have_posts()) : the_post(); ?>
	
	<div class="post">				
	
	<h3><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
			
		<div class="entry">
			<?php the_excerpt(); ?>
		</div>
		
		<div class="meta">By <?php if ( function_exists( 'co_authors' ) ) { co_authors(); } else { the_author(); } ?>, <?php the_date(); ?> <a href="<?php the_permalink(); ?>">&#8734;</a></div>
	
	</div><!-- END .post -->
	
<?php endwhile; ?>

<?php else: ?>
	
	<div class="message info">There aren't any posts published with "<?php echo $term->name; ?>" in <?php echo strtolower( $taxonomy->labels->name); ?></div>

<?php endif; ?>			

</div><!-- END .content -->