<?php

define( 'CNGNYC_VERSION', '0.0' );

if ( !class_exists( 'cngnyc' ) ) {

class cngnyc {
	
	/**
	 * __construct()
	 */
	function __construct() {
		
		// Add support for post formats and post thumbnails
		add_action( 'after_setup_theme', array( &$this, 'after_setup_theme' ) );
		
		add_action( 'init', array( &$this, 'init' ) );
		add_action( 'init', array( &$this, 'create_taxonomies' ) );
		add_action( 'init', array( &$this, 'enqueue_resources' ) );
		add_action( 'init', array( &$this, 'register_menus' ) );
		
	} // END __construct()
	
	/**
	 * init()
	 */
	function init() {
		global $wp_taxonomies;
		
		if ( taxonomy_exists( 'post_tag' ) ) {
			unset( $wp_taxonomies['post_tag']);
		}
		if ( taxonomy_exists( 'category' ) ) {
			unset( $wp_taxonomies['category']);
		}
		
	} // END init()
	
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
		
		$post_types = array(
			'post',
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
			'show_tagcloud' => false,
			'rewrite' => array(
				'slug' => 'places',
				'hierarchical' => true,
			),
		);

		$post_types = array(
			'post',
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
		
		$post_types = array(
			'post',
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
		
		$post_types = array(
			'post',
		);
		register_taxonomy( 'cngnyc_themes', $post_types, $args );
		
	} // END create_taxonomies()

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