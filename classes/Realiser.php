<?php
class Realiser extends \BaseObject{
	
	/**
	 * @ManyToOne(mappedBy)
	 * @JoinColumn(name="IDUTILISATEUR",className="Utilisateur")
	 */
	private $utilisateur;
	
	/**
	 * @ManyToOne(mappedBy)
	 * @JoinColumn(name="IDTACHE",className="Tache")
	 */
	private $tache;
	
	public function getUtilisateur() { 
		return $this->utilisateur;
	}
	public function setUtilisateur($utilisateur) {
		$this->utilisateur = $utilisateur;
		return $this;
	}
	public function getTache() {
		return $this->tache;
	}
	public function setTache($tache) {
		$this->tache = $tache;
		return $this;
	}
	public function getIDUTILISATEUR() {
		return $this->IDUTILISATEUR;
	}
	public function setIDUTILISATEUR($IDUTILISATEUR) {
		$this->IDUTILISATEUR = $IDUTILISATEUR;
		return $this;
	}
	public function getIDTACHE() {
		return $this->IDTACHE;
	}
	public function setIDTACHE($IDTACHE) {
		$this->IDTACHE = $IDTACHE;
		return $this;
	}
	
	
	
	
}