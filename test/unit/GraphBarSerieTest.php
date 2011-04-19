<?php

include_once(dirname(__FILE__).'/../bootstrap/unit.php');

class GraphBarSerieTest extends bfTestUnitFramework
{
  protected $plan = 1;
  private $serie;

  public function setUp()
  {
    $this->serie = new GraphBarSerie();
  }

  public function testGetType()
  {
    $this->is($this->serie->getType(), 'bar', '->getType() returns right value');
  }
}


$graph_serie = new GraphBarSerieTest();
$graph_serie->run();
