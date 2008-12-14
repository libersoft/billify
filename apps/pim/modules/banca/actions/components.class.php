<?php

class bancaComponents extends sfComponents{
	
	public function executeBread(){
		
	}
	
	public function executeEditBread(){
		$this->banca = BancaPeer::retrieveByPK($this->getRequestParameter('id'));
	}
	
	public function executeCreateBread(){
		
	}
}
?>