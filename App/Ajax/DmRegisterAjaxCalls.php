<?php
/**
 * Description: All the ajax Functions are register here.
 *
 * @since 1.0.0
 */

namespace Ddev\Ajax;

use Ddev\Data\DmPluginDataCollection;
use Ddev\Ajax\FormatResponse;
use Ddev\Ajax\Validations\EmailValidations;
use Ddev\Data\DmSettingOptionHandler;

class DmRegisterAjaxCalls {
	public function __construct(){
		// Get table data from database.
		add_action( 'wp_ajax_dm_get_table_data_ajax', array( $this, 'dm_get_table_data_ajax' ) );
		add_action( 'wp_ajax_nopriv_dm_get_table_data_ajax', array( $this, 'dm_get_table_data_ajax' ) );
		// Get Graph data from database.
		add_action( 'wp_ajax_dm_get_graph_data_ajax', array( $this, 'dm_get_graph_data_ajax' ) );
		add_action( 'wp_ajax_nopriv_dm_get_graph_data_ajax', array( $this, 'dm_get_graph_data_ajax' ) );
		// get all settings
		add_action( 'wp_ajax_dm_get_all_settings', array( $this, 'dm_get_all_settings' ) );
		add_action( 'wp_ajax_nopriv_dm_get_all_settings', array( $this, 'dm_get_all_settings' ) );
		// Update Settings Data.
		add_action( 'wp_ajax_dm_update_settings', array( $this, 'dm_update_settings' ) );
		add_action( 'wp_ajax_nopriv_dm_update_settings', array( $this, 'dm_update_settings' ) );

	}

	/**
	 * Get Table data form saved data in the database.
	 *
	 * @since 1.0.0
	 * @return void
	 */

	public function dm_get_table_data_ajax(): void {

		if ( isset( $_POST ) ) {
			// Check is ajax call contain the valid wp nonce.
			$nonce = $_POST['nonce'];
			if ( !wp_verify_nonce( $nonce, 'dm_nonce' ) ) {
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
		}

		exit;
	}

	/**
	 * Get Graph data form saved data in the database.
	 *
	 * @since 1.0.0
	 * @return void
	 */

	public function dm_get_graph_data_ajax(): void {

		if ( isset( $_POST ) ) {
			// Check is ajax call contain the valid wp nonce.
			$nonce = $_POST['nonce'];
			if ( !wp_verify_nonce( $nonce, 'dm_nonce' ) ) {
				// Nonce is not valid; handle the error here
				die( 'Nonce verification failed' );
			}

			if ( isset( $_POST['hot_data'] ) ) {
				// get live data
				$api_data   = new DmPluginDataCollection();
				$data_set = $api_data->call_to_dm_api_service();
			} else {
				// get cache data form the database.
				$api_data   = new DmPluginDataCollection();
				$data_set = $api_data->load_cache_data();
			}
			// format table data getting form the database.
			$graph_data = new FormatResponse( $data_set );
			$graph_data = $graph_data->build_graph_data();
			// return table data to vue action.
			echo json_encode($graph_data);
		}

		exit;
	}

	/**
	 * Get all settings as a array
	 *
	 * @since 1.0.0
	 */
	public function dm_get_all_settings(): void {
		if ( isset( $_POST ) ) {
			// Verify the nonce
			$nonce = $_POST['nonce'];
			if ( !wp_verify_nonce( $nonce, 'dm_nonce' ) ) {
				die( 'Nonce verification failed' );
			}

			$dm_options = new DmSettingOptionHandler();
			$settings   = $dm_options->get_all_settings();
			// Make huamn-date as boolean
			$settings['humandate'] = filter_var($settings['humandate'], FILTER_VALIDATE_BOOLEAN);
			echo json_encode($settings);
			exit;

		}
	}

	/**
	 * Save settings data to database.
	 *
	 * @since 1.0.0
	 */
	public function dm_update_settings() {
		if ( isset( $_POST ) ) {
			// Check is ajax call contain the valid wp nonce.
			$nonce = $_POST['nonce'];
			if ( !wp_verify_nonce( $nonce, 'dm_nonce' ) ) {
				die( 'Nonce verification failed' );
			}

			$dm_options = new DmSettingOptionHandler();
			$settings   = $dm_options->get_all_settings();

			// Check email address list.
			if ( isset( $_POST['emails'] ) ) {
				$emails = $_POST['emails'];
				$errors = [];
				$i = 1;
				if ( count( $emails ) > 0 ) {
					// Validate email addresses
					foreach ( $emails as $email ) {
						$email_validation = new EmailValidations( $email );
						$is_valid = $email_validation->is_valid_email_address();
						if ( false === $is_valid ) {
							$msg = $email ? sprintf( __('"%s" is invalid email!', 'ddev'), $email ) : sprintf( __( "Email Field %d is required!", 'ddev'), $i );
							$errors[$i] = $msg;
						}

						$i++;
					}

					// If there are errors, return them as JSON
					if ( count( $errors ) > 0 ) {
						echo json_encode( [
							'errors'  => $errors,
							'status'  => false,
							'message' => ''
						] );
						exit;
					}

					$settings['emails'] = $emails;
					$is_updated = $dm_options->update_setting_option( $settings );
					if ( $is_updated ) {
						echo json_encode( [
							'errors'  => [],
							'status'  => true,
							'message' => __( 'Settings saved successfully.', 'ddev' )
						] );
					} else {
						echo json_encode( [
							'errors'  => [],
							'status'  => false,
							'message' => __( 'Settings already saved!.', 'ddev' )
						] );
					}
				} else {
					echo json_encode( [
						'errors'  => [],
						'status'  => true,
						'message' => __( 'Please enter email address before save!', 'ddev' )
					] );
				}
			}
			// Update number of Rows to database.
			if ( isset( $_POST['numrows'] ) ){

				$settings['numrows'] = $_POST['numrows'];
				$is_updated = $dm_options->update_setting_option( $settings );
				if ( !$is_updated ) {
					echo json_encode( [
						'errors'  => [],
						'status'  => false,
						'message' => __( 'Number of rows not Updated!', 'ddev')
					] );
				} else {
					echo json_encode( [
						'errors'  => [],
						'status'  => true,
						'message' => __( 'Number of rows Updated!', 'ddev' )
					] );
				}


			}
			// Update Humandate to database.
			if ( isset( $_POST['humandate'] ) ){

				$settings['humandate'] = $_POST['humandate'];
				$is_updated = $dm_options->update_setting_option( $settings );
				if ( !$is_updated ) {
					echo json_encode( [
						'errors'  => [],
						'status'  => false,
						'message' => __( 'Something went wrong try again!.', 'ddev' )
					] );
				} else {
					echo json_encode( [
						'errors'  => [],
						'status'  => true,
						'message' => __( 'Human date status Updated!', 'ddev' )
					] );
				}


			}
		}
		exit;
	}

}