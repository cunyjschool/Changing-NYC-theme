<div class="content">
	
	<div class="featured-live-event post">	
	<?php 
		$post_id = cngnyc_get_active_event();
		$post = get_post( $post_id );
	?>
		<h2>Live now: <?php echo $post->post_title; ?></h2>
		
		<?php if ( !empty( $post->post_excerpt ) ): ?>
		<div class="description"><p><?php echo $post->post_excerpt; ?></p></div>
		<?php endif; ?>
		
		<div class="meta top-meta">By <span class="author"><?php if ( function_exists( 'coauthors_posts_link' ) ) { coauthors_posts_link(); } else { the_author_posts_link(); } ?></span> <span class="permalink"><a href="<?php the_permalink(); ?>">&#8734;</a></span></div>
		
		<div class="entry">
			<?php echo $post->post_content; ?>
		</div>

	</div><!-- END .featured-live-event -->

<?php 
	$args = array(
		'orderby' => 'slug',
		'get' => 'all',
	);
	$theme_terms = get_terms( 'cngnyc_themes', $args );
?>

<div class="clear-both"></div>

<div class="theme-listing">
<?php foreach ( $theme_terms as $single_term ) : ?>
	
	<?php if ( $single_term->slug == 'live') continue; ?>
	
	<div class="item float-left">
	
	<h3><a href="<?php bloginfo('url'); ?>/<?php echo cngnyc_get_term_base( $single_term ) . '/' . $single_term->slug . '/'; ?>"><?php echo $single_term->name; ?></a></h3>
	
	<?php if ( !empty( $single_term->description ) ): ?>
		<div class="theme-description"><?php echo $single_term->description; ?></div>
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
	
	<?php if ( $theme_posts->have_posts() ) : ?>
		
	<ul class="posts">	

	<?php while ( $theme_posts->have_posts()) : $theme_posts->the_post(); ?>

		<li class="post">				
			<h4><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h4>
		</li><!-- END .post -->

	<?php endwhile; ?>
	
	</ul>

	<?php else: endif; ?>
		
	<p><a href="<?php bloginfo('url'); ?>/<?php echo cngnyc_get_term_base( $single_term ) . '/' . $single_term->slug . '/'; ?>">See all &rarr;</a></p>
	
	</div><!-- END .row -->
	
<?php endforeach; ?>

</div><!-- END .theme-listing -->

</div><!-- END .content -->