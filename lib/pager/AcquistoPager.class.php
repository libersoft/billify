<?php

class AcquistoPager extends FatturaPager
{
  public function __construct(sfUser $user, $request)
  {
    $this->filter = new AcquistoFormFilter();
    parent::__construct('Acquisto', $user->getSettings()->getNumFatture(), $request);
  }

  public function setCriteria($criteria)
  {
    $criteria->addAscendingOrderByColumn(FatturaPeer::DATA);
    parent::setCriteria($criteria);
  }
}

