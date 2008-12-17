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
  public function preExecute(){
  	if(!$this->getUser()->isAuthenticated())
  		$this->getUser()->setCulture('it');
  }
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {

  }

  public function executeLogin()
  {
  	$criteria = new Criteria();
  	$criteria->add(UtentePeer::USERNAME, $this->getRequestParameter('login'));
  	$criteria->add(UtentePeer::PASSWORD , md5($this->getRequestParameter('password')));

  	$utente = UtentePeer::doSelectOne($criteria);

  	if (!is_null($utente) && $utente->getStato() != 'disattivo')
  	{
  		$this->getUser()->setAuthenticated(true);
  		$this->getUser()->setAttribute('id_utente',$utente->getId());
  		$this->getUser()->setAttribute('nome',$utente->getNome());
  		$this->getUser()->setAttribute('cognome',$utente->getCognome());
  		$this->getUser()->setAttribute('tipo_utente',$utente->getTipo());

  		if($utente->getUsername() == 'admin'){
  			$this->getUser()->addCredential('admin');
  			//$this->getUser()->addCredential('attivo');
  		}//elseif((!$utente->checkRinnovo() && !$utente->checkDemo()) or in_array($utente->getId(),explode(',',sfConfig::get('app_account_gratis')))){
  			$this->getUser()->addCredential('attivo');
  		//}

  		$utente->setLastlogin(time());
  		$utente->save();

  		return $this->redirect('main/index');
  	}
  	else
  	{
  		if(!is_null($utente) && $utente->getStato() == 'disattivo')
  			$this->getRequest()->setError('login', 'Utente bloccato - <a href="mailto:pim@trucchia.info">Contatta lo staff</a>');
  		else
  			$this->getRequest()->setError('login', 'Identificazione fallita - riprova');

  		return $this->forward('sito','index');
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
  	return $this->redirect('login');
  }
}

?>
