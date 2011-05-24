<?php get_header(); ?>

<div class="main">
	
	<?php get_sidebar('left'); ?>	
	
	<div class="wrap float-left">
		
		<div class="content">
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<div class="image post" id="image-<?php the_ID(); ?>">

					<div class="navigation-links">
						<div class="left-navigation navigation-link float-left">
						<?php previous_image_link( false, '&larr; Previous' ); ?>
						</div>
						<div class="right-navigation navigation-linkf float-right">
							<?php next_image_link( false, 'Next &rarr;' ); ?>
						</div>
						<div class="align-center"><a href="<?php echo get_permalink($post->post_parent); ?>"><?php echo get_the_title($post->post_parent); ?></a></div>
					</div>
					<h2><?php the_title(); ?></h2>

					<div class="primary-image"><?php echo wp_get_attachment_image( $post->ID, array( 870, 870 ) ); ?></div>
					<?php echo edit_post_link( 'Edit this image', '<p>', '</p>' ); ?>

					<?php if ( !empty( $post->post_excerpt ) ) : ?>
					<div class="image-caption"><?php the_excerpt(); ?></div>
					<?php endif; ?>

					<?php if ( !empty( $post->post_content ) ) : ?>			
					<div class="image-description"<?php the_content(); ?></div>
					<?php endif; ?>

					<div style="clear:both;"></div>

				</div><!-- END - .image -->

			<?php // comments_template(); ?>

			<?php endwhile; else: ?>

				<div class="message info">Sorry, no attachments matched your criteria.</div>

			<?php endif; ?>
	
		<div class="clear-both"></div>
		
		</div><!-- END .content -->

	</div><!-- END .wrap -->

</div><!-- END .main -->

<?php get_footer(); ?>