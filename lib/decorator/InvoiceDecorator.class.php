<?php

abstract class InvoiceDecorator
{
  protected $invoice;

  public function  __construct(Vendita $invoice)
  {
    $this->invoice = $invoice;
  }
}
