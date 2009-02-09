<?php

/**
 * Fattura form base class.
 *
 * @package    form
 * @subpackage fattura
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseFatturaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'id_utente'                => new sfWidgetFormPropelSelect(array('model' => 'Utente', 'add_empty' => false)),
      'num_fattura'              => new sfWidgetFormInput(),
      'cliente_id'               => new sfWidgetFormPropelSelect(array('model' => 'Contatto', 'add_empty' => false)),
      'data'                     => new sfWidgetFormDate(),
      'data_stato'               => new sfWidgetFormDate(),
      'modo_pagamento_id'        => new sfWidgetFormPropelSelect(array('model' => 'ModoPagamento', 'add_empty' => true)),
      'sconto'                   => new sfWidgetFormInput(),
      'vat'                      => new sfWidgetFormInput(),
      'spese_anticipate'         => new sfWidgetFormInput(),
      'imposte'                  => new sfWidgetFormInput(),
      'imponibile'               => new sfWidgetFormInput(),
      'stato'                    => new sfWidgetFormInput(),
      'iva_pagata'               => new sfWidgetFormInput(),
      'iva_depositata'           => new sfWidgetFormInput(),
      'commercialista'           => new sfWidgetFormInput(),
      'note'                     => new sfWidgetFormTextarea(),
      'calcola_ritenuta_acconto' => new sfWidgetFormInput(),
      'includi_tasse'            => new sfWidgetFormInput(),
      'calcola_tasse'            => new sfWidgetFormInput(),
      'class_key'                => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorPropelChoice(array('model' => 'Fattura', 'column' => 'id', 'required' => false)),
      'id_utente'                => new sfValidatorPropelChoice(array('model' => 'Utente', 'column' => 'id')),
      'num_fattura'              => new sfValidatorString(array('max_length' => 10)),
      'cliente_id'               => new sfValidatorPropelChoice(array('model' => 'Contatto', 'column' => 'id')),
      'data'                     => new sfValidatorDate(),
      'data_stato'               => new sfValidatorDate(array('required' => false)),
      'modo_pagamento_id'        => new sfValidatorPropelChoice(array('model' => 'ModoPagamento', 'column' => 'id', 'required' => false)),
      'sconto'                   => new sfValidatorInteger(array('required' => false)),
      'vat'                      => new sfValidatorInteger(array('required' => false)),
      'spese_anticipate'         => new sfValidatorNumber(array('required' => false)),
      'imposte'                  => new sfValidatorNumber(array('required' => false)),
      'imponibile'               => new sfValidatorNumber(array('required' => false)),
      'stato'                    => new sfValidatorString(array('required' => false)),
      'iva_pagata'               => new sfValidatorString(array('required' => false)),
      'iva_depositata'           => new sfValidatorString(array('required' => false)),
      'commercialista'           => new sfValidatorString(array('required' => false)),
      'note'                     => new sfValidatorString(array('required' => false)),
      'calcola_ritenuta_acconto' => new sfValidatorString(array('required' => false)),
      'includi_tasse'            => new sfValidatorString(array('required' => false)),
      'calcola_tasse'            => new sfValidatorString(array('required' => false)),
      'class_key'                => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fattura[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Fattura';
  }


}
