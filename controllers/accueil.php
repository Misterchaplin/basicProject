<?php
class accueil extends BaseController {
	
	public function index() {		
		$this->loadView("vHeader");
		if(empty($_SESSION['membre'])){
			$this->loadView("form/vLogin");
		}else{
			$this->loadView("page/vMenuMembre");
			$listProjects = DAO::getAll("Associer", "idutilisateur=".$_SESSION['membre']->getId());
			$listProjectsResponsable = DAO::getAll("Projet", "idutilisateur=".$_SESSION['membre']->getId());
			$lstData = array("lstProjects" => $listProjects, "lstProjectsResponsable" => $listProjectsResponsable);
			$this->loadView("page/vAccueilMembre", $lstData);
			commonUtils::loadJs("jsMain");
		}
		$this->loadView("vFooter");
	}
	
	private function errorFlashCreator($pseudo = null, $passwd = null, $msgError){
		commonUtils::flash( "resultConnexion", $msgError, "flash fError"); // création d'un message flash d'échec
		commonUtils::flash("pseudoConnexion", $pseudo);
		commonUtils::flash("passwdConnexion", $passwd);
		commonUtils::backTo(); // redirection vers le formulaire de connexion
	}
	
	private function errorFlashCreatorRegister($pseudo = null, $surname = null, $firstname = null, $passwd = null, $passwdConfirm = null, $msgError){
		commonUtils::flash("resultInscription", $msgError, "flash fError"); // création d'un message flash d'échec
		commonUtils::flash("pseudoInscription", $pseudo);
		commonUtils::flash("surnameInscription", $surname);
		commonUtils::flash("firstnameInscription", $firstname);
		commonUtils::flash("passwdInscription", $passwd);
		commonUtils::flash("passwdConfirmInscription", $passwdConfirm);
		commonUtils::backTo("accueil/inscription"); // redirection vers le formulaire d'inscription
	}
	
	// charge la vue Guide
	public function guide()
	{
		if(empty($_SESSION['membre'])){
			commonUtils::backTo();
		}else{
			$this->loadView("vHeader");
			$this->loadView("page/vGuide");
			$this->loadView("vFooter");
		}		
	}
	
	/** :::::::::::::::::::::::::: CONNEXION DU MEMBRE ::::::::::::::::::::::::::::::::::: **/
	
	
	public function connexionMembre(){
		$pseudo = $_POST['pseudo'];
		$passwd = $_POST['passwd'];
		if(!empty($pseudo) && !empty($passwd))
		{
			$conditions = "pseudo='".$pseudo."' and mdp='".hash('sha512',$passwd)."'";
			$user=DAO::getOne("Utilisateur", $conditions);
			if($user!=null){// si connexion réussie
				$_SESSION['membre'] = $user; // stocakge du membre en session
				commonUtils::flash( "resultConnexion", "Bienvenue ".$user->getNom()." ".$user->getPrenom(), "flash fSuccess"); // création d'un message flash de succes
				commonUtils::backTo();
			}
			else{
				$this->errorFlashCreator($pseudo, $passwd, "Echec de l'identification");
			}
		}
		else
		{
			$this->errorFlashCreator($pseudo, $passwd, "Aucunes informations envoyées");
		}
	}
	
	/** :::::::::::::::::::::::::: DECONNEXION DU MEMBRE ::::::::::::::::::::::::::::::::::: **/
	
	
	public function deconnexionMembre(){
		//détruit toutes les variables de la session courante
		session_unset();
		//Détruit la session courante
		session_destroy();
		// redirection
		commonUtils::backTo();
	}
	
	/** :::::::::::::::::::::::::: INSCRIPTION DU MEMBRE ::::::::::::::::::::::::::::::::::: **/
	
	public function inscription(){
		$this->loadView("vHeader");
		$this->loadView("form/vRegister");
		$this->loadView("vFooter");
	}
	
	public function inscrireMembre(){
		$pseudo = $_POST['pseudo'];
		$surname = $_POST['surname'];
		$firstname = $_POST['firstname'];
		$passwd = $_POST['passwd'];
		$passwdConfirm = $_POST['passwdConfirm'];
		$data =array($pseudo, $surname,	$firstname,	$passwd, $passwdConfirm);
		$checkRegister = true;
		for($i=0; $i<5; $i++){
			if(strlen($data[$i])==0){
				$checkRegister=false;
			}
		}
		
		if($checkRegister){
			if(strlen($pseudo) > 50 && strlen($passwd) > 20 && 
				strlen($surname) > 150 && strlen($firstname) > 150){
				$checkRegister=false;
			}
			
			if($passwd != $passwdConfirm){
				$checkRegister=false;
			}
			
			$conditions = "pseudo='".$pseudo."'";
			$userFind=DAO::getAll("Utilisateur", $conditions);
			if(count($userFind) > 0){
				$this->errorFlashCreatorRegister($pseudo, $surname, $firstname, $passwd, $passwdConfirm, "Ce pseudo existe déjà");
			}
			
			if($checkRegister == false){
				$this->errorFlashCreatorRegister($pseudo, $surname, $firstname, $passwd, $passwdConfirm, "Echec de l'inscription");
			}else{
				$user = new Utilisateur();
				$user->setPseudo($pseudo);
				$user->setNom($surname);
				$user->setPrenom($firstname);
				$user->setMdp(hash('sha512',$passwd));
				$insertUser = DAO::insert($user);
				if($insertUser){
					$_SESSION['membre'] = $user; // stocakge du membre en session
					commonUtils::flash( "resultConnexion", "Bienvenue ".$user->getNom()." ".$user->getPrenom(), "flash fSuccess"); // création d'un message flash de succes
					commonUtils::backTo();
				}else{
					$this->errorFlashCreatorRegister($pseudo, $surname, $firstname, $passwd, $passwdConfirm, "Echec de l'inscription");
				}
			}
		}else{
			$this->errorFlashCreatorRegister($pseudo, $surname, $firstname, $passwd, $passwdConfirm, "Echec de l'inscription");
		}
	}
}