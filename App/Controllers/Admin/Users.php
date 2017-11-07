<?php

namespace App\Controllers\Admin;

use Core\Controller;

class Users extends Controller
{
    /**
     * @return mixed
     */
    protected function before()
    {
    }

    /**
     * @return void
     */
    protected function after(): void
    {
    }

    /**
     * @return void
     */
    public function indexAction(): void
    {
        echo "User admin index";
    }
}
