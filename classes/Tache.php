<?php

class Tache extends BaseObject{

	/**
	 * @ManyToOne 
	 * @JoinColumn(name="IDETAT",className="Etat")
	 */
	private $etat;
	/**
	 * @ManyToOne
	 * @JoinColumn(name="IDPROJET",className="Projet")
	 */
	private $projet;
	private $designation;
	private $description;

	/* (non-PHPdoc)
	 * @see BaseObject::__construct()
	 */
	public function __construct($id = null) {
		// TODO: Auto-generated method stub
	}
	
	public function getEtat() {
		return $this->etat;
	}
	public function setEtat($etat) {
		$this->etat = $etat;
		return $this;
	}
	public function getProjet() {
		return $this->projet;
	}
	public function setProjet($projet) {
		$this->projet = $projet;
		return $this;
	}
	public function getDesignation() {
		return $this->designation;
	}
	public function setDesignation($designation) {
		$this->designation = $designation;
		return $this;
	}
	public function getDescription() {
		return $this->description;
	}
	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}
	
	public function getRealiser()
	{
		$realiser = DAO::getOne("Realiser", "IDTACHE = ".parent::getId());
		return $realiser;
	}
	
	public function toString(){
		return $this->designation;
	}
	
	
}
