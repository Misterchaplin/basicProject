<?php
class Realiser {
	
	/**
	 * @ManyToOne(mappedBy)
	 * @JoinColumn(name="idUtilisateur",className="Utilisateur",nullable=true)
	 */
	private $utilisateur;
	
	/**
	 * @ManyToOne(mappedBy)
	 * @JoinColumn(name="idTache",className="Tache",nullable=true)
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