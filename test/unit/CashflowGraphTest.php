<?php

include_once(dirname(__FILE__).'/../bootstrap/unit.php');

$test = new bfTestUnit(24, new lime_output_color());
$test->loadData();
$test->signin('user');

$graph = new CashflowGraph();
$graph->build();

$incoming_serie = $graph->getSerie(0);
for($i = 0; $i < 12; $i++)
{
  $result = 0;

  if(date('m', strtotime('-1 month')) == $i + 1)
  {
    $result = 1200;
  }

  if(date('m', strtotime('today')) == $i + 1)
  {
    $result = 24000;
  }

  $test->is($incoming_serie->getData($i), $result, '->getData() returns right data for month '.$i);
}

$outcoming = $graph->getSerie(1);
for($i = 0; $i < 12; $i++)
{
  $result = '0';

  if(date('m', strtotime('-1 month')) == $i + 1)
  {
    $result = 39607.41525;
  }

  if(date('m', strtotime('today')) == $i + 1)
  {
    $result = 8001.84;
  }

  $test->is($outcoming->getData($i), $result, '->getData() returns right data for month '.$i);
}