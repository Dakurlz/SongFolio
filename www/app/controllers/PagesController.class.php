<?php

declare(strict_types=1);

namespace app\Controllers;

use app\Core\View;

class PagesController{

    public function defaultAction() : void
    {

        $view = new View("home", "front");
    }

}