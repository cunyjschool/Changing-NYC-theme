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
	);
	$related_posts = new WP_Query( $args );
?>

<?php if ( $related_posts->have_posts() ) : ?>
	
<div class="sidebar-item related-posts">
	
	<h4><a href="<?php bloginfo('url'); ?>/<?php echo cngnyc_get_term_base( $terms[0] ) . '/' . $terms[0]->slug . '/'; ?>"><?php echo $terms[0]->name; ?></a></h4>
	
<ul class="posts">	

<?php while ( $related_posts->have_posts()) : $related_posts->the_post(); ?>

	<li class="post">				
		<h5><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h5>
	</li><!-- END .post -->

<?php endwhile; ?>

</ul>

<p class="see-all"><a href="<?php bloginfo('url'); ?>/<?php echo cngnyc_get_term_base( $terms[0] ) . '/' . $terms[0]->slug . '/'; ?>">See all &rarr;</a></p>

</div><!-- END .related-posts -->

<?php else: endif; ?>

</div><!-- END .sidebar -->