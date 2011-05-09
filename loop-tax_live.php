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
		'meta_query' => array(
			array(
				'key' => '_cngnyc_event_status',
				'value' => 'off',
				'compare' => '=',
			),
		),
		'orderby' => 'meta_value_num',
		'meta_key' => '_cngnyc_event_start_date',
	);
	$upcoming_events = new WP_Query( $args );

	?>
	
	<h3>Upcoming</h3>
	
<?php if ( $upcoming_events->have_posts() ) : ?>
	
<?php while ( $upcoming_events->have_posts()) : $upcoming_events->the_post(); ?>
	
	<div class="post live-event float-left">				
	
	<h4><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h4>
			
		<div class="entry">
			<?php the_excerpt(); ?>
		</div>
		
		<div class="meta bottom-meta">By <span class="author"><?php if ( function_exists( 'coauthors_posts_link' ) ) { coauthors_posts_link(); } else { the_author_posts_link(); } ?></span> <span class="date"><?php the_time( 'F j, Y' ); ?></span></div>
	
	</div><!-- END .post -->
	
<?php endwhile; ?>

<?php else: endif; ?>
	
	
<div class="clear-both"></div>

	<?php
	$args = array(
		'posts_per_page' => '-1',
		'post_type' => 'cngnyc_event',
		'meta_query' => array(
			array(
				'key' => '_cngnyc_event_status',
				'value' => 'on',
				'compare' => '=',
			),
		),
		'orderby' => 'meta_value_num',
		'meta_key' => '_cngnyc_event_start_date',		
	);
	$covered_events = new WP_Query( $args );
	
	?>
	
<?php if ( $covered_events->have_posts() ) : ?>
	
	<h3>Coverage</h3>	
	
<?php while ( $covered_events->have_posts()) : $covered_events->the_post(); ?>
	
	<div class="post live-event">
		
	<?php
		$start_date_timestamp = get_post_meta($post->ID, '_cngnyc_event_start_date', true);
		$start_date = date_i18n('F j', $start_date_timestamp );
	?>			
	
	<h4><a href="<?php the_permalink(); ?>"><?php echo $start_date; ?> - <?php the_title() ?></a></h4>
			
		<div class="entry">
			<?php the_excerpt(); ?>
		</div>
		
		<div class="meta bottom-meta">Reporting from <span class="author"><?php if ( function_exists( 'coauthors_posts_link' ) ) { coauthors_posts_link(); } else { the_author_posts_link(); } ?></span></div>
	
	</div><!-- END .post -->
	
<?php endwhile; ?>

<?php else: endif; ?>		

</div><!-- END .content -->