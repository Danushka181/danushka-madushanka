<?php
/**
 * Description: Setting option Traits.
 *
 * @since 1.0.0
 */

namespace Ddev\Traits;

trait DmSettingsOptionTraits {
    /**
     * Get Default settings for save options.
     *
     * @since 1.0.0
     * @return array Default settings.
     */
    protected function get_default_settings(): array
    {
        return array(
            'numrows'   => 5,
            'humandate' => true,
            'emails'    => array( get_option( 'admin_email' ) ),
        );
    }

    /**
     * Get saved options Data.
     *
     * @param string  $name option name.
     * @param boolean $default set default false and its optional.
     * @return mixed Data of requested option
     * @since 1.0.0
     */
    protected function get_saved_dm_option_settings(string $name, bool $default = false ): mixed
    {
        // return decoded option data.
        return json_decode( get_option( $name, $default ) );
    }

    /**
     * Update option value by option name.
     *
     * @param string $name Option name for save data.
     * @param mixed  $value save data values for option.
     * @param string $autoload Load option WordPress Started.
     * @return boolean Data saved or not.
     * @since 1.0.0
     */
    protected function save_dm_option_settings_to_database(string $name, mixed $value, string $autoload = 'yes' ): bool
    {
        // Encode Value before add to Database.
        $value = wp_json_encode( $value );
        return add_option( $name, $value, '', $autoload );
    }

    /**
     * Update options by name.
     *
     * @param string $name name of the option need to be updated.
     * @param mixed  $value Values of the option.
     * @param string|null $autoload This is optional and load on WordPress start.
     * @return boolean true if the option update was successful.
     * @since 1.0.0
     */
    protected function update_dm_option_settings_to_database(string $name, array $value, string $autoload = null ): bool
    {
        // get the already saved settings.
        $current_settings = $this->get_saved_dm_option_settings();
        $updated_settings = wp_parse_args( $value, $current_settings );

        $value = wp_json_encode( $updated_settings );
        return update_option( $name, $value, $autoload );
    }

}