<?php

/**
 * Banca filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseBancaFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_utente'    => new sfWidgetFormPropelChoice(array('model' => 'Utente', 'add_empty' => true)),
      'nome_banca'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'abi'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cab'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cin'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'iban'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'numero_conto' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'id_utente'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Utente', 'column' => 'id')),
      'nome_banca'   => new sfValidatorPass(array('required' => false)),
      'abi'          => new sfValidatorPass(array('required' => false)),
      'cab'          => new sfValidatorPass(array('required' => false)),
      'cin'          => new sfValidatorPass(array('required' => false)),
      'iban'         => new sfValidatorPass(array('required' => false)),
      'numero_conto' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('banca_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Banca';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'id_utente'    => 'ForeignKey',
      'nome_banca'   => 'Text',
      'abi'          => 'Text',
      'cab'          => 'Text',
      'cin'          => 'Text',
      'iban'         => 'Text',
      'numero_conto' => 'Text',
    );
  }
}
