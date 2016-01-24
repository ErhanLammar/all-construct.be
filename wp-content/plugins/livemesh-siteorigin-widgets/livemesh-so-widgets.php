<?php
/**
 * Plugin Name: Livemesh SiteOrigin Widgets
 * Plugin URI: http://portfoliotheme.org/siteorigin-widgets
 * Description: A collection of premium quality widgets for use in any widgetized area or in SiteOrigin page builder. SiteOrigin Widgets Bundle is required.
 * Author: Livemesh
 * Author URI: http://portfoliotheme.org/
 * License: GPL3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.txt
 * Version: 1.0
 * Text Domain: livemesh-so-widgets
 * Domain Path: languages
 *
 * Livemesh SiteOrigin Widgets is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Livemesh SiteOrigin Widgets is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Livemesh SiteOrigin Widgets. If not, see <http://www.gnu.org/licenses/>.
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Livemesh_SiteOrigin_Widgets' ) ) :

    /**
     * Main Livemesh_SiteOrigin_Widgets Class
     *
     */
    final class Livemesh_SiteOrigin_Widgets {

        /** Singleton *************************************************************/

        private static $instance;

        /**
         * Main Livemesh_SiteOrigin_Widgets Instance
         *
         * Insures that only one instance of Livemesh_SiteOrigin_Widgets exists in memory at any one
         * time. Also prevents needing to define globals all over the place.
         */
        public static function instance() {
            if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Livemesh_SiteOrigin_Widgets ) ) {
                self::$instance = new Livemesh_SiteOrigin_Widgets;
                self::$instance->setup_constants();

                add_action( 'plugins_loaded', array( self::$instance, 'load_plugin_textdomain' ) );

                self::$instance->includes();

                self::$instance->hooks();


            }
            return self::$instance;
        }

        /**
         * Throw error on object clone
         *
         * The whole idea of the singleton design pattern is that there is a single
         * object therefore, we don't want the object to be cloned.
         */
        public function __clone() {
            // Cloning instances of the class is forbidden
            _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'livemesh-so-widgets' ), '1.6' );
        }

        /**
         * Disable unserializing of the class
         *
         */
        public function __wakeup() {
            // Unserializing instances of the class is forbidden
            _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'livemesh-so-widgets' ), '1.6' );
        }

        /**
         * Setup plugin constants
         *
         */
        private function setup_constants() {

            // Plugin version
            if ( ! defined( 'LSOW_VERSION' ) ) {
                define( 'LSOW_VERSION', '1.0' );
            }

            // Plugin Folder Path
            if ( ! defined( 'LSOW_PLUGIN_DIR' ) ) {
                define( 'LSOW_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
            }

            // Plugin Folder URL
            if ( ! defined( 'LSOW_PLUGIN_URL' ) ) {
                define( 'LSOW_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
            }

            // Plugin Root File
            if ( ! defined( 'LSOW_PLUGIN_FILE' ) ) {
                define( 'LSOW_PLUGIN_FILE', __FILE__ );
            }
        }

        /**
         * Include required files
         *
         */
        private function includes() {

            require_once LSOW_PLUGIN_DIR . 'includes/class-lsow-setup.php';
            require_once LSOW_PLUGIN_DIR . 'includes/helper-functions.php';

        }

        /**
         * Load Plugin Text Domain
         *
         * Looks for the plugin translation files in certain directories and loads
         * them to allow the plugin to be localised
         */
        public function load_plugin_textdomain() {

            $lang_dir = apply_filters('lsow_reviews_lang_dir', trailingslashit(LSOW_PLUGIN_DIR . 'languages'));

            // Traditional WordPress plugin locale filter
            $locale = apply_filters('plugin_locale', get_locale(), 'livemesh-so-widgets');
            $mofile = sprintf('%1$s-%2$s.mo', 'livemesh-so-widgets', $locale);

            // Setup paths to current locale file
            $mofile_local = $lang_dir . $mofile;

            if (file_exists($mofile_local)) {
                // Look in the /wp-content/plugins/livemesh-so-widgets/languages/ folder
                load_textdomain('livemesh-so-widgets', $mofile_local);
            }
            else {
                // Load the default language files
                load_plugin_textdomain('livemesh-so-widgets', false, $lang_dir);
            }

            return false;
        }

        /**
         * Setup the default hooks and actions
         */
        private function hooks() {

            add_action( 'admin_enqueue_scripts', array( $this, 'load_admin_scripts'), 100 );

            add_action( 'wp_enqueue_scripts', array( $this, 'load_frontend_scripts'), 100 );
        }

        /**
         * Load Frontend Scripts/Styles
         *
         */
        public function load_frontend_scripts() {

            // Use minified libraries if SCRIPT_DEBUG is turned off
            $suffix  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

            wp_register_style( 'lsow-frontend-styles', LSOW_PLUGIN_URL . 'assets/css/lsow-frontend.css', array( ), LSOW_VERSION );
            wp_enqueue_style( 'lsow-frontend-styles' );

            wp_register_style( 'lsow-icomoon-styles', LSOW_PLUGIN_URL . 'assets/css/icomoon.css', array( ), LSOW_VERSION );
            wp_enqueue_style( 'lsow-icomoon-styles' );

            wp_register_script( 'lsow-frontend-scripts', LSOW_PLUGIN_URL . 'assets/js/lsow-frontend'. $suffix . '.js', array( ), LSOW_VERSION, true );
            wp_enqueue_script( 'lsow-frontend-scripts' );

        }

        /**
         * Load Admin Scripts/Styles
         *
         */
        public function load_admin_scripts() {

            // Use minified libraries if SCRIPT_DEBUG is turned off
            $suffix  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

            wp_register_style( 'lsow-admin-styles', LSOW_PLUGIN_URL . 'assets/css/lsow-admin.css', array( ), LSOW_VERSION );
            wp_enqueue_style( 'lsow-admin-styles' );

            wp_register_script( 'lsow-admin-scripts', LSOW_PLUGIN_URL . 'assets/js/lsow-admin'. $suffix . '.js', array( ), LSOW_VERSION, true );
            wp_enqueue_script( 'lsow-admin-scripts' );

            wp_enqueue_script( 'jquery-ui-datepicker' );
        }

    }

endif; // End if class_exists check


/**
 * The main function responsible for returning the one true Livemesh_SiteOrigin_Widgets
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $lsow = LSOW(); ?>
 */
function LSOW() {
    return Livemesh_SiteOrigin_Widgets::instance();
}

// Get LSOW Running
LSOW();