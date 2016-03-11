<?php

class Etat extends \BaseObject{

	private $designation;

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
	
	
	
	
	
}
