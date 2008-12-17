<?php

/**
 * TagsFattura form base class.
 *
 * @package    form
 * @subpackage tags_fattura
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseTagsFatturaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'id_fattura'       => new sfWidgetFormPropelSelect(array('model' => 'Fattura', 'add_empty' => false)),
      'id_utente'        => new sfWidgetFormPropelSelect(array('model' => 'Utente', 'add_empty' => false)),
      'tag'              => new sfWidgetFormInput(),
      'tag_normalizzato' => new sfWidgetFormInput(),
      'data'             => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorPropelChoice(array('model' => 'TagsFattura', 'column' => 'id', 'required' => false)),
      'id_fattura'       => new sfValidatorPropelChoice(array('model' => 'Fattura', 'column' => 'id')),
      'id_utente'        => new sfValidatorPropelChoice(array('model' => 'Utente', 'column' => 'id')),
      'tag'              => new sfValidatorString(array('max_length' => 255)),
      'tag_normalizzato' => new sfValidatorString(array('max_length' => 255)),
      'data'             => new sfValidatorDate(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'TagsFattura', 'column' => array('id_fattura', 'id_utente', 'tag_normalizzato')))
    );

    $this->widgetSchema->setNameFormat('tags_fattura[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TagsFattura';
  }


}
