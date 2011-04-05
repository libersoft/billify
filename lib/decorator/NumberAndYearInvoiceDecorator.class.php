<?php

class NumberAndYearInvoiceDecorator extends InvoiceDecorator
{
  public function getNumFattura()
  {
    return str_pad($this->invoice->getPlainNumFattura(), 3, 0, STR_PAD_LEFT).'-'.$this->invoice->getData('Y');
  }
}
