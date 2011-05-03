<?php get_header(); ?>

<div class="main">
	
	<?php get_sidebar('left'); ?>
	
	<div class="wrap">
		
		<div class="content">
			
			<div class="post">
			
				<?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>
				
					<h2><?php the_title() ?></h2>
					
					<div class="meta">By <?php if ( function_exists( 'co_authors' ) ) { co_authors(); } else { the_author(); } ?>, <?php the_date(); ?> <a href="<?php the_permalink(); ?>">&#8734;</a></div>
							
					<div class="entry">
						<?php the_content(); ?>
					</div>
			
				<?php endwhile ; endif; ?>
			
			</div><!-- END .post -->

		</div><!-- END .content -->
	
		<?php get_sidebar(); ?>
	
		<div class="clear"></div>

	</div><!-- END .wrap -->

</div><!-- END .main -->

<?php get_footer(); ?>