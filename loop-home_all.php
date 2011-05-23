<div class="content">
	
<?php 
	$args = array(
		'orderby' => 'slug',
		'get' => 'all',
	);
	$theme_terms = get_terms( 'cngnyc_themes', $args );
?>

<?php foreach ( $theme_terms as $single_term ) : ?>
	
	<?php if ( $single_term->slug == 'live') continue; ?>
	
	<div class="theme-row term-<?php echo $single_term->slug; ?>">
	
	<h3><a href="<?php bloginfo('url'); ?>/<?php echo cngnyc_get_term_base( $single_term ) . '/' . $single_term->slug . '/'; ?>"><?php echo $single_term->name; ?></a></h3>
	
	<div class="inner">	
	
	<?php if ( !empty( $single_term->description ) ): ?>
		<div class="theme-description"><?php echo $single_term->description; ?></div>
	<?php endif; ?>
	
	<?php
		$args = array(
			'orderby' => 'rand',			
			'tax_query' => array(
				array(
					'taxonomy' => 'cngnyc_themes',
					'field' => 'slug',
					'terms' => $single_term->slug,
				)
			),
			'showposts' => 3,
		);
		$theme_posts = new WP_Query( $args );
	?>
	
	<?php if ( $theme_posts->have_posts() && $theme_posts->post_count >= 3 ) : ?>
		
	<ul class="posts">	

	<?php while ( $theme_posts->have_posts()) : $theme_posts->the_post(); ?>

		<li class="post float-left">
			
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="featured-image">
				<?php the_post_thumbnail( 'thumbnail' ); ?>
			</div>
		<?php endif; ?>						

		<h4><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h4>

			<div class="meta bottom-meta">By <span class="author"><?php if ( function_exists( 'coauthors_posts_links' ) ) { coauthors_posts_links(); } else { the_author_posts_link(); } ?></span></div>

		</li><!-- END .post -->

	<?php endwhile; ?>
	
	</ul>

	<div class="clear-left"></div>
	
	<div class="see-all"><a href="<?php bloginfo('url'); ?>/<?php echo cngnyc_get_term_base( $single_term ) . '/' . $single_term->slug . '/'; ?>">See all stories &rarr;</a></div>

	<?php else: ?>
		
	<div class="message info">Stories coming soon</div>

	<?php endif; ?>
	
	</div><!-- END .inner -->
	
	</div><!-- END .row -->

	
<?php endforeach; ?>

</div><!-- END .content -->