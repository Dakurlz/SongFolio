<?php

class PagesController{

    public function defaultAction()
    {
        $v = new View("home", "front");
    }
    public function contentAction()
    {
        $pagename = "Bienvenue sur notre site!";

        $v = new View("content", "front");
        $v->assign('pagename', $pagename);
    }
}