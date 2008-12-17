<?php

/**
 * TemaFattura form base class.
 *
 * @package    form
 * @subpackage tema_fattura
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseTemaFatturaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'id_utente' => new sfWidgetFormPropelSelect(array('model' => 'Utente', 'add_empty' => false)),
      'nome'      => new sfWidgetFormInput(),
      'template'  => new sfWidgetFormTextarea(),
      'css'       => new sfWidgetFormTextarea(),
      'logo'      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorPropelChoice(array('model' => 'TemaFattura', 'column' => 'id', 'required' => false)),
      'id_utente' => new sfValidatorPropelChoice(array('model' => 'Utente', 'column' => 'id')),
      'nome'      => new sfValidatorString(array('max_length' => 100)),
      'template'  => new sfValidatorString(),
      'css'       => new sfValidatorString(),
      'logo'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));


Warning: call_user_func(TemaFatturaPeer::getUniqueColumnNames): First argument is expected to be a valid callback in /Applications/xampp/xamppfiles/lib/php/pear/symfony/plugins/sfPropelPlugin/lib/propel/generator/sfPropelFormGenerator.class.php on line 461

Warning: Invalid argument supplied for foreach() in /Applications/xampp/xamppfiles/lib/php/pear/symfony/plugins/sfPropelPlugin/lib/propel/generator/sfPropelFormGenerator.class.php on line 461
    $this->widgetSchema->setNameFormat('tema_fattura[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TemaFattura';
  }


}
