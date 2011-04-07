<?php

class CodiceIvaPeer extends BaseCodiceIvaPeer
{
  public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
  {
    $criteria->add(self::ID_UTENTE, FatturaPeer::$user_id);
    return parent::doSelectStmt($criteria, $con);
  }

  public static function inserisciDefault($id_utente)
  {
    $con = Propel::getConnection();
    $query = 'SELECT *
    FROM ' . CodiceIvaPeer::TABLE_NAME . '
    WHERE ' . CodiceIvaPeer::ID_UTENTE . ' IS NULL';

    $stmt = $con->prepare($query);
    $rs = $stmt->execute();

    while ($rs->next())
    {
      $codice_iva = new CodiceIva();
      $codice_iva->setIdUtente($id_utente);
      $codice_iva->setNome($rs->get('nome'));
      $codice_iva->setValore($rs->get('valore'));
      $codice_iva->setDescrizione($rs->get('descrizione'));
      $codice_iva->save();
    }
  }

}