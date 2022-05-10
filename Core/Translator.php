<?php
/**
 * Translator.php
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

use const APP_DIR;
use const DIRECTORY_SEPARATOR;

/**
 * @mixin \InitPHP\Translator\Translator
 * @method static \InitPHP\Translator\Translator change(string $current)
 * @method static string _r(string $key, null|string $default = null, array $context = [])
 * @method static void _e(string $key, null|string $default = null, array $context = [])
 */
final class Translator
{
    protected static \InitPHP\Translator\Translator $translator;

    public function __call($name, $arguments)
    {
        return self::getTranslator()->{$name}(...$arguments);
    }

    public static function __callStatic($name, $arguments)
    {
        return self::getTranslator()->{$name}(...$arguments);
    }

    private static function getTranslator(): \InitPHP\Translator\Translator
    {
        if(!isset(self::$translator)){
            self::$translator = new \InitPHP\Translator\Translator();
            self::$translator->useDirectory();
            self::$translator->setDir(APP_DIR . 'Languages' . DIRECTORY_SEPARATOR)
                            ->setDefault(config('base.default_language', 'en'));
        }
        return self::$translator;
    }
}
