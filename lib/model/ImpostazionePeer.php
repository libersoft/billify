<?php

class ImpostazionePeer extends BaseImpostazionePeer
{
  static $available_decorator_classes = array(
      'plain' => 'PlainInvoiceDecorator',
      'number_and_year' => 'NumberAndYearInvoiceDecorator',
  );
}
