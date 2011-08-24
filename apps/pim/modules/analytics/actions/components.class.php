<?php

class analyticsComponents extends paComponents
{
  public function executeContact()
  {
    $graph = new ContactTurnoverGraph($this->contact, $this->total, $this->year);
    $graph->build();
    
    
    $this->pie_graph = new Highcharts($graph);
    $this->pie_graph->setRenderTo('pie');
    
  }	
}