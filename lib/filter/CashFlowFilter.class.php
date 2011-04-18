<?php

class CashFlowFilter extends sfFormFilter
{
  public function setup()
  {
    $this->setWidgets(array(
      'document_date' => new sfWidgetFormDateRange(array('from_date' => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true, 'culture' => 'it')),
                                                         'to_date' => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true, 'culture' => 'it')),
                                                         'template' => 'da %from_date%<br/> a %to_date%')),
    ));

    $this->setValidators(array(
      'document_date'   => new sfValidatorPass(array('required' => false)),
    ));
    
    $this->widgetSchema->setNameFormat('cash_flow_filters[%s]');

    parent::setup();
  }

  public function getDefaultFilter()
  {
    $default_filter = array();
    $default_filter['document_date']['from'] = date('1/n/Y');
    $default_filter['document_date']['to']   = date('t/n/Y');

    return $default_filter;
  }

  public function getRoute()
  {
    return '@cashflow';
  }
}