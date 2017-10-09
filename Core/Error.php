<?php

namespace Core;


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

        echo "<h1>Fatal error</h1>";
        echo "<p>Uncaught exception: <b>" . get_class($exception) . "</b></p>";
        echo "<p>Message: <b>" . $exception->getMessage() . "</b></p>";
        echo "<p>Stack trace: <pre>" . $exception->getTraceAsString() . "</pre></p>";
        echo "<p>Thrown in <b>" . $exception->getFile() . "</b> on line <b>" . $exception->getLine() . "</b></p>";

    }

}