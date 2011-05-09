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
	
	<div class="theme-row">
		
	<div class="theme-information">
	
	<h3><a href="<?php bloginfo('url'); ?>/<?php echo cngnyc_get_term_base( $single_term ) . '/' . $single_term->slug . '/'; ?>"><?php echo $single_term->name; ?></a></h3>
	
	<?php if ( !empty( $single_term->description ) ): ?>
		<div class="description"><?php echo $single_term->description; ?></div>
	<?php endif; ?>
	
	<?php
		$args = array(
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
	
	</div><!-- END .theme-information -->
	
	<?php if ( $theme_posts->have_posts() && $theme_posts->post_count >= 3 ) : ?>
		
	<ul class="posts">	

	<?php while ( $theme_posts->have_posts()) : $theme_posts->the_post(); ?>

		<li class="post float-left">				

		<h4><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h4>

			<div class="meta bottom-meta">By <span class="author"><?php if ( function_exists( 'coauthors_posts_link' ) ) { coauthors_posts_link(); } else { the_author_posts_link(); } ?></span></div>

		</li><!-- END .post -->

	<?php endwhile; ?>
	
	</ul>

	<div class="clear-left"></div>

	<?php else: ?>

	<?php endif; ?>
	
	<div class="see-all"><a href="<?php bloginfo('url'); ?>/<?php echo cngnyc_get_term_base( $single_term ) . '/' . $single_term->slug . '/'; ?>">See all &rarr;</a></div>
	
	</div><!-- END .row -->

	
<?php endforeach; ?>

</div><!-- END .content -->