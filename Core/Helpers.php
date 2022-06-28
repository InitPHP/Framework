<?php
/**
 * Helpers.php
 *
 * This file is part of InitPHP Framework.
 *
 * @author     Muhammet ŞAFAK <info@muhammetsafak.com.tr>
 * @copyright  Copyright © 2022 Muhammet ŞAFAK
 * @license    https://github.com/InitPHP/Framework/blob/main/LICENSE  MIT
 * @version    1.0
 * @link       https://www.muhammetsafak.com.tr
 */

declare(strict_types=1);
if (!defined('BASE_DIR')) {
    die("Access denied.");
}

if(!function_exists('view')){
    /**
     * @param string|string[] $view
     * @param array $data
     * @return string
     */
    function view(string|array $view, array $data = []): string
    {
        if(is_string($view)){
            $view = [$view];
        }
        $viewer = new \InitPHP\Framework\Viewer($view, $data);
        return $viewer->handler();
    }
}

if(!function_exists('route')){
    function route(string $name, array $arguments = []): string
    {
        return \InitPHP\Framework\Route::route($name, $arguments);
    }
}

if(!function_exists('env')){
    function env(string $name, $default = null)
    {
        return \InitPHP\Dotenv\Dotenv::get($name, $default);
    }
}

if(!function_exists('config')){
    function config(string $key, $default = null)
    {
        return \InitPHP\Config\Config::get($key, $default);
    }
}

if(!function_exists('trans')){
    function trans(string $key, ?string $default = null, array $context = []): string
    {
        return \InitPHP\Framework\Translator::_r($key, $default, $context);
    }
}

if(!function_exists('base_url')){
    function base_url(?string $path = null): string
    {
        $base_url = config('base.base_url', '');
        if($path === null || $path == '/'){
            return $base_url;
        }
        return rtrim($base_url, "/")
            . '/' . ltrim($path, "/");
    }
}

if(!function_exists('redirect')){
    function redirect(?string $url = null, int $second = 0, int $status = 302): void
    {
        if($url === null){
            $url = config('base.base_url');
        }
        if($status > 399 || $status < 300){
            $status = 302;
        }
        if($second < 0){
            $second = 0;
        }
        if($second > 0){
            header("Refresh:{$second}; url={$url}");
        }else{
            header("Location: {$url}", true, $status);
        }
    }
}