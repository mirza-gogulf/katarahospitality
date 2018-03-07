<?php
/**
 * Katara functions and definitions
 *
 * @package katara
 * 
 * @since Katara 1.0
 *
 */

/*
 * Load theme constants
 */
require trailingslashit( get_template_directory() ) . 'includes/theme-constants.php';

/**
 * Theme setup functions
 */
require_once ( KATARA_CORE.'/theme-setup.php' );

/**
 * Register widget area and nav.
 */
require_once ( KATARA_CORE.'/theme-register.php' );

/**
 * Enqueue scripts and styles.
 */
require_once ( KATARA_CORE.'/enqueue.php' );

/**
 * Custom functions that act independently of the theme templates.
 */
require_once ( KATARA_FUNCTION.'/extras.php' );

/**
 * Admin setup functions
 */
require_once ( KATARA_CORE.'/admin/init.php' );

/**
 * Aqua resizer
 */
require_once( KATARA_CORE. '/aq_resizer.php' );

/**
 * Theme shortcodes
 */
require_once ( KATARA_FUNCTION.'/shortcodes.php' );

/**
 * Ajax Functions
 */
require_once ( KATARA_FUNCTION.'/ajax-functions.php' );

