<?php
/**
 * Request.php
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

final class Request extends \InitPHP\HTTP\Request
{

    public function __construct()
    {
        if(($headers = \function_exists('apache_request_headers') ? \apache_request_headers() : []) === FALSE){
            $headers = [];
        }
        $uri = \current_url();
        $method = ($_SERVER['REQUEST_METHOD'] ?? 'GET');
        $version = '1.1';
        if(isset($_SERVER['SERVER_PROTOCOL'])){
            switch (\strtolower($_SERVER['SERVER_PROTOCOL'])) {
                case 'http/1.0':
                    $version = '1.0';
                    break;
                case 'http/2.0':
                    $version = '2.0';
                    break;
            }
        }
        $body = null;
        if(($body_read = @\file_get_contents('php://input')) !== FALSE){
            $body = new Stream($body_read);
        }
        parent::__construct($method, $uri, $headers, $body, $version);
    }


}