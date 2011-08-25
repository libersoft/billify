<?php

include_once(dirname(__FILE__).'/../bootstrap/unit.php');

$test = new bfTestUnit(3, new lime_output_color());
$test->loadData();
$user = $test->signin('user');

$validator = new ValidatorDateInvoice();

try
{
  $message = 'Invalid invoice date';
  $validator->clean(array('num_fattura' => '3', 'data' => date('Y-m-d', strtotime('first day of this month')), 'anno' => date('Y'), 'class_key' => FatturaPeer::CLASSKEY_VENDITA));
  $test->fail($message);
}
catch(sfValidatorError $e)
{
  $test->pass($message);
}

try
{
  $message = 'Invalid invoice date';
  $validator->clean(array('num_fattura' => '3', 'data' => date('Y-m-d', strtotime('+1 day', strtotime('first day of this month'))), 'anno' => date('Y'), 'class_key' => FatturaPeer::CLASSKEY_VENDITA));
  $test->fail($message);
}
catch(sfValidatorError $e)
{
  $test->pass($message);
}

$validator->clean(array('num_fattura' => '3', 'data' => date('Y-m-d', strtotime('+3 days', strtotime('first day of this month'))), 'anno' => date('Y'), 'class_key' => FatturaPeer::CLASSKEY_VENDITA));
$validator->clean(array('num_fattura' => '3', 'data' => date('Y-m-d', strtotime('+4 days', strtotime('first day of this month'))), 'anno' => date('Y'), 'class_key' => FatturaPeer::CLASSKEY_VENDITA));

try
{
  $message = 'Invalid invoice date';
  $validator->clean(array('num_fattura' => '3', 'data' => date('Y-m-d', strtotime('+5 days', strtotime('first day of this month'))), 'anno' => date('Y'), 'class_key' => FatturaPeer::CLASSKEY_VENDITA));
  $test->fail($message);
}
catch(sfValidatorError $e)
{
  $test->pass($message);
}
