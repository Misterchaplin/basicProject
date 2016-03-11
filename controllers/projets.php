<?php
class projets extends BaseController{
	
	public function index(){
	
	}
	
	public function afficher($param){
		if(empty($_SESSION['membre']))
		{
			commonUtils::backTo();
		}
		else {
			$this->loadView("vHeader");
			$aProject = DAO::getOne("Projet", $param);
			$this->loadView("vInfoProjet", $aProject);
			$this->loadView("vFooter");
		}
	}
}