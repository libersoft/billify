<?php

/**
 * Bug form base class.
 *
 * @package    form
 * @subpackage bug
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseBugForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'id_utente' => new sfWidgetFormPropelSelect(array('model' => 'Utente', 'add_empty' => false)),
      'priorita'  => new sfWidgetFormInput(),
      'modulo'    => new sfWidgetFormInput(),
      'testo'     => new sfWidgetFormTextarea(),
      'data'      => new sfWidgetFormDate(),
      'stato'     => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorPropelChoice(array('model' => 'Bug', 'column' => 'id', 'required' => false)),
      'id_utente' => new sfValidatorPropelChoice(array('model' => 'Utente', 'column' => 'id')),
      'priorita'  => new sfValidatorString(array('max_length' => 255)),
      'modulo'    => new sfValidatorString(array('max_length' => 255)),
      'testo'     => new sfValidatorString(),
      'data'      => new sfValidatorDate(array('required' => false)),
      'stato'     => new sfValidatorString(array('max_length' => 255)),
    ));

    $this->widgetSchema->setNameFormat('bug[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Bug';
  }


}
