<?php
/**
 * Description: Collect Graph and Table data using API service.
 *
 * @since 1.0.0
 */

namespace Ddev\Data;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Ddev\Api\DmScheduleApiCall;
use Ddev\Api\DmApiService;
use Ddev\Traits\DmCacheDataTraits;

class DmPluginDataCollection {

	use DmCacheDataTraits;

	/**
	 * Api URL for get data from Server.
	 *
	 * @var string
	 */
	private string $api_link = 'https://miusage.com/v1/challenge/2/static/';

	/**
	 * Cache key for save data to wp cache.
	 *
	 * @var string
	 */
	private string $cache_key;

	/**
	 * Set cache key.
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->cache_eky = 'dm_miusage_data_cache';
		$this->set_dm_cache_key( $this->cache_eky );
	}

	/**
	 * Schedule and get plugin related data from API service.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function process_plugin_api_data(): void {
		$cache_data = $this->load_cache_data();
		if ( false === $cache_data ) {
			$this->call_to_dm_api_service();
		}
		new DmScheduleApiCall();
	}

	public function load_cache_data(): mixed {
		return $this->load_cached_data_by_cache_key();
	}

	/**
	 * Call to api service as schedule and directly to get data.
	 *
	 * @return array|bool
	 * @since 1.0.0
	 */
	public function call_to_dm_api_service(): array|bool {
		$this->delete_dm_api_cached_data();
		$server_data = $this->dm_request_data_from_server();
		$this->set_data_cache_for_one_hour( $server_data );
		return $server_data;
	}

	/**
	 * Request data From server.
	 *
	 * @return string|array
	 * @since 1.0.0
	 */
	public function dm_request_data_from_server(): string|array {
		$api_service = new DmApiService( $this->api_link );
		$api_data = $api_service->fetch_data_from_server();
		if ( $api_data ) {
			return $api_data;
		}
		return [];
	}
}