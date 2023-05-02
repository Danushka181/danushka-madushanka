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
     *
     * @since 1.0.0
     * @return void
     */
    public function create_setting_option(): void
    {
        //check settings already saved.
        $settings = $this->get_saved_dm_option_settings( $this->option_name );
        if ( ! $settings ) {
            $value = $this->get_default_settings();
            $this->save_dm_option_settings_to_database( $this->option_name, $value );
        }
    }

	/**
	 * Get saved setting options in database.
	 * 
	 * @since 1.0.0
	 * @return mixed
	 */
	public function get_all_settings(): mixed {
		return $this->get_saved_dm_option_settings( $this->option_name );
	}

    /**
     * Update settings on the database.
     *
     * @param $settings array settings array to update option field.
     * @return boolean
     * @since 1.0.0
     */
    public function update_setting_option( array $settings ): bool
    {
	    return $this->update_dm_option_settings_to_database( $this->option_name, $settings );
    }


}
