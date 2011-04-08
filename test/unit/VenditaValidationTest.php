<?php
include_once(dirname(__FILE__).'/../bootstrap/unit.php');

$test = new bfTestUnit(31, new lime_output_color());
$test->loadData(__DIR__.'/../fixtures/empty.yml');
$user = $test->signin('new_user');

$fattura = new Vendita();
$fattura->setNumFattura('1');
$fattura->setData((date('Y')-1).'-12-19');
$user->addFattura($fattura);
$user->save();

for($i = 0; $i < 10; $i++)
{
  $days = $i*2;
  $fattura = new Vendita();
  $test->is($fattura->getNumFattura(), $i+1, '->getNumFattura() returns right value');
  $fattura->setData(strtotime("+$days days"));
  $user->addFattura($fattura);
  $user->save();
}

$fattura = new Vendita();
$user->addFattura($fattura);
$user->save();

$test->info('Numero nuova fattura');
$test->is($fattura->getNumFattura(), 11, '->getNumFattura() returns right invoice number');
$test->is($fattura->getData('d-m-Y'), date('d-m-Y', strtotime("+$days days")), '->getDate() return the right value');
$test->ok(!$fattura->isProForma(), '->isProForma() returns right value');

$test->info('Numero nuova fattura quando la trasformo da pro-forma');

$fattura = new Vendita();
$fattura->setNumFattura(0);

$user->addFattura($fattura);
$test->is($fattura->getNumFattura(), 0);
$user->save();

$test->ok($fattura->isProForma(), '->isProForma() returns right value');
$test->is($fattura->getNumFattura(), 0, '->getNumFattura() returns right invoice number');
$test->is($fattura->getData('d-m-Y'), date('d-m-Y', strtotime("+$days days")), '->getDate() return the right value');

$fattura->setData(strtotime('+1 month'));
$fattura->save();
$test->is($fattura->getData('d-m-Y'), date('d-m-Y', strtotime("+1 month")), '->getDate() return the right value');

$fattura->setNewNumFattura();
$fattura->save();
$test->ok(!$fattura->isProForma(), '->isProForma() returns right value');
$test->is($fattura->getData('d-m-Y'), date('d-m-Y', strtotime("+$days days")), '->getDate() return the right value');

$test->info('Validazione modifica numero fattura');

try
{
  $message = 'Impossible to save an invoice with a duplicated invoice number';
  $fattura->setNumFattura(1);
  $fattura->save();
  $test->fail($message);
}
catch(Exception $e)
{
  $test->pass($message);
}

$test->todo('Validazione modifica data fattura');

$fattura->setNewNumFattura();

try
{
  $message = 'Impossible to save an invoice with a date in the past where there are other invoices';
  $fattura->setData(strtotime('+3 days'));
  $fattura->save();
  $test->fail($message);
}
catch(Exception $e)
{
  $test->pass($message);
}

try
{
  $message = 'Impossible to save an invoice with a date in the past where there are other invoices';
  $fattura->setData(strtotime('+4 days'));
  $fattura->save();
  $test->fail($message);
}
catch(Exception $e)
{
  $test->pass($message);
}

$fattura->setData(strtotime('+100 days'));
$fattura->save();

$criteria = new Criteria();
$criteria->add(FatturaPeer::NUM_FATTURA, '4');
$fattura = FatturaPeer::doSelectOne($criteria);

try
{
  $message = 'Impossible to move an exisistance invoice';
  $fattura->setData(strtotime('+100 days'));
  $fattura->save();
  $test->fail($message);
}
catch(Exception $e)
{
  $test->pass($message);
}

try
{
  $message = 'Impossible to move an exisistance invoice';
  $fattura->setData(strtotime('-30 days'));
  $fattura->save();
  $test->fail($message);
  
}
catch(Exception $e)
{
  $test->pass($message);
}

try
{
  $message = 'Impossible to move an exisistance invoice';
  $fattura->setData(strtotime('-1 day'));
  $fattura->save();
  $test->fail($message);
}
catch(Exception $e)
{
  $test->pass($message);
}

$fattura->setData((date('Y')-1).'-12-19');
$fattura->setNewNumFattura();
$fattura->save();

$test->is($fattura->getNumFattura(), '2', '->getNumFattura() returns right value');

try
{
  $message = 'Impossible to move an exisistance invoice';
  $fattura->setData((date('Y')-1).'-12-18');
  $fattura->save();
  $test->fail($message);
}
catch(Exception $e)
{
  $test->pass($message);
}

try
{
  $message = 'Impossible to move an exisistance invoice';
  $fattura->setNewNumFattura();
  $fattura->setData((date('Y')-1).'-11-18');
  $fattura->save();
  $test->fail($message);
}
catch(Exception $e)
{
  $test->pass($message);
}

$user->clearFatturas();

try
{
  $message = 'Impossible to add a number greater than latest invoice';
  $fattura = new Vendita();
  $fattura->setNumFattura('1000');
  $user->addFattura($fattura);
  $user->save();
  $test->fail($message);
}
catch(Exception $e)
{
  $test->pass($message);
}

$test->loadData(__DIR__.'/../fixtures/companies/srl.yml');
$test->signin('user', 'user');

$criteria = new Criteria();
$criteria->add(FatturaPeer::NUM_FATTURA, '1');
$fattura = VenditaPeer::doSelectOne($criteria);

$fattura->save();