<?php

class prodottoComponents extends sfComponents{
	
	public function executeBread(){
		
	}
	
	public function executeBreadShow(){
		$this->prodotto = ProdottoPeer::retrieveByPK($this->getRequestParameter('id'));	
	}
	
	public function executeBreadEdit(){
		$this->prodotto = ProdottoPeer::retrieveByPK($this->getRequestParameter('id'));	
	}
}
?>