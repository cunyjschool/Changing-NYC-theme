<div class="sidebar-taxonomy sidebar float-left">
	
	<?php
	$all_taxonomies = array(
		'cngnyc_places',
		'cngnyc_themes',		
	);
	$args = array(
		'orderby' => 'slug',
		'get' => 'all',
	);
	$theme_terms = get_terms( 'cngnyc_themes', $args );
	$place_terms = get_terms( 'cngnyc_places', $args );	

	$post = get_queried_object();
	if ( is_attachment() ) {
		$post_terms = wp_get_object_terms( $post->post_parent, $all_taxonomies );		
	} else if ( is_single( ) ) {
		$post_terms = wp_get_object_terms( $post->ID, $all_taxonomies );		
	} else if ( is_tax() ) {
		$post_terms = array( get_queried_object() );
	} else {
		$post_terms = array();
	}
	?>
	<ul>
	<li class="term-set">
	<h4>Themes</h4>
	<ul class="theme-terms">
	<?php foreach( $theme_terms as $single_term ): ?>
		<li class="single-term"><a<?php if ( cngnyc_is_post_term( $single_term, $post_terms ) ) { echo ' class="active"'; } ?> href="<?php bloginfo('url'); ?>/<?php echo cngnyc_get_term_base( $single_term ) . '/' . $single_term->slug . '/'; ?>"><?php echo $single_term->name; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</li>
	<li class="term-set">
	<h4>Places</h4>
	<ul class="places-terms">
	<?php foreach( $place_terms as $single_term ): ?>
		<li class="single-term"><a<?php if ( cngnyc_is_post_term( $single_term, $post_terms ) ) { echo ' class="active"'; } ?> href="<?php bloginfo('url'); ?>/<?php echo cngnyc_get_term_base( $single_term ) . '/' . $single_term->slug . '/'; ?>"><?php echo $single_term->name; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</li>
	</ul>
	
	<ul>
		<li class="facebook-share"><div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=358716459420&amp;xfbml=1"></script><fb:like href="" send="false" layout="button_count" width="100" show_faces="false" font=""></fb:like></li>
		<li class="share-twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="">Tweet</a></li>
	</ul>
	
</div>