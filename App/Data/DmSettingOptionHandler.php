<?php
/**
 * Description: Create and Update options data
 *
 * @since 1.0.0
 */

namespace Ddev\Data;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class DmOptionHandler {
    use DmSettingsOptionTraits;
    /**
     * Option name for save data in database.
     *
     * @since 1.0.0
     * @var string
     */
    protected string $option_name = 'test_project_option';

    /**
     * Create Setting options in the Database.
     * @return void
     */
    public function create_setting_option() {
        //check settings already saved.

    }


}