<?php
include_once(dirname(__FILE__).'/../bootstrap/unit.php');
include_once(dirname(__FILE__).'/../../lib/adapter/ICashFlowAdapter.class.php');
include_once(dirname(__FILE__).'/../../lib/adapter/CashFlowAcquistoAdapter.class.php');

$test = new lime_test(8, new lime_output_color());

$a1 = new Acquisto();
$a1->setId(100);
$a1->setImponibile(1000);
$a1->setImposte(200);
$a1->setData(strtotime('-3 days'));
$a1->setNumFattura('100');

$acf1 = new CashFlowAcquistoAdapter($a1);

$test->comment('->__construct()');
$test->is($acf1 instanceof ICashFlowAdapter, true, '->__construct() return an instance of ICashFlowAdapter');

$test->comment('->getDate()');
$test->is($acf1->getDate(), date('Y-m-d', strtotime('-3 days')), '->getDate() return right date');

$test->comment('->getDescription()');
$test->is($acf1->getDescription(), 'Fattura N&ordm; 100', '->getDescription() return right description');

$test->comment('->getImponibile()');
$test->is($acf1->getImponibile(), '1000', '->getTotale() return right imponibile');

$test->comment('->getImposte()');
$test->is($acf1->getImposte(), '200', '->getImposte() return right imposte');

$test->comment('->getTotale()');
$test->is($acf1->getTotale(), '1200', '->getTotale() return right totale');

$test->comment('->getModelId()');
$test->is($acf1->getModelId(), '100', '->getModelId() return right model_id');

$test->comment('->getModelClass()');
$test->is($acf1->getModelClass(), 'Acquisto', '->getModel() return right model_class');

?>