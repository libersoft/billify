<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Prodotto filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseProdottoFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_utente' => new sfWidgetFormPropelChoice(array('model' => 'Utente', 'add_empty' => true)),
      'codice'    => new sfWidgetFormFilterInput(),
      'nome'      => new sfWidgetFormFilterInput(),
      'prezzo'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_utente' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Utente', 'column' => 'id')),
      'codice'    => new sfValidatorPass(array('required' => false)),
      'nome'      => new sfValidatorPass(array('required' => false)),
      'prezzo'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('prodotto_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Prodotto';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'id_utente' => 'ForeignKey',
      'codice'    => 'Text',
      'nome'      => 'Text',
      'prezzo'    => 'Number',
    );
  }
}
