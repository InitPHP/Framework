<?php
declare(strict_types=1);

use InitPHP\Framework\Route;

Route::get('/', 'HomeController@index')->name('index');

Route::get('/home', 'HomeController::home');

Route::error_404('ErrorController@pageNotFound');