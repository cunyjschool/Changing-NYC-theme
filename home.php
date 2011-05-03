<?php get_header(); ?>

<div class="main">
	
	<div class="wrap">
		
		<div class="content">
			
			<div class="post">
			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
					<h2><?php the_title() ?></h2>
							
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