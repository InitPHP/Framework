<?php
/**
 * Viewer.php
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

use InitPHP\Container\Container;
use InitPHP\Framework\Exception\ViewerException;
use const DIRECTORY_SEPARATOR;
use function is_file;
use function is_dir;
use function extract;
use function ob_start;
use function ob_end_clean;
use function rtrim;
use function trim;
use function ltrim;
use function array_merge;
use function is_array;
use function is_string;

final class Viewer
{

    protected array $views = [];

    protected array $data = [];

    protected string $dir;

    protected string $content = '';

    public function __construct(string $dir)
    {
        if(!is_dir($dir)){
            throw new ViewerException('The "' . $dir . '" directory could not be found.');
        }
        $this->dir = rtrim($dir, '/\\') . DIRECTORY_SEPARATOR;
    }

    public function __toString(): string
    {
        return $this->handler();
    }

    public function setData(array $data): self
    {
        if(!empty($data)){
            $this->data = array_merge($this->data, $data);
        }
        return $this;
    }

    public function setViews(string ...$views): self
    {
        $this->views = \array_merge($this->views, $views);
        return $this;
    }

    public function setTheme(?string $theme = null): self
    {
        $this->theme = ($theme === null ? null : trim($theme, '/\\'));
        return $this;
    }

    public function require(string ...$views)
    {
        if(!empty($this->data)){
            extract($this->data);
        }
        foreach ($views as $view) {
            $path = $this->get_path($view);
            if(!is_file($path)){
                throw new ViewerException('"' . $path . '" view file not found.');
            }
            require $path;
        }
    }

    /**
     * @param string|string[] $views
     * @param array $data
     * @return $this
     */
    public function view($views, array $data): self
    {
        if(empty($views)){
            throw new ViewerException("Views ar not empty.");
        }
        if (is_array($views)) {
            foreach ($views as $view) {
                if(!is_string($view)){
                    throw new ViewerException("Views can be a string or an array of strings.");
                }
            }
        }elseif(is_string($views)){
            $views = [$views];
        }else{
            throw new ViewerException("Views can be a string or an array of strings.");
        }
        $clone = clone $this;
        $clone->setData($data)
            ->setViews(...$views);
        return $clone;
    }

    public function cell(string $library, string $method, array $data = []): string
    {
        if(!\class_exists($library)){
            throw new ViewerException('Class "' . $library . '" not found.');
        }
        if(!\method_exists($library, $method)){
            throw new ViewerException('The "' . $library . '" class does not have an "' . $method . '" method.');
        }

        /** @var Container $container */
        $container = Stack::get('container');
        $library = $container->get($library);

        $clone = clone $this;
        $clone->views = [];
        $clone->data = [];
        $clone->content = '';
        ob_start(function ($tmp) use ($clone) {
            $clone->content .= $tmp;
        });
        $content = \call_user_func_array([$library, $method], [$data]);
        echo (string)$content;
        ob_end_clean();
        return $clone->handler();
    }

    protected function handler(): string
    {
        $views = [];
        foreach ($this->views as $view) {
            $path = $this->get_path($view);
            if(!is_file($path)){
                throw new ViewerException('"' . $path . '" view file not found.');
            }
            $views[] = $path;
        }
        $this->views = [];

        if(!empty($this->data)){
            $data = $this->data;
            extract($data);
        }

        ob_start(function ($tmp) {
            $this->content .= $tmp;
        });
        foreach ($views as $view) {
            require $view;
        }
        unset($views);
        ob_end_clean();
        $content = $this->content;
        $this->content = '';
        $this->data = [];
        return $content;
    }

    private function get_path(string $view): string
    {
        if(!\str_ends_with($view, '.php')){
            $view .= '.php';
        }
        return $this->dir . ltrim($view, '\\/');
    }

}
