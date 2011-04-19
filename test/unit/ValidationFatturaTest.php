<?php
include_once(dirname(__FILE__).'/../bootstrap/unit.php');

$test = new bfTestUnit(1, new lime_output_color());
$test->loadData(__DIR__.'/../fixtures/empty.yml');

$user = $test->signin('new_user');

$fattura_acquisto = new Acquisto();
$fattura_acquisto->setNumFattura(1);
$fattura_acquisto->setData(strtotime("today"));
$fattura_acquisto->setUtente($user);
$fattura_acquisto->save();

$fattura_acquisto = new Acquisto();
$fattura_acquisto->setNumFattura(2);
$fattura_acquisto->setData(strtotime("-1 day"));
$fattura_acquisto->setUtente($user);
$fattura_acquisto->save();

$fattura = new Vendita();
$fattura->setNumFattura(1);
$fattura->setData(strtotime("today"));
$fattura->setUtente($user);

try
{
  $fattura->save();
  $test->pass('Vendita fattura successfully saved with purchase invoices with same invoice number and less date');
}
catch(Exception $e)
{
  $test->fail($e->getMessage());
}
