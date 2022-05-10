<?php
/**
 * Route.php
 *
 * This file is part of InitPHP Framework.
 *
 * @author     Muhammet ŞAFAK <info@muhammetsafak.com.tr>
 * @copyright  Copyright © 2022 Muhammet ŞAFAK
 * @license    https://github.com/InitPHP/Framework/blob/main/LICENSE  MIT
 * @version    1.0
 * @link       https://www.muhammetsafak.com.tr
 */

namespace InitPHP\Framework;

use \InitPHP\HTTP\{Request, Response, Stream};
use InitPHP\Router\Router;
use Psr\Http\Message\ResponseInterface;
use function function_exists;

/**
 * @mixin Router
 * @method static Router middleware(string[]|string|\Closure[]|\Closure$middleware, int $position = Router::POSITION_BOTH)
 * @method static Router name(string $name)
 * @method static string route(string $name, array $arguments = [])
 * @method static Router add(string|string[] $methods, string $path, string|\Closure|array$execute, array $options = [])
 * @method static Router get(string $path, string|\Closure|array $execute, array $options = [])
 * @method static Router post(string $path, string|\Closure|array $execute, array $options = [])
 * @method static Router put(string $path, string|\Closure|array $execute, array $options = [])
 * @method static Router delete(string $path, string|\Closure|array $execute, array $options = [])
 * @method static Router options(string $path, string|\Closure|array $execute, array $options = [])
 * @method static Router patch(string $path, string|\Closure|array $execute, array $options = [])
 * @method static Router head(string $path, string|\Closure|array $execute, array $options = [])
 * @method static Router xget(string $path, string|\Closure|array $execute, array $options = [])
 * @method static Router xpost(string $path, string|\Closure|array $execute, array $options = [])
 * @method static Router xput(string $path, string|\Closure|array $execute, array $options = [])
 * @method static Router xdelete(string $path, string|\Closure|array $execute, array $options = [])
 * @method static Router xoptions(string $path, string|\Closure|array $execute, array $options = [])
 * @method static Router xpatch(string $path, string|\Closure|array $execute, array $options = [])
 * @method static Router xhead(string $path, string|\Closure|array $execute, array $options = [])
 * @method static Router any(string $path, string|\Closure|array $execute, array $options = [])
 * @method static void group(string $prefix, \Closure $group, array $options = [])
 * @method static void domain(string $domain, \Closure $group, array $options = [])
 * @method static void port(int $port, \Closure $group, array $options = [])
 * @method static void ip(string|string[] $ip, \Closure $group, array $options = [])
 * @method static void controller(string $controller, string $prefix = '')
 * @method static void error_404(string|\Closure|array $execute, array $options = [])
 * @method static Router where(string $key, string $pattern)
 * @method static null|string currentController()
 * @method static null|string currentCMethod()
 * @method static array currentCArguments()
 * @method static ResponseInterface dispatch()
 */
final class Route
{

    protected static Router $router;

    public function __call($name, $arguments)
    {
        return self::getInitPHPRouter()->{$name}(...$arguments);
    }

    public static function __callStatic($name, $arguments)
    {
        return self::getInitPHPRouter()->{$name}(...$arguments);
    }

    private static function getInitPHPRouter(): Router
    {
        if(!isset(self::$router)){
            if(($headers = function_exists('apache_request_headers') ? apache_request_headers() : []) === FALSE){
                $headers = [];
            }

            $uri = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http')
                . '://'
                . ($_SERVER['SERVER_NAME'] ?? 'localhost')
                . ($_SERVER['REQUEST_URI'] ?? '/');

            $request = new Request(
                ($_SERVER['REQUEST_METHOD'] ?? 'GET'),
                $uri,
                $headers,
                null,
                '1.1'
            );

            $response = new Response(200, [], (new Stream('', null)), '1.1');

            $basePath = env('BASE_PATH', '/');
            if($basePath[0] === '/'){
                $basePath = substr($basePath, 1);
            }

            self::$router = new Router($request, $response, [
                'controller'        => [
                    'path'      => APP_DIR . 'Controllers' . DIRECTORY_SEPARATOR,
                    'namespace' => "\\App\\Controllers\\"
                ],
                'middleware'        => [
                    'path'      => APP_DIR . 'Middlewares' . DIRECTORY_SEPARATOR,
                    'namespace' => "\\App\\Middlewares\\"
                ],
                'basePath'          => $basePath,
                'variableMethods'   => env('VARIABLE_METHOD', false),
            ]);
        }
        return self::$router;
    }

}
