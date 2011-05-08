<?php

if ( !class_exists( 'cngnyc_event' ) ) {

class cngnyc_event
{
	
	function __construct() {
		
		// Add Event post type
		add_action('init', array(&$this, 'create_post_type'));
		
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

		$type = 'cngnyc_event';
		$type_slug = 'events';

		$new_rules = array(
			$type_slug . '/([0-9]+)/?$' => 'index.php?post_type=' . $type . '&cngnyc_year=' . $wp_rewrite->preg_index(1),
			$type_slug . '/([0-9]+)/([0-9]+)/?$' => 'index.php?post_type=' . $type . '&cngnyc_year=' . $wp_rewrite->preg_index(1) . '&cngnyc_monthnum=' . $wp_rewrite->preg_index(2),
		);

		$wp_rewrite->rules = array_merge( $new_rules, $wp_rewrite->rules );

	} // END rewrite_rules()
	
	/**
	 * query_vars()
	 * @param array $query_vars Array of query variables to watch for
	 * @return array $query_vars Modified array of query variables to watch for
	 */
	function query_vars( $query_vars ) {
		$query_vars[] = 'cngnyc_year';
		$query_vars[] = 'cngnyc_monthnum';
		return $query_vars;
	} // END query_vars()
	
	/**
	 * create_post_type()
	 */
	function create_post_type() {
		
		register_post_type( 'cngnyc_event',
		    array(
				'labels' => array(
		        	'name' => 'Live Coverage Event',
					'singular_name' => 'Live Coverage Event',
						'add_new_item' => 'Add New Live Coverage Event',
						'edit_item' => 'Edit Live Coverage Event',
						'new_item' => 'New Live Coverage Event',
						'view' => 'View Live Coverage Event',
						'view_item' => 'View Live Coverage Event',
						'search_items' => 'Search Live Coverage Events',
						'not_found' => 'No live coverage events found',
						'not_found_in_trash' => 'No live coverage events found in Trash',
						'parent' => 'Parent Live Coverage Event'
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
					'author',
				),
				'taxonomies' => array(
					'cngnyc_topics',
					'cngnyc_places',
					'cngnyc_themes',
					'cngnyc_classes',
				)
		    )
		); // END register_post_type()
		
	} // END create_post_type()
	
	/**
	 * add_admin_scripts()
	 */
	function add_admin_scripts() {
		global $pagenow;
		
		// Only load scripts and styles on relevant pages in the WordPress admin
		if ( $pagenow == 'post.php' || $pagenow == 'post-new.php' || $pagenow == 'page.php' ) {
			wp_enqueue_script( 'cngnyc_event_js', get_bloginfo('template_url') . '/js/cngnyc_event_admin.js', array('jquery'), CNGNYC_VERSION, true );
			wp_enqueue_style( 'cngnyc_event_admin_css', get_bloginfo('template_url') . '/css/cngnyc_event_admin.css', false, CNGNYC_VERSION, 'all' );
		}
		
	} // END add_admin_scripts()
	
	/**
	 * add_post_meta_box()
	 */
	function add_post_meta_box() {
		global $cngnyc;
		
		add_meta_box( 'cngnyc_events', __( 'Live Coverage Event', 'cngnyc-events' ), array(&$this, 'post_meta_box'), 'cngnyc_event', 'normal', 'high' );
		
	} // END add_post_meta_box()
	
	function post_meta_box() {
		global $post, $cngnyc;
		
		$status = get_post_meta($post->ID, '_cngnyc_event_status', true);
		if ( !$status ) {
			$status = 'off';
		}		
		
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
		if ( !$all_day ) {
			$all_day = 'on';
		}		
		
		$start_date = get_post_meta($post->ID, '_cngnyc_event_start_date', true);
		// Use today's date as start date if start date doesn't exist yet
		if ( !$start_date ) {
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
		
		?>
		
		<div id="inner">
			
			<div id="details"><!-- END #details -->

				<h4>Details</h4>
				
				<p><label for="cngnyc_event-status">Has this been covered?</label>
					<select id="cngnyc_event-status" name="cngnyc_event-status">
						<option<?php if ( $status == 'off' ) echo ' selected="selected"'; ?> value="off">Not yet</option>
						<option<?php if ( $status == 'on' ) echo ' selected="selected"'; ?> value="on">Yep</option>
					</select>
				</p>

			</div><!-- END #details -->	
		
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
		
		</div><!-- END #time-date -->
		
		</div>
		
		<input type="hidden" name="cngnyc_event-nonce" id="cngnyc_event-nonce" value="<?php echo wp_create_nonce('cngnyc_event-nonce'); ?>" />
		
		<?php 
		
	}
	
	function save_post_meta_box($post_id) {
		global $cngnyc, $post;
		
		if ( !wp_verify_nonce( $_POST['cngnyc_event-nonce'], 'cngnyc_event-nonce')) {
			return $post_id;  
		}
		
		if ( !wp_is_post_revision( $post ) && !wp_is_post_autosave( $post ) ) {
			
			$all_day = $_POST['cngnyc_event-status'];
			if ( $all_day == 'on' ) {
				$all_day = 'on';
			} else {
				$all_day = 'off';
			}
			update_post_meta( $post_id, '_cngnyc_event_status', $all_day );			
			
			$all_day = $_POST['cngnyc_event-all_day'];
			if ($all_day) {
				$all_day = 'on';
			} else {
				$all_day = 'off';
			}
			update_post_meta( $post_id, '_cngnyc_event_all_day', $all_day );			
			
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
			
			// Save the data
			
		} // END if ( !wp_is_post_revision( $post ) && !wp_is_post_autosave( $post ) )
		
	}
	
}

}

?>