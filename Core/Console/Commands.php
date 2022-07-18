<?php
/**
 * Commands.php
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

namespace InitPHP\Framework\Console;

use InitPHP\Console\Console;

use InitPHP\Framework\Route;
use InitPHP\Router\Router;
use const APP_DIR;
use const CORE_DIR;
use const PHP_EOL;
use function ucfirst;
use function strtolower;
use function preg_match;
use function is_file;
use function file_put_contents;

final class Commands extends CommandAbstract
{

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
        $content = '<?php' . PHP_EOL . 'declare(strict_types=1);' . PHP_EOL . PHP_EOL . 'namespace App\\Controllers;' . PHP_EOL . PHP_EOL . 'class ' . $name . ' extends \\InitPHP\\Framework\\Base ' . PHP_EOL . '{ ' . PHP_EOL . PHP_EOL . '    public function index() ' . PHP_EOL . '    {' . PHP_EOL . '        return "Hello World!";' . PHP_EOL . '    }' . PHP_EOL . PHP_EOL . '}' . PHP_EOL;
        if(@file_put_contents($path, $content) === FALSE){
            $this->console->error('Failed to create "' . $name . '" controller');
            exit;
        }
        $this->console->success('"' . $name . '" controler created.');
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
            $this->console->warning('A config named "' . $name . '" already exists.');
            exit;
        }
        $content = '<?php' . PHP_EOL . 'declare(strict_types=1); ' . PHP_EOL . PHP_EOL . 'namespace App\\Configs; ' . PHP_EOL . PHP_EOL . 'class ' . $name . ' extends \\InitPHP\\Config\\Classes ' . PHP_EOL . '{ ' . PHP_EOL . PHP_EOL . '    public ?string $conf = null; ' . PHP_EOL . PHP_EOL . '}' . PHP_EOL;
        if(@file_put_contents($path, $content) === FALSE){
            $this->console->error("Failed to create configuration file.");
            exit;
        }
        $this->console->success('"' . $name . '" config created.');
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
            $this->console->warning('A helper named "' . $name . '" already exists.');
            exit;
        }
        $content = '<?php' . PHP_EOL . 'declare(strict_types=1);' . PHP_EOL . 'if (!defined("BASE_DIR")) {' . PHP_EOL . '    die("Access denied.");' . PHP_EOL . '}' . PHP_EOL . PHP_EOL . 'if(!function_exists("hello_world")) {' . PHP_EOL . '    function hello_world()' . PHP_EOL . '    {' . PHP_EOL . '        echo "Hello World!";' . PHP_EOL . '    }' . PHP_EOL . '}' . PHP_EOL;
        if(@file_put_contents($path, $content) === FALSE){
            $this->console->error("Failed to create helper file.");
            exit;
        }
        $this->console->success('"' . $name . '" helper created.');
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
            $this->console->warning('A library named "' . $name . '" already exists.');
            exit;
        }
        $content = '<?php' . PHP_EOL . 'declare(strict_types=1);' . PHP_EOL . PHP_EOL . 'namespace App\\Libraries;' . PHP_EOL . PHP_EOL . 'class ' . $name . ' ' . PHP_EOL . '{ ' . PHP_EOL . PHP_EOL . '    public function hello() ' . PHP_EOL . '    {' . PHP_EOL . '        return "Hello World!";' . PHP_EOL . '    }' . PHP_EOL . PHP_EOL . '}' . PHP_EOL;
        if(@file_put_contents($path, $content) === FALSE){
            $this->console->error("Failed to create library file.");
            exit;
        }
        $this->console->success('"' . $name . '" library created.');
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
            $this->console->warning('A middleware named "' . $name . '" already exists.');
            exit;
        }
        $content = '<?php' . PHP_EOL . 'declare(strict_types=1);' . PHP_EOL . PHP_EOL . 'namespace App\\Middlewares;' . PHP_EOL . PHP_EOL . 'use \\Psr\\Http\\Message\\{RequestInterface, ResponseInterface};' . PHP_EOL . PHP_EOL . 'class ' . $name . ' extends \\InitPHP\\Router\\Middleware ' . PHP_EOL . '{' . PHP_EOL . PHP_EOL . '    /**' . PHP_EOL . '     * @inheritDoc' . PHP_EOL . '     */' . PHP_EOL . '    public function before(RequestInterface $request, ResponseInterface $response, array $arguments = []): ResponseInterface' . PHP_EOL . '    {' . PHP_EOL . '        return $response;' . PHP_EOL . '    }' . PHP_EOL . PHP_EOL . '    /**' . PHP_EOL . '     * @inheritDoc' . PHP_EOL . '     */' . PHP_EOL . '    public function after(RequestInterface $request, ResponseInterface $response, array $arguments = []): ResponseInterface' . PHP_EOL . '    {' . PHP_EOL . '        return $response;' . PHP_EOL . '    }' . PHP_EOL . '}' . PHP_EOL;
        if(@file_put_contents($path, $content) === FALSE){
            $this->console->error("Failed to create middleware file.");
            exit;
        }
        $this->console->success('"' . $name . '" middleware created.');
    }

    public function entity()
    {
        if(($name = $this->console->ask('Enter Entity Name:')) === ''){
            $this->console->error('Entity name cannot be left blank.');
            exit;
        }
        if(((bool)preg_match('/^[a-zA-Z]+$/', $name)) === FALSE){
            $this->console->error("The entity name must consist of alphabetic characters. It must not contain numbers or special characters.");
            exit;
        }
        $name = ucfirst($name);
        $path = APP_DIR . 'Entities/' . $name . '.php';
        if(is_file($path)){
            $this->console->warning('A entity named "' . $name . '" already exists.');
            exit;
        }
        $content = '<?php' . PHP_EOL . 'declare(strict_types=1);' . PHP_EOL . PHP_EOL . 'namespace App\\Entities;' . PHP_EOL . PHP_EOL . 'class ' . $name . ' extends \\InitPHP\\Database\\Entity' . PHP_EOL . '{' . PHP_EOL . PHP_EOL . '}' . PHP_EOL;
        if(@file_put_contents($path, $content) === FALSE){
            $this->console->error("Failed to create entity file.");
            exit;
        }
        $this->console->success('"'.$name.'" entity created.');
    }

    public function model()
    {
        if(($name = $this->console->ask('Enter Model Name:')) === ''){
            $this->console->error('Model name cannot be left blank.');
            exit;
        }
        if(((bool)preg_match('/^[a-zA-Z]+$/', $name)) === FALSE){
            $this->console->error("The model name must consist of alphabetic characters. It must not contain numbers or special characters.");
            exit;
        }
        $name = ucfirst($name);
        $path = APP_DIR . 'Models/' . $name . '.php';
        if(is_file($path)){
            $this->console->warning('A model named "' . $name . '" already exists.');
            exit;
        }
        $content = '<?php' . PHP_EOL . 'declare(strict_types=1);' . PHP_EOL . PHP_EOL . 'namespace App\\Models;' . PHP_EOL . PHP_EOL . 'class ' . $name . ' extends \\InitPHP\\Database\\Model' . PHP_EOL . '{' . PHP_EOL . PHP_EOL . '    protected $entity = \\InitPHP\\Database\\Entity::class;' . PHP_EOL . PHP_EOL . '    protected string $table = "' . strtolower($name) . '";' . PHP_EOL . PHP_EOL . '    protected ?string $primaryKey = "id";' . PHP_EOL . PHP_EOL . '    protected bool $useSoftDeletes = true;' . PHP_EOL . PHP_EOL . '    protected ?string $createdField = "created_at";' . PHP_EOL . PHP_EOL . '    protected ?string $updatedField = "updated_at";' . PHP_EOL . PHP_EOL . '    protected ?string $deletedField = "deleted_at";' . PHP_EOL . PHP_EOL . '    protected ?array $allowedFields = null;' . PHP_EOL . PHP_EOL . '    protected bool $allowedCallbacks = false;' . PHP_EOL . PHP_EOL . '    protected array $beforeInsert = [];' . PHP_EOL . PHP_EOL . '    protected array $afterInsert = [];' . PHP_EOL . PHP_EOL . '    protected array $beforeUpdate = [];' . PHP_EOL . PHP_EOL . '    protected array $afterUpdate = [];' . PHP_EOL . PHP_EOL . '    protected array $beforeDelete = [];' . PHP_EOL . PHP_EOL . '    protected array $afterDelete = [];' . PHP_EOL . PHP_EOL . '    protected bool $readable = true;' . PHP_EOL . PHP_EOL . '    protected bool $writable = true;' . PHP_EOL . PHP_EOL . '    protected bool $deletable = true;' . PHP_EOL . PHP_EOL . '    protected bool $updatable = true;' . PHP_EOL . PHP_EOL . '    protected array $validation = [];' . PHP_EOL . PHP_EOL . '    protected array $validationMsg = [];' . PHP_EOL . PHP_EOL . '    protected array $validationLabels = [];' . PHP_EOL . PHP_EOL . '}' . PHP_EOL;
        if(@file_put_contents($path, $content) === FALSE){
            $this->console->error("Failed to create model file.");
            exit;
        }
        $this->console->success('"'.$name.'" model created.');
    }

    public function routers()
    {
        $method = $this->console->flag('method', null);
        $routers = Route::getRoutes($method);
        $table = new ConsoleTableCreator();
        if(empty($method)){
            foreach ($routers as $methods => $router) {
                $this->route_append_table($table, $router, $methods);
            }
        }else{
            $this->route_append_table($table, $routers, $method);
        }
        echo $table . PHP_EOL;
    }

    private function route_append_table(ConsoleTableCreator &$table, array $routers, string $method = '')
    {
        foreach ($routers as $key => $value) {
            if(is_callable($value['execute'])){
                $execute = 'Callabled!';
            }elseif(is_string($value['execute'])){
                $execute = $value['execute'];
            }elseif(is_array($value['execute'])){
                $execute_key = \key($value['execute']);
                if(is_string($execute_key)){
                    $execute = $execute_key . '::' . $value['execute'][$execute_key];
                }else{
                    $execute = $value['execute'][0] . '::' . $value['execute'][1];
                }
            }else{
                $execute = 'Unknown';
            }
            $table->append([
                'method'    => $method,
                'path'      => $key,
                'execute'   => $execute,
                'name'      => ($value['options']['name'] ?? '-'),
            ]);
        }
    }

}
