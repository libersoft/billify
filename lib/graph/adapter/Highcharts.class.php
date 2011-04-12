<?php

class Highcharts
{
  private $render_to = 'container';
  private $graph;
  private $type_map = array('bar' => 'column', 'area' => 'area', 'pie' => 'pie', 'line' => 'line');
  
  public function __construct(Graph $graph)
  {
    $this->graph = $graph;
  }

  public function setRenderTo($render_to)
  {
    $this->render_to = $render_to;
  }
  
  public function getTitle()
  {
    return $this->graph->getTitle();
  }

  public function getType($serie)
  {
    return $this->type_map[$serie->getType()];
  }

  public function __toString()
  {
    return $this->render();
  }

  public function renderOptions()
  {
    $options['chart'] = array('renderTo' => $this->render_to);
    $options['title'] = array('text' => $this->getTitle());
    $options['xAxis'] = array('categories' => $this->graph->getXAxisValues());
    $options['credits'] = array('enabled' => false);

    foreach($this->graph->getSeries() as $index => $serie)
    {
      $options['series'][$index] = array('type' => $this->getType($serie), 'name' => $serie->getName(), 'data' => $serie->getAllData());
    }

    return json_encode($options);
  }

  public function render()
  {
    return 'new Highcharts.Chart('.$this->renderOptions().');';
  }
}
