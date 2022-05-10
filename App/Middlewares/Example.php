<?php
declare(strict_types=1);

namespace App\Middlewares;

use \Psr\Http\Message\{RequestInterface, ResponseInterface};

class Example extends \InitPHP\Router\Middleware
{

    /**
     * @inheritDoc
     */
    public function before(RequestInterface $request, ResponseInterface $response, array $arguments = []): ResponseInterface
    {
        return $response;
    }

    /**
     * @inheritDoc
     */
    public function after(RequestInterface $request, ResponseInterface $response, array $arguments = []): ResponseInterface
    {
        return $response;
    }
}