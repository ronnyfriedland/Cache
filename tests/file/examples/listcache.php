<h1>Cache Inhalt</h1>

<?php

include_once('Cache.php');
include_once('adapter/CacheAdapterInterface.php');
include_once('adapter/FileCacheAdapter.php');

$CACHE = Cache::getInstance(new Ronnyfriedland\Cache\FileCacheAdapter());

$files = $CACHE->listCache();

if(null != $files) 
{
    foreach($files as $file){
        if(is_file($file)) {
            echo $file . "<br/>";
            echo file_get_contents($file);
            echo "<br/><br/>";
        }
    }
}

?>

<br/>
<a href="clearcache.php">clear cache</a>