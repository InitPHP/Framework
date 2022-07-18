<?php
/**
 * Str_helper.php
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

if(!\function_exists('str_contains')){
    function str_contains(string $haystack, string $needle): bool
    {
        if($needle == ''){
            return true;
        }
        if($haystack == ''){
            return false;
        }
        if(\strlen($haystack) <= \strlen($needle)){
            return $haystack == $needle;
        }
        return \strpos($haystack, $needle) !== FALSE;
    }
}

if(!\function_exists('str_starts_with')){
    function str_starts_with(string $haystack, string $needle): bool
    {
        if($needle == ''){
            return true;
        }
        if($haystack == ''){
            return false;
        }
        $needle_len = \strlen($needle);
        if(\strlen($haystack) <= $needle_len){
            return $haystack == $needle;
        }
        return \substr($haystack, 0, $needle_len) == $needle;
    }
}

if(!\function_exists('str_ends_with')){
    function str_ends_with(string $haystack, string $needle): bool
    {
        if($needle == ''){
            return true;
        }
        if($haystack == ''){
            return false;
        }
        $needle_len = \strlen($needle);
        if(\strlen($haystack) <= $needle_len){
            return $haystack == $needle;
        }
        return \substr($haystack, (0 - $needle_len)) == $needle;
    }
}
