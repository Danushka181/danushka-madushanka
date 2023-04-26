<?php
/**
 * Description: Activate Plugin after plugin loaded.
 *
 * @since 1.0.0
 * @package Ddev\Action
 */

namespace Ddev\Action;

use Ddev\Admin\DmAdminNotices;
use Ddev\Data\DmSettingOptionHandler;
use Ddev\Data\DmPluginDataCollection;
use Ddev\Ajax\DmRegisterAjaxCalls;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * This class will be handle plugin activation part as Singleton method.
 */
final Class DmPluginActivate {
    /**
     * Instance of this class
     *
     * @var DmPluginActivate
     * @since 1.0.0
     */
    private static DmPluginActivate $instance;

    /**
     * User Capabilities need to be initialized plugin.
     *
     * @var string
     */
    const CAPABILITY_RETRIEVE = 'manage_options';

    /**
     * Plugin Slug.
     *
     * @var string
     */
    const DM_PLUGIN_SLUG = 'dm-admin-page';

    public static function get_instance(): DmPluginActivate
    {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Initialize Plugin Admin menus and resources.
     *
     * @return void
     * @since 1.0.0
     */
    public function initialize_plugin_data(): void
    {
        $is_admin = $this->is_user_can_perform_as_admin();
        if( $is_admin ) {
            add_action( 'admin_menu', array( $this, 'dm_create_plugin_admin_menu' ) );
            add_action( 'admin_enqueue_scripts', array( $this, 'load_dm_plugin_assets' ) );

            // create setting options.
            $options = new DmSettingOptionHandler();
            $options->create_setting_option();

            // set data to plugin after installation.
            $dm_plugin_data = new DmPluginDataCollection();
            $dm_plugin_data->process_plugin_api_data();

			// register ajax calls here.
	        new DmRegisterAjaxCalls();
        }else{
            if ( is_user_logged_in() ) {
	            $admin_message = new DmAdminNotices();
	            $admin_message->show_dm_admin_notice( 'success', 'You are not authorized to perform this action.' );
            }
        }
    }

    /**
     * Create admin Menu for plugin.
     *
     * @return void
     * @since 1.0.0
     */
    public function dm_create_plugin_admin_menu(): void
    {
        add_menu_page(
            __( 'Danushka Madushanka Plugin', 'ddev' ),
            __( 'Danushka DDEV', 'ddev' ),
            self::CAPABILITY_RETRIEVE,
            self::DM_PLUGIN_SLUG,
            array( $this, 'dm_load_admin_menu_template' ),
            'dashicons-welcome-widgets-menus',
            20,
        );
    }

    /**
     * Load plugin related resources such as js and css.
     *
     * @since 1.0.0
     * @return void
     */
    public function load_dm_plugin_assets(): void
    {
        wp_enqueue_script( 'dm-vue-script', DM_PLUGIN_URL . '/dist/js/main.js', array(), DM_VERSION, true );
        wp_enqueue_style( 'dm-plugin-style', DM_PLUGIN_URL . '/dist/css/main.css', array(), DM_VERSION, false );

	    wp_localize_script( 'dm-vue-script', 'dmVueNonce', array(
		    'ajax_url' => admin_url( 'admin-ajax.php' ),
		    'nonce' => wp_create_nonce( 'dm_nonce' ),
	    ) );
        $admin_message = new DmAdminNotices();
        $admin_message->show_dm_no_script_message();
    }

    /**
     * Admin View Template for the Plugin.
     *
     * @since 1.0.0
     * @return void
     */
    public function dm_load_admin_menu_template(): void
    {
        require_once DM_PLUGIN_DIR . '/App/Views/DmAdminView.php';
    }

    /**
     * Check current user permissions as admin.
     *
     * @since 1.0.0
     * @return boolean
     */
    protected function is_user_can_perform_as_admin(): bool
    {
        return current_user_can( self::CAPABILITY_RETRIEVE );
    }



}
