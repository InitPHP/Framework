<?php
declare(strict_types=1);

namespace App\Controllers;

class HomeController extends \InitPHP\Framework\Base
{
    public function index()
    {
        return view('welcome', [
            'title'     => 'Welcome to InitPHP Framework'
        ]);
    }

    public function home()
    {
        $views = ['welcome'];
        $data = [
            'title'     => 'Welcome to InitPHP Framework'
        ];
        return view($views, $data);
    }
}
