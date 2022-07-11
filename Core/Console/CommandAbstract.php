<?php
/**
 * CommandAbstract.php
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

namespace InitPHP\Framework\Console;

use InitPHP\Console\Console;

abstract class CommandAbstract
{

    protected Console $console;

    public function __construct(Console $console)
    {
        $this->console = $console;
    }

    abstract public function register(): Console;

}
