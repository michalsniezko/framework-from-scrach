<?php

namespace Core;


class View
{
    /**
     * @param string $view
     * @param array $args
     */
    public static function render(string $view, array $args = []):void
    {
        extract($args, EXTR_SKIP);

        $file = "../App/Views/$view"; //relative to Core directory

        if(is_readable($file))
        {
            /** @noinspection PhpIncludeInspection */
            require $file;
        }
        else
        {
            echo "$file not found";
        }
    }

}