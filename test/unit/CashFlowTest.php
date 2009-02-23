<?php
include_once(dirname(__FILE__).'/../bootstrap/unit.php');
include_once(dirname(__FILE__).'/../../lib/adapter/ICashFlowAdapter.class.php');
include_once(dirname(__FILE__).'/../../lib/adapter/CashFlowAcquistoAdapter.class.php');
include_once(dirname(__FILE__).'/../../lib/CashFlow.class.php');

$test = new lime_test(1, new lime_output_color());

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
$cf->addRow(new CashFlowRow(new CashFlowAcquistoAdapter($a1)));
$cf->addRow(new CashFlowRow(new CashFlowAcquistoAdapter($a2)));
$cf->addRow(new CashFlowRow(new CashFlowAcquistoAdapter($a3)));

$test->is($cf->getBalance(), '-3000');


?>