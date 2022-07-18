<?php
declare(strict_types=1);
if (!defined('BASE_DIR')) {
    die("Access denied.");
}
use InitPHP\Events\Events;

Events::on('before_boot', function () {
    return;
});

/*
Events::on('after_boot', function () {
    return;
});
*/

/*
Events::on('after_application', function () {
    return;
});
*/