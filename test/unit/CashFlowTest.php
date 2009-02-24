<?php
include_once(dirname(__FILE__).'/../bootstrap/unit.php');
include_once(dirname(__FILE__).'/../../lib/adapter/ICashFlowAdapter.class.php');
include_once(dirname(__FILE__).'/../../lib/adapter/CashFlowAcquistoAdapter.class.php');
include_once(dirname(__FILE__).'/../../lib/CashFlow.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('pim', 'dev', true);
sfContext::createInstance($configuration);

new sfDatabaseManager($configuration);

$loader = new sfPropelData();
$loader->loadData(sfConfig::get('sf_test_dir').'/fixtures');

$test = new lime_test(9, new lime_output_color());

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
$cf->addOutcoming(new CashOutcome(new CashFlowAcquistoAdapter($a1)));
$cf->addOutcoming(new CashOutcome(new CashFlowAcquistoAdapter($a2)));
$cf->addOutcoming(new CashOutcome(new CashFlowAcquistoAdapter($a3)));

$test->is($cf->getBalance(), '-3000', '->getBalance() return right balance');
$test->is($cf->getIncoming(), '0', '->getIncoming() return right incoming');
$test->is($cf->getOutcoming(), '3000', '->getOutcoming() return right outcoming');

$criteria = new Criteria();
$criteria->add(CashFlowRowPeer::DATE, strtotime('-2 days'), Criteria::GREATER_EQUAL );
$criteria->add(CashFlowRowPeer::DATE, strtotime('+2 days'), Criteria::LESS_EQUAL  );
$rows = CashFlowRowPeer::doSelect($criteria);

$cf = new CashFlow();
$cf->withImposte();

foreach ($rows as $row) {
  $cf->addRow($row);
}

$test->is($cf->getBalance(), '-3600', '->getBalance() return right balance');
$test->is($cf->getIncoming(), '0', '->getIncoming() return right incoming');
$test->is($cf->getOutcoming(), '3600', '->getOutcoming() return right outcoming');

$cf->withoutImposte();

$test->is($cf->getBalance(), '-3000', '->getBalance() return right balance');
$test->is($cf->getIncoming(), '0', '->getIncoming() return right incoming');
$test->is($cf->getOutcoming(), '3000', '->getOutcoming() return right outcoming');
?>