<?php
declare(strict_types=1);

namespace App\Configs;

use InitPHP\Config\Classes;

class Base extends Classes
{

    public string $base_url = 'http://framework.lvh.me';

    public string $default_language = 'tr';

    public string $timezone = 'Europe/Istanbul';

    public bool $ssl_redirect = false;

}
