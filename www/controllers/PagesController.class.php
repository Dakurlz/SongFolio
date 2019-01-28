<?php

class PagesController{

    public function defaultAction()
    {
        $v = new View("home", "front");
    }
}