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
			$this->loadView("page/vInfoProjet", array("af" => $af,
												"te" => $te,
												"ec" => $ec,
												"na" => $na,
											 	"project" => $aProjet
											)
			);
			$this->loadView("vFooter");
		}
	}
	
	public function attribution($pIdTask, $pIdProjet, $pIdEtat)
	{
		if($pIdTask != null && $pIdProjet != null)
		{
			try
			{
				// on charge la tâche
				$task = DAO::getOne("Tache", "id ='".$pIdTask."'");
				// change l'etat de la tâche à AF
				$etatAf = DAO::getOne("Etat", "id = ".$pIdEtat);
				$task->setEtat($etatAf);
				DAO::update($task);
				if($pIdEtat == 1)
				{
					$objReal = new Realiser();
					$objReal->setTache($task);
					$objReal->setUtilisateur($_SESSION['membre']);
					DAO::insert($objReal);
				}				
				commonUtils::flash( "resultAttribution", "Etat de la tâche mis à jour !", "flash fSuccess"); // création d'un message flash de success
			}
			catch(Exception $e)
			{
				commonUtils::flash( "resultAttribution", "Erreur lors de la mise à jour de l'etat de la tâche", "flash fError"); // création d'un message flash d'échec
			}	
			commonUtils::backTo("projets/afficher/".$pIdProjet);
		}
		else
		{
			commonUtils::backTo();
		}
		
	}
	
	public function ajouterProjet()
	{
		if($_POST['designation'] != null && $_POST['description'] != null)
		{
			try
			{
				$newObjProjet = new Projet();
				$newObjProjet->setDatecreation(date("Y-m-d H:i:s"));
				$newObjProjet->setUtilisateur($_SESSION['membre']);
				$newObjProjet->setDescription(htmlspecialchars($_POST['description']));
				$newObjProjet->setDesignation(htmlspecialchars($_POST['designation']));
				$insert = DAO::insert($newObjProjet);
				commonUtils::flash( "resultAjoutProjet", "Projet ajouté !", "flash fSuccess"); // création d'un message flash de réussite
				commonUtils::backTo("projets/afficher/".$newObjProjet->getId());
			}
			catch(Exception $e)
			{
				commonUtils::flash( "resultAjoutProjet", "Erreur lors de l'ajout du projet !", "flash fError"); // création d'un message flash d'échec
				commonUtils::backTo("projets/formulaireAjoutProjet");
			}
		}
		else
		{
			commonUtils::flash( "resultAjoutProjet", "Donnees manquantes !", "flash fError"); // création d'un message flash d'échec
			commonUtils::backTo("projets/formulaireAjoutProjet");
		}
	}
	
	/** ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: **/
	/** :::::::::::::::::::::::::: SI MEMBRE = CONNECTÉ ::::::::::::::::::::::::::::::::::: **/
	/** ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: **/
	
	public function formulaireAjoutProjet(){
		if(empty($_SESSION['membre']))
		{
			commonUtils::backTo();
		}
		else
		{
			$this->loadView("vHeader");
			$this->loadView("form/vCreateProject");
			$this->loadView("vFooter");
		}		
	}
}