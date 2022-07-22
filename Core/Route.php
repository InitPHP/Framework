<?php
/**
 * Route.php
 *
 * This file is part of InitPHP Framework.
 *
 * @author     Muhammet ŞAFAK <info@muhammetsafak.com.tr>
 * @copyright  Copyright © 2022 Muhammet ŞAFAK
 * @license    https://github.com/InitPHP/Framework/blob/main/LICENSE  MIT
 * @version    1.1
 * @link       https://www.muhammetsafak.com.tr
 */

namespace InitPHP\Framework;

/**
 * @mixin \InitPHP\Router\Router
 * @method static \InitPHP\Router\Router middleware(string[]|string|\Closure[]|\Closure$middleware, int $position = Route::POSITION_BOTH)
 * @method static \InitPHP\Router\Router name(string $name)
 * @method static string route(string $name, array $arguments = [])
 * @method static \InitPHP\Router\Router add(string|string[] $methods, string $path, string|\Closure|array$execute, array $options = [])
 * @method static \InitPHP\Router\Router get(string $path, string|\Closure|array $execute, array $options = [])
 * @method static \InitPHP\Router\Router post(string $path, string|\Closure|array $execute, array $options = [])
 * @method static \InitPHP\Router\Router put(string $path, string|\Closure|array $execute, array $options = [])
 * @method static \InitPHP\Router\Router delete(string $path, string|\Closure|array $execute, array $options = [])
 * @method static \InitPHP\Router\Router options(string $path, string|\Closure|array $execute, array $options = [])
 * @method static \InitPHP\Router\Router patch(string $path, string|\Closure|array $execute, array $options = [])
 * @method static \InitPHP\Router\Router head(string $path, string|\Closure|array $execute, array $options = [])
 * @method static \InitPHP\Router\Router any(string $path, string|\Closure|array $execute, array $options = [])
 * @method static void group(string $prefix, \Closure $group, array $options = [])
 * @method static void domain(string $domain, \Closure $group, array $options = [])
 * @method static void port(int $port, \Closure $group, array $options = [])
 * @method static void ip(string|string[] $ip, \Closure $group, array $options = [])
 * @method static void controller(string $controller, string $prefix = '')
 * @method static void error_404(string|\Closure|array $execute, array $options = [])
 * @method static \InitPHP\Router\Router pattern(string $key, string $pattern)
 * @method static \InitPHP\Router\Router where(string $key, string $pattern)
 * @method static \Psr\Http\Message\ResponseInterface dispatch()
 */
final class Route
{

    public const POSITION_AFTER = \InitPHP\Router\Router::AFTER;
    public const POSITION_BEFORE = \InitPHP\Router\Router::BEFORE;
    public const POSITION_BOTH = \InitPHP\Router\Router::BOTH;

    public function __call($name, $arguments)
    {
        return Stack::get('router')->{$name}(...$arguments);
    }

    public static function __callStatic($name, $arguments)
    {
        return Stack::get('router')->{$name}(...$arguments);
    }

}
