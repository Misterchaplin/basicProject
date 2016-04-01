<?php

class Utilisateur extends \BaseObject{

	private $pseudo;
	private $nom;
	private $prenom;
	private $mdp;

	/* (non-PHPdoc)
	 * @see BaseObject::__construct()
	 */
	public function __construct($id = null) {
		// TODO: Auto-generated method stub

	}
	public function getPseudo() {
		return $this->pseudo;
	}
	public function setPseudo($pseudo) {
		$this->pseudo = $pseudo;
		return $this;
	}
	public function getNom() {
		return $this->nom;
	}
	public function setNom($nom) {
		$this->nom = $nom;
		return $this;
	}
	public function getPrenom() {
		return $this->prenom;
	}
	public function setPrenom($prenom) {
		$this->prenom = $prenom;
		return $this;
	}
	public function getMdp() {
		return $this->mdp;
	}
	public function setMdp($mdp) {
		$this->mdp = $mdp;
		return $this;
	}
	
	public function toString(){
		return $this->nom." ".$this->prenom;
	}
	
	
	
	
	
	
	
	
}
