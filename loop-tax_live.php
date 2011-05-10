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
		'posts_per_page' => '-1',
		'post_type' => 'cngnyc_event',
		'orderby' => 'meta_value_num',
		'order' => 'asc',		
		'meta_key' => '_cngnyc_event_start_date',
	);
	$all_events = new WP_Query( $args );

	?>
	
	<?php if ( $all_events->have_posts() ) : ?>
	
	<?php while ( $all_events->have_posts()) : $all_events->the_post(); ?>
		
	<?php
		$start_date_timestamp = get_post_meta($post->ID, '_cngnyc_event_start_date', true);
		$start_date = date_i18n('F j', $start_date_timestamp );	
		if ( $start_date != $current_date ) {
			echo '<div class="event-date float-left">' . $start_date . '</div>';
			$current_date = $start_date;
		}
	?>		
	
	<div class="post live-event">
	
	<h3><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
			
	<?php if ( !empty( $post->post_excerpt ) ): ?>
	<div class="event-description"><p><?php echo $post->post_excerpt; ?></p></div>
	<?php endif; ?>

	<?php $term_list = get_the_term_list( get_the_id(), 'cngnyc_media', false, ', ' ); ?>
	<?php if ( !empty( $term_list ) ) { $text = 'Media includes <span class="media">' . $term_list . '</span>'; } else { $text = ''; } ?>
	<div class="meta top-meta">Reporting by <span class="author"><?php if ( function_exists( 'coauthors_posts_links' ) ) { coauthors_posts_links(); } else { the_author_posts_link(); } ?></span><?php echo $text; ?></div>
	
	</div><!-- END .post -->
	
	<div class="clear-both"></div>
	
<?php endwhile; ?>

<?php else: endif; ?>	

</div><!-- END .content -->