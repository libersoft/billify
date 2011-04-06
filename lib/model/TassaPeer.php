<?php

class TassaPeer extends BaseTassaPeer
{
  public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
  {
    $criteria->add(self::ID_UTENTE, FatturaPeer::$user_id);
    return parent::doSelectStmt($criteria, $con);
  }
}
