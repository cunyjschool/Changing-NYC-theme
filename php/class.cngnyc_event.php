<?php

if ( !class_exists( 'cngnyc_event' ) ) {

class cngnyc_event
{
	
	function __construct() {
		
		// Add Event post type
		add_action('init', array(&$this, 'create_post_type'));
		add_action('init', array(&$this, 'create_taxonomies'));
		
		// Set up metabox and related actions
		add_action('admin_menu', array(&$this, 'add_post_meta_box'));
		add_action('save_post', array(&$this, 'save_post_meta_box'));
		add_action('edit_post', array(&$this, 'save_post_meta_box'));
		add_action('publish_post', array(&$this, 'save_post_meta_box'));
		
		// Load necessary scripts and stylesheets
		add_action('admin_enqueue_scripts', array(&$this, 'add_admin_scripts'));
		
		// Add a rewrite rule to handle pagination on archive page
		add_action( 'generate_rewrite_rules', array( &$this, 'rewrite_rules' ) );
		add_filter( 'query_vars', array( &$this, 'query_vars' ) );
		
	}

	/**
	 * rewrite_rules()
	 */
	function rewrite_rules( $wp_rewrite ) {

		$type = 'cunyj_event';
		$type_slug = 'events';

		$new_rules = array(
			$type_slug . '/([0-9]+)/?$' => 'index.php?post_type=' . $type . '&cunyj_year=' . $wp_rewrite->preg_index(1),
			$type_slug . '/([0-9]+)/([0-9]+)/?$' => 'index.php?post_type=' . $type . '&cunyj_year=' . $wp_rewrite->preg_index(1) . '&cunyj_monthnum=' . $wp_rewrite->preg_index(2),
		);

		$wp_rewrite->rules = array_merge( $new_rules, $wp_rewrite->rules );

	} // END rewrite_rules()
	
	/**
	 * query_vars()
	 * @param array $query_vars Array of query variables to watch for
	 * @return array $query_vars Modified array of query variables to watch for
	 */
	function query_vars( $query_vars ) {
		$query_vars[] = 'cunyj_year';
		$query_vars[] = 'cunyj_monthnum';
		return $query_vars;
	} // END query_vars()
	
	function create_post_type() {

		if (function_exists('register_post_type')) {
			register_post_type('cunyj_event',
		    array(
				'labels' => array(
		        	'name' => 'Events',
					'singular_name' => 'Event',
						'add_new_item' => 'Add New Event',
						'edit_item' => 'Edit Event',
						'new_item' => 'New Event',
						'view' => 'View Event',
						'view_item' => 'View Event',
						'search_items' => 'Search Events',
						'not_found' => 'No events found',
						'not_found_in_trash' => 'No events found in Trash',
						'parent' => 'Parent Event'
				),
				'menu_position' => 10,
				'public' => true,
				'has_archive' => true,
				'rewrite' => array(
					'slug' => 'events',
					'feeds' => false,
					'with_front' => true
				),
				'supports' => array(
					'title',
					'editor',
					'comments',
					'excerpt',
					'thumbnail',
				),
				'taxonomies' => array(
					'post_tag',
					'cunyj_event_category'
				)
		    )
		  );
		}
	}
	
	function create_taxonomies() {
		
		$args = array(	'label' => 'Event Categories',	
						'show_tagcloud' => false,
						'hierarchical' => true,
						);
		
		register_taxonomy('cunyj_event_category', 'cunyj_event', $args);
		
		
	}
	
	// Loads scripts 
	function add_admin_scripts() {
		global $pagenow;
		
		// Only load scripts and styles on relevant pages in the WordPress admin
		if ( $pagenow == 'post.php' || $pagenow == 'post-new.php' || $pagenow == 'page.php' ) {
			wp_enqueue_script( 'cngnyc_event_js', get_bloginfo('template_url') . '/js/events_admin.js', array('jquery'), CUNYJ_VERSION, true );
			wp_enqueue_style( 'cngnyc_event_admin_css', get_bloginfo('template_url') . '/css/events_admin.css', false, CUNYJ_VERSION, 'all' );
		}
		
	}
	
	function add_post_meta_box() {
		global $cunyj;
		
		if (function_exists('add_meta_box')) {
			add_meta_box('cunyj-events', __('Event', 'cunyj-events'), array(&$this, 'post_meta_box'), 'cunyj_event', 'normal', 'high');
		}
	}
	
	function post_meta_box() {
		global $post, $cunyj;
		
		$all_months = array(
				'January',
				'February',
				'March',
				'April',
				'May',
				'June',
				'July',
				'August',
				'September',
				'October',
				'November',
				'December');
				
		$all_day = get_post_meta($post->ID, '_cngnyc_event_all_day', true);
		if (!$all_day) {
			$all_day = 'on';
		}		
		
		$start_date = get_post_meta($post->ID, '_cngnyc_event_start_date', true);
		// Use today's date as start date if start date doesn't exist yet
		if (!$start_date) {
			$start_date = false;
		}
		$start_date_month = date_i18n('F', $start_date);
		$start_date_day = date_i18n('j', $start_date);
		$start_date_year = date_i18n('Y', $start_date);
		$start_date_hour = date_i18n('g', $start_date);
		$start_date_minute = date_i18n('i', $start_date);
		$start_date_ampm = date_i18n('A', $start_date);
			
		$end_date = get_post_meta($post->ID, '_cngnyc_event_end_date', true);
		// Use today's date as end date if end date doesn't exist yet
		if (!$end_date) {
			$end_date = false;
		}
		$end_date_month = date_i18n('F', $end_date);
		$end_date_day = date_i18n('j', $end_date);
		$end_date_year = date_i18n('Y', $end_date);
		// @todo adjust hour plus one
		$end_date_hour = date_i18n('g', $end_date);
		$end_date_minute = date_i18n('i', $end_date);
		$end_date_ampm = date_i18n('A', $end_date);
		
		$venue = get_post_meta($post->ID, '_cngnyc_event_venue', true);
		$street = get_post_meta($post->ID, '_cngnyc_event_street', true);
		$city = get_post_meta($post->ID, '_cngnyc_event_city', true);
		$state = get_post_meta($post->ID, '_cngnyc_event_state', true);
		$zipcode = get_post_meta($post->ID, '_cngnyc_event_zipcode', true);
		
		?>
		
		<div id="inner">
		
		<div id="time-date">
		
			<h4 class="buttonize">Date &amp; Time</h4>
			
			<div class="sub">
			
			<p><label for="cngnyc_event-all_day">All day event?</label><input type="checkbox" id="cngnyc_event-all_day" name="cngnyc_event-all_day"<?php if ($all_day == 'on') { echo ' checked="checked"'; } ?> /></p>
			
			<p><label>From:</label>
				<select id="cngnyc_event-start_date_month" name="cngnyc_event-start_date_month">
					<?php foreach( $all_months as $month ) : ?>
						<option<?php if ($start_date_month == $month) echo ' selected="selected"'; ?>><?php echo $month; ?></option>
					<?php endforeach; ?>
				</select>
				<input type="text" id="cngnyc_event-start_date_day" name="cngnyc_event-start_date_day" value="<?php echo $start_date_day; ?>" size="2" maxlength="2" autocomplete="off" />
				<input type="text" id="cngnyc_event-start_date_year" name="cngnyc_event-start_date_year" value="<?php echo $start_date_year; ?>" size="4" maxlength="4" autocomplete="off" />
				<span class="event_date_time<?php if ($all_day == 'on') { echo ' hidden'; } ?>">
					<span class="inline">at</span>
					<input type="text" id="cngnyc_event-start_date_hour" name="cngnyc_event-start_date_hour" value="<?php echo $start_date_hour; ?>" size="2" maxlength="2" autocomplete="off" />
					<input type="text" id="cngnyc_event-start_date_minute" name="cngnyc_event-start_date_minute" value="<?php echo $start_date_minute; ?>" size="2" maxlength="2" autocomplete="off" />
					<select id="cngnyc_event-start_date_ampm" name="cngnyc_event-start_date_ampm">
							<option<?php if ($start_date_ampm == 'AM') echo ' selected="selected"'; ?>>AM</option>
							<option<?php if ($start_date_ampm == 'PM') echo ' selected="selected"'; ?>>PM</option>							
					</select>
				</span>
			</p>
			
			<p><label>To:</label>
				<select id="cngnyc_event-end_date_month" name="cngnyc_event-end_date_month">
					<?php foreach( $all_months as $month ) : ?>
						<option<?php if ($end_date_month == $month) echo ' selected="selected"'; ?>><?php echo $month; ?></option>
					<?php endforeach; ?>
				</select>
				<input type="text" id="cngnyc_event-end_date_day" name="cngnyc_event-end_date_day" value="<?php echo $end_date_day; ?>" size="2" maxlength="2" autocomplete="off" />
				<input type="text" id="cngnyc_event-end_date_year" name="cngnyc_event-end_date_year" value="<?php echo $end_date_year; ?>" size="4" maxlength="4" autocomplete="off" />
				<span class="event_date_time<?php if ($all_day == 'on') { echo ' hidden'; } ?>">
					<span class="inline">at</span>
					<input type="text" id="cngnyc_event-end_date_hour" name="cngnyc_event-end_date_hour" value="<?php echo $end_date_hour; ?>" size="2" maxlength="2" autocomplete="off" />
					<input type="text" id="cngnyc_event-end_date_minute" name="cngnyc_event-end_date_minute" value="<?php echo $end_date_minute; ?>" size="2" maxlength="2" autocomplete="off" />
					<select id="cngnyc_event-end_date_ampm" name="cngnyc_event-end_date_ampm">
							<option<?php if ($end_date_ampm == 'AM') echo ' selected="selected"'; ?>>AM</option>
							<option<?php if ($end_date_ampm == 'PM') echo ' selected="selected"'; ?>>PM</option>							
					</select>
				</span>
			</p>
			
			</div>
		
		</div>
		
		<div id="details">
			
			<h4>Details</h4>
			
			<div class="sub">
				
				<p><label for="cngnyc_event-venue">Venue:</label>
					<input type="text" id="cngnyc_event-venue" name="cngnyc_event-venue" value="<?php echo $venue; ?>" size="50" /></p>
				<?php if (!$street && !$city && !$state && !$zipcode) : ?>
				<p><a href="#" id="add_street_address" class="action">Add street address</a></p>
				<?php endif; ?>
				<div id="street_address_wrap" <?php if (!$street && !$city && !$state && !$zipcode) { echo ' class="hidden"'; } ?>>
				<p><label for="cngnyc_event-street">Street:</label>
					<input type="text" id="cngnyc_event-street" name="cngnyc_event-street" value="<?php echo $street; ?>" size="50" /></p>
				<p><label for="cngnyc_event-city">City:</label>
					<input type="text" id="cngnyc_event-city" name="cngnyc_event-city" value="<?php echo $city; ?>" size="50" /></p>
					
				<p><label for="cngnyc_event-state">State:</label>
					<input type="text" id="cngnyc_event-state" name="cngnyc_event-state" value="<?php echo $state; ?>" size="50" /></p>
				<p><label for="cngnyc_event-zipcode">Zipcode:</label>
					<input type="text" id="cngnyc_event-zipcode" name="cngnyc_event-zipcode" value="<?php echo $zipcode; ?>" size="50" /></p>
					
				</div>
				
			</div>
			
		</div>

		<div id="contact">
			
			<h4>Contact</h4>
			
			<div class="sub">
			
				Coming soon
				
			</div>
			
		</div>
		
		<div id="related-links">
			
			<h4>Related Links</h4>
			
			<div class="sub">
				
				Coming soon
				
			</div>
			
		</div>
		
		</div>
		
		<input type="hidden" name="cngnyc_event-nonce" id="cngnyc_event-nonce" value="<?php echo wp_create_nonce('cngnyc_event-nonce'); ?>" />
		
		<?php 
		
	}
	
	function save_post_meta_box($post_id) {
		global $cunyj, $post;
		
		if ( !wp_verify_nonce( $_POST['cngnyc_event-nonce'], 'cngnyc_event-nonce')) {
			return $post_id;  
		}
		
		if( !wp_is_post_revision($post) && !wp_is_post_autosave($post) ) {
			
			$all_day = $_POST['cngnyc_event-all_day'];
			if ($all_day) {
				$all_day = 'on';
			} else {
				$all_day = 'off';
			}
			update_post_meta($post_id, '_cngnyc_event_all_day', $all_day);
			
			$default_time = ' 12:00 PM';
			
			$start_date_month = $_POST['cngnyc_event-start_date_month'];
			$start_date_day = $_POST['cngnyc_event-start_date_day'];
			$start_date_year = $_POST['cngnyc_event-start_date_year'];
			$start_date_hour = $_POST['cngnyc_event-start_date_hour'];
			$start_date_minute = $_POST['cngnyc_event-start_date_minute'];
			$start_date_ampm = $_POST['cngnyc_event-start_date_ampm'];
			$start_date = $start_date_month . ' ' . $start_date_day . ', ' . $start_date_year;
			if ($all_day == 'off') {
				$start_date .= ' ' . $start_date_hour . ':' . $start_date_minute . ' ' . $start_date_ampm;
			} else {
				$start_date .= ' ' . $default_time;
			}
			//$start_date = get_gmt_from_date($start_date); // @todo we should probably store this as unix timestamp
			$start_date = strtotime($start_date);
			update_post_meta($post_id, '_cngnyc_event_start_date', $start_date);
			
			$end_date_month = $_POST['cngnyc_event-end_date_month'];
			$end_date_day = $_POST['cngnyc_event-end_date_day'];
			$end_date_year = $_POST['cngnyc_event-end_date_year'];
			$end_date_hour = $_POST['cngnyc_event-end_date_hour'];
			$end_date_minute = $_POST['cngnyc_event-end_date_minute'];
			$end_date_ampm = $_POST['cngnyc_event-end_date_ampm'];
			$end_date = $end_date_month . ' ' . $end_date_day . ', ' . $end_date_year;
			if ($all_day == 'off') {
				$end_date .= ' ' . $end_date_hour . ':' . $end_date_minute . ' ' . $end_date_ampm;
			} else {
				$end_date .= ' ' . $default_time;
			}
			//$end_date = get_gmt_from_date($end_date); // @todo we should probably store this as unix timestamp
			$end_date = strtotime($end_date);
			update_post_meta($post_id, '_cngnyc_event_end_date', $end_date);
			
			update_post_meta($post_id, '_cngnyc_event_venue', esc_html($_POST['cngnyc_event-venue']));
			update_post_meta($post_id, '_cngnyc_event_street', esc_html($_POST['cngnyc_event-street']));
			update_post_meta($post_id, '_cngnyc_event_city', esc_html($_POST['cngnyc_event-city']));
			update_post_meta($post_id, '_cngnyc_event_state', esc_html($_POST['cngnyc_event-state']));
			update_post_meta($post_id, '_cngnyc_event_zipcode', esc_html($_POST['cngnyc_event-zipcode']));
			
			// Save the data
		}		
	}
	
}

}

?>