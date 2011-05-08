<?php

define( 'CNGNYC_VERSION', '0.1' );

include_once( 'php/class.cngnyc_event.php' );

if ( !class_exists( 'cngnyc' ) ) {

class cngnyc {
	
	var $options_group = 'cngnyc_';
	var $options_group_name = 'cngnyc_options';
	var $settings_page = 'cngnyc_settings';
	
	/**
	 * __construct()
	 */
	function __construct() {
		
		$this->event = new cngnyc_event();
		
		// Add support for post formats and post thumbnails
		add_action( 'after_setup_theme', array( &$this, 'after_setup_theme' ) );
		
		add_action( 'init', array( &$this, 'init' ) );
		add_action( 'init', array( &$this, 'create_taxonomies' ) );
		add_action( 'init', array( &$this, 'enqueue_resources' ) );
		add_action( 'init', array( &$this, 'register_menus' ) );
		
		add_action( 'admin_init', array( &$this, 'admin_init' ) );
		
		$this->options = get_option( $this->options_group_name );
		
	} // END __construct()
	
	/**
	 * init()
	 */
	function init() {
		global $wp_taxonomies;
		
		if ( is_admin() ) {
			add_action( 'admin_menu', array(&$this, 'add_admin_menu_items') );
		}		
		
		if ( taxonomy_exists( 'post_tag' ) ) {
			unset( $wp_taxonomies['post_tag']);
		}
		if ( taxonomy_exists( 'category' ) ) {
			unset( $wp_taxonomies['category']);
		}
		
	} // END init()
	
	/**
	 * admin_init()
	 */
	function admin_init() {
		
		$this->register_settings();
		
	} // END admin_init()
	
	/**
	 * add_admin_menu_items()
	 * Any admin menu items we need
	 */
	function add_admin_menu_items() {

		add_submenu_page( 'themes.php', 'Changing NYC Theme Options', 'Theme Options', 'manage_options', 'cngnyc_options', array( &$this, 'options_page' ) );			

	} // END add_admin_menu_items()
	
	/**
	 * register_menus()
	 * Register menus
	 */
	function register_menus() {
	  register_nav_menus(
	    array( 
			'primary-navigation' => 'Primary Navigation',
			'sidebar-taxonomy-places' => 'Taxonomy Sidebar: Places'
		)
	  );
	} // END register_menus()
	
	
	/**
	 * enqueue_resources()
	 * Enqueue any resources we need
	 */
	function enqueue_resources() {
		
		if ( !is_admin() ) {
			wp_enqueue_style( 'cngnyc_primary_css', get_bloginfo('template_directory') . '/style.css', false, CNGNYC_VERSION );
			wp_enqueue_style( 'custom_font_css', 'http://fonts.googleapis.com/css?family=Droid+Serif:regular,italic,bold,bolditalic', false, CNGNYC_VERSION );
		}
		
	} // END enqueue_resources()
	
	/**
	 * create_taxonomies()
	 * Register taxonomies for all of our post types
	 */
	function create_taxonomies() {
		
		$post_types = array(
			'post',
			'cngnyc_event',
		);
		
		// Register the Classes taxonomy
		$args = array(
			'label' => 'Classes',
			'labels' => array(
				'name' => 'Classes',
				'singular_name' => 'Class',
				'search_items' =>  'Search Classes',
				'popular_items' => 'Popular Classes',
				'all_items' => 'All Classes',
				'parent_item' => 'Parent Classes',
				'parent_item_colon' => 'Parent Classes:',
				'edit_item' => 'Edit Class', 
				'update_item' => 'Update Class',
				'add_new_item' => 'Add New Class',
				'new_item_name' => 'New Class',
				'separate_items_with_commas' => 'Separate classes with commas',
				'add_or_remove_items' => 'Add or remove classes',
				'choose_from_most_used' => 'Choose from the most common classes',
				'menu_name' => 'Classes',
			),
			'hierarchical' => true,
			'show_tagcloud' => false,
			'rewrite' => array(
				'slug' => 'classes',
				'hierarchical' => true,
			),
		);
		register_taxonomy( 'cngnyc_classes', $post_types, $args );
		
		// Register the Places taxonomy
		$args = array(
			'label' => 'Places',
			'labels' => array(
				'name' => 'Places',
				'singular_name' => 'Place',
				'search_items' =>  'Search Places',
				'popular_items' => 'Popular Places',
				'all_items' => 'All Places',
				'parent_item' => 'Parent Places',
				'parent_item_colon' => 'Parent Places:',
				'edit_item' => 'Edit Place', 
				'update_item' => 'Update Place',
				'add_new_item' => 'Add New Place',
				'new_item_name' => 'New Place',
				'separate_items_with_commas' => 'Separate places with commas',
				'add_or_remove_items' => 'Add or remove places',
				'choose_from_most_used' => 'Choose from the most common places',
				'menu_name' => 'Places',
			),
			'hierarchical' => true,
			'show_tagcloud' => false,
			'rewrite' => array(
				'slug' => 'places',
				'hierarchical' => true,
			),
		);
		register_taxonomy( 'cngnyc_places', $post_types, $args );
		
		// Register the Topics taxonomy
		$args = array(
			'label' => 'Topics',
			'labels' => array(
				'name' => 'Topics',
				'singular_name' => 'Topic',
				'search_items' =>  'Search Topics',
				'popular_items' => 'Popular Topics',
				'all_items' => 'All Topics',
				'parent_item' => 'Parent Topics',
				'parent_item_colon' => 'Parent Topics:',
				'edit_item' => 'Edit Topic', 
				'update_item' => 'Update Topic',
				'add_new_item' => 'Add New Topic',
				'new_item_name' => 'New Topic',
				'separate_items_with_commas' => 'Separate topics with commas',
				'add_or_remove_items' => 'Add or remove topics',
				'choose_from_most_used' => 'Choose from the most common topics',
				'menu_name' => 'Topics',
			),
			'show_tagcloud' => false,
			'rewrite' => array(
				'slug' => 'topics',
				'hierarchical' => true,
			),
		);
		register_taxonomy( 'cngnyc_topics', $post_types, $args );
		
		// Register the Themes taxonomy
		$args = array(
			'label' => 'Themes',
			'labels' => array(
				'name' => 'Themes',
				'singular_name' => 'Theme',
				'search_items' =>  'Search Themes',
				'popular_items' => 'Popular Themes',
				'all_items' => 'All Themes',
				'parent_item' => 'Parent Themes',
				'parent_item_colon' => 'Parent Themes:',
				'edit_item' => 'Edit Theme', 
				'update_item' => 'Update Theme',
				'add_new_item' => 'Add New Theme',
				'new_item_name' => 'New Theme',
				'separate_items_with_commas' => 'Separate themes with commas',
				'add_or_remove_items' => 'Add or remove themes',
				'choose_from_most_used' => 'Choose from the most common themes',
				'menu_name' => 'Themes',
			),
			'hierarchical' => true,
			'show_tagcloud' => false,
			'rewrite' => array(
				'slug' => 'themes',
				'hierarchical' => true,
			),
		);
		register_taxonomy( 'cngnyc_themes', $post_types, $args );
		
	} // END create_taxonomies()
	
	/**
	 * register_settings()
	 */
	function register_settings() {
		
		register_setting( $this->options_group, $this->options_group_name, array( &$this, 'settings_validate' ) );

		// Global options
		add_settings_section( 'cngnyc_global', 'Global', array(&$this, 'settings_global_section'), $this->settings_page );
		// Top homepage announcement
		add_settings_field( 'project_description', 'Project Description', array(&$this, 'settings_project_description_option'), $this->settings_page, 'cngnyc_global' );
		
		
	} // END register_settings()
	
	/**
	 * settings_project_description_option()
	 */
	function settings_project_description_option() {
		
		$options = $this->options;
		$allowed_tags = htmlentities( '<b><strong><em><i><span><a><br>' );

		echo '<textarea id="project_description" name="' . $this->options_group_name . '[project_description]" cols="80" rows="6">';
		if ( isset( $options['project_description'] ) && $options['project_description'] ) {
			echo $options['project_description'];
		}
		echo '</textarea>';
		echo '<p class="description">The following tags are permitted: ' . $allowed_tags . '</p>';
		
	} // END settings_project_description_option()
	
	/**
	 * settings_validate()
	 * Validation and sanitization on the settings field
	 */
	function settings_validate( $input ) {

		$input['top_announcement'] = strip_tags( $input['top_announcement'], $allowed_tags );
		return $input;

	} // END settings_validate()
	
	/**
	 * Options page for the theme
	 */
	function options_page() {
		?>                                   
		<div class="wrap">
			<div class="icon32" id="icon-options-general"><br/></div>

			<h2><?php _e('Changing NYC Theme Options', 'cngnyc-theme') ?></h2>

			<form action="options.php" method="post">

				<?php settings_fields( $this->options_group ); ?>
				<?php do_settings_sections( $this->settings_page ); ?>

				<p class="submit"><input name="submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" /></p>

			</form>
		</div>
		<?php
	}

	/**
	 * after_setup_theme()
	 */
	function after_setup_theme() {
		
		$post_formats = array(
			'audio',
			'gallery',
			'image',
		);
		add_theme_support( 'post-formats', $post_formats );
		add_post_type_support( 'post', 'post-formats' );
		
		add_theme_support( 'post-thumbnails' );
		
	} // END after_setup_theme()
	
	
} // END class cngnyc
	
} // END if ( !class_exists( 'cngnyc' ) )

global $cngnyc;
$cngnyc = new cngnyc();

/**
 * cngnyc_get_term_base()
 */
function cngnyc_get_term_base( $term_object ) {
	
	if ( !is_object( $term_object ) ) {
		return false;
	}
	
	switch( $term_object->taxonomy ) {
		case 'cngnyc_classes':
			return 'classes';
			break;
		case 'cngnyc_topics':
			return 'topics';
			break;
		case 'cngnyc_places':
			return 'places';
			break;
		case 'cngnyc_themes':
			return 'themes';
			break;	
		default:
			return false;
	}
	
} // END cngnyc_get_term_base()

/**
 * cngnyc_head_title()
 * Generate the <title> tag based on context
 */
function cngnyc_head_title() {
	
	$title = get_bloginfo('name') . ' | ' . get_bloginfo('description');
	
	if ( is_single() ) {
		global $post;
		$title = get_the_title( $post->ID );
	} else if ( is_tax() ) {
		$title = single_term_title( false, false ) . ' | ' . get_bloginfo('name');
	}
	
	echo '<title>' . $title . '</title>';
	
} // END cngnyc_head_title()

/**
 * cngnyc_project_description()
 * Print the project description
 */
function cngnyc_project_description() {
	global $cngnyc;
	
	if ( !empty( $cngnyc->options['project_description'] ) ) {
		echo $cngnyc->options['project_description'];		
	} else {
		echo "Please add a project description in theme options.";
	}
	
} // END cngnyc_project_description()

/**
 * cngnyc_is_post_term()
 */
function cngnyc_is_post_term( $term_object, $post_terms = array() ) {
	
	if ( !is_object( $term_object ) || empty( $post_terms ) ) {
		return false;
	}
	
	foreach ( $post_terms as $post_term ) {
		if ( $post_term->slug == $term_object->slug && $post_term->taxonomy == $term_object->taxonomy ) {
			return true;
		}
	} // END foreach ( $post_terms as $post_term )	
	
	return false;
	
} // END cngnyc_is_post_term()

?>