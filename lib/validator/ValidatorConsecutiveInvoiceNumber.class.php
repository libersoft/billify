<?php

class ValidatorConsecutiveInvoiceNumber extends sfValidatorBase
{
  protected function configure($options = array(), $messages = array())
  {
    $this->addOption('latest');
    $this->addOption('is_new');
    $this->setMessage('invalid', '"%value%" is not consecutive to latest.');

    $this->setOption('latest', 0);
    $this->setOption('is_new', true);
  }

  public function doClean($value)
  {
    $range = (int)$value - $this->getOption('latest');

    if ($this->getOption('is_new') && $this->getOption('latest') && $range != 1)
    {
      throw new sfValidatorError($this, 'invalid', array('value' => $value));
    }
  }
}

