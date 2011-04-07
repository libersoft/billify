<?php
include_once(dirname(__FILE__).'/../bootstrap/unit.php');

$test = new lime_test(20, new lime_output_color());

$a1 = new Acquisto();
$a1->setData(strtotime('-3 days'));;
$a1->setImponibile(1000);

$a2 = new Acquisto();
$a2->setData(strtotime('-2 days'));;
$a2->setImponibile(1000);

$a3 = new Acquisto();
$a3->setData(strtotime('-1 days'));;
$a3->setImponibile(1000);

$cf = CashFlow::getInstance();
$cf->addOutcoming(new CashFlowPurchaseAdapter($a1));
$cf->addOutcoming(new CashFlowPurchaseAdapter($a2));
$cf->addOutcoming(new CashFlowPurchaseAdapter($a3));

$test->is($cf->getBalance(), '-3000', '->getBalance() return right balance');
$test->is($cf->getIncoming(), '0', '->getIncoming() return right incoming');
$test->is($cf->getOutcoming(), '3000', '->getOutcoming() return right outcoming');

$a1 = new Acquisto();
$a1->setData(strtotime('-3 days'));;
$a1->setImponibile(2000);
$a1->setImposte(200);

$cf = CashFlow::getInstance();
$cf->reset();
$cf->addOutcoming(new CashFlowPurchaseAdapter($a1));

$test->is($cf->getBalance(), '-2200', '->getBalance() return right balance');
$test->is($cf->getIncoming(), '0', '->getIncoming() return right incoming');
$test->is($cf->getOutcoming(), '2200', '->getOutcoming() return right outcoming');

$cf = CashFlow::getInstance();
$cf->reset();
$cf->setWithTaxes(false);
$cf->addOutcoming(new CashFlowPurchaseAdapter($a1));

$test->is($cf->getBalance(), '-2000', '->getBalance() return right balance');
$test->is($cf->getIncoming(), '0', '->getIncoming() return right incoming');
$test->is($cf->getOutcoming(), '2000', '->getOutcoming() return right outcoming');

$cf = CashFlow::getInstance();
$cf->reset();

$dettaglio = new DettagliFattura();
$dettaglio->setPrezzo(1000);
$dettaglio->setQty(2);
$dettaglio->setIva(20);

$v1 = new Vendita();
$v1->addDettagliFattura($dettaglio);
$v1->setData(strtotime('-3 days'));
$v1->calcolaFattura();

$cf->addIncoming(new CashFlowSalesAdapter($v1));

$test->is($cf->getBalance(), '2400', '->getBalance() return right balance');
$test->is($cf->getIncoming(), '2400', '->getIncoming() return right incoming');
$test->is($cf->getOutcoming(), '0', '->getOutcoming() return right outcoming');

$cf = CashFlow::getInstance();
$cf->reset();

$cf->setWithTaxes(false);
$cf->addIncoming(new CashFlowSalesAdapter($v1));
$cf->addOutcoming(new CashFlowPurchaseAdapter($a1));

$test->is('0', $cf->getBalance(), '->getBalance() return right balance');
$test->is('2000', $cf->getIncoming(), '->getIncoming() return right incoming');
$test->is('2000', $cf->getOutcoming(), '->getOutcoming() return right outcoming');

$test->is('400', $cf->getIncomingTaxes(), '->getOutcomingTaxes() return right incoming taxes');
$test->is('200', $cf->getOutcomingTaxes(), '->getIncomingTaxes() return right incoming taxes');

$start_time = microtime();
$test->is('-200', $cf->getBalanceTaxes(), '->getBalance() return right balance');
$end_time = microtime();

$no_cached_time = $end_time - $start_time;

$start_time = microtime();
$test->is('-200', $cf->getBalanceTaxes(), '->getBalance() return right balance');
$end_time = microtime();

$cached_time = $end_time - $start_time;

$test->ok($cached_time < $no_cached_time, 'Cached time is less than no cached time');