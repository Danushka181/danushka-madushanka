<?php
/**
 * Handles the Api call in this class.
 *
 * @since 1.0.0
 * @package Ddev/Admin
 */

namespace Ddev\Api;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class DmApiService {

    /**
     * API url for retrieving data.
     *
     * @since 1.0.0
     * @var string
     */
    private string $api_url;

    /**
     * Class constructor.
     *
     * @param string $api_url The API url for retrieving data.
     */
    public function __construct( string $api_url )
    {
        $this->api_url = $api_url;
    }

    /**
     * Get data from the server using wp_remote_get.
     *
     * @since 1.0.0
     * @return string|false The response body if successful, or false on error.
     */
    public function fetch_data_from_server(): string|false
    {
        $response = wp_safe_remote_get($this->api_url);
        if (is_wp_error($response)) {
            return false;
        }
        return wp_remote_retrieve_body($response);
    }

}
