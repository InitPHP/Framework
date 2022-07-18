<?php
/**
 * Stream.php
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

final class Stream extends \InitPHP\HTTP\Stream
{
    public function __construct(string $body = '')
    {
        parent::__construct($body, null);
    }
}
