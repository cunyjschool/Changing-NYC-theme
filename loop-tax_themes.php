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
					'terms' => $single_term->slug,
				)
			),
			'posts_per_page' => -1,
			'orderby' => 'title',
			'order' => 'asc',
		);
		$theme_posts = new WP_Query( $args );
	?>
	
<?php if ( have_posts() ) : ?>
	
<?php while (have_posts()) : the_post(); ?>
	
	<div class="post">
		
		<div class="post-meta float-right">
			<ul>
			<li class="author"><span class="label">By</span> <?php if ( function_exists( 'coauthors_posts_link' ) ) { coauthors_posts_link(); } else { the_author_posts_link(); } ?></li>
			<li class="timestamp"><span class="label">Published</span> <?php the_time( 'F j, Y' ); ?></li>
			<?php if ( $topics = get_the_term_list( $post->ID, 'cngnyc_topics', '', ', ', '' ) ) : ?>
			<li class="topics"><span class="label">Topics</span> <?php echo $topics; ?></li>
			<?php endif; ?>
			<?php if ( $media = get_the_term_list( $post->ID, 'cngnyc_media', '', ', ', '' ) ) : ?>
			<li class="media"><span class="label">Media</span> <?php echo $media; ?></li>
			<?php endif; ?>
		</div><!-- END .meta -->
	
	<div class="primary-content w600">
	
	<h3><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
			
		<div class="entry">
			<?php the_excerpt(); ?>
		</div>
		
	</div><!-- END .primary-content -->
	
	</div><!-- END .post -->
	
	<div class="clear-right"></div>
	
<?php endwhile; ?>

<?php else: ?>
	
	<div class="message info">There aren't any pieces published yet. Come back soon and there will be.</div>

<?php endif; ?>			

</div><!-- END .content -->