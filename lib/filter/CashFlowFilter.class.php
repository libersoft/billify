<?php

class CashFlowFilter extends sfFormFilter
{
  public function setup()
  {
    $this->setWidgets(array(
      'document_date' => new sfWidgetFormDateRange(array('from_date' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')),
                                                         'to_date' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')),
                                                         'template' => 'da %from_date% a %to_date%')),
    ));

    $this->widgetSchema->setNameFormat('cash_flow_filters[%s]');

    parent::setup();
  }
}