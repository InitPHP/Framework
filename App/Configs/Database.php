<?php
/**
 * Database.php
 *
 * This file is part of Framework.
 *
 * @author     Muhammet ŞAFAK <info@muhammetsafak.com.tr>
 * @copyright  Copyright © 2022 Muhammet ŞAFAK
 * @license    ./LICENSE  MIT
 * @version    1.0
 * @link       https://www.muhammetsafak.com.tr
 */

declare(strict_types=1);

namespace App\Configs;

class Database extends \InitPHP\Framework\BaseConfig
{

    public bool $enable = true;

    public string $dsn = 'mysql:host=localhost;port=3306;dbname=deneme;charset=utf8mb4';

    public string $username = 'root';

    public string $password = '';

    public string $charset = 'utf8mb4';

    public string $collation = 'utf8mb4_general_ci';

    public string $prefix = '';

}
