<?php
/**
 * Cache.php
 *
 * This file is part of Framework.
 *
 * @author     Muhammet ŞAFAK <info@muhammetsafak.com.tr>
 * @copyright  Copyright © 2022 Muhammet ŞAFAK
 * @license    ./LICENSE  MIT
 * @version    1.1
 * @link       https://www.muhammetsafak.com.tr
 */

declare(strict_types=1);

namespace InitPHP\Framework;

use InitPHP\Cache\CacheInterface;
use InitPHP\Config\Interfaces\ConfigInterface;
use InitPHP\Framework\Exception\FrameworkException;

final class Cache implements CacheInterface
{

    public const FILE = 0;
    public const REDIS = 1;
    public const MEMCACHE = 2;
    public const WINCACHE = 3;

    protected ConfigInterface $config;

    protected CacheInterface $cache;


    public function __construct(int $handler = self::FILE)
    {
        $this->config = new \App\Configs\Cache();

        switch ($handler) {
            case self::FILE:
                $this->cache = \InitPHP\Cache\Cache::create(\InitPHP\Cache\Handler\File::class, [
                    'path'      => $this->config->get('dir', \BASE_DIR . 'Writable/')
                ]);
                break;
            case self::REDIS:
                $handler = $this->config->get('redis.handler', \InitPHP\Cache\Handler\Redis::class);
                $this->cache = \InitPHP\Cache\Cache::create($handler, $this->config->get('redis', [
                    'prefix'    => 'cache_',
                    'host'      => '127.0.0.1',
                    'password'  => null,
                    'port'      => 6379,
                    'timeout'   => 0,
                    'database'  => 0
                ]));
                break;
            case self::MEMCACHE:
                $handler = $this->config->get('memcache.handler', \InitPHP\Cache\Handler\Memcache::class);
                $this->cache = \InitPHP\Cache\Cache::create($handler, $this->config->get('memcache', [
                    'prefix'        => 'cache_',
                    'host'          => '127.0.0.1',
                    'port'          => 11211,
                    'weight'        => 1,
                    'raw'           => false,
                    'default_ttl'   => 60,
                ]));
                break;
            case self::WINCACHE:
                $handler = $this->config->get('wincache.handler', \InitPHP\Cache\Handler\Wincache::class);
                $this->cache = \InitPHP\Cache\Cache::create($handler, $this->config->get('wincache', [
                    'prefix'        => 'cache_',
                    'default_ttl'   => 60,
                ]));
                break;
            default:
                throw new FrameworkException("An invalid cache handler has been identified.");
        }
    }

    public function useRedis(): CacheInterface
    {
        if(($cache = Stack::get('redis_cache')) === null){
            $cache = new self(self::REDIS);
            Stack::set('redis_cache', $cache);
        }
        return $cache;
    }

    public function useMemcache(): CacheInterface
    {
        if(($cache = Stack::get('memcache_cache')) === null){
            $cache = new self(self::MEMCACHE);
            Stack::set('memcache_cache', $cache);
        }
        return $cache;
    }

    public function useWinCache(): CacheInterface
    {
        if(($cache = Stack::get('wincache_cache')) === null){
            $cache = new self(self::WINCACHE);
            Stack::set('wincache_cache', $cache);
        }
        return $cache;
    }

    public function useFile(): CacheInterface
    {
        if(($cache = Stack::get('cache')) === null){
            $cache = new self(self::FILE);
            Stack::set('cache', $cache);
        }
        return $cache;
    }

    /**
     * @inheritDoc
     */
    public function get($key, $default = null)
    {
        return $this->cache->get($key, $default);
    }

    /**
     * @inheritDoc
     */
    public function set($key, $value, $ttl = null)
    {
        return $this->cache->set($key, $value, $ttl);
    }

    /**
     * @inheritDoc
     */
    public function clear()
    {
        return $this->cache->clear();
    }

    /**
     * @inheritDoc
     */
    public function getMultiple($keys, $default = null)
    {
        return $this->cache->getMultiple($keys, $default);
    }

    /**
     * @inheritDoc
     */
    public function deleteMultiple($keys)
    {
        return $this->cache->deleteMultiple($keys);
    }

    /**
     * @inheritDoc
     */
    public function setOptions($options = [])
    {
        return $this->cache->setOptions($options);
    }

    /**
     * @inheritDoc
     */
    public function increment($name, $offset = 1)
    {
        return $this->cache->increment($name, $offset);
    }

    /**
     * @inheritDoc
     */
    public function decrement($name, $offset = 1)
    {
        return $this->cache->decrement($name, $offset);
    }

    /**
     * @inheritDoc
     */
    public function delete($key)
    {
        return $this->cache->delete($key);
    }

    /**
     * @inheritDoc
     */
    public function setMultiple($values, $ttl = null)
    {
        return $this->cache->setMultiple($values, $ttl);
    }

    /**
     * @inheritDoc
     */
    public function has($key)
    {
        return $this->cache->has($key);
    }

}
