<?php

/**
 * Banca form base class.
 *
 * @package    form
 * @subpackage banca
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseBancaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'id_utente'    => new sfWidgetFormPropelSelect(array('model' => 'Utente', 'add_empty' => false)),
      'abi'          => new sfWidgetFormInput(),
      'cab'          => new sfWidgetFormInput(),
      'cin'          => new sfWidgetFormInput(),
      'iban'         => new sfWidgetFormInput(),
      'numero_conto' => new sfWidgetFormInput(),
      'nome_banca'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorPropelChoice(array('model' => 'Banca', 'column' => 'id', 'required' => false)),
      'id_utente'    => new sfValidatorPropelChoice(array('model' => 'Utente', 'column' => 'id')),
      'abi'          => new sfValidatorString(array('max_length' => 255)),
      'cab'          => new sfValidatorString(array('max_length' => 255)),
      'cin'          => new sfValidatorString(array('max_length' => 255)),
      'iban'         => new sfValidatorString(array('max_length' => 255)),
      'numero_conto' => new sfValidatorString(array('max_length' => 255)),
      'nome_banca'   => new sfValidatorString(array('max_length' => 255)),
    ));

    $this->widgetSchema->setNameFormat('banca[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Banca';
  }


}
