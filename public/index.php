<?php
declare(strict_types=1);

define('BASE_DIR', dirname(__DIR__) . DIRECTORY_SEPARATOR);

const APP_DIR = BASE_DIR . 'App' . DIRECTORY_SEPARATOR;
const CORE_DIR = BASE_DIR . 'Core' . DIRECTORY_SEPARATOR;
const VERSION = '1.0';

require_once BASE_DIR . "vendor/autoload.php";

$framework = new \InitPHP\Framework\InitPHP;
$framework->bootstrap();
$framework->emitter();
