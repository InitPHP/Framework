<?php
/**
 * Commands.php
 *
 * This file is part of Framework.
 *
 * @author     Muhammet ŞAFAK <info@muhammetsafak.com.tr>
 * @copyright  Copyright © 2022 Muhammet ŞAFAK
 * @license    ./LICENSE  MIT
 * @version    1.0
 * @link       https://www.muhammetsafak.com.tr
 */

declare(strict_types=1);

namespace InitPHP\Framework\Console;

use InitPHP\Console\Console;

use InitPHP\Framework\Route;
use InitPHP\Router\Router;
use const APP_DIR;
use const CORE_DIR;
use const PHP_EOL;

final class Commands
{
    protected Console $console;

    public function __construct(Console &$console)
    {
        $this->console = $console;
    }

    public function register(): Console
    {
        $this->console->register('controller', [$this, 'controller'], 'Creates a controller.')
            ->register('config', [$this, 'config'], 'Creates a config.')
            ->register('entity', [$this, 'entity'], 'Creates a entity.')
            ->register('helper', [$this, 'helper'], 'Creates a helper.')
            ->register('library', [$this, 'library'], 'Creates a library.')
            ->register('middleware', [$this, 'middleware'], 'Creates a middleware.')
            ->register('model', [$this, 'model'], 'Creates a model.')
            ->register('routers', [$this, 'routers'], 'Routers list.');
        return $this->console;
    }

    public function controller()
    {
        if(($name = $this->console->ask('Enter Controller Name')) === ''){
            $this->console->error('Controller name cannot be left blank.');
            exit;
        }
        if(((bool)preg_match('/^[a-zA-Z]+$/', $name)) === FALSE){
            $this->console->error('Controller name can only consist of alphabetic characters.');
            exit;
        }
        $name = ucfirst($name);
        $path = APP_DIR . 'Controllers/' . $name . '.php';
        if(is_file($path)){
            $this->console->warning('A controller named ' . $name . ' already exists.');
            exit;
        }
        $content = '<?php' . PHP_EOL . 'declare(strict_types=1);' . PHP_EOL . PHP_EOL . 'namespace App\\Controllers;' . PHP_EOL . PHP_EOL . 'class ' . $name . ' ' . PHP_EOL . '{ ' . PHP_EOL . PHP_EOL . '    public function index() ' . PHP_EOL . '    {' . PHP_EOL . '        return "Hello World!";' . PHP_EOL . '    }' . PHP_EOL . PHP_EOL . '}' . PHP_EOL;
        if(@file_put_contents($path, $content) === FALSE){
            $this->console->error('Failed to create ' . $name . ' controller');
            exit;
        }
        $this->console->success($name . ' controler created.');
    }

    public function config()
    {
        if(($name = $this->console->ask("Enter Config Name")) === ''){
            $this->console->error("Configuration name cannot be left blank.");
            exit;
        }
        if(((bool)preg_match('/^[a-zA-Z]+$/', $name)) === FALSE){
            $this->console->error("The configuration name must consist of alphabetic characters. It must not contain numbers or special characters.");
            exit;
        }
        $name = ucfirst($name);
        $path = APP_DIR . 'Configs/' . $name . '.php';
        if(is_file($path)){
            $this->console->warning('A config named ' . $name . ' already exists.');
            exit;
        }
        $content = '<?php' . PHP_EOL . 'declare(strict_types=1); ' . PHP_EOL . PHP_EOL . 'namespace App\\Configs; ' . PHP_EOL . PHP_EOL . 'class ' . $name . ' extends \\InitPHP\\Framework\\BaseConfig ' . PHP_EOL . '{ ' . PHP_EOL . PHP_EOL . '    public ?string $conf = null; ' . PHP_EOL . PHP_EOL . '}' . PHP_EOL;
        if(@file_put_contents($path, $content) === FALSE){
            $this->console->error("Failed to create configuration file.");
            exit;
        }
        $this->console->success('Config created.');
    }

    public function helper()
    {
        if(($name = $this->console->ask("Enter Helper Name")) === ''){
            $this->console->error("Helper name cannot be left blank.");
            exit;
        }
        if(((bool)preg_match('/^[a-zA-Z]+$/', $name)) === FALSE){
            $this->console->error("The helper name must consist of alphabetic characters. It must not contain numbers or special characters.");
            exit;
        }
        $name = ucfirst($name);
        $path = APP_DIR . 'Helpers/' . $name . '_helper.php';
        if(is_file($path)){
            $this->console->warning('A helper named ' . $name . ' already exists.');
            exit;
        }
        $content = '<?php' . PHP_EOL . 'declare(strict_types=1);' . PHP_EOL . 'if (!defined("BASE_DIR")) {' . PHP_EOL . '    die("Access denied.");' . PHP_EOL . '}' . PHP_EOL . PHP_EOL . 'if(!function_exists("hello_world")) {' . PHP_EOL . '    function hello_world()' . PHP_EOL . '    {' . PHP_EOL . '        echo "Hello World!";' . PHP_EOL . '    }' . PHP_EOL . '}' . PHP_EOL;
        if(@file_put_contents($path, $content) === FALSE){
            $this->console->error("Failed to create helper file.");
            exit;
        }
        $this->console->success('Helper created.');
    }

    public function library()
    {
        if(($name = $this->console->ask("Enter Library Name")) === ''){
            $this->console->error("Library name cannot be left blank.");
            exit;
        }
        if(((bool)preg_match('/^[a-zA-Z]+$/', $name)) === FALSE){
            $this->console->error("The library name must consist of alphabetic characters. It must not contain numbers or special characters.");
            exit;
        }
        $name = ucfirst($name);
        $path = APP_DIR . 'Libraries/' . $name . '.php';
        if(is_file($path)){
            $this->console->warning('A library named ' . $name . ' already exists.');
            exit;
        }
        $content = '<?php' . PHP_EOL . 'declare(strict_types=1);' . PHP_EOL . PHP_EOL . 'namespace App\\Libraries;' . PHP_EOL . PHP_EOL . 'class ' . $name . ' ' . PHP_EOL . '{ ' . PHP_EOL . PHP_EOL . '    public function hello() ' . PHP_EOL . '    {' . PHP_EOL . '        return "Hello World!";' . PHP_EOL . '    }' . PHP_EOL . PHP_EOL . '}' . PHP_EOL;
        if(@file_put_contents($path, $content) === FALSE){
            $this->console->error("Failed to create library file.");
            exit;
        }
        $this->console->success('Library created.');
    }

    public function middleware()
    {
        if(($name = $this->console->ask("Enter Middleware Name")) === ''){
            $this->console->error("Middleware name cannot be left blank.");
            exit;
        }
        if(((bool)preg_match('/^[a-zA-Z]+$/', $name)) === FALSE){
            $this->console->error("The middleware name must consist of alphabetic characters. It must not contain numbers or special characters.");
            exit;
        }
        $name = ucfirst($name);
        $path = APP_DIR . 'Middlewares/' . $name . '.php';
        if(is_file($path)){
            $this->console->warning('A middleware named ' . $name . ' already exists.');
            exit;
        }
        $content = '<?php' . PHP_EOL . 'declare(strict_types=1);' . PHP_EOL . PHP_EOL . 'namespace App\\Middlewares;' . PHP_EOL . PHP_EOL . 'use \\Psr\\Http\\Message\\{RequestInterface, ResponseInterface};' . PHP_EOL . PHP_EOL . 'class ' . $name . ' extends \\InitPHP\\Router\\Middleware ' . PHP_EOL . '{' . PHP_EOL . PHP_EOL . '    /**' . PHP_EOL . '     * @inheritDoc' . PHP_EOL . '     */' . PHP_EOL . '    public function before(RequestInterface $request, ResponseInterface $response, array $arguments = []): ResponseInterface' . PHP_EOL . '    {' . PHP_EOL . '        return $response;' . PHP_EOL . '    }' . PHP_EOL . PHP_EOL . '    /**' . PHP_EOL . '     * @inheritDoc' . PHP_EOL . '     */' . PHP_EOL . '    public function after(RequestInterface $request, ResponseInterface $response, array $arguments = []): ResponseInterface' . PHP_EOL . '    {' . PHP_EOL . '        return $response;' . PHP_EOL . '    }' . PHP_EOL . '}' . PHP_EOL;
        if(@file_put_contents($path, $content) === FALSE){
            $this->console->error("Failed to create middleware file.");
            exit;
        }
        $this->console->success('Middleware created.');

    }

    public function entity()
    {

    }

    public function model()
    {

    }

    public function routers()
    {
        $method = $this->console->flag('method', null);
        $routers = Route::getRoutes($method);
        print_r($routers);
    }

}
