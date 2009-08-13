<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Contatto filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseContattoFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_utente'                => new sfWidgetFormPropelChoice(array('model' => 'Utente', 'add_empty' => true)),
      'azienda'                  => new sfWidgetFormFilterInput(),
      'ragione_sociale'          => new sfWidgetFormFilterInput(),
      'via'                      => new sfWidgetFormFilterInput(),
      'citta'                    => new sfWidgetFormFilterInput(),
      'provincia'                => new sfWidgetFormFilterInput(),
      'cap'                      => new sfWidgetFormFilterInput(),
      'nazione'                  => new sfWidgetFormFilterInput(),
      'piva'                     => new sfWidgetFormFilterInput(),
      'cf'                       => new sfWidgetFormFilterInput(),
      'cognome'                  => new sfWidgetFormFilterInput(),
      'nome'                     => new sfWidgetFormFilterInput(),
      'telefono'                 => new sfWidgetFormFilterInput(),
      'fax'                      => new sfWidgetFormFilterInput(),
      'cellulare'                => new sfWidgetFormFilterInput(),
      'email'                    => new sfWidgetFormFilterInput(),
      'modo_pagamento_id'        => new sfWidgetFormPropelChoice(array('model' => 'ModoPagamento', 'add_empty' => true)),
      'stato'                    => new sfWidgetFormFilterInput(),
      'contatto'                 => new sfWidgetFormFilterInput(),
      'id_tema_fattura'          => new sfWidgetFormPropelChoice(array('model' => 'TemaFattura', 'add_empty' => true)),
      'id_banca'                 => new sfWidgetFormPropelChoice(array('model' => 'Banca', 'add_empty' => true)),
      'calcola_ritenuta_acconto' => new sfWidgetFormFilterInput(),
      'includi_tasse'            => new sfWidgetFormFilterInput(),
      'calcola_tasse'            => new sfWidgetFormFilterInput(),
      'cod'                      => new sfWidgetFormFilterInput(),
      'note'                     => new sfWidgetFormFilterInput(),
      'class_key'                => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_utente'                => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Utente', 'column' => 'id')),
      'azienda'                  => new sfValidatorPass(array('required' => false)),
      'ragione_sociale'          => new sfValidatorPass(array('required' => false)),
      'via'                      => new sfValidatorPass(array('required' => false)),
      'citta'                    => new sfValidatorPass(array('required' => false)),
      'provincia'                => new sfValidatorPass(array('required' => false)),
      'cap'                      => new sfValidatorPass(array('required' => false)),
      'nazione'                  => new sfValidatorPass(array('required' => false)),
      'piva'                     => new sfValidatorPass(array('required' => false)),
      'cf'                       => new sfValidatorPass(array('required' => false)),
      'cognome'                  => new sfValidatorPass(array('required' => false)),
      'nome'                     => new sfValidatorPass(array('required' => false)),
      'telefono'                 => new sfValidatorPass(array('required' => false)),
      'fax'                      => new sfValidatorPass(array('required' => false)),
      'cellulare'                => new sfValidatorPass(array('required' => false)),
      'email'                    => new sfValidatorPass(array('required' => false)),
      'modo_pagamento_id'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ModoPagamento', 'column' => 'id')),
      'stato'                    => new sfValidatorPass(array('required' => false)),
      'contatto'                 => new sfValidatorPass(array('required' => false)),
      'id_tema_fattura'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'TemaFattura', 'column' => 'id')),
      'id_banca'                 => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Banca', 'column' => 'id')),
      'calcola_ritenuta_acconto' => new sfValidatorPass(array('required' => false)),
      'includi_tasse'            => new sfValidatorPass(array('required' => false)),
      'calcola_tasse'            => new sfValidatorPass(array('required' => false)),
      'cod'                      => new sfValidatorPass(array('required' => false)),
      'note'                     => new sfValidatorPass(array('required' => false)),
      'class_key'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('contatto_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contatto';
  }

  public function getFields()
  {
    return array(
      'id'                       => 'Number',
      'id_utente'                => 'ForeignKey',
      'azienda'                  => 'Text',
      'ragione_sociale'          => 'Text',
      'via'                      => 'Text',
      'citta'                    => 'Text',
      'provincia'                => 'Text',
      'cap'                      => 'Text',
      'nazione'                  => 'Text',
      'piva'                     => 'Text',
      'cf'                       => 'Text',
      'cognome'                  => 'Text',
      'nome'                     => 'Text',
      'telefono'                 => 'Text',
      'fax'                      => 'Text',
      'cellulare'                => 'Text',
      'email'                    => 'Text',
      'modo_pagamento_id'        => 'ForeignKey',
      'stato'                    => 'Text',
      'contatto'                 => 'Text',
      'id_tema_fattura'          => 'ForeignKey',
      'id_banca'                 => 'ForeignKey',
      'calcola_ritenuta_acconto' => 'Text',
      'includi_tasse'            => 'Text',
      'calcola_tasse'            => 'Text',
      'cod'                      => 'Text',
      'note'                     => 'Text',
      'class_key'                => 'Number',
    );
  }
}
