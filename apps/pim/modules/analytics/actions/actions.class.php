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
    $this->monthly_turnover_graph->setRenderTo('monthly_turnover');

    $graph = new CashFlowGraph();
    $graph->build();

    $this->cashflow_graph = new Highcharts($graph);
    $this->cashflow_graph->setRenderTo('cashflow');

    $graph = new ClientsSummaryTurnoverGraph();
    $graph->build();

    $this->clients_graph = new Highcharts($graph);
    $this->clients_graph->setRenderTo('clients_graph');

    $graph = new ClientsSummaryTurnoverGraph(true);
    $graph->build();

    $this->supplier_graph = new Highcharts($graph);
    $this->supplier_graph->setRenderTo('supplier_graph');
  
    $graph = new CategorySummaryTurnoverGraph();
    $graph->build();

    $this->category_income_graph = new Highcharts($graph);
    $this->category_income_graph->setRenderTo('category_income_graph');

    $graph = new CategorySummaryTurnoverGraph(true);
    $graph->build();

    $this->category_outcome_graph = new Highcharts($graph);
    $this->category_outcome_graph->setRenderTo('category_outcome_graph');
  }
}
