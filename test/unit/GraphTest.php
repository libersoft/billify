<?php

include_once(dirname(__FILE__).'/../bootstrap/unit.php');

class GraphTest extends bfTestUnitFramework
{
  protected $plan = 6;
  private $graph;

  public function setUp()
  {
    $this->graph = new Graph();
  }
  
  public function testTitle()
  {
    $this->graph->setTitle('Financial documents');
    $this->is($this->graph->getTitle(), 'Financial documents', '->getTitle() returns right value');
  }

  public function testGetXAxisValue()
  {
    $this->graph->addXAxisValue('2009');
    $this->is($this->graph->getXAxisValue(0), '2009', '->getXAxisValue() returns right value');
  }

  public function testGetXAxisValues()
  {
    $this->graph->addXAxisValue('2009');
    $this->graph->addXAxisValue('2010');
    $this->graph->addXAxisValue('2011');

    $this->is($this->graph->getXAxisValues(), array('2009', '2010', '2011'), '->getXAxisValues() returns right value');
  }

  public function testSetXAxisValues()
  {
    $this->graph->setXAxisValues(array('2009', '2010'));
    $this->is($this->graph->getXAxisValues(), array('2009', '2010'), '->getXAxisValues() returns right value');
  }

  public function testAddSerie()
  {
    $serie = new GraphBarSerie();
    $this->graph->addSerie($serie);
    $this->isa_ok($this->graph->getSerie(0), 'GraphBarSerie', '->getSerie() returns right value');
  }

  public function testGetSeries()
  {
    $serie = new GraphBarSerie();
    $this->graph->addSerie($serie);
    $this->graph->addSerie($serie);
    $this->is($this->graph->getSeries(), array($serie, $serie), '->getSeries() returns right value');
  }
}

$chart = new GraphTest();
$chart->run();

