<?php
/**
 * Application.php
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

use \App\Configs\{Autoload, Database};
use InitPHP\Config\Config;
use InitPHP\Container\Container;
use InitPHP\Database\DB;
use InitPHP\Dotenv\Dotenv;
use InitPHP\Events\Events;
use InitPHP\HTTP\Emitter;
use InitPHP\Router\Router;

final class Application
{

    private bool $isBoot = false;

    protected array $_attributes = [];

    public function __construct()
    {
        $this->boot();
    }

    public function boot(): self
    {
        if($this->isBoot !== FALSE){
            return $this;
        }
        Events::trigger('before_boot', null);
        Stack::set('container', new Container());
        Stack::set('viewer', new Viewer(\APP_DIR . 'Views/'));
        $this->config_boot();
        $this->https_redirect_check();
        $this->set_timezone();
        $this->dotenv_create_immutable();
        $this->database_boot();
        $this->http_boot();
        $this->translator_boot();
        Stack::set('cache', new Cache(Cache::FILE));
        Stack::set('logger', new Logger());
        Events::trigger('after_boot', null);
        $this->isBoot = true;
        return $this;
    }

    public function run()
    {
        $emitter = new Emitter;
        $emitter->emit(Route::dispatch());
        Events::trigger('after_application');
    }

    private function database_boot()
    {
        $config = new Database();
        if($config->get('enable', false) === FALSE){
            return;
        }
        $db = new DB($config->all());
        $db->connectionAsGlobal();
        Stack::set('db', $db);
    }

    private function dotenv_create_immutable()
    {
        if(\is_file(\BASE_DIR . '.env')){
            Dotenv::create(\BASE_DIR . '.env');
        }
    }

    private function config_boot()
    {
        $autoload = new Autoload();
        foreach ($autoload->get('configs', []) as $config) {
            Config::setClass($config);
        }

        $helpers = $autoload->get('helpers', []);
        if(!empty($helpers)){
            \helper(...$helpers);
        }
        unset($helpers);
        unset($autoload);
    }

    private function set_timezone()
    {
        if(($timezone = \config('base.timezone')) !== null){
            \date_default_timezone_set($timezone);
        }
    }

    private function https_redirect_check()
    {
        if(\config('base.ssl_redirect', false) === FALSE){
            return;
        }
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            return;
        }
        $uri = new \InitPHP\HTTP\Uri(\current_url());
        $url = $uri->withScheme('https')->__toString();
        \redirect($url, 0, 301);
        echo "Redirect HTTPS";
        exit;
    }

    private function http_boot()
    {
        $this->http_request_boot();
        $this->http_response_boot();
        $this->http_router_boot();
    }

    private function http_request_boot()
    {
        $this->_attributes['request'] = new Request();
        Stack::set('request', $this->_attributes['request']);
    }

    private function http_response_boot()
    {
        $body = new Stream('', null);
        $this->_attributes['response'] = new Response();
        Stack::set('response', $this->_attributes['response']);
    }

    private function http_router_boot()
    {
        $options = [
            'paths'             => [
                'controller'    => APP_DIR . 'Controllers' . DIRECTORY_SEPARATOR,
                'middleware'    => APP_DIR . 'Middlewares' . DIRECTORY_SEPARATOR,
            ],
            'namespaces'        => [
                'controller'    => '\\App\\Controllers\\',
                'middleware'    => '\\App\\Middlewares\\'
            ],
            'base_path'         => \env('BASE_PATH', '/'),
            'variable_method'   => \env('VARIABLE_METHOD', false),
            'container'         => Stack::get('container')
        ];
        $this->_attributes['router'] = new Router($this->_attributes['request'], $this->_attributes['response'], $options);
        Stack::set('router', $this->_attributes['router']);
    }

    private function translator_boot()
    {
        $translator = new \InitPHP\Translator\Translator();
        $translator->useDirectory()
            ->setDir(\APP_DIR . 'Languages/');
        if(($default = \config('base.default_language')) !== null){
            $translator->setDefault($default);
        }
        Stack::set('translator', $translator);
    }


}
