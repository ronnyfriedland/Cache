<?php

use Ronnyfriedland\Cache\Cache;
use Ronnyfriedland\Cache\Adapter\FileCacheAdapter;

class FileCacheTest extends PHPUnit_Framework_TestCase
{
    private $cache;

    public function setUp()
    {
        $this->cache = new Cache(new FileCacheAdapter());
    }

    public function tearDown()
    {
        $this->cache->clearCache();
    }


    public function testCache()
    {
        $this->assertTrue($this->cache->get("test") == null);
        
        $this->cache->put("test", "example");
        
        $this->assertFalse($this->cache->get("test") == null);
        $this->assertEquals("example", $this->cache->get("test"));
    }
}