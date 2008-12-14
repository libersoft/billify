<?php

/**
 * api actions.
 *
 * @package    sf_sandbox
 * @subpackage api
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class apiActions extends sfActions
{
  public function preExecute(){
    $this->setLayout(false);
  }
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('default', 'module');
  }
  
  public function executeCustomer(){
    
    if(!$this->auth($this->getRequestParameter('key'))){
      return sfView::ERROR;
    }
  	
    if($this->hasRequestParameter('id')){
      $this->customer = ClientePeer::retrieveByPK($this->getRequestParameter('id'));
    }else{
      $c = new Criteria();
      $c->add(ClientePeer::RAGIONE_SOCIALE, '%'.$this->getRequestParameter('code').'%', Criteria::LIKE);
      $this->customer = ClientePeer::doSelectOne($c);
    }
    
    if(!$this->customer){
      return sfView::ERROR;
    }
  }
  
  private function auth($key){
    $criteria = new Criteria();
  	$criteria->add(InvitationCodePeer::CODICE, '%'.$key.'%', Criteria::LIKE);
  	$criteria->addJoin(InvitationCodePeer::ID, UtentePeer::ID_INVITATION_CODE );
  	$utente = UtentePeer::doSelect($criteria);
  	
  	if($utente[0]){
  	  $this->getUser()->setAttribute('id_utente', $utente[0]->getId());
      return true;
  	}else{
  	  return false;
  	}
  }
  
}
