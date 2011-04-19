<?php

include_once(dirname(__FILE__).'/../bootstrap/unit.php');

$test = new bfTestUnit(5, new lime_output_color());
$test->loadData();
$test->signin('user');

$graph = new TurnoverGraph();
$graph->build();

$years_serie = $graph->getSerie(0);

$test->is($years_serie->getData(0), 4000, '->getData() returns right data for year');
$test->is($years_serie->getData(1), 3000, '->getData() returns right data for year');
$test->is($years_serie->getData(2), 2000, '->getData() returns right data for year');
$test->is($years_serie->getData(3), 3000, '->getData() returns right data for year');
$test->is($years_serie->getData(4), 12000, '->getData() returns right data for year');