<?php

class AcquistoCriteria extends Criteria
{
  public function  __construct($dbName = null)
  {
    parent::__construct($dbName);
    $this->add(FatturaPeer::CLASS_KEY, FatturaPeer::CLASSKEY_ACQUISTO );
  }
}

