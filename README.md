Cache
=====

Extendable PHP Cache

##Available cache destinations

* Memory
* Filesystem

##Example

``` php
use Ronnyfriedland\Cache\Cache;
use Ronnyfriedland\Cache\Adapter\FileCacheAdapter;

$cache = Cache::getInstance(new FileCacheAdapter());
```
