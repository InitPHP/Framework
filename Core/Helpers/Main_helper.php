<?php
/**
 * Main_helper.php
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

if (!defined('BASE_DIR')) {
    die("Access denied.");
}

if(!\function_exists('cache')){
    function cache(): \InitPHP\Framework\Cache
    {
        return \InitPHP\Framework\Stack::get('cache');
    }
}

if(!\function_exists('view')){
    /**
     * @param string|string[] $view
     * @param array $data
     * @return string
     */
    function view($view, array $data = []): string
    {
        if(is_string($view)){
            $view = [$view];
        }
        /** @var \InitPHP\Framework\Viewer $viewer */
        $viewer = \InitPHP\Framework\Stack::get('viewer');
        $viewer->setData($data)
            ->setViews(...$view);
        return $viewer->__toString();
    }
}

if(!\function_exists('view_require')){
    function view_require(string ...$views)
    {
        \InitPHP\Framework\Stack::get('viewer')
            ->require(...$views);
    }
}

if(!\function_exists('view_cell')){
    function view_cell(string $library, string $method, array $data = [], ?int $cache_ttl = null, ?string $cache_name = null): ?string
    {
        /** @var \InitPHP\Framework\Viewer $viewer */
        $viewer = \InitPHP\Framework\Stack::get('viewer');
        if($cache_ttl === null){
            return $viewer->cell($library, $method, $data);
        }
        if($cache_ttl < 1){
            throw new \InitPHP\Framework\Exception\ViewerException('Cache duration of view cells (' . $method . ') cannot be 0 or a negative number.');
        }
        if(empty($cache_name)){
            $cache_name = 'view_cell_' . \md5($library . $method) . '.cache';
        }
        $cache = \cache();
        if(($res = $cache->get($cache_name, null)) === null){
            $res = $viewer->cell($library, $method, $data);
            $cache->set($cache_name, $res, $cache_ttl);
        }
        return $res;
    }
}

if(!\function_exists('helper')){
    function helper(string ...$helpers)
    {
        foreach ($helpers as $helper) {
            if(!\str_ends_with($helper, '.php')){
                $helper .= (\str_ends_with($helper, '_helper') ? '.php' : '_helper.php');
            }
            $path = \CORE_DIR . 'Helpers/' . $helper;
            if(\is_file($path)){
                require_once $path;
                continue;
            }
            $path = \APP_DIR . 'Helpers/' . $helper;
            if(\is_file($path)){
                require_once $path;
                continue;
            }
            throw new \InitPHP\Framework\Exception\HelperException('Helper file (' . $path . ') is not found.');
        }
    }
}

if(!\function_exists('route')){
    function route(string $name, array $arguments = []): string
    {
        return \InitPHP\Framework\Route::route($name, $arguments);
    }
}

if(!\function_exists('env')){
    function env(string $name, $default = null)
    {
        return \InitPHP\Dotenv\Dotenv::get($name, $default);
    }
}

if(!\function_exists('config')){
    function config(string $key, $default = null)
    {
        return \InitPHP\Config\Config::get($key, $default);
    }
}

if(!\function_exists('trans')){
    function trans(string $key, ?string $default = null, array $context = []): string
    {
        return \InitPHP\Framework\Stack::get('translator')
            ->_r($key, $default, $context);
    }
}

if(!\function_exists('language_change')){
    function language_change(string $lang): \InitPHP\Translator\Translator
    {
        return \InitPHP\Framework\Stack::get('translator')
            ->change($lang);
    }
}


if(!\function_exists('base_url')){
    function base_url(?string $path = null): string
    {
        $base_url = \config('base.base_url', '');
        if($path === null || $path == '/'){
            return $base_url;
        }
        return \rtrim($base_url, "/")
            . '/' . \ltrim($path, "/");
    }
}

if(!\function_exists('redirect')){
    function redirect(?string $url = null, int $second = 0, int $status = 302): void
    {
        if($url === null){
            $url = \config('base.base_url', '/');
        }
        if($status > 399 || $status < 300){
            $status = 302;
        }
        if($second < 0){
            $second = 0;
        }
        if($second > 0){
            \header("Refresh:{$second}; url={$url}");
        }else{
            \header("Location: {$url}", true, $status);
        }
    }
}

if(!\function_exists('current_url')){
    /**
     * @param int|null $component
     * @return array|int|string|null
     */
    function current_url(?int $component = null)
    {
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http')
            . '://'
            . ($_SERVER['SERVER_NAME'] ?? 'localhost')
            . (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != 80 ? ':' . $_SERVER['SERVER_PORT'] : '')
            . ($_SERVER['REQUEST_URI'] ?? '/');
        if($component === null){
            return $url;
        }
        $parse = \parse_url($url, $component);
        if($parse === null || $parse === FALSE){
            return null;
        }
        return $parse;
    }
}
