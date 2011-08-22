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
    $this->fatture_da_incassare = VenditaPeer::getFattureDaIncassare();
    $this->fatture_da_inviare = VenditaPeer::getFattureDaInviare();
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