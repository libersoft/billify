<?php

class clienteComponents extends sfComponents{
	
	public function executeTopBar(){
	
	}
	
	public function executeBreadCliente(){
		
	}
	
	public function executeBreadShow(){
		$this->cliente = ClientePeer::retrieveByPK($this->getRequestParameter('id'));	
	}
	
	public function executeBreadEdit(){
		$this->cliente = ClientePeer::retrieveByPK($this->getRequestParameter('id'));	
	}
}
?>