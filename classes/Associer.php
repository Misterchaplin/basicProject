<?php
class Associer{
	
	/**
	 * @ManyToOne(mappedBy)
	 * @JoinColumn(name="IDUTILISATEUR",className="Utilisateur",nullable=true)
	 */
	private $utilisateur;
	
	/**
	 * @ManyToOne(mappedBy)
	 * @JoinColumn(name="IDPROJET",className="Projet",nullable=true)
	 */
	private $projet;
	
	public function getUtilisateur() {
		return $this->utilisateur;
	}
	public function setUtilisateur($utilisateur) {
		$this->utilisateur = $utilisateur;
		return $this;
	}
	public function getProjet() {
		return $this->projet;
	}
	public function setProjet($projet) {
		$this->projet = $projet;
		return $this;
	}
	
	
	
	
}