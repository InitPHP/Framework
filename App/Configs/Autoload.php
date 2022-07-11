<?php
declare(strict_types=1);

namespace App\Configs;

class Autoload extends \InitPHP\Framework\BaseConfig
{
    public array $configs = [
        Base::class,
        Storage::class,
    ];

    public array $helpers = [
        'App'
    ];

    public array $console_commands = [
        \App\Console\ExampleCommand::class
    ];

}
