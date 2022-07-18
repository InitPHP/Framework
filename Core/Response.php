<?php
/**
 * Response.php
 *
 * This file is part of Framework.
 *
 * @author     Muhammet ŞAFAK <info@muhammetsafak.com.tr>
 * @copyright  Copyright © 2022 Muhammet ŞAFAK
 * @license    ./LICENSE  MIT
 * @version    1.1
 * @link       https://www.muhammetsafak.com.tr
 */

declare(strict_types=1);

namespace InitPHP\Framework;

class Response extends \InitPHP\HTTP\Response
{
    public function __construct()
    {
        parent::__construct(200, [], (new Stream('')), '1.1', null);
    }
}
