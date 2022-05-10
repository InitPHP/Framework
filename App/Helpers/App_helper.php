<?php
declare(strict_types=1);
if (!defined('BASE_DIR')) {
    die("Access denied.");
}

if(!function_exists('hello_world')) {
    function hello_world()
    {
        echo 'Hello World!';
    }
}
