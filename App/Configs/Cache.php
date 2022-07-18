<?php
declare(strict_types=1);

namespace App\Configs;

use InitPHP\Config\Classes;

class Cache extends Classes
{

    public string $dir = \APP_DIR . 'Cache/';

    public array $redis = [
        'handler'   => \InitPHP\Cache\Handler\Redis::class,
        'prefix'    => 'cache_',
        'host'      => '127.0.0.1',
        'password'  => null,
        'port'      => 6379,
        'timeout'   => 0,
        'database'  => 0
    ];

    public array $wincache = [
        'handler'       => \InitPHP\Cache\Handler\Wincache::class,
        'prefix'        => 'cache_',
        'default_ttl'   => 60,
    ];

    public array $memcache = [
        'handler'       => \InitPHP\Cache\Handler\Memcache::class,
        'prefix'        => 'cache_',
        'host'          => '127.0.0.1',
        'port'          => 11211,
        'weight'        => 1,
        'raw'           => false,
        'default_ttl'   => 60,
    ];

}
