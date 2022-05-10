<?php
/**
 * Logger.php
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

use InitPHP\Logger\FileLogger;
use \Psr\Log\{LoggerInterface, NullLogger};

/**
 * @mixin LoggerInterface
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
class Logger
{

    /** @var LoggerInterface */
    protected static LoggerInterface $logger;

    public function __call($name, $arguments)
    {
        return self::getLogger()->{$name}(...$arguments);
    }

    public static function __callStatic($name, $arguments)
    {
        return self::getLogger()->{$name}(...$arguments);
    }

    private static function getLogger(): LoggerInterface
    {
        if(!isset(self::$logger)){
            if(($file = config('storage.log', null)) !== null){
                self::$logger = new FileLogger($file);
            }else{
                self::$logger = new NullLogger();
            }
        }
        return self::$logger;
    }

}
