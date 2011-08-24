<?php

class ImpostazionePeer extends BaseImpostazionePeer
{
  static $available_decorator_classes = array(
      'plain' => 'PlainInvoiceDecorator',
      'number_and_year' => 'NumberAndYearInvoiceDecorator',
  );

  static $available_decorator_classes_text = array(
      'plain' => 'Plain number',
      'number_and_year' => 'Number and year',
  );
  
  public static function retrieveByIdUtente($id_utente)
  {
    $criteria = new Criteria();
    $criteria->add(ImpostazionePeer::ID_UTENTE, $id_utente);
    
    return ImpostazionePeer::doSelectOne($criteria);
  }
}
