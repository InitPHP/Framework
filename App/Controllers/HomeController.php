<?php
declare(strict_types=1);

namespace App\Controllers;

use InitPHP\Framework\Viewer;

class HomeController
{
    public function index()
    {
        return new Viewer(['welcome'], [
            'title'     => 'Welcome to InitPHP Framework'
        ]);
    }

    public function home()
    {
        return view('welcome');
    }
}
