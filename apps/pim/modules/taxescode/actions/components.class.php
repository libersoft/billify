<?php

class taxescodeComponents extends paComponents
{
  public function executeEditBread()
  {
    $this->taxcode = CodiceIvaPeer::retrieveByPK($this->getRequestParameter('id'));
  }
}