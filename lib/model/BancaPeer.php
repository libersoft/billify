<?php

class BancaPeer extends BaseBancaPeer
{
  public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
  {
    $criteria->add(self::ID_UTENTE, FatturaPeer::$user_id);
    return parent::doSelectStmt($criteria, $con);
  }

  public static function createDefault($id_utente)
  {
    $banca = new Banca();
    $banca->setNomeBanca('Banca Default');
    $banca->setIdUtente($id_utente);
    $banca->setAbi('0000');
    $banca->setCab('0000');
    $banca->setCin('0000');
    $banca->setNumeroConto('0000');
    $banca->save();
  }

}
