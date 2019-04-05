<?php

declare(strict_types=1);

class PagesController{

    public function defaultAction() : void
    {

        $view = new View("home", "front");
    }

}