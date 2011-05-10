<div class="content">
	
<?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>
	
<div class="post live-event">				
	<?php
		$start_date_timestamp = get_post_meta($post->ID, '_cngnyc_event_start_date', true);
		$start_date = date_i18n('F j', $start_date_timestamp );
	?>
	<h2><?php echo $start_date; ?>: <?php the_title() ?></h2>
	
	<?php if ( !empty( $post->post_excerpt ) ): ?>
	<div class="event-description"><p><?php echo $post->post_excerpt; ?></p></div>
	<?php endif; ?>

	<?php $term_list = get_the_term_list( get_the_id(), 'cngnyc_media', false, ', ' ); ?>
	<?php if ( !empty( $term_list ) ) { $text = 'Media includes <span class="media">' . $term_list . '</span>'; } else { $text = ''; } ?>
	<div class="meta top-meta">Reporting by <span class="author"><?php if ( function_exists( 'coauthors_posts_links' ) ) { coauthors_posts_links(); } else { the_author_posts_link(); } ?></span><?php echo $text; ?></div>
	
	<?php if ( !empty( $post->post_content ) ) : ?>
	<div class="entry">
		<?php echo $post->post_content; ?>
	</div>
	<?php else: ?>
		<div class="message info">Come back on <?php echo $start_date; ?> for coverage of the event</div>
	<?php endif; ?>
	
</div><!-- END .post -->
	
<?php endwhile ; endif; ?>			

</div><!-- END .content -->