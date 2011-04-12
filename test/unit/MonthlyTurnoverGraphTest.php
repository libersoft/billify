<?php

include_once(dirname(__FILE__).'/../bootstrap/unit.php');

$test = new bfTestUnit(36, new lime_output_color());
$test->loadData();
$test->signin('user');

$graph = new MonthlyTurnoverGraph();
$graph->build();

$two_year_ago_serie = $graph->getSerie(0);
for($i = 0; $i < 12; $i++)
{
  $test->is($two_year_ago_serie->getData($i), $i == 0 ? 2000 : 0, '->getData() returns right data for month '.$i);
}

$one_year_ago_serie = $graph->getSerie(1);
for($i = 0; $i < 12; $i++)
{
  $test->is($one_year_ago_serie->getData($i), $i < 3 ? 1000 : 0, '->getData() returns right data for month '.$i);
}

$year_serie = $graph->getSerie(2);
for($i = 0; $i < 12; $i++)
{
  $result = 0;

  if(date('m', strtotime('-1 month')) == $i + 1)
  {
    $result = 1000;
  }
  
  if(date('m', strtotime('today')) == $i + 1)
  {
    $result = 11000;
  }

  $test->is($year_serie->getData($i), $result, '->getData() returns right data for month '.$i);
}