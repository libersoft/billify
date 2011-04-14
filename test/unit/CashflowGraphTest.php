<?php

include_once(dirname(__FILE__).'/../bootstrap/unit.php');

$test = new bfTestUnit(24, new lime_output_color());
$test->loadData();
$test->signin('user');

$cf = new CashFlow();

$graph = new CashflowGraph();
$graph->build();

$incoming_serie = $graph->getSerie(0);
for($i = 0; $i < 12; $i++)
{

  $document_data['from']['day'] = 1;
  $document_data['from']['month'] = $i + 1;
  $document_data['from']['year'] = date('Y');

  $document_data['to']['day'] = date('t', strtotime(($i + 1).'/1/'.date('Y')));
  $document_data['to']['month'] = $i + 1;
  $document_data['to']['year'] = date('Y');
  
  $documents = FinancialDocumentPeer::doSelectForCashFlow($document_data, new CashFlowCriteria());
  $cf->reset();
  $cf->addDocuments($documents);

  $test->is($incoming_serie->getData($i), $cf->getIncoming(), '->getData() returns right data for month '.($i + 1));
}

$outcoming = $graph->getSerie(1);
for($i = 0; $i < 12; $i++)
{
  $document_data['from']['day'] = 1;
  $document_data['from']['month'] = $i + 1;
  $document_data['from']['year'] = date('Y');

  $document_data['to']['day'] = date('t', strtotime(($i + 1).'/1/'.date('Y')));
  $document_data['to']['month'] = $i + 1;
  $document_data['to']['year'] = date('Y');

  $documents = FinancialDocumentPeer::doSelectForCashFlow($document_data, new CashFlowCriteria());
  $cf->reset();
  $cf->addDocuments($documents);

  $test->is($outcoming->getData($i), $cf->getOutcoming(), '->getData() returns right data for month '.($i + 1));
}