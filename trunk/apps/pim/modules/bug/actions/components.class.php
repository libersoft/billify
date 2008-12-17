<?php

class bugComponents extends sfComponents{
	
	public function executeBread(){
		
	}
	
	public function executeBreadShow(){
		$this->bug = BugPeer::retrieveByPK($this->getRequestParameter('id'));	
	}
	
	public function executeBreadEdit(){
		$this->bug = BugPeer::retrieveByPK($this->getRequestParameter('id'));	
	}
}
?>