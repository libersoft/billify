<?php 


Class AcquistoPeer {
  private $user;

  public function __construct(sfUser $user)
  {
    $this->user = $user;
  }

  public function doSelect(Criteria $criteria = null)
	{
    if (null === $criteria)
    {
      $criteria = new Criteria();
    }
    $criteria->add(FatturaPeer::ID_UTENTE, $this->user->getAttribute('id_utente'));
    $criteria->add(FatturaPeer::CLASS_KEY, FatturaPeer::CLASSKEY_ACQUISTO);
    $criteria->addAscendingOrderByColumn(FatturaPeer::DATA);

		return FatturaPeer::doSelect($criteria);
	}
}