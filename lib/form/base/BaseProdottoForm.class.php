<?php

/**
 * Prodotto form base class.
 *
 * @package    form
 * @subpackage prodotto
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseProdottoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'id_utente' => new sfWidgetFormPropelSelect(array('model' => 'Utente', 'add_empty' => false)),
      'codice'    => new sfWidgetFormInput(),
      'nome'      => new sfWidgetFormInput(),
      'prezzo'    => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorPropelChoice(array('model' => 'Prodotto', 'column' => 'id', 'required' => false)),
      'id_utente' => new sfValidatorPropelChoice(array('model' => 'Utente', 'column' => 'id')),
      'codice'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nome'      => new sfValidatorString(array('max_length' => 255)),
      'prezzo'    => new sfValidatorNumber(),
    ));

    $this->widgetSchema->setNameFormat('prodotto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Prodotto';
  }


}
