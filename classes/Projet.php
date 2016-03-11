<?php

class Projet extends \BaseObject{

	/**
	 * @ManyToOne
	 * @JoinColumn(name="IDUTILISATEUR",className="utilisateur")
	 */
	private $utilisateur;
	private $designation;
	private $datecreation;
	private $description;

	/* (non-PHPdoc)
	 * @see BaseObject::__construct()
	 */
	public function __construct($id = null) {
		// TODO: Auto-generated method stub

	}
	public function getDesignation() {
		return $this->designation;
	}
	public function setDesignation($designation) {
		$this->designation = $designation;
		return $this;
	}
	public function getDatecreation() {
		return $this->datecreation;
	}
	public function setDatecreation($datecreation) {
		$this->datecreation = $datecreation;
		return $this;
	}
	public function getDescription() {
		return $this->description;
	}
	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}
	public function getUtilisateur() {
		return $this->utilisateur;
	}
	public function setUtilisateur($utilisateur) {
		$this->utilisateur = $utilisateur;
		return $this;
	}
	public function getTaches() {
		return $this->taches;
	}
	public function setTaches($taches) {
		$this->taches = $taches;
		return $this;
	}
	
	public function toString(){
		return $this->designation;
	}
	
	
	
	
	
}
