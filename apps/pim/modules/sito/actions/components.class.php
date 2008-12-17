<?php

class sitoComponents extends sfComponents{
	
	public function executeAdsense(){
		if($this->getContext()->getModuleName() == 'sito' or ($this->getContext()->getModuleName() == 'login') or ($this->getContext()->getModuleName() == 'utente' and !$this->getContext()->getUser()->isAuthenticated()) or ($this->getContext()->getUser()->isAuthenticated() && !UtentePeer::checkDemo())){
			$this->getContext()->getResponse()->addStylesheet('no_adsense');
		}
	}
	
	public function executeMenu(){
		
	}
}
?>