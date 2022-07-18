<?php
/**
 * Base.php
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

/**
 * @property-read \InitPHP\Container\Container $container
 * @property-read Viewer $viewer
 * @property-read Cache $cache
 * @property-read \InitPHP\Logger\Logger $logger
 * @property-read \InitPHP\Database\DB $db
 * @property-read Request $request
 * @property-read Response $response
 * @property-read \InitPHP\Translator\Translator $translator
 */
abstract class Base
{

    public function __get($name)
    {
        if(($stack = Stack::get($name)) === null){
            throw new \InitPHP\Framework\Exception\FrameworkException('"' . $name . '" property not found.');
        }
        return $stack;
    }

    public function __isset($name)
    {
        return Stack::has($name);
    }

}
