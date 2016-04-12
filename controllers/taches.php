<?php
class taches extends BaseController{
	
	public function index(){
		commonUtils::backTo();
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