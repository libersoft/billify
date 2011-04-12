<?php

include_once(dirname(__FILE__).'/../bootstrap/unit.php');

class GraphExampleSerie extends GraphSerie
{
  public function getType()
  {
    return 'example';
  }
}

class GraphSerieTest extends bfTestUnitFramework
{
  protected $plan = 5;
  private $serie;

  public function setUp()
  {
    $this->serie = new GraphExampleSerie();
  }

  public function testGetType()
  {
    $this->is($this->serie->getType(), 'example', '->getType() returns right value');
  }

  public function testGetName()
  {
    $this->serie->setName('Entrate');
    $this->is($this->serie->getName(), 'Entrate', '->getName() returns right value');
  }

  public function testGetData()
  {
    $this->serie->addData(100000);
    $this->is($this->serie->getData(0), 100000, '->getData() returns right data');
  }

  public function testGetAllData()
  {
    $this->serie->addData(100000);
    $this->serie->addData(200000);
    $this->serie->addData(300000);
    $this->is($this->serie->getAllData(), array(100000, 200000, 300000), '->getAllData() returns right data');
  }

  public function testSetData()
  {
    $this->serie->setData(array(123123, 144144));
    $this->is($this->serie->getAllData(), array(123123, 144144), '->getAllData() returns right data');
  }
}


$graph_serie = new GraphSerieTest();
$graph_serie->run();
