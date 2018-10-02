<?php
/**
 * The HTML component attributes class
 *
 * @package MoTheme
 * @since 1.0.0
 */

if ( ! class_exists( 'MoThemeHTMLComponentAttributes' ) ) {
	/**
	 * The HTML component attributes class.
	 *
	 * @since 1.0.0
	 */
	class MoThemeHTMLComponentAttributes extends MoThemeHTMLComponent {

		/**
		 * Class arguments.
		 *
		 * @since 1.0.0
		 *
		 * @var array An array of arguments.
		 */
		public $arguments = array(
			'block'                   => '',
			'element'                 => '',
			'modifier'                => '',
			'custom_class'            => '',
			'custom_id'               => '',
			'display_class'           => true,
			'display_id'              => false,
			'display_data_attributes' => false,
			'class_tag'               => 'class',
			'id_tag'                  => 'id',
			'element_prefix'          => '-',
			'modifier_prefix'         => '--',
		);

		/**
		 * The arguments of an attribute.
		 *
		 * @since 1.0.0
		 *
		 * @var array An array of arguments
		 */
		public $attribute_arguments = array(
			'custom_attribute' => '',
			'attribute_tag'    => '',
		);

		/**
		 * The arguments of an attribute with values.
		 *
		 * @since 1.0.0
		 *
		 * @var array An array of arguments.
		 */
		public $attribute_with_values_arguments = array(
			'tag'        => '',
			'attributes' => '',
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
		 * Displays the attributes of an element.
		 *
		 * @since 1.0.0
		 *
		 * @param array $arguments The class setup arguments array.
		 * @return void
		 */
		public function display( $arguments = array() ) {
			$this->arguments    = array_merge( $this->arguments, $arguments );
			$this->bem_selector = $this->create_bem_selector();

			if ( $this->arguments['display_class'] ) {
				$this->display_attribute(
					array(
						'custom_attribute' => $this->arguments['custom_class'],
						'attribute_tag'    => $this->arguments['class_tag'],
					)
				);
			} else {
				if ( '' !== $this->arguments['custom_class'] ) {
					$this->display_attribute_with_values(
						array(
							'tag'        => $this->arguments['class_tag'],
							'attributes' => $this->arguments['custom_class'],
						)
					);
				}
			}

			if ( $this->arguments['display_id'] ) {
				$this->display_attribute(
					array(
						'custom_attribute' => $this->arguments['custom_id'],
						'attribute_tag'    => $this->arguments['id_tag'],
					)
				);
			} else {
				if ( '' !== $this->arguments['custom_id'] ) {
					$this->display_attribute_with_values(
						array(
							'tag'        => $this->arguments['id_tag'],
							'attributes' => $this->arguments['custom_id'],
						)
					);
				}
			}
		}

		/**
		 * Display a single attribute.
		 *
		 * @since 1.0.0
		 *
		 * @param array $arguments The arguments array.
		 * @return void
		 */
		public function display_attribute( $arguments = array() ) {
			$arguments  = array_merge( $this->attribute_arguments, $arguments );
			$attributes = implode(
				' ',
				array_filter(
					array(
						$this->bem_selector,
						$arguments['custom_attribute'],
					)
				)
			);

			$this->display_attribute_with_values(
				array(
					'tag'        => $arguments['attribute_tag'],
					'attributes' => $attributes,
				)
			);
		}

		/**
		 * Displays an attribute with values.
		 *
		 * @since 1.0.0
		 *
		 * @param array $arguments The arguments array..
		 * @return void
		 */
		public function display_attribute_with_values( $arguments = array() ) {
			$arguments = array_merge( $this->attributes_with_values_arguments, $arguments );

			if ( ( '' === $arguments['tag'] ) || ( '' === $arguments['attributes'] ) ) {
				return;
			}

			$ret = sprintf(
				'%1$s="%2$s"',
				esc_attr( $arguments['tag'] ),
				esc_attr( $arguments['attributes'] )
			);

			echo $ret;
		}

		/**
		 * Creates a BEM selector.
		 *
		 * @since 1.0.0
		 *
		 * @return string [description]
		 */
		public function create_bem_selector() {
			$block    = $this->arguments['block'];
			$element  = $this->arguments['element'];
			$modifier = $this->arguments['modifier'];

			if ( '' === $block ) {
				return '';
			}

			$classname = $this->convert_string_to_classname( $block );
			$ret       = [];

			if ( '' !== $element ) {
				$classname .= $this->arguments['element_prefix'];
				$classname .= $this->convert_string_to_classname( $element );
			}

			$ret[] = $classname;

			if ( '' !== $modifier ) {
				$classname .= $this->arguments['modifier_prefix'];
				$classname .= $this->convert_string_to_classname( $modifier );
				$ret[]      = $classname;
			}

			return implode( ' ', $ret );
		}

		/**
		 * Converts a string to classname.
		 *
		 * @since 1.0.0
		 *
		 * @param  string $string A string.
		 * @return string         The string converted to a classname.
		 */
		public function convert_string_to_classname( $string ) {
			$a = preg_replace( '/([^a-z0-9]+)/i', '-', $string );
			$b = preg_replace( '/ /', '-', $a );

			$ret = strtolower( $b );

			return $ret;
		}
	}
}
