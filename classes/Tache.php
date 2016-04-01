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
	/**
	 * @ManyToOne(mappedBy)
	 * @JoinColumn(name="IDTACHE",className="Realiser")
	 */
	private $realiser;
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
	public function getRealiser() {
		return $this->realiser;
	}
	public function setRealiser($realiser) {
		$this->realiser = $realiser;
		return $this;
	}
	
	
	
	
}
