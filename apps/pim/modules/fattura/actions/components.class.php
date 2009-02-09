<?php

class fatturaComponents extends sfComponents{
	
	public function executeTopBar(){
			
	}
	
	public function executeBreadList(){
			
	}
	
	public function executeBreadShow(){
		if($this->getRequestParameter('id'))
			$this->fattura = VenditaPeer::retrieveByPK($this->getRequestParameter('id'));
	}
	
	public function executeBreadEdit(){
		if($this->getRequestParameter('id'))
			$this->fattura = VenditaPeer::retrieveByPK($this->getRequestParameter('id'));
	}
	
	public function executeBreadTags(){
		
	}
}
?>