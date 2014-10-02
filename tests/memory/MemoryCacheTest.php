<?php

use Ronnyfriedland\Cache\Cache;
use Ronnyfriedland\Cache\Adapter\MemoryCacheAdapter;

class MemoryCacheTest extends PHPUnit_Framework_TestCase
{
    private $cache;

    public function setUp()
    {
        $this->cache = Cache::getInstance(new MemoryCacheAdapter());
    }

    public function testAddAndUpdate()
    {
        $this->assertTrue($this->cache->get("test") == null);
        
        $this->cache->put("test", "example");
        
        $this->assertFalse($this->cache->get("test") == null);
        $this->assertEquals("example", $this->cache->get("test"));
    }
    
    public function testTTL()
    {
        $adapter = new MemoryCacheAdapter();
        $adapter->put("ttl_test", "foo", -1);
        
        $this->assertTrue($adapter->get("ttl_test", -1) == null);

        $adapter->put("ttl_test", "foo", 3600);
        $this->assertFalse($adapter->get("ttl_test", 3600) == null);
    }
}