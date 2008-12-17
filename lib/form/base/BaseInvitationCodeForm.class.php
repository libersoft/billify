<?php

/**
 * InvitationCode form base class.
 *
 * @package    form
 * @subpackage invitation_code
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseInvitationCodeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'codice'  => new sfWidgetFormInput(),
      'inviato' => new sfWidgetFormInput(),
      'email'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorPropelChoice(array('model' => 'InvitationCode', 'column' => 'id', 'required' => false)),
      'codice'  => new sfValidatorString(array('max_length' => 10)),
      'inviato' => new sfValidatorString(),
      'email'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'InvitationCode', 'column' => array('codice')))
    );

    $this->widgetSchema->setNameFormat('invitation_code[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'InvitationCode';
  }


}
