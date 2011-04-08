<?php

include_once(dirname(__FILE__).'/../bootstrap/unit.php');

$test = new bfTestUnit(3, new lime_output_color());
$test->loadData();
$user = $test->signin('user');

$validator = new ValidatorDateInvoice();

try
{
  $message = 'Invalid invoice date';
  $validator->clean(array('num_fattura' => '3', 'data' => date('Y-m-d', strtotime('today')), 'anno' => date('Y')));
  $test->fail($message);
}
catch(sfValidatorError $e)
{
  $test->pass($message);
}

try
{
  $message = 'Invalid invoice date';
  $validator->clean(array('num_fattura' => '3', 'data' => date('Y-m-d', strtotime('tomorrow')), 'anno' => date('Y')));
  $test->fail($message);
}
catch(sfValidatorError $e)
{
  $test->pass($message);
}

$validator->clean(array('num_fattura' => '3', 'data' => date('Y-m-d', strtotime('+3 days')), 'anno' => date('Y')));
$validator->clean(array('num_fattura' => '3', 'data' => date('Y-m-d', strtotime('+4 days')), 'anno' => date('Y')));

try
{
  $message = 'Invalid invoice date';
  $validator->clean(array('num_fattura' => '3', 'data' => date('Y-m-d', strtotime('+5 days')), 'anno' => date('Y')));
  $test->fail($message);
}
catch(sfValidatorError $e)
{
  $test->pass($message);
}
