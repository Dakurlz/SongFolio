<?php
class PagesController{


	public function defaultAction(){

		$pseudo = "Prof";

		$v = new View("homepage", "back");
		$v->assign("pseudo",$pseudo);
	}

}