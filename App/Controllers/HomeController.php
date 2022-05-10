<?php
declare(strict_types=1);

namespace App\Controllers;

class HomeController extends \InitPHP\Framework\BaseController
{
    public function index()
    {
        # \InitPHP\Framework\Logger::alert('Hello World! :)');

        return view('welcome');
    }

    public function home()
    {
        return view('welcome');
    }
}
