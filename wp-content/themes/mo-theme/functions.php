<?php
/**
 * Sets up the global variables and the theme
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package MoTheme
 * @since 1.0.0
 */

/**
 * Defines the WordPress.org functionality set.
 *
 * @since 1.0.0
 * @var string
 */
define( 'FUNCTIONALITY_SET_WPORG', 'wporg' );

/**
 * Use Composer's autoload.
 */
if ( file_exists( get_template_directory() . '/vendor/autoload.php' ) ) {
	require_once 'vendor/autoload.php';
}

/**
 * Sets up the theme.
 *
 * @since 1.0.0
 * @var object $mo_theme The main theme object.
 */
$mo_theme = new MoThemeSetup(
	apply_filters( 'mo_theme_setup_array',
		array(
			'include_folder'    => 'includes/',
			'functionality_set' => FUNCTIONALITY_SET_WPORG,
			'assets'            => array(
				'src_url'           => get_template_directory_uri(),
				'folder'            => '',
				'javascript_folder' => 'assets/js',
				'css_folder'        => '',
				'css_file_name'     => 'style',
			),
		)
	)
);
