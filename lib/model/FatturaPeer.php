<?php
/**
 * Skeleton subclass for performing query and update operations on the 'fattura' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */
class FatturaPeer extends BaseFatturaPeer
{
  const NUM_BLOCCO_FATTURE = 10;

  static $instance;
  static $user_id;
  
  public static function doSelectRS(Criteria $criteria, $conn = null)
  {
    if(sfConfig::get('sf_app')!='backend')
    {
      $criteria->add(FatturaPeer::ID_UTENTE, self::$user_id);
    }
    
    return parent::doSelectStmt($criteria);
  }
  
  

  public static function doSelectForCashFlow($document_date = null)
  {
    $criteria = new Criteria();

    if (!is_null($document_date))
    {
      $from = implode('/', array_reverse($document_date['from']));
      $to = implode('/', array_reverse($document_date['to']));
      $criteria->add(FatturaPeer::DATA_SCADENZA, $from, Criteria::GREATER_EQUAL);
      $criteria->addAnd(FatturaPeer::DATA_SCADENZA, $to, Criteria::LESS_EQUAL);
    }

    $criteria->addAscendingOrderByColumn(FatturaPeer::DATA_SCADENZA);
    return FatturaPeer::doSelect($criteria);
  }
  
} // FatturaPeer
