<?php
/*
Plugin Name: UnikForce Elementor Icons
Plugin URI: https://unikforce.com/
Description: UnikForce Elementor Icons contains bunch of elementor icons in elementor panel.
Author: unikforce
Author URI: https://unikforce.com
Version: 1.0.0
*/


if ( ! defined( 'ABSPATH' ) ) exit;
define( 'UEI_VERSION', '1.0.0' );
define( 'UEI_PLUG_DIR', dirname(__FILE__).'/' );
define('UEI_PLUG_URL', plugin_dir_url(__FILE__));

function uei_framework_init_check() {
    require_once UEI_PLUG_DIR .'helper/index.php';
    require_once UEI_PLUG_DIR .'vendor/index.php';
    require_once UEI_PLUG_DIR .'include/index.php';
}

add_action( 'plugins_loaded', 'uei_framework_init_check' );