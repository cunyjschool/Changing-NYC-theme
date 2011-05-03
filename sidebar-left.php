<div class="sidebar-taxonomy sidebar float-left">
	
	<?php
	$taxonomies = array(
		'cngnyc_classes',
		'cngnyc_topics',
		'cngnyc_places',
	);
	$args = array(
		'orderby' => 'slug',
	);
	$all_terms = get_terms( $taxonomies, $args );
	
	if ( is_single() ) {
		$post_terms = wp_get_object_terms( $post->ID, $taxonomies );
		var_dump( $post_terms );
	}
	?>
	<ul class="all-terms">
	<?php foreach( $all_terms as $single_term ): ?>
		<li class="single-term"><a href="<?php bloginfo('url'); ?>/<?php echo cngnyc_get_term_base( $single_term ) . '/' . $single_term->slug . '/'; ?>"><?php echo $single_term->name; ?></a></li>
	<?php endforeach; ?>
	</ul>
	
</div>