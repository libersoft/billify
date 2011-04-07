<?php

class TemaFatturaPeer extends BaseTemaFatturaPeer
{
  public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
  {
    $criteria->add(self::ID_UTENTE, FatturaPeer::$user_id);
    return parent::doSelectStmt($criteria, $con);
  }

  public static function createDefault($id_utente)
  {

    $tema_fattura = new TemaFattura();
    $tema_fattura->setNome('Default');
    $tema_fattura->setIdUtente($id_utente);
    $tema_fattura->setTemplate(file_get_contents(sfConfig::get('sf_data_dir') . DIRECTORY_SEPARATOR . 'template_fattura' . DIRECTORY_SEPARATOR . 'template.htm'));
    $tema_fattura->setCss(file_get_contents(sfConfig::get('sf_data_dir') . DIRECTORY_SEPARATOR . 'template_fattura' . DIRECTORY_SEPARATOR . 'stile.css'));
    $tema_fattura->save();
  }
}
