<?php
/**
 * Description: Schedule API call to get data.
 *
 * @since 1.0.0
 */

namespace Ddev\Api;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Ddev\Data\DmPluginDataCollection;

/**
 * Schedule api call for fetching data.
 *
 * @since 1.0.0
 */
class DmScheduleApiCall {

	/**
	 * Add action to schedule API call hourly.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		// Schedule API call hourly.
		add_action( 'schedule_dm_api_call_hourly', array( $this, 'dm_call_to_scheduled_api_service' ) );
		$this->schedule_dm_api_service();

	}

	/**
	 * Schedule api call if already not scheduled.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	private function schedule_dm_api_service(): void {
		if ( ! wp_next_scheduled( 'schedule_dm_api_call_hourly' ) ) {
			wp_schedule_event( time(), 'hourly', 'schedule_dm_api_call_hourly' );
		}
	}

	/**
	 * Call the scheduled API service.
	 *
	 * @since 1.0.0
	 */
	public function dm_call_to_scheduled_api_service(): void {
		$plugin_data_collect = new DmPluginDataCollection();
		$plugin_data_collect->call_to_dm_api_service();
	}

}
