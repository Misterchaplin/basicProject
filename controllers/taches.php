<?php
class taches extends BaseController{
	
	public function index(){
		commonUtils::backTo();
	}
	
	/** ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: **/
	/** :::::::::::::::::::::::::: GESTION TACHE ::::::::::::::::::::::::::::::::::: **/
	/** ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: **/
	
	public function gestion($idProjet, $idTache)
	{
		if(empty($_SESSION['membre']))
		{
			commonUtils::backTo();
		}
		else
		{
			try
			{
				$projet = DAO::getOne("Projet", "id = ".$idProjet);
				if($projet->getUtilisateur()->getId() == $_SESSION['membre']->getId())
				{
					$tache = DAO::getOne("Tache", "id = ".$idTache);
					$this->loadView("vHeader");
					$this->loadView("form/vManageTask", array("tache" => $tache, "projet" => $projet));
					$this->loadView("vFooter");
				}
				else
				{
					commonUtils::backTo();
				}
			}
			catch(Exception $ex)
			{
				commonUtils::backTo();
			}
		}
	}
	
	public function deleteTask($idProjet, $idTache){
		if(empty($_SESSION['membre']))
		{
			commonUtils::backTo();
		}
		else
		{
			try
			{
				$projet = DAO::getOne("Projet", "id = ".$idProjet);
				if($projet->getUtilisateur()->getId() == $_SESSION['membre']->getId())
				{
					$tache = DAO::getOne("Tache", "id = ".$idTache);
					$delete = DAO::delete($tache);
					if($delete)
					{
						commonUtils::flash( "resultSupprTache", "Tâche supprimée !", "flash fSuccess");
						commonUtils::backTo("projets/afficher/".$idProjet);
					}
					else
					{
						commonUtils::flash( "resultSupprTache", "Erreur lors de la suppresion de la tâche !", "flash fError"); // création d'un message flash d'échec
						commonUtils::backTo("taches/gestion/".$idProjet."/".$idTache);
					}
				}
				else
				{
					commonUtils::backTo();
				}
			}
			catch(Excepyion $ex)
			{
				commonUtils::backTo();
			}
		}
	}
	
	
	public function updateTache($tache, $project){
	if(!empty($_POST['designation']) && !empty($_POST['description'])&& $tache != null && $project != null)
		{
			try
			{	$projet = DAO::getOne("Projet", "id = ".$project);
				if($projet->getUtilisateur()->getId() == $_SESSION['membre']->getId())
				{
					$tache = DAO::getOne("Tache", "id = ".$tache);
					$tache->setDescription(htmlspecialchars($_POST['description']));
					$tache->setDesignation(htmlspecialchars($_POST['designation']));
					$update = DAO::update($tache);
					if($update){
						commonUtils::flash( "resultUpdateTache", "Tâche modifiée !", "flash fSuccess"); // création d'un message flash de réussite
						commonUtils::backTo("projets/afficher/".$project);
					}else{
						commonUtils::flash( "resultUpdateTache", "Erreur lors de la modification de la tâche !", "flash fError"); // création d'un message flash d'échec
						commonUtils::backTo("projets/gestion/".$project);
					}
				}
				else
				{
					commonUtils::flash( "resultUpdateTache", "C'est pas bien Mr Brutus !", "flash fError"); // création d'un message flash d'échec
					commonUtils::backTo();
				}
			}
			catch(Exception $e)
			{
				commonUtils::flash( "resultUpdateTache", "Erreur lors de la modification de la tâche !", "flash fError"); // création d'un message flash d'échec
				commonUtils::flash("descrUpdateTache", $_POST['description']);
				commonUtils::flash("desiUpdateTache", $_POST['designation']);
				commonUtils::backTo("taches/gestion/$project/$tache");
			}
		}
		else
		{
			commonUtils::flash( "resultUpdateTache", "Donnees manquantes !", "flash fError"); // création d'un message flash d'échec
			commonUtils::flash("descrUpdateTache", $_POST['description']);
			commonUtils::flash("desiUpdateTache", $_POST['designation']);
			commonUtils::backTo("taches/gestion/$project/$tache");
		}
	}
	

	/** ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: **/
	/** :::::::::::::::::::::::::: AJOUT TACHE ::::::::::::::::::::::::::::::::::: **/
	/** ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: **/
	
	public function ajouterTache($idProjet)
	{
		if($_POST['designation'] != null && $_POST['description'] != null && $idProjet != null)
		{
			try
			{	$projet = DAO::getOne("Projet", "id = ".$idProjet);
				if($projet->getUtilisateur()->getId() == $_SESSION['membre']->getId())
				{
					$etat = DAO::getOne("Etat", "id = 4");
					$newObjTache = new Tache();
					$newObjTache->setEtat($etat);
					$newObjTache->setDescription(htmlspecialchars($_POST['description']));
					$newObjTache->setDesignation(htmlspecialchars($_POST['designation']));
					$newObjTache->setProjet($projet);
					$insert = DAO::insert($newObjTache);
					commonUtils::flash( "resultAjoutTache", "Tâche ajoutée !", "flash fSuccess"); // création d'un message flash de réussite
					commonUtils::backTo("projets/afficher/".$idProjet);
				}
				else
				{
					commonUtils::flash( "resultAjoutTache", "C'est pas bien Mr Brutus !", "flash fError"); // création d'un message flash d'échec
					commonUtils::backTo();
				}
			}
			catch(Exception $e)
			{
				commonUtils::flash( "resultAjoutTache", "Erreur lors de l'ajout de la tâche !", "flash fError"); // création d'un message flash d'échec
				commonUtils::backTo("taches/formulaireAjoutTache/".$idProjet);
			}
		}
		else
		{
			commonUtils::flash( "resultAjoutTache", "Donnees manquantes !", "flash fError"); // création d'un message flash d'échec
			commonUtils::backTo("taches/formulaireAjoutTache/".$idProjet);
		}
	}
	
	public function formulaireAjoutTache($idProjet){
		if(empty($_SESSION['membre']) || $idProjet == null)
		{
			commonUtils::backTo();
		}
		else
		{
			$this->loadView("vHeader");
			$this->loadView("form/vCreateTask", $idProjet);
			$this->loadView("vFooter");
		}		
	}
	

}