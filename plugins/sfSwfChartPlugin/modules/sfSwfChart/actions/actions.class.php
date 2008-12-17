<?php

/**
 * sfSwfChart actions.
 *
 * @package    sfSwfChartPlugin
 * @author     Dustin Whittle
 * @version    SVN: $Id$
 */
class sfSwfChartActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeTest()
  {
    return sfView::SUCCESS;
  }

  /**
   * Executes source action
   *
   */
  public function executeSource()
  {
    $sfSwfChart = new sfSwfChart();

    $chart['chart_type'] = 'bar';
    $chart['chart_border'] = array('top_thickness' => 0, 'bottom_thickness' => 4, 'left_thickness' => 4, 'right_thickness' => 4);

    $chart['chart_data'][0] = array("", "2001", "2002", "2003", "2004");
    $chart['chart_data'][1][0] = "Region A";
    $chart['chart_data'][2][0] = "Region B";
    $chart['chart_data'][3][0] = "Region C";

    for ( $row = 1; $row <= 3; $row++ ) {
       for ( $col = 1; $col <= 4; $col++ ) {
          $chart['chart_data'][ $row ][ $col ] = rand ( 0, 100 );
       }
    }

    $xml = $sfSwfChart->convertArray($chart);

    $this->setLayout(false);
    $this->getContext()->getResponse()->setContent($xml);

    return sfView::NONE;
  }
}
