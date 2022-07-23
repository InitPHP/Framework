<?php
declare(strict_types=1);

namespace App\Configs;

use InitPHP\Config\Classes;

class Database extends Classes
{

    public bool $enable = false;

    public string $dsn = 'mysql:host=localhost;port=3306;dbname=framework;charset=utf8mb4';

    public string $username = 'root';

    public string $password = '';

    public string $charset = 'utf8mb4';

    public string $collation = 'utf8mb4_general_ci';

}
