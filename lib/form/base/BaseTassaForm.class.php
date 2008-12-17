<?php

/**
 * Tassa form base class.
 *
 * @package    form
 * @subpackage tassa
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseTassaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'id_utente'   => new sfWidgetFormPropelSelect(array('model' => 'Utente', 'add_empty' => false)),
      'nome'        => new sfWidgetFormInput(),
      'valore'      => new sfWidgetFormInput(),
      'descrizione' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'Tassa', 'column' => 'id', 'required' => false)),
      'id_utente'   => new sfValidatorPropelChoice(array('model' => 'Utente', 'column' => 'id')),
      'nome'        => new sfValidatorString(array('max_length' => 255)),
      'valore'      => new sfValidatorString(array('max_length' => 255)),
      'descrizione' => new sfValidatorString(array('max_length' => 255)),
    ));


Warning: call_user_func(TassaPeer::getUniqueColumnNames): First argument is expected to be a valid callback in /Applications/xampp/xamppfiles/lib/php/pear/symfony/plugins/sfPropelPlugin/lib/propel/generator/sfPropelFormGenerator.class.php on line 461

Warning: Invalid argument supplied for foreach() in /Applications/xampp/xamppfiles/lib/php/pear/symfony/plugins/sfPropelPlugin/lib/propel/generator/sfPropelFormGenerator.class.php on line 461
    $this->widgetSchema->setNameFormat('tassa[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tassa';
  }


}
