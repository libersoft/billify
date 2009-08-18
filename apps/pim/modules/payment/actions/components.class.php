<?php

class paymentComponents extends paComponents
{
  public function executeEditBread()
  {
    $this->payment = ModoPagamentoPeer::retrieveByPK($this->getRequestParameter('id'));
  }
}