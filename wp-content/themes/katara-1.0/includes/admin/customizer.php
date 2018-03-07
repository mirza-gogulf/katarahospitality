<?php

function katara_customizer_config() {
	$args = array(
		// Change the logo image. (URL)
		// If omitted, the default theme info will be displayed.
		// A good size for the logo is 250x50.
		'logo_image'   => KATARA_IMG.'/logo-inner.png',
		// The color of active menu items, help bullets etc.
		'color_active' => '',#00bbf5',
		// Color used for secondary elements and desable/inactive controls
		'color_light'  => '', #8cddcd',
		// Color used for button-set controls and other elements
		'color_select' => '', #34495e',
		// Color used on slider controls and image selects
		'color_accent' => '',
		// The generic background color.
		// You should choose a dark color here as we're using white for the text color.
		'color_back'   => '',
		// If Kirki is embedded in your theme, then you can use this line to specify its location.
		// This will be used to properly enqueue the necessary stylesheets and scripts.
		// If you are using kirki as a plugin then please delete this line.
		//'url_path'     => KATARA_CORE . '/admin/plugins/kirki/',
		// If you want to take advantage of the backround control's 'output',
		// then you'll have to specify the ID of your stylesheet here.
		// The "ID" of your stylesheet is its "handle" on the wp_enqueue_style() function.
		// http://codex.wordpress.org/Function_Reference/wp_enqueue_style
		//'stylesheet_id' => 'arb',
	);
	return $args;
}


add_filter( 'kirki/config', 'katara_customizer_config' );
$prefix = 'kat_';

/**
 * Add the theme configuration.
 */

Kirki::add_config( 'kat_config', array(
	'option_type' => 'theme_mod',
	'capability'  => 'edit_theme_options',
) );

// Add panel.
Kirki::add_panel( 'kat_panel', array(
    'priority'    => 10,
    'title'       => __( 'KATARA Theme Options ', 'katara' ),
    
) );

// Header Settings
Kirki::add_section( 'kat_header', array(
    'title'          => __( 'HEADER SETTINGS', 'katara' ),
    'description'    => __( 'Header setting options.', 'katara' ),
    'panel'          => 'kat_panel', // Not typically needed.
    'priority'       => 2,
    'capability'     => 'edit_theme_options',
    
) );

//Header Field
Kirki::add_field( 'kat_config', array(
	'type'        => 'image',
	'settings'    => $prefix . 'header_logo',
	'label'       => esc_attr__( 'Header Logo', 'katara' ),
	'section'     => 'kat_header',
	'default'     => '',
	'priority'    => 20,
	)
);

Kirki::add_field( 'kat_config', array(
	'type'        => 'image',
	'settings'    => $prefix . 'header_inner_logo',
	'label'       => esc_attr__( 'Header Logo Inner', 'katara' ),
	'section'     => 'kat_header',
	'default'     => '',
	'priority'    => 30,
	)
);

// Region Settings
Kirki::add_section( 'kat_region', array(
    'title'          => __( 'REGION SETTINGS', 'katara' ),
    'description'    => __( 'Katara Regions options.', 'katara' ),
    'panel'          => 'kat_panel', // Not typically needed.
    'priority'       => 3,
    'capability'     => 'edit_theme_options',
    
) );

 $kataraRegions = kataraRegions(); 
 foreach ($kataraRegions as $key => $region) {
 	
	//katara regions
	Kirki::add_field( 'kat_config', array(
		'type'        => 'image',
		'settings'    => $prefix . $key. '_bg_image',
		'label'       => $region .esc_attr__( ' Background Image', 'katara' ),
		'section'     => 'kat_region',
		'default'     => '',
		'priority'    => 20,
		)
	);

}

// Footer Settings
Kirki::add_section( 'kat_footer', array(
    'title'          => __( 'FOOTER SETTINGS', 'katara' ),
    'description'    => __( 'Footer setting options.', 'katara' ),
    'panel'          => 'kat_panel', // Not typically needed.
    'priority'       => 4,
    'capability'     => 'edit_theme_options',
    
) );

//Footer Field
Kirki::add_field( 'kat_config', array(
	'type'        => 'image',
	'settings'    => $prefix . 'footer_logo',
	'label'       => esc_attr__( 'Footer Logo', 'katara' ),
	'section'     => 'kat_footer',
	'default'     => '',
	'priority'    => 20,
	)
);

Kirki::add_field( 'kat_config', array(
	'type'        => 'upload',
	'settings'    => $prefix . 'direction_file',
	'label'       => esc_attr__( 'Upload Direction File (PDF)', 'katara' ),
	'section'     => 'kat_footer',
	'default'     => '',
	'priority'    => 30,
	)
);

Kirki::add_field( 'kat_config', array(
	'type'        => 'text',
	'settings'    => $prefix . 'footer_email',
	'label'       => esc_attr__( 'E-Mail Address', 'katara' ),
	'section'     => 'kat_footer',
	'default'     => '',
	'priority'    => 40,
	)
);

Kirki::add_field( 'kat_config', array(
	'type'        => 'textarea',
	'settings'    => $prefix . 'footer_address',
	'label'       => esc_attr__( 'Address', 'katara' ),
	'section'     => 'kat_footer',
	'default'     => '',
	'priority'    => 40,
	)
);

Kirki::add_field( 'kat_config', array(
	'type'        => 'text',
	'settings'    => $prefix . 'footer_tel',
	'label'       => esc_attr__( 'Telephone', 'katara' ),
	'section'     => 'kat_footer',
	'default'     => '',
	'priority'    => 40,
	)
);

Kirki::add_field( 'kat_config', array(
	'type'        => 'text',
	'settings'    => $prefix . 'footer_fax',
	'label'       => esc_attr__( 'Fax', 'katara' ),
	'section'     => 'kat_footer',
	'default'     => '',
	'priority'    => 40,
	)
);

Kirki::add_field( 'kat_config', array(
	'type'        => 'text',
	'settings'    => $prefix . 'footer_linkedin',
	'label'       => esc_attr__( 'Linked In Profile URL', 'katara' ),
	'section'     => 'kat_footer',
	'default'     => '',
	'priority'    => 40,
	)
);

Kirki::add_field( 'kat_config', array(
	'type'        => 'text',
	'settings'    => $prefix . 'footer_twitter',
	'label'       => esc_attr__( 'Twitter Profile URL', 'katara' ),
	'section'     => 'kat_footer',
	'default'     => '',
	'priority'    => 40,
	)
);
