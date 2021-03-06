<div class="sidebar float-right post-secondary">
<?php $post = get_queried_object(); ?>

<?php

	$terms = wp_get_object_terms( $post->ID, 'cngnyc_themes' );
	$args = array(
		'tax_query' => array(
			array(
				'taxonomy' => 'cngnyc_themes',
				'field' => 'slug',
				'terms' => $terms[0]->slug,
			)
		),
		'showposts' => 5,
		'orderby' => 'rand',
		'post__not_in' => array(
			$post->ID,
		),
	);
	$related_posts = new WP_Query( $args );
?>

<?php if ( $related_posts->have_posts() ) : ?>
	
<div class="sidebar-item related-posts">
	
	<h4><a href="<?php bloginfo('url'); ?>/<?php echo cngnyc_get_term_base( $terms[0] ) . '/' . $terms[0]->slug . '/'; ?>"><?php echo $terms[0]->name; ?></a></h4>
	
	<?php if ( !empty( $terms[0]->description ) ): ?>
		<div class="theme-description"><?php echo $terms[0]->description; ?></div>
	<?php endif; ?>	
	
<ul class="posts">	

<?php while ( $related_posts->have_posts()) : $related_posts->the_post(); ?>

	<li class="post clear-left">
	
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="featured-image float-left">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
		</div>
		<?php endif; ?>
		
		<h5><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h5>			
		<div class="entry">
			<?php the_excerpt(); ?>
		</div>
	</li><!-- END .post -->

<?php endwhile; ?>

</ul>

<p class="see-all"><a href="<?php bloginfo('url'); ?>/<?php echo cngnyc_get_term_base( $terms[0] ) . '/' . $terms[0]->slug . '/'; ?>">See all &rarr;</a></p>

</div><!-- END .related-posts -->

<?php else: endif; ?>

</div><!-- END .sidebar -->