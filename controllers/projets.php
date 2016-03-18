<?php
class projets extends BaseController{
	
	public function index(){
		commonUtils::backTo();
	}
	
	public function afficher($param){
		if(empty($_SESSION['membre']) || $param == null)
		{
			commonUtils::backTo();
		}
		else {
			$this->loadView("vHeader");
			$aProjet = DAO::getOne("Projet", $param);
			$listTaches = DAO::getAll("Tache", "idprojet=".$param);
			$te = array();
			$af = array();
			$ec = array();
			$na = array();
			foreach($listTaches as $uneTache)
			{
				switch ($uneTache->getEtat()->getId()) {
					case 1:
						array_push($af, $uneTache);
						break;
					case 2:
						array_push($ec, $uneTache);
						break;
					case 3:
						array_push($te, $uneTache);
						break;
					case 4:
						array_push($na, $uneTache);
						break;
				}
			}			
			$this->loadView("vInfoProjet", array("af" => $af,
												"te" => $te,
												"ec" => $ec,
												"na" => $na,
											 	"project" => $aProjet
											)
			);
			$this->loadView("vFooter");
		}
	}
	
	public function attribution($pIdTask, $pIdProjet)
	{
		if($pIdTask != null && $pIdProjet != null)
		{
			try
			{
				// on charge la tâche
				$task = DAO::getOne("Tache", "id ='".$pIdTask."'");
				// change l'etat de la tâche à AF
				$etatAf = DAO::getOne("Etat", "id = '1'");
				$task->setEtat($etatAf);
				DAO::update($task);
				$objReal = new Realiser();
				$objReal->setTache($task);
				$objReal->setUtilisateur($_SESSION['membre']);
				DAO::insert($objReal);
				commonUtils::flash( "resultAttribution", "Tâche affectée !", "flash fSuccess"); // création d'un message flash de success
			}
			catch(Exception $e)
			{
				commonUtils::flash( "resultAttribution", "Erreur lors de l'attribution de la tâche", "flash fError"); // création d'un message flash d'échec
			}	
			commonUtils::backTo("projets/afficher/".$pIdProjet);
		}
		else
		{
			commonUtils::backTo();
		}
		
	}
}