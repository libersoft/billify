<?php
include_once(dirname(__FILE__).'/../bootstrap/unit.php');

$test = new bfTestUnit(4, new lime_output_color());
$test->loadData();
$test->signin('user');


$fatturato = VenditaPeer::getFatturato('2011');

$test->is($fatturato[0], 17280, '->getFatturato returns right fatturato annuo');
$test->is($fatturato[1], 12000, '->getFatturato returns right fatturato annuo netto');
$test->is($fatturato[2], 0, '->getFatturato returns right ritenuta acconto');
$test->is($fatturato[3], 2400, '->getFatturato returns right inps');
