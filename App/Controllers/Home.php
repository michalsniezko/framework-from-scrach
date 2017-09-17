<?php

namespace App\Controllers;

use Core\Controller;

class Home extends Controller
{
    /**
     * @return mixed
     */
    protected function before()
    {
        echo "BEFORE METHOD CALLED";
        return false;
    }

    /**
     * @return void
     */
    protected function after(): void
    {
        echo 'AFTER METHOD CALLED';
    }

    /**
     * @return void
     */
    public function indexAction(): void
    {
        echo "Index action in the Home controller";
    }
}