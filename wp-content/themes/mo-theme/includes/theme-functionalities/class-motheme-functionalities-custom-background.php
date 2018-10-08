<?php
/**
 * The WordPress Custom Background functionality
 *
 * @package MoTheme
 * @since 1.0.0
 */

if ( ! class_exists( 'MoThemeFunctionalitiesCustomBackground' ) ) {
	/**
	 * The WordPress Custom Background functionality class
	 *
	 * Adds theme background color and image support.
	 *
	 * @since 1.0.0
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#custom-background
	 */
	class MoThemeFunctionalitiesCustomBackground {
		/**
		 * Sets up the class.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		public function __construct() {
			add_theme_support(
				'custom-background',
				apply_filters( 'mo_theme_custom_background_args',
					array(
						'default-color' => 'ffffff',
						'default-image' => '',
					)
				)
			);
		}
	}
}