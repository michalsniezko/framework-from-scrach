<?php

namespace Core;


use App\Config;
use Exception;

class Error
{

    public static function errorHandler(int $level, string $message, string $file, int $line) : void
    {
        if(error_reporting() !== 0)
        {
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }

    public static function exceptionHandler(Exception $exception) : void
    {
        if(Config::SHOW_ERRORS)
        {

            echo "<h1>Fatal error</h1>";
            echo "<h2>DEV MODE</h2>";
            echo "<p>Uncaught exception: <b>" . get_class($exception) . "</b></p>";
            echo "<p>Message: <b>" . $exception->getMessage() . "</b></p>";
            echo "<p>Stack trace: <pre>" . $exception->getTraceAsString() . "</pre></p>";
            echo "<p>Thrown in <b>" . $exception->getFile() . "</b> on line <b>" . $exception->getLine() . "</b></p>";

        }
        else
        {

            date_default_timezone_set('GMT');

            //remember the directory permissions
            $log = dirname(__DIR__) . '/logs/' . date('Y-m-d') . '.txt';
            ini_set('error_log', $log);

            $message = "Uncaught exception " . get_class($exception)
                . " with message " . $exception->getMessage()
                . "\n Stack trace: " . $exception->getTraceAsString()
                . "\n Thrown in " . $exception->getFile()
                . " on line " . $exception->getLine();

            error_log($message);
            echo "<h1>An error occured</h1>";

        }
    }

}