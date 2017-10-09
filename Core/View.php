<?php

namespace Core;


class View
{
    /**
     * @param string $view
     * @param array $args
     * @return void
     */
    public static function render(string $view, array $args = []): void
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
//            echo "$file not found";
            throw new \Exception("$file not found");
        }
    }

    /**
     * @param string $template
     * @param array $args
     * @return void
     */
    public static function renderTemplate(string $template, array $args = []): void
    {
        static $twig = null;

        if($twig === null){
            $loader = new \Twig_Loader_Filesystem('../App/Views');
            $twig = new \Twig_Environment($loader);
        }

        echo $twig->render($template, $args);

    }

}