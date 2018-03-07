<?php

if ( ! class_exists( 'Post_Timeline' ) ) {

	class Post_Timeline {

		// Constructor.
		public function __construct() {
			add_action( 'init', array( &$this, 'kat_timeline_init' ) );
			add_action( 'init', array( &$this, 'kat_year_taxonomies' ) );

		}

		// Register post type.
		public function kat_timeline_init() {
			$labels = array(
				'name'               => _x( 'Timeline', 'post type general name', 'katara' ),
				'singular_name'      => _x( 'Timeline', 'post type singular name', 'katara' ),
				'menu_name'          => _x( 'Timeline', 'admin menu', 'katara' ),
				'name_admin_bar'     => _x( 'Timeline', 'add new on admin bar', 'katara' ),
				'add_new'            => _x( 'Add New Timeline', 'faq', 'katara' ),
				'add_new_item'       => __( 'Add New Timeline', 'katara' ),
				'new_item'           => __( 'New Timeline', 'katara' ),
				'edit_item'          => __( 'Edit Timeline', 'katara' ),
				'view_item'          => __( 'View Timeline', 'katara' ),
				'all_items'          => __( 'All Timeline', 'katara' ),
				'search_items'       => __( 'Search Timeline', 'katara' ),
				'parent_item_colon'  => __( 'Parent Timeline:', 'katara' ),
				'not_found'          => __( 'No Timeline found.', 'katara' ),
				'not_found_in_trash' => __( 'No Timeline found in Trash.', 'katara' )
			);

			$args = array(
				'labels'             => $labels,
				'description'        => __( 'This is a custom post type for site Timeline.', 'katara' ),
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'capability_type'    => 'post',
				'has_archive'        => false,
				'hierarchical'       => false,
				'map_meta_cap'       => true,
				'exclude_from_search' => true,
				'menu_position'      => null,
				'supports'           => array( 'title', 'editor', 'thumbnail', 'page-attributes'),
				'menu_icon'			 => 'dashicons-arrow-right-alt',
			);

			register_post_type( 'history_timeline', $args );
		}

		public function kat_year_taxonomies(){
			$labels = array(
				'name'              => _x( 'Years', 'taxonomy general name', 'katara' ),
				'singular_name'     => _x( 'Year', 'taxonomy singular name', 'katara' ),
				'search_items'      => __( 'Search Years', 'katara' ),
				'all_items'         => __( 'All Years', 'katara' ),
				'parent_item'       => __( 'Parent Year', 'katara' ),
				'parent_item_colon' => __( 'Parent Year: ', 'katara' ),
				'edit_item'         => __( 'Edit Year', 'katara' ),
				'update_item'       => __( 'Update Year', 'katara' ),
				'add_new_item'      => __( 'Add New Year', 'katara' ),
				'new_item_name'     => __( 'New Year Name', 'katara' ),
				'separate_items_with_commas' => __( 'Separate city with commas.', 'katara' ),
				'add_or_remove_items'		 => __( 'Add or remove city.', 'katara' ),
				'choose_from_most_used'		 => __( 'Choose from the most used city.', 'katara' ),
				'menu_name'         		 => __( 'Years', 'katara' ),
			);

			$args = array(
				'hierarchical'      => true,
				'labels'            => $labels,
				'public'			=> true,
				'show_ui'           => true,
				'show_in_nav_menus'	=> true,
				'show_tagcloud'		=> false,
				'show_admin_column' => true,
				'query_var'         => true,
			);

			register_taxonomy( 'history_year', array( 'history_timeline' ), $args );
		}

	}

	// Make a call.
	new Post_Timeline();

}
