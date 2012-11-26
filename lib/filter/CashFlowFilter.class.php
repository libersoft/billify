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
    $this->widgetSchema['categoria_id'] = new sfWidgetFormPropelChoice(array('model' => 'Categoria', 'add_empty' => true));

    $this->setValidators(array(
      'document_date'   => new sfValidatorPass(array('required' => false)),
    ));
    $this->validatorSchema['categoria_id'] = new sfValidatorPropelChoice(array('required' => false, 'model' => 'Categoria', 'column' => 'id'));
    
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
