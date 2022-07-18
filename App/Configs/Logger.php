<?php
declare(strict_types=1); 

namespace App\Configs;

use const APP_DIR;
use const DIRECTORY_SEPARATOR;

class Logger extends \InitPHP\Config\Classes 
{

    public array $file = [
        'enable'    => true,
        'path'      => APP_DIR . 'Logs' . DIRECTORY_SEPARATOR . '{year}_{month}_{day}_{hour}.log'
    ];

    /**
     * CREATE TABLE `logs` (
        `level` ENUM('EMERGENCY','ALERT','CRITICAL','ERROR','WARNING','NOTICE','INFO','DEBUG') NOT NULL,
        `message` TEXT NOT NULL,
        `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;
     *
     */
    public array $pdo = [
        'enable'    => false,
        'dsn'       => 'mysql:host=localhost;dbname=logs;charset=utf8mb4',
        'username'  => 'root',
        'password'  => '',
        'table'     => 'logs',
    ];

}
