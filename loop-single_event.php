<div class="content">
	
<?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>
	
<div class="post live-event">				
	
	<h2><?php the_title() ?></h2>
	<?php
	$start_date_timestamp = get_post_meta($post->ID, '_cngnyc_event_start_date', true);
	$start_date = date_i18n('F j', $start_date_timestamp );
	$term_list = get_the_term_list( get_the_id(), 'cngnyc_media', false, ', ' ); ?>
	<?php if ( !empty( $term_list ) ) { $text = $term_list; } else { $text = 'Reporting'; } ?>
	<div class="meta top-meta"><?php echo $text; ?> by <span class="author"><?php if ( function_exists( 'coauthors_posts_link' ) ) { coauthors_posts_link(); } else { the_author_posts_link(); } ?></span></div>
	
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