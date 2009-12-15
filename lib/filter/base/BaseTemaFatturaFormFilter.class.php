<?php

/**
 * TemaFattura filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseTemaFatturaFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_utente' => new sfWidgetFormPropelChoice(array('model' => 'Utente', 'add_empty' => true)),
      'nome'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'template'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'css'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
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
