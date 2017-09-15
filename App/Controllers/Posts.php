<?php

namespace App\Controllers;

class Posts
{

    /**
     * @return void
     */
    public function index(): void
    {
        echo "iam the index action in the posts controller";
    }

    /**
     * @return void
     */
    public function addNew(): void
    {
        echo "iam the addnew action in the posts controller";
    }

}