<?php

if ( ! class_exists( 'Post_Press_Room' ) ) {

	class Post_Press_Room {

		// Constructor.
		public function __construct() {
			add_action( 'init', array( &$this, 'kat_press_room_init' ) );
			add_action( 'init', array( &$this, 'kat_pr_taxonomies' ) );

		}

		// Register post type.
		public function kat_press_room_init() {
			$labels = array(
				'name'               => _x( 'Press Room', 'post type general name', 'katara' ),
				'singular_name'      => _x( 'Press Room', 'post type singular name', 'katara' ),
				'menu_name'          => _x( 'Press Room', 'admin menu', 'katara' ),
				'name_admin_bar'     => _x( 'Press_Room', 'add new on admin bar', 'katara' ),
				'add_new'            => _x( 'Add New Press Room', 'faq', 'katara' ),
				'add_new_item'       => __( 'Add New Press Room', 'katara' ),
				'new_item'           => __( 'New Press Room', 'katara' ),
				'edit_item'          => __( 'Edit Press_Room', 'katara' ),
				'view_item'          => __( 'View Press_Room', 'katara' ),
				'all_items'          => __( 'All Press Rooms', 'katara' ),
				'search_items'       => __( 'Search Press Room', 'katara' ),
				'parent_item_colon'  => __( 'Parent Press Room:', 'katara' ),
				'not_found'          => __( 'No Press_Room found.', 'katara' ),
				'not_found_in_trash' => __( 'No Press_Room found in Trash.', 'katara' )
			);

			$args = array(
				'labels'             => $labels,
				'description'        => __( 'This is a custom post type for site Press Room.', 'katara' ),
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

			register_post_type( 'press_room', $args );
		}

		public function kat_pr_taxonomies(){
			$labels = array(
				'name'              => _x( 'Categories', 'taxonomy general name', 'katara' ),
				'singular_name'     => _x( 'Category', 'taxonomy singular name', 'katara' ),
				'search_items'      => __( 'Search Categories', 'katara' ),
				'all_items'         => __( 'All Categories', 'katara' ),
				'parent_item'       => __( 'Parent Category', 'katara' ),
				'parent_item_colon' => __( 'Parent Category: ', 'katara' ),
				'edit_item'         => __( 'Edit Category', 'katara' ),
				'update_item'       => __( 'Update Category', 'katara' ),
				'add_new_item'      => __( 'Add New Category', 'katara' ),
				'new_item_name'     => __( 'New Category Name', 'katara' ),
				'separate_items_with_commas' => __( 'Separate ategory with commas.', 'katara' ),
				'add_or_remove_items'		 => __( 'Add or remove ategory.', 'katara' ),
				'choose_from_most_used'		 => __( 'Choose from the most used ategory.', 'katara' ),
				'menu_name'         		 => __( 'Categories', 'katara' ),
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

			register_taxonomy( 'press_room_cat', array( 'press_room' ), $args );
		}

	}

	// Make a call.
	new Post_Press_Room();

}
