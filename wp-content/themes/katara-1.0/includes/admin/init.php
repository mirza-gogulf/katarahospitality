<?php 

    /**
     * Register Custom Post Types
     */
    require_once( __DIR__.'/post-types/post-timeline.php' );
    require_once( __DIR__.'/post-types/post-partner.php' );
    require_once( __DIR__.'/post-types/post-press-room.php' );


	/**
     * Kirki Customizer
     */
    if ( ! class_exists( 'Kirki' ) ) {
    	require_once( __DIR__.'/plugins/kirki/kirki.php' );
    }

    /**
     * Customizer additions.
     */
   	require_once ( __DIR__.'/customizer.php' );

    /**
     * Load ACF
     */

    // 1. customize ACF path
    add_filter('acf/settings/path', 'my_acf_settings_path');
     
    function my_acf_settings_path( $path ) {
     
        // update path
        $path = get_stylesheet_directory() . '/includes/admin/plugins/acf/';
        
        // return
        return $path;
        
    }
     

    // 2. customize ACF dir
    add_filter('acf/settings/dir', 'my_acf_settings_dir');
     
    function my_acf_settings_dir( $dir ) {
     
        // update path
        $dir = get_stylesheet_directory_uri() . '/includes/admin/plugins/acf/';
        
        // return
        return $dir;
        
    }
 

    // Hide ACF field group menu item
    //add_filter('acf/settings/show_admin', '__return_false');

    if ( ! class_exists( 'acf' ) ) {
        
        require_once( __DIR__.'/plugins/acf/acf.php' );
    }