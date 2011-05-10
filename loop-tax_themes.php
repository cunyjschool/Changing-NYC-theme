<div class="content">
	
	<?php
		$term = get_queried_object();
		$taxonomy = get_taxonomy( $term->taxonomy );
	?>
	
	<?php if ( !empty( $term->description ) ): ?>
		<div class="theme-description float-right"><?php echo $term->description; ?></div>
	<?php endif; ?>
	
	<h2><?php echo $term->name; ?></h2>
	
<?php if ( have_posts() ) : ?>
	
<?php while (have_posts()) : the_post(); ?>
	
	<div class="post">
		
		<div class="post-meta float-right">
			<ul>
			<li class="author"><span class="label">By</span> <?php if ( function_exists( 'coauthors_posts_link' ) ) { coauthors_posts_link(); } else { the_author_posts_link(); } ?></li>
			<li class="timestamp"><span class="label">Published</span> <?php the_time( 'F j, Y' ); ?></li>
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
	
<?php endwhile; ?>

<?php else: ?>
	
	<div class="message info">There aren't any pieces published yet. Come back soon and there will be.</div>

<?php endif; ?>			

</div><!-- END .content -->