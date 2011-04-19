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
    $criteria = new Criteria();
    $criteria->addAsColumn('integer_num_fattura', 'CONVERT('.FatturaPeer::NUM_FATTURA.', signed)');
    $criteria->addAscendingOrderByColumn('YEAR(data)');
    $criteria->addAscendingOrderByColumn('integer_num_fattura');
    $criteria->add(FatturaPeer::STATO, Vendita::INVIATA);

    $this->fatture_da_incassare = VenditaPeer::doSelectJoinAllExceptModoPagamento($criteria);

    $criteria->add(FatturaPeer::STATO, Vendita::NON_PAGATA);
    $this->fatture_da_inviare = VenditaPeer::doSelectJoinAllExceptModoPagamento($criteria);

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