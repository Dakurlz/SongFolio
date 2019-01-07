<?php
class PagesController{


	public function defaultAction(){


		$v = new View("homepage", "back");
		$v->assign("pseudo");
	}

}