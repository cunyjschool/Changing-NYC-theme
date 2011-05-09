	<div class="sidebar live-coverage float-right">
		
		<?php $live_term = get_term_by( 'slug', 'live', 'cngnyc_themes' ); ?>
		
		<h3><a href="<?php bloginfo('url'); ?>/<?php echo cngnyc_get_term_base( $live_term ) . '/' . $live_term->slug . '/'; ?>">Live in the City</a></h3>
		
		<div class="theme-description"><?php echo $live_term->description; ?></div>
	
		<?php
		$args = array(
			'posts_per_page' => 5,
			'post_type' => 'cngnyc_event',
			'meta_query' => array(
				array(
					'key' => '_cngnyc_event_status',
					'value' => 'off',
					'compare' => '=',
				),
				array(
					'key' => '_cngnyc_event_start_date',
					'value' => time(),
					'compare' => '>=',
				),
			),
			'orderby' => 'meta_value_num',
			'order' => 'asc',
			'meta_key' => '_cngnyc_event_start_date',		
		);
		$covered_events = new WP_Query( $args );

		?>

	<?php if ( $covered_events->have_posts() ) : ?>

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

			<?php $term_list = get_the_term_list( get_the_id(), 'cngnyc_media', false, ', ' ); ?>
			<?php if ( !empty( $term_list ) ) { $text = $term_list; } else { $text = 'Reporting'; } ?>
			<div class="meta bottom-meta"><?php echo $text; ?> from <span class="author"><?php if ( function_exists( 'coauthors_posts_link' ) ) { coauthors_posts_link(); } else { the_author_posts_link(); } ?></span></div>

		</div><!-- END .post -->

	<?php endwhile; ?>

	<?php else: endif; ?>
		
		<p><a href="<?php bloginfo('url'); ?>/<?php echo cngnyc_get_term_base( $live_term ) . '/' . $live_term->slug . '/'; ?>">See all &rarr;</a></p>
	
	</div><!-- END .live-coverage -->