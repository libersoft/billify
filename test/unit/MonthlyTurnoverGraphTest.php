<?php

include_once(dirname(__FILE__).'/../bootstrap/unit.php');

$test = new bfTestUnit(12, new lime_output_color());
$test->loadData();
$test->signin('user');

$graph = new MonthlyTurnoverGraph();
$graph->build();

$two_year_ago_serie = $graph->getSerie(0);
$test->is($two_year_ago_serie->getData(0), '2000');
$test->is($two_year_ago_serie->getData(1), '0');
$test->is($two_year_ago_serie->getData(2), '0');
$test->is($two_year_ago_serie->getData(3), '0');
$test->is($two_year_ago_serie->getData(4), '0');
$test->is($two_year_ago_serie->getData(5), '0');
$test->is($two_year_ago_serie->getData(6), '0');
$test->is($two_year_ago_serie->getData(7), '0');
$test->is($two_year_ago_serie->getData(8), '0');
$test->is($two_year_ago_serie->getData(9), '0');
$test->is($two_year_ago_serie->getData(10), '0');
$test->is($two_year_ago_serie->getData(11), '0');
