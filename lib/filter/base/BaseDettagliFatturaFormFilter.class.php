<?php

/**
 * DettagliFattura filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseDettagliFatturaFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'fattura_id'  => new sfWidgetFormPropelChoice(array('model' => 'Fattura', 'add_empty' => true)),
      'descrizione' => new sfWidgetFormFilterInput(),
      'qty'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sconto'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'iva'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'prezzo'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'fattura_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Fattura', 'column' => 'id')),
      'descrizione' => new sfValidatorPass(array('required' => false)),
      'qty'         => new sfValidatorPass(array('required' => false)),
      'sconto'      => new sfValidatorPass(array('required' => false)),
      'iva'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'prezzo'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('dettagli_fattura_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'DettagliFattura';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'fattura_id'  => 'ForeignKey',
      'descrizione' => 'Text',
      'qty'         => 'Text',
      'sconto'      => 'Text',
      'iva'         => 'Number',
      'prezzo'      => 'Text',
    );
  }
}
