<?php

class modipagamentoComponents extends sfComponents{
	
	public function executeBread(){
		
	}
	
	public function executeEditBread(){
		$this->pagamento = ModoPagamentoPeer::retrieveByPK($this->getRequestParameter('id'));
	}
	
	public function executeCreateBread(){
		
	}
}
?>