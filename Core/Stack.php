<?php
/**
 * Stack.php
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

use InitPHP\Framework\Exception\StackException;

class Stack
{

    protected static array $_stack = [];

    public static function has(string $name): bool
    {
        $name = trim($name);
        if($name == ''){
            return false;
        }
        $key = strtolower($name);
        return isset(self::$_stack[$key]);
    }

    public static function get(string $name)
    {
        $key = self::name2key($name);
        return self::$_stack[$key] ?? null;
    }

    public static function set(string $name, $value)
    {
        $key = self::name2key($name);
        if(isset(self::$_stack[$key])){
            throw new StackException('The "' . $name . '" stack was previously defined by the system or application.');
        }
        self::$_stack[$key] = $value;
    }

    private static function name2key(string $name): string
    {
        $name = trim($name);
        if($name == ''){
            throw new StackException('The stack name cannot be empty.');
        }
        return strtolower($name);
    }

}
