<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Fattura filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseFatturaFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_utente'                => new sfWidgetFormPropelChoice(array('model' => 'Utente', 'add_empty' => true)),
      'num_fattura'              => new sfWidgetFormFilterInput(),
      'cliente_id'               => new sfWidgetFormPropelChoice(array('model' => 'Contatto', 'add_empty' => true)),
      'contatto_string'          => new sfWidgetFormFilterInput(),
      'descrizione'              => new sfWidgetFormFilterInput(),
      'data'                     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'data_stato'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'data_scadenza'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'modo_pagamento_id'        => new sfWidgetFormPropelChoice(array('model' => 'ModoPagamento', 'add_empty' => true)),
      'sconto'                   => new sfWidgetFormFilterInput(),
      'vat'                      => new sfWidgetFormFilterInput(),
      'spese_anticipate'         => new sfWidgetFormFilterInput(),
      'imposte'                  => new sfWidgetFormFilterInput(),
      'imponibile'               => new sfWidgetFormFilterInput(),
      'stato'                    => new sfWidgetFormFilterInput(),
      'iva_pagata'               => new sfWidgetFormFilterInput(),
      'iva_depositata'           => new sfWidgetFormFilterInput(),
      'commercialista'           => new sfWidgetFormFilterInput(),
      'note'                     => new sfWidgetFormFilterInput(),
      'calcola_ritenuta_acconto' => new sfWidgetFormFilterInput(),
      'includi_tasse'            => new sfWidgetFormFilterInput(),
      'calcola_tasse'            => new sfWidgetFormFilterInput(),
      'class_key'                => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_utente'                => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Utente', 'column' => 'id')),
      'num_fattura'              => new sfValidatorPass(array('required' => false)),
      'cliente_id'               => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Contatto', 'column' => 'id')),
      'contatto_string'          => new sfValidatorPass(array('required' => false)),
      'descrizione'              => new sfValidatorPass(array('required' => false)),
      'data'                     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'data_stato'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'data_scadenza'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'modo_pagamento_id'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ModoPagamento', 'column' => 'id')),
      'sconto'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'vat'                      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'spese_anticipate'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'imposte'                  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'imponibile'               => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'stato'                    => new sfValidatorPass(array('required' => false)),
      'iva_pagata'               => new sfValidatorPass(array('required' => false)),
      'iva_depositata'           => new sfValidatorPass(array('required' => false)),
      'commercialista'           => new sfValidatorPass(array('required' => false)),
      'note'                     => new sfValidatorPass(array('required' => false)),
      'calcola_ritenuta_acconto' => new sfValidatorPass(array('required' => false)),
      'includi_tasse'            => new sfValidatorPass(array('required' => false)),
      'calcola_tasse'            => new sfValidatorPass(array('required' => false)),
      'class_key'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('fattura_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Fattura';
  }

  public function getFields()
  {
    return array(
      'id'                       => 'Number',
      'id_utente'                => 'ForeignKey',
      'num_fattura'              => 'Text',
      'cliente_id'               => 'ForeignKey',
      'contatto_string'          => 'Text',
      'descrizione'              => 'Text',
      'data'                     => 'Date',
      'data_stato'               => 'Date',
      'data_scadenza'            => 'Date',
      'modo_pagamento_id'        => 'ForeignKey',
      'sconto'                   => 'Number',
      'vat'                      => 'Number',
      'spese_anticipate'         => 'Number',
      'imposte'                  => 'Number',
      'imponibile'               => 'Number',
      'stato'                    => 'Text',
      'iva_pagata'               => 'Text',
      'iva_depositata'           => 'Text',
      'commercialista'           => 'Text',
      'note'                     => 'Text',
      'calcola_ritenuta_acconto' => 'Text',
      'includi_tasse'            => 'Text',
      'calcola_tasse'            => 'Text',
      'class_key'                => 'Number',
    );
  }
}
