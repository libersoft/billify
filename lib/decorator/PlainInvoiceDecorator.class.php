<?php

class PlainInvoiceDecorator extends InvoiceDecorator
{
  public function getNumFattura()
  {
    return $this->invoice->getPlainNumFattura();
  }
}
