<?php
declare(strict_types=1);

use InitPHP\Framework\Route;

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController::home');

Route::error_404('ErrorController@pageNotFound');