<?php
/**
 * Uninstall DM plugin
 *
 * @since 1.0.0
 */

// Delete options
delete_option('test_project_option');

// Delete transients
global $wpdb;
$wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_dm_miusage_data_cache'");
$wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_timeout_dm_miusage_data_cache'");

// Clear any cached data that has been removed
wp_cache_flush();