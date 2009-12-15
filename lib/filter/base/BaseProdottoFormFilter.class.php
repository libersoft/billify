<?php

/**
 * Prodotto filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseProdottoFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_utente' => new sfWidgetFormPropelChoice(array('model' => 'Utente', 'add_empty' => true)),
      'codice'    => new sfWidgetFormFilterInput(),
      'nome'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'prezzo'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
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
