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

    $this->setValidators(array(
      'document_date'   => new sfValidatorPass(array('required' => false)),
    ));
    
    $this->widgetSchema->setNameFormat('cash_flow_filters[%s]');

    parent::setup();
  }

  public function getDefaultFilter()
  {
    $default_filter = array();
    $default_filter['document_date']['from']['day'] = 1;
    $default_filter['document_date']['from']['month'] = date('n');
    $default_filter['document_date']['from']['year'] = date('Y');

    $default_filter['document_date']['to']['day']   = date('t');
    $default_filter['document_date']['to']['month']   = date('n');
    $default_filter['document_date']['to']['year']   = date('Y');

    return $default_filter;
  }
}