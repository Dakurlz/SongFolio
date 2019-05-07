<?php

declare(strict_types=1);

namespace Songfolio\Controllers;

use Songfolio\Core\View;

class PagesController{

    public function defaultAction() : void
    {

        $view = new View("home", "front");
    }

}