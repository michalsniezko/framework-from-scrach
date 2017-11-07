<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;
use App\Models\Post;

class Posts extends Controller
{

    /**
     * @return void
     */
    public function indexAction(): void
    {
        $posts = Post::getAll();
        View::renderTemplate(
            'Posts/index.html.twig',
            array(
                'posts' => $posts
            )
        );
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
