<?php

/**
 * DettagliFattura form base class.
 *
 * @package    form
 * @subpackage dettagli_fattura
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseDettagliFatturaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'fattura_id'  => new sfWidgetFormPropelSelect(array('model' => 'Fattura', 'add_empty' => false)),
      'descrizione' => new sfWidgetFormTextarea(),
      'qty'         => new sfWidgetFormInput(),
      'sconto'      => new sfWidgetFormInput(),
      'iva'         => new sfWidgetFormInput(),
      'prezzo'      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'DettagliFattura', 'column' => 'id', 'required' => false)),
      'fattura_id'  => new sfValidatorPropelChoice(array('model' => 'Fattura', 'column' => 'id')),
      'descrizione' => new sfValidatorString(array('required' => false)),
      'qty'         => new sfValidatorString(array('max_length' => 10)),
      'sconto'      => new sfValidatorString(array('max_length' => 10)),
      'iva'         => new sfValidatorInteger(),
      'prezzo'      => new sfValidatorString(array('max_length' => 50)),
    ));

    $this->widgetSchema->setNameFormat('dettagli_fattura[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'DettagliFattura';
  }


}
