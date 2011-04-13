<?php
include_once(dirname(__FILE__).'/../bootstrap/unit.php');

$test = new bfTestUnit(11, new lime_output_color());
$test->loadData();
$test->signin('user');

$request = new sfWebRequest(new sfEventDispatcher());
$pager = new VenditaPager($test->getContext()->getUser(), $request);

$test->ok($pager instanceof sfPropelPager, '->__construct() instance the right class');
$test->can_ok($pager, 'filter', '->filter() method exists');
$test->can_ok($pager, 'init', '->init() method exists');

$pager->filter();
$pager->init();

$test->ok($pager->haveToPaginate(), '->haveToPaginate() is true');
$test->is('Vendita', $pager->getClass(),'->getClass() returns Vendita');
$test->is($pager->getMaxPerPage(), $test->getContext()->getUser()->getSettings()->getNumFatture(), '->getMaxPerPage() returns right value');
$test->is($pager->getPage(), 1, '->getPage() returns right value');
$test->is($pager->getNextPage(), 2, '->getNextPage() returns right value');
$test->is($pager->count(), 29, '->getNextPage() returns right value');


$request->addRequestParameters(array('fattura_filters' => array('cliente_id' => '01')));

$pager->filter();
$pager->init();

$test->ok(!$pager->haveToPaginate(), '->haveToPaginate() is false');
$test->is($pager->count(), 19, '->count() returns right value');


