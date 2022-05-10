<?php
declare(strict_types=1);

namespace App\Controllers;

class ErrorController extends \InitPHP\Framework\BaseController
{

    public function pageNotFound()
    {
        return 'Error::404 - Page Not Found';
    }

}
