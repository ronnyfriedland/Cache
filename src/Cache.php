<?php

namespace Ronnyfriedland\Cache;

/*
 * Cache controller which delegates calls to CacheAdapterInterface.
 *
 * @author ronnyfriedland
 */
class Cache {

    /** time after which cache entry expires (24h) */
    const TTL = 86400;
    
    private $cacheAdapter;
    
    protected static $_instance = null;
    
    public static function getInstance(Ronnyfriedland\Cache\CacheAdapterInterface $cacheAdapter)
    {
        if (self::$_instance === null) {
            self::$_instance = new Cache($cacheAdapter);
        }
        return self::$_instance;
    }
    
    /*
     * The constructor
     */
    public function __construct($cacheAdapter)
    {
        $this->cacheAdapter = $cacheAdapter;
    }
    
    /*
     * List all entries in cache
     */
    public function listCache() {
        return $this->cacheAdapter->listCache();
    }
    
    /*
     * Clear all entries in cache
     */
    public function clearCache() {
        $this->cacheAdapter->clearCache();
    }
    
    /**
     * Get cached data
     */
    public function get($key) {
        return $this->cacheAdapter->get($key, Cache::TTL);
    }
    
    /**
     * Put data to cache
     * If cache directory does not exist it will be createdCache
     */
    public function put($key, $data) {
        $this->cacheAdapter->put($key, $data, Cache::TTL);
    }
}

?> 