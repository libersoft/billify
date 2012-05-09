<?php

class ContattoPeer extends BaseContattoPeer
{
  public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
  {
    $criteria->add(self::ID_UTENTE, FatturaPeer::$user_id);
    return parent::doSelectStmt($criteria, $con);
  }

  public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
  {
    $criteria->add(self::ID_UTENTE, FatturaPeer::$user_id);
    return parent::doCount($criteria, $distinct, $con);
  }

  public static function doSelectClienti()
  {
    $c = new Criteria();
    $c->addAscendingOrderByColumn(ContattoPeer::RAGIONE_SOCIALE);
    return ClientePeer::doSelect($c);
  }
}
