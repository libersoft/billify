<?php

class ValidatorPaidInvoce extends sfValidatorSchema
{
  protected function configure($options = array(), $messages = array())
  {
    $this->setMessage('required', 'You have to specify a data when marking an invoice as paid.');

    parent::configure($options, $messages);
  }

  protected function hasDataStato($values)
  {
    return isset($values['data_stato']) &&
           $values['data_stato']['year'] != '' &&
           $values['data_stato']['month'] != '' &&
           $values['data_stato']['day'] != '';
  }

  public function isPagata($values)
  {
    return isset($values['stato']) && $values['stato'] == Acquisto::PAGATA;
  }

  /**
   * @see sfValidatorBase
   */
  protected function doClean($values)
  {
    if ($this->isPagata($values) && !$this->hasDataStato($values))
    {
      throw new sfValidatorErrorSchema($this, array('data_stato' => new sfValidatorError($this, 'required', array())));
    }

    return $values;
  }
}