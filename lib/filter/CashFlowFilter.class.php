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
}