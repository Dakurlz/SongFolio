<?php

class PagesController{


<<<<<<< HEAD
		$v = new View("homepage", "back");
		$v->assign("pseudo");
	}

        $v = new View("home");
        $v->assign("pseudo", $pseudo);
=======
        $v = new View("home", "front");
>>>>>>> Kilian
    }
}