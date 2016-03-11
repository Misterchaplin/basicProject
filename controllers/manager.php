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
			$listProject = DAO::getAll("Associer", "idutilisateur=".$_SESSION['membre']->getId());
			$this->loadView("vGestion", $listProject);
			commonUtils::loadJs("jsManager");
			$this->loadView("vFooter");
		}
	}
	
	public function addProject(){
		
	}
}