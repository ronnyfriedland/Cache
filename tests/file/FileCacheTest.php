<?php

use Ronnyfriedland\Cache\Cache;
use Ronnyfriedland\Cache\Adapter\FileCacheAdapter;

class FileCacheTest extends PHPUnit_Framework_TestCase
{
    private $cache;
    private $localCache;

    private $localCacheLocation = "./tests/file/tmp";

    public function setUp()
    {
        $this->cache = new Cache(new FileCacheAdapter());

        if(!file_exists($this->localCacheLocation))
        {
            mkdir($this->localCacheLocation);
        }
        $this->localCache = new Cache(new FileCacheAdapter($this->localCacheLocation));
    }

    public function tearDown()
    {
        $this->cache->clearCache();
    }

    public function testAddAndUpdate()
    {
        $this->assertFalse($this->cache == null);

        $this->assertTrue($this->cache->get("test") == null);
        
        $this->cache->put("test", "example");
        
        $this->assertFalse($this->cache->get("test") == null);
        $this->assertEquals("example", $this->cache->get("test"));

        $this->cache->put("test", "example2");
        $this->assertEquals("example2", $this->cache->get("test"));
    }
    
    public function testFilesystemOperations()
    {
        $this->assertTrue(file_exists($this->localCacheLocation));
        $this->assertFalse($this->localCache == null);
        
        $this->localCache->put("localCache", "test");
        $this->assertEquals("test", $this->localCache->get("localCache"));

        $this->localCache->clearCache();
        $this->assertTrue(rmdir($this->localCacheLocation));

        $this->assertFalse(file_exists($this->localCacheLocation));
    }
}