<?php
class Associer extends BaseObject{
	
	/**
	 * @Id
	 */
	private $IDUTILISATEUR;
	
	/**
	 * @Id
	 */
	private $IDPROJET;
	
	/**
	 * @ManyToOne(mappedBy)
	 * @JoinColumn(name="IDUTILISATEUR",className="utilisateur")
	 */
	private $utilisateur;
	
	/**
	 * @ManyToOne(mappedBy)
	 * @JoinColumn(name="IDPROJET",className="projet")
	 */
	private $projet;
	
	
	public function __construct($idproj = "", $iduser = ""){
		$this->IDUTILISATEUR = $iduser;
		$this->IDPROJET = $idproj;
	}
	
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
	public function getIDUTILISATEUR() {
		return $this->IDUTILISATEUR;
	}
	public function setIDUTILISATEUR($IDUTILISATEUR) {
		$this->IDUTILISATEUR = $IDUTILISATEUR;
		return $this;
	}
	public function getIDPROJET() {
		return $this->IDPROJET;
	}
	public function setIDPROJET($IDPROJET) {
		$this->IDPROJET = $IDPROJET;
		return $this;
	}
	

	
	
	
}