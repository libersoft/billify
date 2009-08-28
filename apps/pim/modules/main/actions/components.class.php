<?php

class mainComponents extends sfComponents{

	public function executeSideBar(){

	}

	public function executeBread(){

	}

	public function executeDemoScaduto(){

	}

	public function executeBreadRiepilogo(){

	}

	public function executeUpdateProfile(){

		if(sfContext::getInstance()->getRequest()->getCookie('updateProfile') != 'noview'){
			$this->utente = UtentePeer::retrieveByPK(sfContext::getInstance()->getUser()->getAttribute('id_utente'));
			$this->numTasse = TassaPeer::doCount(new Criteria());
			$this->tema = TemaFatturaPeer::doCount(new Criteria());
			$this->banca = BancaPeer::doCount(new Criteria());

			if($this->utente->getRagioneSociale() != '' && $this->utente->getPartitaIva() != '' && $this->utente->getCodiceFiscale() != '' && $this->numTasse > 0 && $this->tema > 0 && $this->banca > 0)
				sfContext::getInstance()->getResponse()->setCookie('updateProfile','noview');
		}
	}
}
?>