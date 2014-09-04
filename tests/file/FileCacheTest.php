<?php

use Ronnyfriedland\Cache\Cache;
use Ronnyfriedland\Cache\Adapter\FileCacheAdapter;

class FileCacheTest extends PHPUnit_Framework_TestCase
{
    private $localCache;
    private $localCacheLocation = "./tests/file/tmp";

    public function setUp()
    {
        if(!file_exists($this->localCacheLocation))
        {
            mkdir($this->localCacheLocation);
        }
        $this->localCache = Cache::getInstance(new FileCacheAdapter($this->localCacheLocation));
        $this->assertTrue(file_exists($this->localCacheLocation));
    }

    public function tearDown()
    {
        $this->localCache->clearCache();

        $this->assertTrue(rmdir($this->localCacheLocation));
        $this->assertFalse(file_exists($this->localCacheLocation));
    }

    public function testAddAndUpdate()
    {
        $this->assertFalse($this->localCache === null);

        $this->localCache->put("addup", "test1");
        $this->assertEquals("test1", $this->localCache->get("addup"));

        $this->localCache->put("addup", "test2");
        $this->assertEquals("test2", $this->localCache->get("addup"));
    }
    
    public function testFilesystemOperations()
    {
        $this->assertFalse($this->localCache === null);
        
        $this->localCache->put("fsops", "test3");
        $this->assertEquals("test3", $this->localCache->get("fsops"));
    }
}