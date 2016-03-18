<?php
class Realiser extends BaseObject{
	
	/**
	 * @ManyToOne
	 * @JoinColumn(name="IDUTILISATEUR",className="Utilisateur")
	 */
	private $utilisateur;
	
	/**
	 * @ManyToOne
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
	
	
	
}