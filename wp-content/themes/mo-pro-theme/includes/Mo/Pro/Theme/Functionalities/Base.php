<?php
/**
 * The theme functionalities setup
 *
 * @package Mo\Pro\Theme\Functionalities
 * @since 1.0.0
 */

if ( ! class_exists( 'Mo_Pro_Theme_Functionalities_Base' ) ) {
	/**
	 * The theme functionalities setup class.
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
	class Mo_Pro_Theme_Functionalities_Base extends Mo_Theme_Base {

		/**
		 * The class arguments.
		 *
		 * @since 1.0.0
		 *
		 * @var array An array of arguments.
		 */
		public $arguments = array();

		/**
		 * The features the associated plugin has to implement.
		 *
		 * @since 1.1.0
		 * @var array An array of arguments.
		 */
		public $features = array(
			'custom-post-type' => true,
			'shortcode'        => true,
			'settings-menu'    => array(
				'menu_id'  => 'mo_theme_settings',
				'sections' => array(
					array(
						'section_id' => 'features',
						'section_title' => 'Theme features',
						'section_description' => 'Enable or disable theme features',
						'fields' => array(
							array(
								'field_id'   => 'custom-post-type',
								'field_type' => 'checkbox',
							),
							array(
								'field_id'   => 'shortcode',
								'field_type' => 'checkbox',
							),
						),
					),
				),
			),
		);

		/**
		 * Sets up the class.
		 *
		 * @since 1.0.0
		 *
		 * @param array $arguments An array of arguments.
		 * @return void
		 */
		public function __construct( $arguments = array() ) {
			$this->arguments = $this->array_merge( $this->arguments, $arguments );
			$this->setup();
		}

		/**
		 * Sets up functionalities.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		public function setup() {
			add_filter( 'mo_theme_home_title', array( $this, 'change_home_title' ) );
			add_action( 'after_setup_theme', array( $this, 'define_theme_support' ), 10, 0 );
			add_action( 'mo-plugin_books_action_after', array( $this, 'display_books_shortcode' ), 10, 0 );
			add_action( 'widgets_init', array( $this, 'register_books_widget' ) );
		}

		/**
		 * Defines what features to be implemented by the plugin.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		public function define_theme_support() {
			add_theme_support(
				'MO_PRO_THEME_FEATURE_SET',
				$this->features
			);
		}

		/**
		 * Enables the widget for books.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		public function register_books_widget() {
			register_widget( 'Mo_Pro_Theme_Functionalities_CustomWidget' );
		}

		/**
		 * Displays the shortcode for books.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		public function display_books_shortcode() {
			global $books;

			$query = array(
				'title' => 'Book list',
				'query' => $books,
			);

			$arguments = array(
				'query_var_name'     => 'post-list-query-vars',
				'query_var_value'    => $query,
				'template_part_slug' => 'template-parts/post-list/post-list',
				'template_part_name' => 'with-external-query',
			);

			echo wp_kses_post( $this->get_template_part( $arguments ) );
		}

		/**
		 * Changes the Home section title.
		 *
		 * @since 1.0.0
		 *
		 * @return string
		 */
		public function change_home_title() {
			return array(
				'title' => 'Pro Home',
			);
		}
	}
} // End if().
