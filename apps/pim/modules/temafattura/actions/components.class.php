<?php

class TemaFatturaComponents extends sfComponents{

	public function executeBread(){

	}

	public function executeEditBread(){
		$this->temafattura = TemaFatturaPeer::retrieveByPK($this->getRequestParameter('id'));
	}

	public function executeCreateBread(){

	}
}
?>