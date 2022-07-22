<?php
declare(strict_types=1);

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;

class ErrorController
{

    public function pageNotFound()
    {
        return \view('errors/404.php');
    }

}
