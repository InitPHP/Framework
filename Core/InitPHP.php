<?php
/**
 * InitPHP.php
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

namespace InitPHP\Framework;

use \App\Configs\{Autoload, Database};
use InitPHP\Config\Config;
use InitPHP\Database\DB;
use InitPHP\Dotenv\Dotenv;
use InitPHP\Events\Events;
use InitPHP\HTTP\Emitter;

use const BASE_DIR;
use const APP_DIR;
use const DIRECTORY_SEPARATOR;
use const LC_ALL;

final class InitPHP
{

    public function bootstrap()
    {
        $this->_autoload();
        $this->_ssl_redirect_check();

        Events::trigger('before_bootstrap', null);

        \setlocale(LC_ALL, \config('base.locale', 'tr_TR'));

        $this->_setTimezone();
        $this->_dotenv();
        $this->_db_connection();
        Events::trigger('after_bootstrap', null);
    }

    public function emitter()
    {
        $emitter = new Emitter;
        $emitter->emit(Route::dispatch());
        Events::trigger('after_emitter', null);
    }

    private function _dotenv()
    {
        if(\file_exists(BASE_DIR . '.env')){
            Dotenv::create(BASE_DIR . '.env');
        }
    }

    private function _setTimezone()
    {
        \date_default_timezone_set(\config('base.timezone', 'Europe/Berlin'));
    }

    private function _autoload()
    {
        $autoload = new Autoload();
        foreach ($autoload->get('configs', []) as $config) {
            Config::setClass($config);
        }

        $helperPath = APP_DIR . 'Helpers' . DIRECTORY_SEPARATOR;
        foreach ($autoload->get('helpers', []) as $helper) {
            $path =  $helperPath . \ucfirst($helper) . '_helper.php';
            require_once $path;
        }
        unset($autoload);
    }

    private function _db_connection()
    {
        $config = new Database();
        if($config->get('enable', false) === FALSE){
            return;
        }
        $db = (new DB($config->all()))->connection();
        $db->asConnectionGlobal();
    }

    private function _ssl_redirect_check()
    {
        if(\config('base.ssl_redirect', false) === FALSE){
            return;
        }
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
            return;
        }
        $uri = 'https://' . ($_SERVER['SERVER_NAME'] ?? 'localhost') . ($_SERVER['REQUEST_URI'] ?? '/');
        \redirect($uri,0, 301);
        exit;
    }

}
