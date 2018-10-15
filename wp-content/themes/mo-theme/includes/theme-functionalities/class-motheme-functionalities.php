<?php
/**
 * The functionalities setup
 *
 * @package MoTheme
 * @since 1.0.0
 * @see MoThemeBase Based on the MoThemeBase class.
 */

if ( ! class_exists( 'MoThemeFunctionalities' ) ) {
	/**
	 * The functionalities setup class.
	 *
	 * Implements the functionalities of the theme.
	 *
	 * This aims to be the most important class of the theme.
	 * The idea is to have a central place where all functionalities a theme implements can be quickly overviewed or managed.
	 *
	 * Looking into this file should reveal what the theme does.
	 *
	 * @since 1.0.0
	 */
	class MoThemeFunctionalities extends MoThemeBase {

		/**
		 * The class arguments.
		 *
		 * @since 1.0.0
		 *
		 * @var array $arguments An array of arguments
		 */
		public $arguments = array(
			'set' => '',
		);

		/**
		 * Sets up the class.
		 *
		 * @since 1.0.0
		 *
		 * @param array $arguments An array of arguments.
		 * @return void
		 */
		public function __construct( $arguments ) {
			$this->arguments = $this->array_merge( $this->arguments, $arguments );

			switch ( $this->arguments['set'] ) {
				case FUNCTIONALITY_SET_WPORG:
					$this->setup_wporg();
					break;
			}
		}

		/**
		 * Sets up WordPress.org specific functionalities.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		public function setup_wporg() {
			$content_width     = new MoThemeFunctionalitiesContentWidth();
			$post_formats      = new MoThemeFunctionalitiesPostFormats();
			$sidebars          = new MoThemeFunctionalitiesSidebars();
			$title_tag         = new MoThemeFunctionalitiesTitleTag();
			$post_thumbnails   = new MoThemeFunctionalitiesPostThumbnails();
			$custom_header     = new MoThemeFunctionalitiesCustomHeader();
			$custom_background = new MoThemeFunctionalitiesCustomBackground();
			$editor_style      = new MoThemeFunctionalitiesEditorStyle();
			$comment_scripts   = new MoThemeFunctionalitiesCommentScripts();
			$custom_logo       = new MoThemeFunctionalitiesCustomLogo();
			$html5_support     = new MoThemeFunctionalitiesHTML5Support();
			$navigation_menus  = new MoThemeFunctionalitiesNavigationMenus();
			$refresh_widgets   = new MoThemeFunctionalitiesRefreshWidgets();
		}
	}
} // End if().
