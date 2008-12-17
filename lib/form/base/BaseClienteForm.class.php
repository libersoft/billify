<?php

/**
 * Cliente form base class.
 *
 * @package    form
 * @subpackage cliente
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseClienteForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'id_utente'                => new sfWidgetFormPropelSelect(array('model' => 'Utente', 'add_empty' => false)),
      'azienda'                  => new sfWidgetFormInput(),
      'ragione_sociale'          => new sfWidgetFormInput(),
      'via'                      => new sfWidgetFormInput(),
      'citta'                    => new sfWidgetFormInput(),
      'provincia'                => new sfWidgetFormInput(),
      'cap'                      => new sfWidgetFormInput(),
      'piva'                     => new sfWidgetFormInput(),
      'cf'                       => new sfWidgetFormInput(),
      'cognome'                  => new sfWidgetFormInput(),
      'nome'                     => new sfWidgetFormInput(),
      'telefono'                 => new sfWidgetFormInput(),
      'fax'                      => new sfWidgetFormInput(),
      'cellulare'                => new sfWidgetFormInput(),
      'email'                    => new sfWidgetFormInput(),
      'modo_pagamento_id'        => new sfWidgetFormPropelSelect(array('model' => 'ModoPagamento', 'add_empty' => true)),
      'stato'                    => new sfWidgetFormInput(),
      'note'                     => new sfWidgetFormTextarea(),
      'id_tema_fattura'          => new sfWidgetFormPropelSelect(array('model' => 'TemaFattura', 'add_empty' => true)),
      'id_banca'                 => new sfWidgetFormPropelSelect(array('model' => 'Banca', 'add_empty' => true)),
      'calcola_ritenuta_acconto' => new sfWidgetFormInput(),
      'includi_tasse'            => new sfWidgetFormInput(),
      'calcola_tasse'            => new sfWidgetFormInput(),
      'cod'                      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorPropelChoice(array('model' => 'Cliente', 'column' => 'id', 'required' => false)),
      'id_utente'                => new sfValidatorPropelChoice(array('model' => 'Utente', 'column' => 'id')),
      'azienda'                  => new sfValidatorString(),
      'ragione_sociale'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'via'                      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'citta'                    => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'provincia'                => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'cap'                      => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'piva'                     => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'cf'                       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'cognome'                  => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'nome'                     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'telefono'                 => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'fax'                      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'cellulare'                => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'email'                    => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'modo_pagamento_id'        => new sfValidatorPropelChoice(array('model' => 'ModoPagamento', 'column' => 'id', 'required' => false)),
      'stato'                    => new sfValidatorString(),
      'note'                     => new sfValidatorString(array('required' => false)),
      'id_tema_fattura'          => new sfValidatorPropelChoice(array('model' => 'TemaFattura', 'column' => 'id', 'required' => false)),
      'id_banca'                 => new sfValidatorPropelChoice(array('model' => 'Banca', 'column' => 'id', 'required' => false)),
      'calcola_ritenuta_acconto' => new sfValidatorString(),
      'includi_tasse'            => new sfValidatorString(),
      'calcola_tasse'            => new sfValidatorString(),
      'cod'                      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cliente[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cliente';
  }


}
