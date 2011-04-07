<?php

include_once(dirname(__FILE__).'/../bootstrap/unit.php');

$test = new bfTestUnit(2, new lime_output_color());

$validator = new ValidatorPaidInvoce();

$values = array(
    array('stato' => Acquisto::PAGATA),
    array('stato' => Acquisto::PAGATA, 'data_stato' => array('year' => '', 'month' => '', 'day' => '')),
);

foreach ($values as $value)
{
  try
  {
    $validator->clean($value);
    $test->fail('No exception thrown');
  }
  catch(sfValidatorErrorSchema $e)
  {
    $test->pass('Exception thrwon with data '.print_r($value, true));
  }
}

