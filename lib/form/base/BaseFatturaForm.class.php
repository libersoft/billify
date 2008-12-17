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
      'cliente_id'               => new sfWidgetFormPropelSelect(array('model' => 'Cliente', 'add_empty' => false)),
      'data'                     => new sfWidgetFormDate(),
      'data_stato'               => new sfWidgetFormDate(),
      'modo_pagamento_id'        => new sfWidgetFormPropelSelect(array('model' => 'ModoPagamento', 'add_empty' => true)),
      'sconto'                   => new sfWidgetFormInput(),
      'vat'                      => new sfWidgetFormInput(),
      'spese_anticipate'         => new sfWidgetFormInput(),
      'totale_mem'               => new sfWidgetFormInput(),
      'imponibile_mem'           => new sfWidgetFormInput(),
      'stato'                    => new sfWidgetFormInput(),
      'iva_pagata'               => new sfWidgetFormInput(),
      'iva_depositata'           => new sfWidgetFormInput(),
      'commercialista'           => new sfWidgetFormInput(),
      'note'                     => new sfWidgetFormTextarea(),
      'calcola_ritenuta_acconto' => new sfWidgetFormInput(),
      'includi_tasse'            => new sfWidgetFormInput(),
      'calcola_tasse'            => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorPropelChoice(array('model' => 'Fattura', 'column' => 'id', 'required' => false)),
      'id_utente'                => new sfValidatorPropelChoice(array('model' => 'Utente', 'column' => 'id')),
      'num_fattura'              => new sfValidatorInteger(),
      'cliente_id'               => new sfValidatorPropelChoice(array('model' => 'Cliente', 'column' => 'id')),
      'data'                     => new sfValidatorDate(),
      'data_stato'               => new sfValidatorDate(array('required' => false)),
      'modo_pagamento_id'        => new sfValidatorPropelChoice(array('model' => 'ModoPagamento', 'column' => 'id', 'required' => false)),
      'sconto'                   => new sfValidatorInteger(),
      'vat'                      => new sfValidatorInteger(),
      'spese_anticipate'         => new sfValidatorNumber(),
      'totale_mem'               => new sfValidatorNumber(array('required' => false)),
      'imponibile_mem'           => new sfValidatorNumber(array('required' => false)),
      'stato'                    => new sfValidatorString(),
      'iva_pagata'               => new sfValidatorString(),
      'iva_depositata'           => new sfValidatorString(),
      'commercialista'           => new sfValidatorString(),
      'note'                     => new sfValidatorString(array('required' => false)),
      'calcola_ritenuta_acconto' => new sfValidatorString(),
      'includi_tasse'            => new sfValidatorString(),
      'calcola_tasse'            => new sfValidatorString(),
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
