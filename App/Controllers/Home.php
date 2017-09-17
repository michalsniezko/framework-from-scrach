<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

class Home extends Controller
{
    /**
     * @return mixed
     */
    protected function before()
    {
//        echo "BEFORE METHOD CALLED";
//        return false;
    }

    /**
     * @return void
     */
    protected function after(): void
    {
//        echo 'AFTER METHOD CALLED';
    }

    /**
     * @return void
     */
    public function indexAction(): void
    {
//        echo "Index action in the Home controller";
        View::render(
            'Home/index.php',
            array(
                'name' => 'Mike',
                'colours' => array('red', 'green', 'blue')
            )
        );
    }
}