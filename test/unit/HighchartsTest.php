<?php

include_once(dirname(__FILE__).'/../bootstrap/unit.php');

class HighchartsTest extends bfTestUnitFramework
{
  protected $plan = 2;
  private $graph;

  public function setUp()
  {
    $this->graph = new Graph();
    $this->adapter = new Highcharts($this->graph);
  }

  public function testGetTitle()
  {
    $this->graph->setTitle('Entrate | Uscite');
    $this->is($this->adapter->getTitle(), 'Entrate | Uscite', '->getTitle() returns right value');
  }

  public function testPrototype()
  {

    $this->adapter->setRenderTo('header');
    $this->graph->setTitle('Fatturato');
    $this->graph->addXAxisValue('2008');
    $this->graph->addXAxisValue('2009');
    $this->graph->addXAxisValue('2010');

    $serie = new GraphBarSerie();
    $serie->setName('Uscite');
    $serie->addData(200000);
    $serie->addData(300000);
    $serie->addData(400000);
    $this->graph->addSerie($serie);

    $serie = new GraphAreaSerie();
    $serie->setName('Uscite');
    $serie->addData(200000);
    $serie->addData(300000);
    $serie->addData(400000);
    $this->graph->addSerie($serie);

    $serie = new GraphPieSerie();
    $serie->setName('Uscite');
    $serie->addData(200000);
    $serie->addData(300000);
    $serie->addData(400000);
    $this->graph->addSerie($serie);

    $options = array();
    $options['chart'] = array('renderTo' => 'header');
    $options['title'] = array('text' => 'Fatturato');
    $options['xAxis'] = array('categories' => array('2008', '2009', '2010'));
    $options['credits']['enabled'] = false;
    $options['series'][0] = array('type' => 'column', 'name' => 'Uscite', 'data' => array(200000, 300000, 400000));
    $options['series'][1] = array('type' => 'area', 'name' => 'Uscite', 'data' => array(200000, 300000, 400000));
    $options['series'][2] = array('type' => 'pie', 'name' => 'Uscite', 'data' => array(200000, 300000, 400000));
    
    $options = json_encode($options);

    $this->is($this->adapter->renderOptions(), $options, '->__toString() returns right value');
  }
}

$chart = new HighchartsTest();
$chart->run();
