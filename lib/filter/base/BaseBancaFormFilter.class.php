<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Banca filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseBancaFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_utente'    => new sfWidgetFormPropelChoice(array('model' => 'Utente', 'add_empty' => true)),
      'abi'          => new sfWidgetFormFilterInput(),
      'cab'          => new sfWidgetFormFilterInput(),
      'cin'          => new sfWidgetFormFilterInput(),
      'iban'         => new sfWidgetFormFilterInput(),
      'numero_conto' => new sfWidgetFormFilterInput(),
      'nome_banca'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_utente'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Utente', 'column' => 'id')),
      'abi'          => new sfValidatorPass(array('required' => false)),
      'cab'          => new sfValidatorPass(array('required' => false)),
      'cin'          => new sfValidatorPass(array('required' => false)),
      'iban'         => new sfValidatorPass(array('required' => false)),
      'numero_conto' => new sfValidatorPass(array('required' => false)),
      'nome_banca'   => new sfValidatorPass(array('required' => false)),
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
      'abi'          => 'Text',
      'cab'          => 'Text',
      'cin'          => 'Text',
      'iban'         => 'Text',
      'numero_conto' => 'Text',
      'nome_banca'   => 'Text',
    );
  }
}
