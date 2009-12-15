<?php

/**
 * Utente filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseUtenteFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_invitation_code' => new sfWidgetFormFilterInput(),
      'username'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nome'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cognome'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ragione_sociale'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'partita_iva'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'codice_fiscale'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'password'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'data_attivazione'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'data_rinnovo'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'tipo'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'stato'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fattura'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'lastlogin'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'approva_contratto'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'approva_policy'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sconto'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'id_invitation_code' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'username'           => new sfValidatorPass(array('required' => false)),
      'nome'               => new sfValidatorPass(array('required' => false)),
      'cognome'            => new sfValidatorPass(array('required' => false)),
      'ragione_sociale'    => new sfValidatorPass(array('required' => false)),
      'partita_iva'        => new sfValidatorPass(array('required' => false)),
      'codice_fiscale'     => new sfValidatorPass(array('required' => false)),
      'email'              => new sfValidatorPass(array('required' => false)),
      'password'           => new sfValidatorPass(array('required' => false)),
      'data_attivazione'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'data_rinnovo'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'tipo'               => new sfValidatorPass(array('required' => false)),
      'stato'              => new sfValidatorPass(array('required' => false)),
      'fattura'            => new sfValidatorPass(array('required' => false)),
      'lastlogin'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'approva_contratto'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'approva_policy'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'sconto'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('utente_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Utente';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'id_invitation_code' => 'Number',
      'username'           => 'Text',
      'nome'               => 'Text',
      'cognome'            => 'Text',
      'ragione_sociale'    => 'Text',
      'partita_iva'        => 'Text',
      'codice_fiscale'     => 'Text',
      'email'              => 'Text',
      'password'           => 'Text',
      'data_attivazione'   => 'Date',
      'data_rinnovo'       => 'Date',
      'tipo'               => 'Text',
      'stato'              => 'Text',
      'fattura'            => 'Text',
      'lastlogin'          => 'Date',
      'approva_contratto'  => 'Number',
      'approva_policy'     => 'Number',
      'sconto'             => 'Number',
    );
  }
}
