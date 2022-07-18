<?php
/**
 * Logger.php
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

use InitPHP\Framework\Exception\LoggerException;

/**
 * @mixin \InitPHP\Logger\Logger
 * @method static void emergency(string $message, array $context = array())
 * @method static void alert(string $message, array $context = array())
 * @method static void critical(string $message, array $context = array())
 * @method static void error(string $message, array $context = array())
 * @method static void warning(string $message, array $context = array())
 * @method static void notice(string $message, array $context = array())
 * @method static void info(string $message, array $context = array())
 * @method static void debug(string $message, array $context = array())
 * @method static void log(string $level, string $message, array $context = array())
 */
final class Logger extends \InitPHP\Logger\Logger
{

    public function __construct()
    {
        $config = new \App\Configs\Logger();
        $handlers = [];

        if($config->get('file.enable', false) !== FALSE){
            $handlers[] = new \InitPHP\Logger\FileLogger($config->get('file.path', \APP_DIR . 'Logs/{year}_{month}_{day}.log'));
        }

        $pdo_handler_options = $config->get('pdo', []);
        if(($pdo_handler_options['enable'] ?? false) !== FALSE){
            if (!isset($pdo_handler_options['dsn'])
                || !isset($pdo_handler_options['username'])
                || !isset($pdo_handler_options['password'])
                || !isset($pdo_handler_options['table'])) {
                    throw new LoggerException('PDOLogger cannot be installed due to incomplete configuration.');
            }
            try {
                $pdo = new \PDO($pdo_handler_options['dsn'], $pdo_handler_options['username'], $pdo_handler_options['password']);
            }catch (\PDOException $e) {
                throw new LoggerException($e->getMessage());
            }
            $handlers[] = new \InitPHP\Logger\PDOLogger($pdo, $pdo_handler_options['table']);
        }

        if(empty($handlers)){
            $handlers[] = new \Psr\Log\NullLogger();
        }
        parent::__construct(...$handlers);
    }

    public static function __callStatic($name, $arguments)
    {
        return Stack::get('logger')->{$name}(...$arguments);
    }

}
