<?php

namespace Ronnyfriedland\Cache\Adapter;

/*
 * Cache adapter implementation to use simple array in memory as cache.
 *
 * @author ronnyfriedland
 */
class MemoryCacheAdapter implements CacheAdapterInterface
{
    // the cache store
    private $CACHE_STORE;
    
    /*
     * The default constructor
     */
    public function __construct()
    {
        $this->CACHE_STORE = array();
    }
    
    /**
     * Retrieve the value from cache
     */
    public function get($key, $ttl)
    {
        $theKey = md5($key);
        $theValue = $this->CACHE_STORE[$theKey];
        
        if ($theValue['ttl'] > time()) {
            return unserialize($theValue['value']);
        }
        
        return null;
    }
    
    /**
     * Put the value into cache
     */
    public function put($key, $value, $ttl)
    {
        $theKey = md5($key);
        $theValue = serialize($value);
        
        $this->CACHE_STORE[$theKey] = array(
            'value' => $theValue,
            'ttl' => $ttl + time(),
        );
    }
    
    /*
     * Retrieve whole content of cache
     */
    public function listCache()
    {
        return $this->CACHE_STORE;
    }
    
    /*
     * Clear cache
     */
    public function clearCache()
    {
        $this->CACHE_STORE = array();
    }
}
    
?>