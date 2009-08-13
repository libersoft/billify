<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Tassa filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseTassaFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_utente'   => new sfWidgetFormPropelChoice(array('model' => 'Utente', 'add_empty' => true)),
      'nome'        => new sfWidgetFormFilterInput(),
      'valore'      => new sfWidgetFormFilterInput(),
      'descrizione' => new sfWidgetFormFilterInput(),
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
