<?php
/**
 * Plugin Name: Danushka Madushanka
 * Plugin URI: https://www.linkedin.com/in/danushka181/
 * Description: The Vue.js Integration for WordPress plugin seamlessly integrates Vue.js into your WordPress site, enabling you to create customizable components, enhance user experience, and make AJAX calls to your WordPress backend.
 * Version: 1.0.0
 * Author: Danushka Madushanka - Awesome-motive
 * Author URI: https://awasomemotive.com/
 * License: GPL-2.0+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: ddev
 * Domain Path: /languages
 * Requires at least: 6.0
 * Requires PHP: 5.6.20
 *
 * WC requires at least: 3.0
 * WC tested up to: 6.1
 * I accept the coding challenge given by Awesome-motive team and here is
 * my Sample plugin for the coding challenge
 *
 * @since 1.0.0
 * @author Danushka Madushanka
 * @package Ddev
 * @license GPL-2.0+
 * @copyright 2023 Danushka Madushanka
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Define file Path.
 */
if ( ! defined( 'DM_FILE' ) ) {
    define( 'DM_FILE', __FILE__ );
}

/**
 * Define plugin version and nobody cant change.
 */
const DM_VERSION = '1.0';

/**
 * Define plugin URL and PATH.
 */
define( 'DM_PLUGIN_URL', plugin_dir_url( DM_FILE ) );
define( 'DM_PLUGIN_DIR', dirname( DM_FILE ) );

/**
 * Load the plugin activator and autoload.
 */
require_once DM_PLUGIN_DIR . '/vendor/autoload.php';


/**
 * Initialize the plugin when WordPress is loaded and create instance.
 */
add_action( 'plugins_loaded', 'dm_plugin_initialize' );

/**
 * Call static function to initialize the DM plugin.
 * @since 1.0.0
 * @return void
 */
function dm_plugin_initialize(): void
{
    $instance = Ddev\Action\DmPluginActivate::get_instance();
    $instance->initialize_plugin_data();
}
