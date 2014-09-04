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
}