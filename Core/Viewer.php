<?php
/**
 * Viewer.php
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

namespace InitPHP\Framework;

use InitPHP\Framework\Exception\FrameworkException;
use const APP_DIR;
use const DIRECTORY_SEPARATOR;
use function str_ends_with;
use function is_file;
use function extract;
use function ob_start;
use function ob_get_contents;
use function ob_end_clean;

final class Viewer
{

    protected static array $views = [];

    protected static array $data = [];

    public function __construct(array $views, array $data = [])
    {
        foreach ($views as $view) {
            if(($view = self::viewFileCheck($view)) === FALSE){
                throw new FrameworkException('View "' . $view . '" not found.');
            }
            self::$views[] = $view;
        }
        self::$data = $data;
    }

    public function __toString(): string
    {
        return $this->handler();
    }

    public static function require(string $view)
    {
        if(($view = self::viewFileCheck($view)) === FALSE){
            throw new FrameworkException('View "' . $view . '" not found.');
        }
        if(!empty(self::$data)){
            extract(self::$data);
        }
        require $view;
    }

    public function handler(): string
    {
        if(!empty(self::$data)){
            extract(self::$data);
        }
        ob_start();
        foreach (self::$views as $view) {
            require $view;
        }
        if(($content = ob_get_contents()) === FALSE){
            $content = '';
        }
        ob_end_clean();
        return $content;
    }

    private static function viewFileCheck(string $view): string|false
    {
        if(!str_ends_with($view, '.php')){
            $view .= '.php';
        }
        $path = APP_DIR . 'Views' . DIRECTORY_SEPARATOR . $view;
        return is_file($path) ? $path : false;
    }

}
