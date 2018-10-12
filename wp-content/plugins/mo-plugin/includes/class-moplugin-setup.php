<?php
/**
 * The plugin setup class
 *
 * @package MoPlugin
 * @since 1.0.0
 */

if ( ! class_exists( 'MoPluginSetup' ) ) {
	/**
	 * The main plugin class.
	 *
	 * @since 1.0.0
	 */
	class MoPluginSetup extends MoPluginBase {

		/**
		 * Class arguments.
		 *
		 * @since 1.0.0
		 *
		 * @var array $arguments An Array of arguments.
		 */
		public $arguments = array(
			'has_admin_interface'     => false,
			'has_public_interface'    => false,
			'admin_assets_folder'     => 'admin',
			'public_assets_folder'    => 'public',
			'javascript_folder'       => 'js',
			'css_folder'              => 'css',
			'images_folder'           => 'images',
			'javascript_file_handle'  => 'script',
			'css_file_handle'         => 'style',
			'javascript_extension'    => 'js',
			'javascript_dependencies' => array(),
			'javascript_in_footer'    => true,
			'css_extension'           => 'css',
			'css_dependencies'        => array(),
			'theme_feature_set'       => '',
			'theme_features'          => array(),
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

			$this->setup_variables();
			$this->setup_assets();

			/**
			 * `get_theme_features` must be called after `add_theme_support`.
			 * Which is wrapped into a call like: `add_action( 'after_setup_theme', 'mo_pro_theme_define_theme_support', 10, 0 );`.
			 * We attach the `get_theme_features` call into the same hook but with a lowerpriority.
			 */
			add_action( 'after_setup_theme', array( $this, 'get_theme_features' ), 11, 0 );

			/**
			 * `activate_plugin` must be re-called after the theme features are set up for the plugin.
			 * We attach the `activate_plugin` call into the same hook like the features setup but with a lower priority.
			 */
			add_action( 'after_setup_theme', array( $this, 'activate_plugin' ), 12, 0 );
		}


		/**
		 * Gets theme features.
		 *
		 * And saves into `this->theme_features`.
		 *
		 * @since 1.0.0
		 *
		 * @return void.
		 */
		public function get_theme_features() {
			if ( '' === $this->theme_feature_set ) {
				return;
			}

			$features = get_theme_support( $this->theme_feature_set );

			if ( empty( $features ) || empty( $features[0] ) ) {
				return;
			}

			$this->theme_features = $features[0];
		}

		/**
		 * Activates the plugin.
		 *
		 * First this method is called in the plugin main file with the `register_activation_hook`.
		 * Since the theme features are not yet set up it will probably do nothing.
		 *
		 * Second is called after the theme features are set up.
		 * As the features are set up now they can be enabled.
		 *
		 * @since 1.0.0
		 *
		 * @link https://developer.wordpress.org/plugins/the-basics/activation-deactivation-hooks/
		 * @return void
		 */
		public function activate_plugin() {
			if ( ! isset( $this->theme_features ) ) {
				return;
			}

			if ( array() === $this->theme_features ) {
				return;
			}

			$features = new MoPluginFeatures(
				array(
					'features' => $this->theme_features,
				)
			);

			$features->activate();
		}

		/**
		 * Deactivates the plugin.
		 *
		 * Called in the plugin main file with the `register_deactivation_hook`.
		 * The theme features are all set up since deactivation is executed at the end of the hook chain.
		 *
		 * @since 1.0.0
		 *
		 * @link https://developer.wordpress.org/plugins/the-basics/activation-deactivation-hooks/
		 * @return void
		 */
		public function deactivate_plugin() {
			if ( ! isset( $this->theme_features ) ) {
				return;
			}

			if ( array() === $this->theme_features ) {
				return;
			}

			$features = new MoPluginFeatures(
				array(
					'features' => $this->theme_features,
				)
			);

			$features->deactivate();
		}

		/**
		 * Uninstalls the plugin.
		 *
		 * Called in the plugin main file with the `register_uninstall_hook`.
		 *
		 * @since 1.0.0
		 *
		 * @link https://developer.wordpress.org/plugins/the-basics/uninstall-methods/
		 * @return void
		 */
		public function uninstall_plugin() {
			// Do nothing for now.
		}

		/**
		 * Sets up plugin variables.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		public function setup_variables() {
			/**
			 * `get_plugin_data` must be loaded first ...
			 *
			 * @link https://wordpress.stackexchange.com/questions/17948/call-to-undefined-function-get-plugin-data
			 */
			if ( ! function_exists( 'get_plugin_data' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php';
			}

			$plugin = get_plugin_data( PLUGIN_FILE_PATH );

			$this->name        = $plugin['Name'];
			$this->version     = $plugin['Version'];
			$this->text_domain = $plugin['TextDomain'];

			$this->has_admin_interface  = $this->arguments['has_admin_interface'];
			$this->has_public_interface = $this->arguments['has_public_interface'];
			$this->admin_assets_folder  = $this->arguments['admin_assets_folder'];
			$this->public_assets_folder = $this->arguments['public_assets_folder'];

			$this->theme_feature_set = $this->arguments['theme_feature_set'];
			$this->theme_features    = $this->arguments['theme_features'];
		}


		/**
		 * Sets up plugin assets.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		public function setup_assets() {
			if ( true === $this->has_admin_interface ) {
				$arguments = $this->array_merge(
					$this->arguments,
					array(
						'folder'       => $this->admin_assets_folder,
						'admin_folder' => $this->admin_assets_folder,
						'action'       => 'admin_enqueue_scripts',
						'version'      => $this->version,
						'text_domain'  => $this->text_domain,
					)
				);

				$assets = new MoPluginAssets( $arguments );
				$assets->add();
			}

			if ( true === $this->has_public_interface ) {
				$arguments = $this->array_merge(
					$this->arguments,
					array(
						'folder'       => $this->public_assets_folder,
						'admin_folder' => $this->admin_assets_folder,
						'action'       => 'wp_enqueue_scripts',
						'version'      => $this->version,
						'text_domain'  => $this->text_domain,
					)
				);

				$assets = new MoPluginAssets( $arguments );
				$assets->add();
			}
		}
	}
} // End if().
