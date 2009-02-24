<?php

/**
 * CashFlow form base class.
 *
 * @package    form
 * @subpackage cash_flow
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseCashFlowForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'date'        => new sfWidgetFormDateTime(),
      'description' => new sfWidgetFormInput(),
      'left'        => new sfWidgetFormInput(),
      'rigt'        => new sfWidgetFormInput(),
      'amount'      => new sfWidgetFormInput(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'CashFlow', 'column' => 'id', 'required' => false)),
      'date'        => new sfValidatorDateTime(array('required' => false)),
      'description' => new sfValidatorString(array('max_length' => 255)),
      'left'        => new sfValidatorInteger(),
      'rigt'        => new sfValidatorInteger(),
      'amount'      => new sfValidatorInteger(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cash_flow[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CashFlow';
  }


}
