<?php
class manager extends BaseController{
	
	public function index(){
		if(empty($_SESSION['membre']))
		{
			commonUtils::backTo();
		}
		else {
			$this->loadView("vHeader");
			$this->loadView("vMenuGestion");
			$listProject = DAO::getAll("Projet");
			$this->loadView("vGestion", $listProject);
			commonUtils::loadJs("jsManager");
			$this->loadView("vFooter");
		}
	}
}