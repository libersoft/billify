<?php

/**
 * Tassa filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseTassaFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_utente'   => new sfWidgetFormPropelChoice(array('model' => 'Utente', 'add_empty' => true)),
      'nome'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'valore'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descrizione' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'id_utente'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Utente', 'column' => 'id')),
      'nome'        => new sfValidatorPass(array('required' => false)),
      'valore'      => new sfValidatorPass(array('required' => false)),
      'descrizione' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tassa_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tassa';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'id_utente'   => 'ForeignKey',
      'nome'        => 'Text',
      'valore'      => 'Text',
      'descrizione' => 'Text',
    );
  }
}
