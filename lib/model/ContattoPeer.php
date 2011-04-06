<?php

class ContattoPeer extends BaseContattoPeer
{
  public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
  {
    $criteria->add(self::ID_UTENTE, FatturaPeer::$user_id);
    return parent::doSelectStmt($criteria, $con);
  }

  public static function doSelectClienti()
  {
    return ClientePeer::doSelect(new Criteria());
  }
}
