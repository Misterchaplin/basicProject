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
			$listProjects = DAO::getAll("Associer", "idutilisateur=".$_SESSION['membre']->getId());
			$listProjectsResponsable = DAO::getAll("Projet", "idutilisateur=".$_SESSION['membre']->getId());
			$lstData = array("lstProjects" => $listProjects, "lstProjectsResponsable" => $listProjectsResponsable);
			$this->loadView("vGestion", $lstData);
			commonUtils::loadJs("jsManager");
			$this->loadView("vFooter");
		}
	}
	
	public function addProject(){
		
	}
}