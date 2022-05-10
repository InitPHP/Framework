<?php
declare(strict_types=1);
if (!defined('BASE_DIR')) {
    die("Access denied.");
}
use InitPHP\Events\Events;

Events::on('before_bootstrap', function () {
    return;
});

/*
Events::on('after_bootstrap', function () {
    return;
});
*/

/*
Events::on('after_emitter', function () {
    return;
});
*/