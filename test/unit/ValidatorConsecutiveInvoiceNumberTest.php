<?php

include_once(dirname(__FILE__).'/../bootstrap/unit.php');

$test = new bfTestUnit(7, new lime_output_color());

$validator = new ValidatorConsecutiveInvoiceNumber(array('latest' => 10, 'is_new' => true));

$values = array('pippo', '', '0', '10', '5', '12', '20');

foreach($values as $value)
{
  try
  {
    $message = 'Invalid consecutive number';
    $validator->clean('0');
    $test->fail($value);
  }
  catch(sfValidatorError $e)
  {
    $test->pass($message);
  }
}

$validator->clean('11');

$validator = new ValidatorConsecutiveInvoiceNumber(array('latest' => false));
$validator->clean('2');

$validator = new ValidatorConsecutiveInvoiceNumber(array('latest' => 10, 'is_new' => false));
$validator->clean('2');