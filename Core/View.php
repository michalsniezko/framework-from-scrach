<?php

namespace Core;


class View
{
    /**
     * @param string $view
     * @return void
     */
    public static function render(string $view):void
    {
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