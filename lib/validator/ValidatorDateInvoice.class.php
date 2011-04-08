<?php

class ValidatorDateInvoice extends sfValidatorSchema
{
  protected function doClean($values)
  {
    if (!is_array($values))
    {
      throw new InvalidArgumentException('You must pass an array parameter to the clean() method (this validator can only be used as a post validator).');
    }

    if (!isset($values['num_fattura']) || !isset($values['data']) || !isset($values['anno']))
    {
      throw new InvalidArgumentException('You must pass an array with num_fattura, data and anno key');

    }
    $criteria = new Criteria();
    $c1 = $criteria->getNewCriterion(FatturaPeer::NUM_FATTURA, $values['num_fattura']-1);
    $c2 = $criteria->getNewCriterion(FatturaPeer::DATA, $values['data'], Criteria::GREATER_THAN);

    $c1->addAnd($c2);
    $criteria->add($c1);

    $c3 = $criteria->getNewCriterion(FatturaPeer::NUM_FATTURA, $values['num_fattura']+1);
    $c4 = $criteria->getNewCriterion(FatturaPeer::DATA, $values['data'], Criteria::LESS_THAN);

    $c3->addAnd($c4);
    $criteria->addOr($c3);
    $criteria->addAnd(FatturaPeer::NUM_FATTURA, 0, Criteria::NOT_EQUAL);
    $criteria->addAnd(FatturaPeer::ANNO, $values['anno'], Criteria::EQUAL);

    //echo $criteria->toString();
    if (FatturaPeer::doCount($criteria) > 0)
    {
      throw new sfValidatorError($this, 'invalid');
    }
  }
}