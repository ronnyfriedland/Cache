<?php

include_once('Cache.php');
include_once('adapter/CacheAdapterInterface.php');
include_once('adapter/FileCacheAdapter.php');

$files = Cache::getInstance(new Ronnyfriedland\Cache\FileCacheAdapter())->clearCache();

?>

<a href="listcache.php">list cache</a>