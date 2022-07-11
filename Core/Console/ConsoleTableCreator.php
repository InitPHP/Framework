<?php
/**
 * ConsoleTableCreator.php
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

use const PHP_EOL;

final class ConsoleTableCreator
{
    protected array $data = [];

    public function __construct()
    {
    }

    public function __toString(): string
    {
        return $this->handler();
    }

    public function append(array $data): self
    {
        $this->data[] = $data;
        return $this;
    }

    public function handler(): string
    {
        $titles = [];
        $rows = [];
        $length = [];
        foreach ($this->data as $row) {
            $titles = \array_merge($titles, \array_keys($row));
        }
        $titles = \array_unique($titles);
        foreach ($titles as $title) {
            $length[$title] = \strlen($title);
        }
        foreach ($this->data as $row) {
            foreach ($titles as $title) {
                if(!isset($row[$title])){
                    $row[$title] = null;
                }else{
                    $len = \strlen($row[$title]);
                    if($len > $length[$title]){
                        $length[$title] = $len;
                    }
                }
            }
            $rows[] = $row;
        }
        $res = '|';
        foreach ($titles as $title) {
            $len = (int)\ceil((($length[$title] + 4) - \strlen($title)) / 2);
            $res .= \str_repeat(' ', $len)
                . $title
                . \str_repeat(' ', $len) . '|';
        }
        $res .= PHP_EOL;
        $total_len = \strlen($res);
        $res .= \str_repeat('-', $total_len) . PHP_EOL;
        foreach ($rows as $row) {
            $res .= '|';
            foreach ($row as $title => $col) {
                if($col === null){
                    $col = '-';
                }
                $len = (int)\ceil((($length[$title] + 4) - \strlen($col)) / 2);
                $res .= \str_repeat(' ', $len)
                    . $col
                    . \str_repeat(' ', $len) . '|';
            }
            $res .= PHP_EOL;
            $res .= \str_repeat('-', $total_len) . PHP_EOL;
        }
        return \str_repeat('-', $total_len) . PHP_EOL . $res;
    }

}
