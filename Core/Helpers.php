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
    function view(string $view, array $data = []): string
    {
        if(substr($view, -4) !== '.php'){
            $view .= '.php';
        }
        $_init_php_view_path = APP_DIR . 'Views' . DIRECTORY_SEPARATOR . $view;
        if(!is_file($_init_php_view_path)){
            throw new \InitPHP\Framework\Exception\FrameworkException('The view file ' . $view . ' cannot be found.');
        }
        if(!empty($data)){
            extract($data);
        }
        ob_start();
        require $_init_php_view_path;
        if(($content = ob_get_contents()) === FALSE){
            $content = '';
        }
        ob_end_clean();
        return $content;
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
    function base_url(?string $path = null)
    {
        $base_url = config('base.base_url');
        if($path === null || $path == '/'){
            return $base_url;
        }
        return rtrim($base_url, "/")
            . '/' . ltrim($path, "/");
    }
}

if(!function_exists('redirect')){
    function redirect(?string $url = null, int $second = 0, int $status = 302)
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