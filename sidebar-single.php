<div class="sidebar float-right post-secondary">
<?php $post = get_queried_object(); ?>

<div class="post-meta">
	<ul>
	<li class="timestamp"><span class="label">Published</span> <?php the_time( 'F j, Y', $post->ID ); ?></li>
	<?php if ( $topics = get_the_term_list( $post->ID, 'cngnyc_topics', '', ', ', '' ) ) : ?>
	<li class="topics"><span class="label">Topics</span> <?php echo $topics; ?></li>
	<?php endif; ?>
	<?php if ( $media = get_the_term_list( $post->ID, 'cngnyc_media', '', ', ', '' ) ) : ?>
	<li class="media"><span class="label">Media</span> <?php echo $media; ?></li>
	<?php endif; ?>
</div><!-- END .meta -->

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

<p><a href="<?php bloginfo('url'); ?>/<?php echo cngnyc_get_term_base( $terms[0] ) . '/' . $terms[0]->slug . '/'; ?>">See all &rarr;</a></p>

</div><!-- END .related-posts -->

<?php else: endif; ?>

</div><!-- END .sidebar -->