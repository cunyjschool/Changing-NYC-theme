<div class="sidebar live-coverage float-right">
	
	<?php $live_term = get_term_by( 'slug', 'live', 'cngnyc_themes' ); ?>
	
	<h3><a href="<?php bloginfo('url'); ?>/<?php echo cngnyc_get_term_base( $live_term ) . '/' . $live_term->slug . '/'; ?>">Live in the City</a></h3>
	
	<div class="theme-description"><?php echo $live_term->description; ?></div>

	<?php
	$args = array(
		'posts_per_page' => -1,
		'post_type' => 'cngnyc_event',
		'orderby' => 'meta_value_num',
		'order' => 'asc',
		'meta_key' => '_cngnyc_event_start_date',		
	);
	$covered_events = new WP_Query( $args );

	?>

<?php if ( $covered_events->have_posts() ) : ?>

<?php while ( $covered_events->have_posts()) : $covered_events->the_post(); ?>
	
	<?php
		$start_date_timestamp = get_post_meta($post->ID, '_cngnyc_event_start_date', true);
		$start_date = date_i18n('F j', $start_date_timestamp );	
		if ( $start_date != $current_date ) {
			echo '<div class="event-date float-left">' . $start_date . '</div>';
			$current_date = $start_date;
		}
	?>

	<div class="post live-event">

	<h4><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h4>

	</div><!-- END .post -->
	
	<div class="clear-left"></div>

<?php endwhile; ?>

<?php else: endif; ?>
	
	<p class="see-all"><a href="<?php bloginfo('url'); ?>/<?php echo cngnyc_get_term_base( $live_term ) . '/' . $live_term->slug . '/'; ?>">See all coverage &rarr;</a></p>

</div><!-- END .live-coverage -->