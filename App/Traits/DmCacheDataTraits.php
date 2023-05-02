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
	 * @param mixed $data array Api data Caching.
	 *
	 * @return bool
	 * @since 1.0.0
	 */
    public function set_data_cache_for_one_hour( mixed $data ): bool {
        return set_transient( $this->cache_eky, serialize( $data ), HOUR_IN_SECONDS );
    }

    /**
     * Load transient cache data by key name.
     *
     * @return mixed cache data array.
     * @since 1.0.0
     */
    protected function load_cached_data_by_cache_key(): mixed
    {
		$cache_data = get_transient( $this->cache_eky );
	    return unserialize( $cache_data );
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