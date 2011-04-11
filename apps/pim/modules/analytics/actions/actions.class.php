<?php

class analyticsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $graph = new TurnoverGraph();
    $graph->build();

    $this->turnover_graph = new Highcharts($graph);
    $this->turnover_graph->setRenderTo('turnover');

    $graph = new MonthlyTurnoverGraph();
    $graph->build();

    $this->monthly_turnover_graph = new Highcharts($graph);
    $this->monthly_turnover_graph->setRenderTo('cashflow');
  }
}
