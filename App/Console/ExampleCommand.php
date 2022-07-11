<?php
declare(strict_types=1);

namespace App\Console;

use InitPHP\Console\Console;

class ExampleCommand extends \InitPHP\Framework\Console\CommandAbstract
{

    public function register(): Console
    {
        $this->console->register('hello', [$this, 'hello']);
        return $this->console;
    }

    public function hello()
    {
        $this->console->message('Hello {name}!', [
            'name'  => $this->console->flag('name', 'World')
        ]);
    }

}
