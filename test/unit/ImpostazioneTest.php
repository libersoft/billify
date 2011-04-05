<?php

include_once(dirname(__FILE__).'/../bootstrap/unit.php');

$test = new lime_test(3, new lime_output_color());

$settings = new Impostazione();
$invoice = new Vendita();

try
{
  $message = 'Catch the right exception with invalid decorator type';
  $settings->setInvoiceDecoratorType('test');
  $test->fail($message);
}
catch(Exception $e)
{
  $test->pass($message);
}

$settings->setInvoiceDecoratorType('plain');
$test->isa_ok($settings->getInvoiceDecorator($invoice), 'PlainInvoiceDecorator', '->getInvoiceDecorator() returns the right value');

$settings->setInvoiceDecoratorType('number_and_year');
$test->isa_ok($settings->getInvoiceDecorator($invoice), 'NumberAndYearInvoiceDecorator', '->getInvoiceDecorator() returns the right value');