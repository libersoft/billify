<?php
include_once(dirname(__FILE__).'/../bootstrap/unit.php');
include_once(dirname(__FILE__).'/../../lib/adapter/ICashFlowAdapter.class.php');
include_once(dirname(__FILE__).'/../../lib/adapter/AbstractCashFlowAdapter.class.php');
include_once(dirname(__FILE__).'/../../lib/adapter/CashFlowPurchaseAdapter.class.php');

$test = new lime_test(10, new lime_output_color());

$a1 = new Acquisto();
$a1->setId(100);
$a1->setImponibile(1000);
$a1->setImposte(200);
$a1->setData(strtotime('-3 days'));
$a1->setNumFattura('100');

$cliente = new Fornitore();
$cliente->setId(100);
$cliente->setRagioneSociale('Provider');
$cliente->setAzienda('s');

$a1->setCliente($cliente);

$acf1 = new CashFlowPurchaseAdapter($a1);
$test->is($acf1 instanceof ICashFlowAdapter, true, '->__construct() return an instance of ICashFlowAdapter');
$test->is($acf1->getDate(), date('Y-m-d', strtotime('-3 days')), '->getDate() return right date');
$test->is($acf1->getDescription(), 'Fattura n. 100', '->getDescription() return right description');
$test->is($acf1->getTaxable(), '1000', '->getTaxable() return right taxable value');
$test->is($acf1->getTaxes(), '200', '->getTaxes() return right taxes value');
$test->is($acf1->getTotal(), '1200', '->getTotal() return right total value');
$test->is($acf1->getContact(), 'Provider', '->getTotal() return right total value');
$test->is($acf1->getContactUrl(), 'contact/edit?id=100', '->getTotal() return right total value');
$test->is($acf1->isPaid(), false, '->getTotal() return right total value');
$test->is($acf1->getDocumentUrl(), 'invoice/edit?id=100', '->getTotal() return right total value');

?>