<?php

/**
 * ModoPagamento filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseModoPagamentoFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_utente'   => new sfWidgetFormPropelChoice(array('model' => 'Utente', 'add_empty' => true)),
      'num_giorni'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descrizione' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_utente'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Utente', 'column' => 'id')),
      'num_giorni'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'descrizione' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('modo_pagamento_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ModoPagamento';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'id_utente'   => 'ForeignKey',
      'num_giorni'  => 'Number',
      'descrizione' => 'Text',
    );
  }
}
