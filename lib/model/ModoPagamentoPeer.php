<?php

class ModoPagamentoPeer extends BaseModoPagamentoPeer
{
  public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
  {
    $criteria->addAscendingOrderByColumn(ModoPagamentoPeer::DESCRIZIONE);
    $criteria->add(self::ID_UTENTE, FatturaPeer::$user_id);
    return parent::doSelectStmt($criteria, $con);
  }

  public static function inserisciDefault($id_utente)
  {

    $con = Propel::getConnection();
    $query = '
    SELECT * 
   	FROM ' . ModoPagamentoPeer::TABLE_NAME . '
    WHERE ' . ModoPagamentoPeer::ID_UTENTE . ' IS NULL';

    $stmt = $con->prepare($query);
    $rs = $stmt->execute();

    while ($rs->next())
    {
      $modo_pagamento = new ModoPagamento();
      $modo_pagamento->setIdUtente($id_utente);
      $modo_pagamento->setNumGiorni($rs->get('num_giorni'));
      $modo_pagamento->setDescrizione($rs->get('descrizione'));
      $modo_pagamento->save();
    }
  }
}
