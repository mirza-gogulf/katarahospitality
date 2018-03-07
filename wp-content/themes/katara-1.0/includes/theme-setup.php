<?php
    /**
     * Tell WordPress to run katara_setup() when the 'after_setup_theme' hook is run.
     */
    add_action( 'after_setup_theme', 'katara_setup' );

    if ( ! function_exists( 'katara_setup' ) ):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which runs
     * before the init hook. The init hook is too late for some features, such as indicating
     * support post thumbnails.
     *
     * To override katara_setup() in a child theme, add your own katara_setup to your child theme's
     * functions.php file.
     *
     * @uses load_theme_textdomain() For translation/localization support.
     * @uses add_editor_style() To style the visual editor.
     * @uses add_theme_support() To add support for post thumbnails, automatic feed links, and Post Formats.
     *
     * @since Twenty Eleven 1.0
     */
    function katara_setup() {

        add_theme_support( 'title-tag' );

        /* Make Twenty Eleven available for translation.
         * Translations can be added to the /languages/ directory.
         * If you're building a theme based on Twenty Eleven, use a find and replace
         * to change 'twentyeleven' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'katara', TEMPLATEPATH . '/languages' );

        $locale = get_locale();
        $locale_file = TEMPLATEPATH . "/languages/$locale.php";
        if ( is_readable( $locale_file ) )
            require_once( $locale_file );

        // This theme styles the visual editor with editor-style.css to match the theme style.
        add_editor_style();


        // This theme uses wp_nav_menu() in one location.
        register_nav_menu( 'primary', __( 'Primary Menu', 'katara' ) );
        register_nav_menu( 'header-1', __( 'Header Menu 1 ', 'katara' ) );
        register_nav_menu( 'header-2', __( 'Header Menu 2 ', 'katara' ) );
        register_nav_menu( 'footer', __( 'Footer Menu', 'katara' ) );
        register_nav_menu( 'sidebar', __( 'Sidebar Menu', 'katara' ) );

        // This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
        add_theme_support( 'post-thumbnails' );

        
        // Image sizes
        add_image_size( 'size-960-321', 960, 321, TRUE );
        add_image_size( 'size-710-299', 710, 299, TRUE ); // Single hotel images
        add_image_size( 'size-710-189', 710, 189, TRUE ); // About Us page banner
        add_image_size( 'size-535-321', 535, 321, TRUE );
        add_image_size( 'size-280-129', 280, 129, TRUE ); // small front page images
        add_image_size( 'size-220-82', 220, 82, TRUE ); // Hotel images for sidebar
        add_image_size( 'size-143-143', 143, 143, TRUE ); // our board, Our Executives images
        add_image_size( 'size-80-80', 80, 80, TRUE ); // Hotel Logo
        
        // Remove Admin Bar for subscriber
        if ( ! is_admin() && is_user_logged_in() )
        {
            $current_user = wp_get_current_user();

            if ( isset($current_user->roles) && in_array( "subscriber", $current_user->roles ) )
            {
                show_admin_bar( FALSE );
            }
        }

        // Remove /blog prefix
        global $wp_rewrite;
        $wp_rewrite->front = str_replace("/blog", "", $wp_rewrite->front );
        $wp_rewrite->permalink_structure = str_replace("/blog", "", $wp_rewrite->permalink_structure );
    }
    endif; // katara_setup