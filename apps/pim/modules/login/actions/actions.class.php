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

  public function preExecute()
  {
    if (!$this->getUser()->isAuthenticated())
    {
      $this->getUser()->setCulture('it');
    }
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
    $criteria->add(UtentePeer::PASSWORD, md5($this->getRequestParameter('password')));

    $utente = UtentePeer::doSelectOne($criteria);

    if (!is_null($utente) && $utente->isActive())
    {
      $this->getUser()->signin($utente);

      return $this->redirect('main/index');
    }

    $this->getUser()->setFlash('login', 'Identificazione fallita - riprova');
    return $this->redirect('login/index');
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
    return $this->redirect('login/index');
  }

}

?>
