<?php
/**
 * The HTML component arrows class
 *
 * Arrows are one of the design landmarks of the site.
 *
 * @package MoTheme
 * @since 1.0.0
 */

if ( ! class_exists( 'MoThemeHTMLComponentArrows' ) ) {
	/**
	 * The HTML component arrow class.
	 *
	 * @since 1.0.0
	 */
	class MoThemeHTMLComponentArrows extends MoThemeBase {

		/**
		 * Class arguments.
		 *
		 * @since 1.0.0
		 *
		 * @var array $arguments An Array of arguments.
		 */
		public $arguments = array(
			'number'    => 1,
			'direction' => 'top',
		);

		/**
		 * HTML tags and attributes allowed for arrows.
		 *
		 * @var array
		 */
		public $wp_kses_for_arrow = array(
			'span' => array(
				'class' => array(),
			),
		);

		/**
		 * Sets up the class.
		 *
		 * @since 1.0.0
		 *
		 * @param array $arguments The class setup arguments array.
		 * @return void
		 */
		public function __construct( $arguments = array() ) {
			$this->arguments = array_merge( $this->arguments, $arguments );
		}

		/**
		 * Displays the arrows.
		 *
		 * @since 1.0.0
		 *
		 * @param array $arguments The class setup arguments array.
		 * @return void
		 */
		public function display( $arguments = array() ) {
			$this->arguments            = array_merge( $this->arguments, $arguments );
			$this->arguments['display'] = true;

			$this->display_or_get();
		}

		/**
		 * Returns the arrows.
		 *
		 * @since 1.0.0
		 *
		 * @param array $arguments The class setup arguments array.
		 * @return string
		 */
		public function get( $arguments = array() ) {
			$this->arguments            = array_merge( $this->arguments, $arguments );
			$this->arguments['display'] = false;

			return $this->display_or_get();
		}

		/**
		 * Displays or returns the arrows.
		 *
		 * @since 1.0.0
		 *
		 * @return void|string Void if the arrows are displayed, otherwise the arrows.
		 */
		public function display_or_get() {
			$arguments = array(
				'query_var_name'     => 'component-title-query-vars',
				'query_var_value'    => $this->arguments,
				'template_part_slug' => 'template-parts/html-component/arrow-with-triangle/arrow-with-triangle',
				'template_part_name' => '',
			);

			$ret = '';

			for ( $i = 0;  $i < $this->arguments['number'];  $i++ ) {
				if ( true === $this->arguments['display'] ) {
					echo wp_kses(
						$this->get_template_part( $arguments ),
						$this->wp_kses_for_arrow
					);
				} else {
					$ret .= $this->get_template_part( $arguments );
				}
			}

			return $ret;
		}
	}
} // End if().
