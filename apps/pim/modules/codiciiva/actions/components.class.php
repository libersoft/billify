<?php

class codiciivaComponents extends sfComponents{
	
	public function executeBread(){
		
	}
	
	public function executeEditBread(){
		$this->codice = CodiceIvaPeer::retrieveByPK($this->getRequestParameter('id'));
	}
	
	public function executeCreateBread(){
		
	}
}
?>