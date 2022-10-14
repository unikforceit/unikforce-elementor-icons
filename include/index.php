<?php
if (!defined('ABSPATH')) {
    exit;
}
if (class_exists('ELEMENTOR')){
    return;
}
if (!class_exists('UEI_ICONS')) {

    /**
     * Main BringBack_Elementor_Addons Class
     *
     */
    final class UEI_ICONS
    {
        /** Singleton *************************************************************/
        private static $instance;

        /**
         * Main UEI_ICONS Instance
         *
         * Insures that only one instance of BringBack_Elementor_Addons exists in memory at any one
         * time. Also prevents needing to define globals all over the place.
         */
        public static function instance() {

            if (!isset(self::$instance) && !(self::$instance instanceof UEI_ICONS)) {

                self::$instance = new UEI_ICONS();

                self::$instance->setup_constants();

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
            _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'uei'), UEI_VERSION);
        }

        /**
         * Disable unserializing of the class
         *
         */
        public function __wakeup() {
            // Unserializing instances of the class is forbidden
            _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'uei'), UEI_VERSION);
        }

        /**
         * Setup plugin constants
         *
         */
        private function setup_constants() {

            // Plugin Folder Path
            if (!defined('UEI_PLUGIN_DIR')) {
                define('UEI_PLUGIN_DIR', plugin_dir_path(__FILE__));
            }

            // Plugin Folder URL
            if (!defined('UEI_PLUGIN_URL')) {
                define('UEI_PLUGIN_URL', plugin_dir_url(__FILE__));
            }

        }

        /**
         * Include required files
         *
         */
        private function includes() {
        }

        /**
         * Load Plugin Text Domain
         *
         * Looks for the plugin translation files in certain directories and loads
         * them to allow the plugin to be localised
         */
        public function load_plugin_textdomain() {
        }

        /**
         * Setup the default hooks and actions
         */
        private function hooks() {
            add_action('plugins_loaded', array($this, 'load_plugin_textdomain'));
            add_filter( 'elementor/icons_manager/additional_tabs', array($this, 'add_material_icons_tabs' ) );
            add_action('elementor/frontend/after_enqueue_styles', array($this, 'register_frontend_styles'), 10);
        }

        public function register_frontend_styles() {
            wp_enqueue_style( 'iconoir-icon', 'https://cdn.jsdelivr.net/gh/lucaburgio/iconoir@main/css/iconoir.css');
            wp_enqueue_style( 'iconsax-icon', UEI_PLUGIN_URL . 'assets/css/isax/isax.css');
            wp_enqueue_style( 'phosphor-icon', UEI_PLUGIN_URL . 'assets/css/phosphor/icons.css');
        }

        public function add_material_icons_tabs( $tabs = array() ) {
            $tabs['iconoir'] = array(
                'name'          => 'ueiiconoir',
                'label'         => esc_html__( 'Iconoir', 'uei' ),
                'labelIcon'     => 'iconoir-2x2-cell',
                'prefix'        => 'iconoir-',
                'displayPrefix' => 'ueiiconoir',
                'url'           => 'https://cdn.jsdelivr.net/gh/lucaburgio/iconoir@main/css/iconoir.css',
                'fetchJson'         => UEI_PLUGIN_URL . 'assets/js/iconoir.json',
                'ver'           => '3.0.1',
            );
            $tabs['iconsax'] = array(
                'name'          => 'ueiiconsax',
                'label'         => esc_html__( 'Iconsax', 'uei' ),
                'labelIcon'     => 'isax-dcube',
                'prefix'        => 'isax-',
                'displayPrefix' => 'isax',
                'url'           => UEI_PLUGIN_URL . 'assets/css/isax/isax.css',
                'fetchJson'         => UEI_PLUGIN_URL . 'assets/js/isax.json',
                'ver'           => '3.0.1',
            );
            $tabs['phosphor'] = array(
                'name'          => 'ueiphosphor',
                'label'         => esc_html__( 'Phosphor', 'uei' ),
                'labelIcon'     => 'ph-book-bold',
                'prefix'        => 'ph-',
                'displayPrefix' => 'phosphor',
                'url'           => UEI_PLUGIN_URL . 'assets/css/phosphor/icons.css',
                'fetchJson'         => UEI_PLUGIN_URL . 'assets/js/phosphor.json',
                'ver'           => '3.0.1',
            );
            return $tabs;
        }
    }
}

function UEI_ICONS() {
    return UEI_ICONS::instance();
}

// Get Bringback Running
UEI_ICONS();