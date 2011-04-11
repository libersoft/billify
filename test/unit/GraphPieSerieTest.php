<?php

include_once(dirname(__FILE__).'/../bootstrap/unit.php');

class GraphPieSerieTest extends bfTestUnitFramework
{
  protected $plan = 1;
  private $serie;

  public function setUp()
  {
    $this->serie = new GraphPieSerie();
  }

  public function testGetType()
  {
    $this->is($this->serie->getType(), 'pie', '->getType() returns right value');
  }
}


$graph_serie = new GraphPieSerieTest();
$graph_serie->run();
