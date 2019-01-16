<?php

class PagesController{


		$v = new View("homepage", "back");
		$v->assign("pseudo");
	}

        $v = new View("home");
        $v->assign("pseudo", $pseudo);
    }
}