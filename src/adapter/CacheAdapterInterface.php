<?php

namespace Ronnyfriedland\Cache\Adapter;

/**
 * @author ronnyfriedland
 */
interface CacheAdapterInterface {
    
    /**
    * Retrieve value of cache
    *
    * @param string $key the cache key
    * @param string $ttl the time to live
    * @return value of cache or <code>false</code> if cache does not contains key
    */
    public function get($key, $ttl);

    /**
    * Put value into cache
    *
    * @param string $key the cache key
    * @param string $value the cache value
    * @param string $ttl the time to live
    * @return null
    */
    public function put($key, $value, $ttl);

    /*
     * Retrieve whole content of cache
     */
    public function listCache();
    
    /*
     * Clear cache
     */
    public function clearCache();
}
?>