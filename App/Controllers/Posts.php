<?php

namespace App\Controllers;

use Core\Controller;

class Posts extends Controller
{

    /**
     * @return void
     */
    public function indexAction(): void
    {
        echo "iam the index action in the posts controller";
//        echo "<p>Query string parameters: <pre>"
//            . htmlspecialchars(print_r($_GET, true))
//            . "</pre></p>";

    }

    /**
     * @return void
     */
    public function addNewAction(): void
    {
        echo "iam the addnew action in the posts controller";
    }

    /**
     * @return void
     */
    public function editAction(): void
    {
        echo "Edit action in Posts controller;";
        echo "<p>Route parameters: <pre>"
            . htmlspecialchars(print_r($this->route_params, true))
            . "</pre></p>";
    }


}