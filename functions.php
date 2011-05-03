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
			'primary-navigation' => __( 'Header Menu' ) 
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
		
	} // END create_taxonomies()

	/**
	 * after_setup_theme()
	 */
	function after_setup_theme() {
		
		$post_formats = array(
			'aside',
			'gallery',
			'status',
			'quote',
			'image',
			'link',
		);
		add_theme_support( 'post-formats', $post_formats );
		add_post_type_support( 'post', 'post-formats' );
		
		add_theme_support( 'post-thumbnails' );
		
	} // END after_setup_theme()
	
	
} // END class cngnyc
	
} // END if ( !class_exists( 'cngnyc' ) )

global $cngnyc;
$cngnyc = new cngnyc();

?>