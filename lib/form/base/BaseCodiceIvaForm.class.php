<?php

/**
 * CodiceIva form base class.
 *
 * @package    form
 * @subpackage codice_iva
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseCodiceIvaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'id_utente'   => new sfWidgetFormPropelSelect(array('model' => 'Utente', 'add_empty' => true)),
      'nome'        => new sfWidgetFormInput(),
      'valore'      => new sfWidgetFormInput(),
      'descrizione' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'CodiceIva', 'column' => 'id', 'required' => false)),
      'id_utente'   => new sfValidatorPropelChoice(array('model' => 'Utente', 'column' => 'id', 'required' => false)),
      'nome'        => new sfValidatorString(array('max_length' => 255)),
      'valore'      => new sfValidatorInteger(),
      'descrizione' => new sfValidatorString(),
    ));

    $this->widgetSchema->setNameFormat('codice_iva[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CodiceIva';
  }


}
