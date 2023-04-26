<?php
/**
 * Description: All the ajax Functions are register here.
 *
 * @since 1.0.0
 */

namespace Ddev\Ajax;

use Ddev\Data\DmPluginDataCollection;
use Ddev\Ajax\FormatResponse;
use JetBrains\PhpStorm\NoReturn;

class DmRegisterAjaxCalls {
	public function __construct(){
		add_action( 'wp_ajax_dm_get_table_data_ajax', array( $this, 'dm_get_table_data_ajax' ) );
		add_action( 'wp_ajax_nopriv_dm_get_table_data_ajax', array( $this, 'dm_get_table_data_ajax' ) );

//		$this->dm_get_table_data_ajax();
	}

	/**
	 * Get Table data form saved data in the database.
	 *
	 * @since 1.0.0
	 * @return void
	 */

	#[NoReturn] public function dm_get_table_data_ajax(): void {

		// Check is ajax call contain the valid wp nonce.
		$nonce = $_POST['nonce'];
		if ( ! wp_verify_nonce( $nonce, 'dm_nonce' ) ) {
			// Nonce is not valid; handle the error here
			die( 'Nonce verification failed' );
		}

		// get cache data form the database.
		$api_data   =   new DmPluginDataCollection();
		$cache_data =   $api_data->load_cache_data();

		// format table data getting form the database.
		$table_data = new FormatResponse( $cache_data );
		$table_data = $table_data->build_table_data();

		// return table data to vue action.
		echo json_encode($table_data);
		exit();
	}


}