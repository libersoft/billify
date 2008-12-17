<?php

/**
 * ModoPagamento form base class.
 *
 * @package    form
 * @subpackage modo_pagamento
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseModoPagamentoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'id_utente'   => new sfWidgetFormPropelSelect(array('model' => 'Utente', 'add_empty' => true)),
      'num_giorni'  => new sfWidgetFormInput(),
      'descrizione' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'ModoPagamento', 'column' => 'id', 'required' => false)),
      'id_utente'   => new sfValidatorPropelChoice(array('model' => 'Utente', 'column' => 'id', 'required' => false)),
      'num_giorni'  => new sfValidatorInteger(),
      'descrizione' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('modo_pagamento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ModoPagamento';
  }


}
