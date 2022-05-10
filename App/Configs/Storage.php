<?php
declare(strict_types=1);

namespace App\Configs;

use const APP_DIR;
use const DIRECTORY_SEPARATOR;

class Storage extends \InitPHP\Framework\BaseConfig
{

    public ?string $log = APP_DIR . 'Logs' . DIRECTORY_SEPARATOR . '{year}_{month}_{day}_{hour}.log';

}
