<?php

if ( ! class_exists( 'Post_Partner' ) ) {

	class Post_Partner {

		// Constructor.
		public function __construct() {
			add_action( 'init', array( &$this, 'kat_partner_init' ) );
			
		}

		// Register post type.
		public function kat_partner_init() {
			$labels = array(
				'name'               => _x( 'Partners', 'post type general name', 'katara' ),
				'singular_name'      => _x( 'Partner', 'post type singular name', 'katara' ),
				'menu_name'          => _x( 'Partners', 'admin menu', 'katara' ),
				'name_admin_bar'     => _x( 'Partner', 'add new on admin bar', 'katara' ),
				'add_new'            => _x( 'Add New Partner', 'faq', 'katara' ),
				'add_new_item'       => __( 'Add New Partner', 'katara' ),
				'new_item'           => __( 'New Partner', 'katara' ),
				'edit_item'          => __( 'Edit Partner', 'katara' ),
				'view_item'          => __( 'View Partner', 'katara' ),
				'all_items'          => __( 'All Partners', 'katara' ),
				'search_items'       => __( 'Search Partner', 'katara' ),
				'parent_item_colon'  => __( 'Parent Partner:', 'katara' ),
				'not_found'          => __( 'No Partner found.', 'katara' ),
				'not_found_in_trash' => __( 'No Partner found in Trash.', 'katara' )
			);

			$args = array(
				'labels'             => $labels,
				'description'        => __( 'This is a custom post type for site Partner.', 'katara' ),
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'map_meta_cap'       => true,
				'exclude_from_search' => true,
				'menu_position'      => null,
				'supports'           => array( 'title', 'thumbnail' ),
				'menu_icon'			 => 'dashicons-arrow-right-alt',
			);

			register_post_type( 'partners', $args );
		}

		

	}

	// Make a call.
	new Post_Partner();

}
