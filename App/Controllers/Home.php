<?php

namespace App\Controllers;

use Core\Controller;

class Home extends Controller
{
    /**
     * @return void
     */
    public function index(): void
    {
        echo "Index action in the Home controller";
    }
}