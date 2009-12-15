<?php

/**
 * TagsFattura filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseTagsFatturaFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_fattura'       => new sfWidgetFormPropelChoice(array('model' => 'Fattura', 'add_empty' => true)),
      'id_utente'        => new sfWidgetFormPropelChoice(array('model' => 'Utente', 'add_empty' => true)),
      'tag'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tag_normalizzato' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'data'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'id_fattura'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Fattura', 'column' => 'id')),
      'id_utente'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Utente', 'column' => 'id')),
      'tag'              => new sfValidatorPass(array('required' => false)),
      'tag_normalizzato' => new sfValidatorPass(array('required' => false)),
      'data'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('tags_fattura_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TagsFattura';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'id_fattura'       => 'ForeignKey',
      'id_utente'        => 'ForeignKey',
      'tag'              => 'Text',
      'tag_normalizzato' => 'Text',
      'data'             => 'Date',
    );
  }
}
