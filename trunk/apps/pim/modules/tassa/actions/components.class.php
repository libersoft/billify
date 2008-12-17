<?php

class tassaComponents extends sfComponents{
	
	public function executeBread(){
		
	}
	
	public function executeEditBread(){
		$this->tassa = TassaPeer::retrieveByPK($this->getRequestParameter('id'));
	}
	
	public function executeCreateBread(){
		
	}
}
?>