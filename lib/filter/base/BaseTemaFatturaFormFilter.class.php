<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * TemaFattura filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseTemaFatturaFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_utente' => new sfWidgetFormPropelChoice(array('model' => 'Utente', 'add_empty' => true)),
      'nome'      => new sfWidgetFormFilterInput(),
      'template'  => new sfWidgetFormFilterInput(),
      'css'       => new sfWidgetFormFilterInput(),
      'logo'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_utente' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Utente', 'column' => 'id')),
      'nome'      => new sfValidatorPass(array('required' => false)),
      'template'  => new sfValidatorPass(array('required' => false)),
      'css'       => new sfValidatorPass(array('required' => false)),
      'logo'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tema_fattura_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TemaFattura';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'id_utente' => 'ForeignKey',
      'nome'      => 'Text',
      'template'  => 'Text',
      'css'       => 'Text',
      'logo'      => 'Text',
    );
  }
}
