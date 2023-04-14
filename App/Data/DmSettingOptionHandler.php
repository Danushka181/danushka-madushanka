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

use Ddev\Traits\DmSettingsOptionTraits;

class DmSettingOptionHandler {

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
    public function create_setting_option(): void
    {
        //check settings already saved.
        $settings = $this->get_saved_dm_option_settings( $this->option_name );
        if ( ! $settings ) {
            $value = $this->get_default_settings();
            $dd = $this->save_dm_option_settings_to_database( $this->option_name, $value );
        }
    }


}
