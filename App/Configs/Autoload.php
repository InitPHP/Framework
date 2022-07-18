<?php
declare(strict_types=1);

namespace App\Configs;

use InitPHP\Config\Classes;

class Autoload extends Classes
{
    public array $configs = [
        Base::class,
    ];

    public array $helpers = [
        'App'
    ];

    public array $console_commands = [
        \App\Console\ExampleCommand::class
    ];

}
