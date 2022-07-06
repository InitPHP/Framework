<?php
declare(strict_types=1);

namespace App\Controllers;

class ErrorController
{

    public function pageNotFound()
    {
        return 'Error::404 - Page Not Found';
    }

}
