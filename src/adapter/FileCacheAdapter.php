<?php

namespace Ronnyfriedland\Cache\Adapter;

/*
 * Cache adapter implementation to use store cache in filesystem.
 *
 * @author ronnyfriedland
 */
class FileCacheAdapter implements CacheAdapterInterface
{
    // the cache store
    private $CACHE_STORE;
    
    /*
     * The constructor
     * @param string cache location
     */
    public function __construct($cacheLocation = NULL)
    {   if($cacheLocation === NULL) 
        {
            $this->CACHE_STORE = sys_get_temp_dir().'dat/';
        } else 
        {
            if (substr($cacheLocation, -1) != '/')
            {
                $cacheLocation = $cacheLocation . "/";
            }
            $this->CACHE_STORE = $cacheLocation;
        }
    }

    /**
     * Retrieve the value from cache
     */
    public function get($key, $ttl)
    {
        $theKey = md5($key);
        $file = $this->CACHE_STORE.$theKey;
        
        if(file_exists($file)) {
            if(time() < (filemtime($file) + $ttl)) {
                return unserialize(file_get_contents($file));
            }
            unlink($file);
        }
        
        return false;
    }
    
    /**
     * Put the value into cache
     * If cache directory does not exist it will be createdCache
     */
    public function put($key, $value, $ttl)
    {
        $theKey = md5($key);
        $theValue = serialize($value);

        if (!file_exists($this->CACHE_STORE)) {
            mkdir($this->CACHE_STORE, 0777);
        }

        file_put_contents($this->CACHE_STORE.$theKey, $theValue);
    }
    
    /*
     * Retrieve whole content of cache
     */
    public function listCache()
    {
        return glob($this->CACHE_STORE.'*');
    }
    
    /*
     * Clear cache
     */
    public function clearCache()
    {
        $files = glob($this->CACHE_STORE.'*');
        foreach($files as $file){
            if(is_file($file)) {
                unlink($file);
            }
        }
    }
}
    
?>