<?php

/**
 * CashFlowRow form base class.
 *
 * @package    form
 * @subpackage cash_flow_row
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseCashFlowRowForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'date'        => new sfWidgetFormDateTime(),
      'model_id'    => new sfWidgetFormInput(),
      'model_class' => new sfWidgetFormInput(),
      'imponibile'  => new sfWidgetFormInput(),
      'imposte'     => new sfWidgetFormInput(),
      'description' => new sfWidgetFormInput(),
      'class_key'   => new sfWidgetFormInput(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'CashFlowRow', 'column' => 'id', 'required' => false)),
      'date'        => new sfValidatorDateTime(array('required' => false)),
      'model_id'    => new sfValidatorInteger(array('required' => false)),
      'model_class' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'imponibile'  => new sfValidatorNumber(array('required' => false)),
      'imposte'     => new sfValidatorNumber(array('required' => false)),
      'description' => new sfValidatorString(array('max_length' => 255)),
      'class_key'   => new sfValidatorInteger(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cash_flow_row[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CashFlowRow';
  }


}
