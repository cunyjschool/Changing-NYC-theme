<div class="content">
	
<?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>
	
<div class="post">
	
	<h2><?php the_title() ?></h2>
	
	<div class="meta top-meta">By <span class="author"><?php if ( function_exists( 'coauthors_posts_links' ) ) { coauthors_posts_links(); } else { the_author_posts_link(); } ?></span>&nbsp;&nbsp;&nbsp;Published <span class="timestamp"><?php the_time( 'F j, Y', $post->ID ); ?></span></div>
	
	<?php if ( has_post_thumbnail() && 'gallery' != get_post_format() && 'video' != get_post_format() ) : ?>
		<div class="featured-image">
			<?php
			the_post_thumbnail( 'large' );
			$img_id = get_post_meta( get_the_id(), '_thumbnail_id', true );
			$img_post = get_post( $img_id );
			if ( !empty( $img_post->post_excerpt ) ) {
				echo '<div class="image-meta">';
				echo '<span class="image-caption">' . $img_post->post_excerpt . '</span>';
				echo '</div>';
			} ?>
		</div>
	<?php endif; ?>	

	<div class="entry">
		<?php the_content(); ?>
	</div>
	
	<div class="meta bottom-meta">
		<?php if ( $topics = get_the_term_list( $post->ID, 'cngnyc_topics', '', ', ', '' ) ) : ?>
		<p>Topics <span class="topics"><?php echo $topics; ?></span></p>
		<?php endif; ?>
		<?php if ( $media = get_the_term_list( $post->ID, 'cngnyc_media', '', ', ', '' ) ) : ?>
		<p>Media <span class="media"><?php echo $media; ?></span></p>
		<?php endif; ?>
	</div><!-- END .meta -->
	
</div><!-- END .post -->

<?php comments_template( '', true ); ?>
	
<?php endwhile ; endif; ?>			

</div><!-- END .content -->