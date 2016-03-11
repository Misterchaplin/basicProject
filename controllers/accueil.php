<?php
class accueil extends BaseController {
	
	public function index() {
		if(empty($_SESSION['membre'])){
			$this->loadView("vHeader");
			$this->loadView("vLogin");
			$this->loadView("vFooter");
		}else{
			commonUtils::backTo("manager");
		}
	}
	
	private function errorFlashCreator($pseudo = null, $passwd = null, $msgError){
		commonUtils::flash( "resultConnexion", $msgError, "flash fError"); // création d'un message flash d'échec
		commonUtils::flash("pseudoConnexion", $pseudo);
		commonUtils::flash("passwdConnexion", $passwd);
		commonUtils::backTo(); // redirection vers le formulaire de connexion
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
				commonUtils::backTo("manager");
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
	
}