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
			$aProjet = DAO::getOne("Projet", $param);
			$listTaches = DAO::getAll("Tache", "idprojet=".$param);
			$this->loadView("vInfoProjet", array("tasks" => $listTaches,
												 "project" => $aProjet
											)
							);
			$this->loadView("vFooter");
		}
	}
}