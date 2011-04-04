<?php

/**
 * Main Actions.
 *
 * @package    billify
 * @subpackage main
 * @author     Francesco Trucchia
 * @version    SVN: $Id$
 */
class mainActions extends sfActions
{
  
  public function executeIndex()
  {
    $this->getUser()->setCulture('it_IT');

    $this->invoice_repository = VenditaPeer::getInstance();

    $this->invoice_repository->fattureDaIncassare();
    $this->invoice_repository->fattureDaInviare();

  }

  public function executeUpdateProfile()
  {
    if($this->hasRequestParameter('noview'))
    {
      $this->getResponse()->setCookie('updateProfile', 'noview');
      return $this->redirect($this->getRequestParameter('referrer'));
    }
    return sfView::NONE;
  }
}