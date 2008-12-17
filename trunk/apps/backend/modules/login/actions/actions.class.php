<?php
include_once('propel/util/Criteria.php');
/**
 * login actions.
 *
 * @package    phpmyinvoice
 * @subpackage login
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 500 2006-01-23 09:15:57Z fabien $
 */
class loginActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
  	$this->getResponse()->addStylesheet('../sf/css/sf_admin/main.css');
  }

  public function executeSecure()
  {
  	$this->forward('login','logout');
  }
  
  public function executeLogin()
  {
  	$criteria = new Criteria();
  	$criteria->add(UtentePeer::USERNAME, $this->getRequestParameter('login'));
  	$criteria->add(UtentePeer::PASSWORD , md5($this->getRequestParameter('password')));
  	
  	$utente = UtentePeer::doSelectOne($criteria);
  	
  	if (!is_null($utente) && $this->getRequestParameter('login') == 'admin')
  	{
  		$this->getUser()->setAuthenticated(true);
  		$this->getUser()->setAttribute('id_utente',$utente->getId());
  		$this->getUser()->setAttribute('nome',$utente->getNome());
  		$this->getUser()->setAttribute('cognome',$utente->getCognome());
  		$this->getUser()->setAttribute('tipo_utente',$utente->getTipo());
  		$this->getUser()->addCredential('admin');
  		return $this->redirect('utente');
  	}
  	else
  	{
  		$this->getRequest()->setError('login', 'incorrect entry');
  		return $this->forward('login', 'index');
  	}
  }

  public function executeLogout()
  {
  	$this->getUser()->getAttributeHolder()->remove('id_utente');
  	$this->getUser()->getAttributeHolder()->remove('nome');
  	$this->getUser()->getAttributeHolder()->remove('cognome');
  	$this->getUser()->getAttributeHolder()->remove('tipo');
  	$this->getUser()->getAttributeHolder()->remove('impostazioni');
  	$this->getUser()->getAttributeHolder()->remove('modifica_data');
  	$this->getUser()->getAttributeHolder()->remove('modifica_num_fattura');
  	$this->getUser()->getAttributeHolder()->remove('anno');
  	$this->getUser()->getAttributeHolder()->remove('stato');
  	$this->getUser()->getAttributeHolder()->remove('trimestre');
  	$this->getUser()->getAttributeHolder()->remove('tipo');
  	$this->getUser()->getAttributeHolder()->remove('success');
  	$this->getUser()->getAttributeHolder()->remove('cliente');
  	$this->getUser()->getAttributeHolder()->remove('conta_dettagli');
  	$this->getUser()->getAttributeHolder()->remove('dettagli_in_modifica');
  	$this->getUser()->clearCredentials();
  	$this->getUser()->setAuthenticated(false);
  	return $this->redirect('main/index');
  }
}

?>
