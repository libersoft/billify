<?php
include_once(dirname(__FILE__).'/../bootstrap/unit.php');
include_once(dirname(__FILE__).'/../../lib/adapter/ICashFlowAdapter.class.php');
include_once(dirname(__FILE__).'/../../lib/adapter/CashFlowAcquistoAdapter.class.php');
include_once(dirname(__FILE__).'/../../lib/adapter/CashFlowVenditaAdapter.class.php');
include_once(dirname(__FILE__).'/../../lib/CashFlow.class.php');

$test = new lime_test(12, new lime_output_color());

$a1 = new Acquisto();
$a1->setData(strtotime('-3 days'));;
$a1->setImponibile(1000);

$a2 = new Acquisto();
$a2->setData(strtotime('-2 days'));;
$a2->setImponibile(1000);

$a3 = new Acquisto();
$a3->setData(strtotime('-1 days'));;
$a3->setImponibile(1000);

$cf = new CashFlow();
$cf->addOutcoming(new CashFlowAcquistoAdapter($a1));
$cf->addOutcoming(new CashFlowAcquistoAdapter($a2));
$cf->addOutcoming(new CashFlowAcquistoAdapter($a3));

$test->diag('->getBalance()');
$test->is($cf->getBalance(), '-3000', '->getBalance() return right balance');
$test->diag('->getIncoming()');
$test->is($cf->getIncoming(), '0', '->getIncoming() return right incoming');
$test->diag('->getOutcoming()');
$test->is($cf->getOutcoming(), '3000', '->getOutcoming() return right outcoming');

$a1 = new Acquisto();
$a1->setData(strtotime('-3 days'));;
$a1->setImponibile(2000);
$a1->setImposte(200);

$cf = new CashFlow();
$cf->withImposte();

$cf->addOutcoming(new CashFlowAcquistoAdapter($a1));

$test->diag('->getBalance()');
$test->is($cf->getBalance(), '-2200', '->getBalance() return right balance');
$test->diag('->getIncoming()');
$test->is($cf->getIncoming(), '0', '->getIncoming() return right incoming');
$test->diag('->getOutcoming()');
$test->is($cf->getOutcoming(), '2200', '->getOutcoming() return right outcoming');

$cf->withoutImposte();

$test->diag('->getBalance()');
$test->is($cf->getBalance(), '-2000', '->getBalance() return right balance');
$test->diag('->getIncoming()');
$test->is($cf->getIncoming(), '0', '->getIncoming() return right incoming');
$test->diag('->getOutcoming()');
$test->is($cf->getOutcoming(), '2000', '->getOutcoming() return right outcoming');

$cf = new CashFlow();
$cf->withImposte();

$dettaglio = new DettagliFattura();
$dettaglio->setPrezzo(1000);
$dettaglio->setQty(2);
$dettaglio->setIva(20);

$v1 = new Vendita();
$v1->addDettagliFattura($dettaglio);
$v1->setData(strtotime('-3 days'));
$v1->calcolaFattura();

$cf->addIncoming(new CashFlowVenditaAdapter($v1));

$test->diag('->getBalance()');
$test->is($cf->getBalance(), '2400', '->getBalance() return right balance');
$test->diag('->getIncoming()');
$test->is($cf->getIncoming(), '2400', '->getIncoming() return right incoming');
$test->diag('->getOutcoming()');
$test->is($cf->getOutcoming(), '0', '->getOutcoming() return right outcoming');

?>