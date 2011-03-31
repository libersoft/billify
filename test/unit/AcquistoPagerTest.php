<?php
include_once(dirname(__FILE__).'/../bootstrap/unit.php');

$test = new bfTestUnit(11, new lime_output_color());
$test->loadData();
$test->signin('user');

$request = new sfWebRequest(new sfEventDispatcher());
$pager = new AcquistoPager($test->getContext()->getUser(), $request);

$test->ok($pager instanceof sfPropelPager, '->__construct() instance the right class');
$test->can_ok($pager, 'filter', '->filter() method exists');
$test->can_ok($pager, 'init', '->init() method exists');

$pager->filter();
$pager->init();

$test->ok(!$pager->haveToPaginate(), '->haveToPaginate() is false');
$test->is('Acquisto', $pager->getClass(),'->getClass() returns Vendita');
$test->is($pager->getMaxPerPage(), $test->getContext()->getUser()->getSettings()->getNumFatture(), '->getMaxPerPage() returns right value');
$test->is($pager->getPage(), 1, '->getPage() returns right value');
$test->is($pager->getNextPage(), 1, '->getNextPage() returns right value');
$test->is($pager->count(), 9, '->getNextPage() returns right value');

$filters = array();
$filters['data']['from']['day'] = '';
$filters['data']['from']['month'] = '';
$filters['data']['from']['year'] = '';
$filters['data']['to']['day'] = '';
$filters['data']['to']['month'] = '';
$filters['data']['to']['year'] = '';

$request->addRequestParameters(array('fattura_filters' => $filters));

$pager->filter();
$pager->init();

$test->ok($pager->haveToPaginate(), '->haveToPaginate() is true');
$test->is($pager->count(), 28, '->count() returns right value');


