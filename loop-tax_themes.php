<div class="content">
	
	<?php
		$term = get_queried_object();
		$taxonomy = get_taxonomy( $term->taxonomy );
	?>
	
	<?php if ( !empty( $term->description ) ): ?>
		<div class="theme-description float-right"><?php echo $term->description; ?></div>
	<?php endif; ?>
	
	<h2><?php echo $term->name; ?></h2>
	
	<?php
		$args = array(
			'tax_query' => array(
				array(
					'taxonomy' => 'cngnyc_themes',
					'field' => 'slug',
					'terms' => $term->slug,
				)
			),
			'posts_per_page' => -1,
			'orderby' => 'rand',
		);
		$theme_posts = new WP_Query( $args );
	?>
	
<?php if ( $theme_posts->have_posts() ) : ?>
	
	<?php
		$i = 0;
		$total = 0;
		$normalized_total = $theme_posts->post_count - 1;		
	?>
	
	<div class="display-table">
	
<?php while ( $theme_posts->have_posts()) : $theme_posts->the_post(); ?>
	
	<?php if ( $i == 0 ) : ?>
		<div class="display-table-row">
	<?php endif; ?>
	
	<div class="post display-table-cell">
		
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="featured-image">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array( 275, 180 ) ); ?></a>
		</div>
	<?php endif; ?>		
	
		<h3><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
			
		<div class="entry">
			<?php the_excerpt(); ?>
		</div>
	
	</div><!-- END .post.display-table-cell -->
	
	<?php
		$i++;
		$total++;
	 ?>	
	
	<?php if ( $i == 3 || $total == $theme_posts->post_count ): ?>

		</div><!-- END .display-table-row -->
		<?php $i = 0; ?>
	<?php endif; ?>	
	
<?php endwhile; ?>

	</div><!-- END .display-table -->

<?php else: ?>
	
	<div class="message info">There aren't any pieces published yet. Come back soon.</div>

<?php endif; ?>			

</div><!-- END .content -->