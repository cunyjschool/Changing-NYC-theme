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
	
	if ( is_single() ) {
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
		<li class="facebook-share"><iframe src="http://www.facebook.com/plugins/like.php?href&amp;send=true&amp;layout=button_count&amp;width=100&amp;show_faces=false&amp;action=recommend&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe></li>
		<li class="share-twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="">Tweet</a></li>
	</ul>
	
</div>