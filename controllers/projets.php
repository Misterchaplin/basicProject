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
		else 
		{
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
			commonUtils::loadJs("jsMain");
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
	
	
	/** ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: **/
	/** :::::::::::::::::::::::::: GESTION PROJET ::::::::::::::::::::::::::::::::::: **/
	/** ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: **/
	
	
	public function gestion($idProjet)
	{
		if(empty($_SESSION['membre']))
		{
			commonUtils::backTo();
		}
		else
		{
			$projet = DAO::getOne("Projet", "id = ".$idProjet);
			if($projet->getUtilisateur()->getId() == $_SESSION['membre']->getId())
			{
				$this->loadView("vHeader");
				$this->loadView("form/vManageProject", $projet);
				$this->loadView("vFooter");
			}
			else
			{
				commonUtils::backTo();
			}	
		}
	}
	
	public function deleteProj($idProjet){
		if(empty($_SESSION['membre']))
		{
			commonUtils::backTo();
		}
		else
		{
			if($idProjet != null)
			{
				$projet = DAO::getOne("Projet", "id = ".$idProjet);
				if($projet->getUtilisateur()->getId() == $_SESSION['membre']->getId())
				{
					$delete = DAO::delete($projet);
					if($delete)
					{
						commonUtils::flash( "resultSupprProjet", "Projet supprimé !", "flash fSuccess");
						commonUtils::backTo();
					}
					else
					{
						commonUtils::flash( "resultSupprProjet", "Erreur lors de la suppresion du projet !", "flash fError"); // création d'un message flash d'échec
						commonUtils::backTo("projets/gestion/".$idProjet);
					}
				}
				else
				{
					commonUtils::backTo();
				}	
			}
			else
			{
				commonUtils::flash( "resultSupprProjet", "Identificaiton du projet impossible !", "flash fError"); // création d'un message flash d'échec
				commonUtils::backTo();
			}			
		}
	}
	
	
	public function updateProj($idProjet){
		if(!empty($_POST['designation']) && !empty($_POST['description']) && $idProjet!= null)
		{	
			$projet = DAO::getOne("Projet", "id = ".$idProjet);
			try
			{
				$projet->setDescription(htmlspecialchars($_POST['description']));
				$projet->setDesignation(htmlspecialchars($_POST['designation']));
				$update = DAO::update($projet);
				if($update){
					commonUtils::flash( "resultUpdateProj", "Projet modifié !", "flash fSuccess"); // création d'un message flash de réussite
					commonUtils::backTo("projets/afficher/".$projet->getId());
				}	
			}
			catch(Exception $e)
			{
				commonUtils::flash( "resultUpdateProj", "Erreur lors de la modification du projet !", "flash fError"); // création d'un message flash d'échec
				commonUtils::flash("descrUpdateProj", $_POST['description']);
				commonUtils::flash("desiUpdateProj", $_POST['designation']);
				commonUtils::backTo("projets/gestion/$idProjet");
			}
		}
		else
		{
			commonUtils::flash( "resultUpdateProj", "Donnees manquantes !", "flash fError"); // création d'un message flash d'échec
			commonUtils::flash("descrUpdateProj", $_POST['description']);
			commonUtils::flash("desiUpdateProj", $_POST['designation']);
			commonUtils::backTo("projets/gestion/$idProjet");
		}
	}
	
	
	
	/** ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: **/
	/** :::::::::::::::::::::::::: AJOUT TASKER ::::::::::::::::::::::::::::::::::: **/
	/** ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: **/
	
	public function formulaireAjoutTaskeur($idProjet){
		if(empty($_SESSION['membre']) || $idProjet == null)
		{
			commonUtils::backTo();
		}
		else
		{
			$projet = DAO::getOne("Projet", "id = ".$idProjet);
			if($projet->getUtilisateur()->getId() == $_SESSION['membre']->getId())
			{
				$lstFinalUsers = array();
				$usersAsso = DAO::getAll("Associer", "IDPROJET = ".$idProjet);
				$users = DAO::getAll("Utilisateur", "id <> ".$_SESSION['membre']->getId());
				foreach($users as $userNotA)
				{
					$everIn = false;
					foreach($usersAsso as $userA)
					{
						if($userA->getUtilisateur()->getId() == $userNotA->getId())
						{
							$everIn = true;
							break;
						}
					}
					if(!$everIn)
					{
						// ajout de l'utilisateur dans la liste de retour
						array_push($lstFinalUsers, $userNotA);
					}
				}
				$this->loadView("vHeader");
				$this->loadView("form/vCreateTasker", array("lstUsers" => $lstFinalUsers, "idProjet" => $idProjet));
				$this->loadView("vFooter");
			}
			else
			{
				commonUtils::flash( "resultAjoutTaskeur", "C'est pas bien Mr Brutus !", "flash fError"); // création d'un message flash d'échec
				commonUtils::backTo();
			}
		}
	}
	
	public function ajouterTaskeur($idProjet)
	{
		if($_POST['userSelected'] != null && $idProjet != null)
		{
			
			try
			{
				$projet = DAO::getOne("Projet", "id = ".$idProjet);
				if($projet->getUtilisateur()->getId() == $_SESSION['membre']->getId())
				{
					//$user = DAO::getOne("Utilisateur", "id = ".$_POST['userSelected']);
					$newObjAssocier = new Associer($projet->getId(),$_POST['userSelected']);				
					$insert = DAO::insert($newObjAssocier);
					commonUtils::flash( "resultAjoutTaskeur", "Tâskeur ajouté au projet !", "flash fSuccess"); // création d'un message flash de réussite
					commonUtils::backTo("projets/afficher/".$idProjet);
				}
				else
				{
					commonUtils::flash( "resultAjoutTaskeur", "C'est pas bien Mr Brutus !", "flash fError"); // création d'un message flash d'échec
					commonUtils::backTo();
				}
			}
			catch(Exception $e)
			{
				commonUtils::flash( "resultAjoutTaskeur", "Erreur lors de l'ajout du taskeur !", "flash fError"); // création d'un message flash d'échec
				commonUtils::backTo("projets/formulaireAjoutTaskeur/".$idProjet);
			}
		}
		else
		{
			commonUtils::flash( "resultAjoutTaskeur", "Donnees manquantes !", "flash fError"); // création d'un message flash d'échec
			commonUtils::backTo("projets/formulaireAjoutTaskeur/".$idProjet);
		}
	}
}