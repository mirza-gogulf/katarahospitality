<?php
/**
 * Katara constants
 *
 * @package katara
 * 
 * @since Katara 1.0
 *
 */

$get_theme = wp_get_theme();

define('KATARA_THEME_NAME', $get_theme);
define('KATARA_THEME_VERSION', '1.0.0');
define('KATARA_THEME_SLUG', 'katara');
define('KATARA_PREFIX', 'kat_');
define('KATARA_BASE_URL', get_template_directory_uri() );
define('KATARA_BASE', wp_normalize_path ( get_template_directory() ) );

define('KATARA_CORE', KATARA_BASE . '/includes');
define('KATARA_FUNCTION', KATARA_BASE . '/includes/functions');

define('KATARA_ASS_URI', KATARA_BASE_URL . '/assets');
define('KATARA_JS', KATARA_BASE_URL . '/assets/js');
define('KATARA_CSS', KATARA_BASE_URL . '/assets/css');
define('KATARA_IMG', KATARA_BASE_URL . '/assets/images');

// ----- SET GLOBALS FOR LANGUAGES ----- //
define("EN_SITE_ID", 1);
define("AR_SITE_ID", 3);
define( 'NO_REPLY', 'no-reply@katarahospitality.com' );
define( 'CDN_URL', 'http://static.katara.dev' );
