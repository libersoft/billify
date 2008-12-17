<?php

/**
 * Utente form base class.
 *
 * @package    form
 * @subpackage utente
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseUtenteForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'id_invitation_code' => new sfWidgetFormInput(),
      'username'           => new sfWidgetFormInput(),
      'nome'               => new sfWidgetFormInput(),
      'cognome'            => new sfWidgetFormInput(),
      'ragione_sociale'    => new sfWidgetFormInput(),
      'partita_iva'        => new sfWidgetFormInput(),
      'codice_fiscale'     => new sfWidgetFormInput(),
      'email'              => new sfWidgetFormInput(),
      'password'           => new sfWidgetFormInput(),
      'data_attivazione'   => new sfWidgetFormDate(),
      'data_rinnovo'       => new sfWidgetFormDate(),
      'tipo'               => new sfWidgetFormInput(),
      'stato'              => new sfWidgetFormInput(),
      'fattura'            => new sfWidgetFormInput(),
      'lastlogin'          => new sfWidgetFormDateTime(),
      'approva_contratto'  => new sfWidgetFormInput(),
      'approva_policy'     => new sfWidgetFormInput(),
      'sconto'             => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorPropelChoice(array('model' => 'Utente', 'column' => 'id', 'required' => false)),
      'id_invitation_code' => new sfValidatorInteger(array('required' => false)),
      'username'           => new sfValidatorString(array('max_length' => 255)),
      'nome'               => new sfValidatorString(array('max_length' => 255)),
      'cognome'            => new sfValidatorString(array('max_length' => 255)),
      'ragione_sociale'    => new sfValidatorString(array('max_length' => 255)),
      'partita_iva'        => new sfValidatorString(array('max_length' => 255)),
      'codice_fiscale'     => new sfValidatorString(array('max_length' => 255)),
      'email'              => new sfValidatorString(array('max_length' => 255)),
      'password'           => new sfValidatorString(array('max_length' => 255)),
      'data_attivazione'   => new sfValidatorDate(),
      'data_rinnovo'       => new sfValidatorDate(),
      'tipo'               => new sfValidatorString(),
      'stato'              => new sfValidatorString(),
      'fattura'            => new sfValidatorString(),
      'lastlogin'          => new sfValidatorDateTime(),
      'approva_contratto'  => new sfValidatorInteger(),
      'approva_policy'     => new sfValidatorInteger(),
      'sconto'             => new sfValidatorInteger(),
    ));


Warning: call_user_func(UtentePeer::getUniqueColumnNames): First argument is expected to be a valid callback in /Applications/xampp/xamppfiles/lib/php/pear/symfony/plugins/sfPropelPlugin/lib/propel/generator/sfPropelFormGenerator.class.php on line 461

Warning: Invalid argument supplied for foreach() in /Applications/xampp/xamppfiles/lib/php/pear/symfony/plugins/sfPropelPlugin/lib/propel/generator/sfPropelFormGenerator.class.php on line 461
    $this->widgetSchema->setNameFormat('utente[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Utente';
  }


}
