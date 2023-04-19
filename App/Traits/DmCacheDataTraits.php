<?php
/**
 * Description: Handle Caching data.
 *
 * @since 1.0.0
 */

namespace Ddev\Traits;

/**
 * We can use this class to add update and delete cache data by passing its key.
 *
 * @since 1.0.0
 */
trait DmCacheDataTraits {

    /**
     * Cache Key for handle cache data.
     * @var string
     * @since 1.0.0
     */
    private string $cache_eky;

	/**
	 * Set cache key for add, update, delete.
	 * @param $cache_eky
	 *
	 * @return void
	 */
    public function set_dm_cache_key( $cache_eky ): void {
        $this->cache_eky = $cache_eky;
    }

	/**
	 * Add data cache using wp transient.
	 *
	 * @param array|bool $data array Api data Caching.
	 * @return array|bool
	 * @since 1.0.0
	 */
    public function set_data_cache_for_one_hour( array|bool $data ): array|bool
    {
        return set_transient( $this->cache_eky, wp_json_encode( $data ), HOUR_IN_SECONDS );
    }

    /**
     * Load transient cache data by key name.
     *
     * @return array|bool cache data array.
     * @since 1.0.0
     */
    protected function load_cached_data_by_cache_key(): array|bool
    {
        return get_transient( $this->cache_eky );
    }

    /**
     * Delete transient cache data by key name.
     *
     * @return bool cache data delete status.
     * @since 1.0.0
     */
    protected function delete_dm_api_cached_data(): bool
    {
        return delete_site_transient( $this->cache_eky );
    }

}