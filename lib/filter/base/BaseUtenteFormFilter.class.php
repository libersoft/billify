<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Utente filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseUtenteFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_invitation_code' => new sfWidgetFormFilterInput(),
      'username'           => new sfWidgetFormFilterInput(),
      'nome'               => new sfWidgetFormFilterInput(),
      'cognome'            => new sfWidgetFormFilterInput(),
      'ragione_sociale'    => new sfWidgetFormFilterInput(),
      'partita_iva'        => new sfWidgetFormFilterInput(),
      'codice_fiscale'     => new sfWidgetFormFilterInput(),
      'email'              => new sfWidgetFormFilterInput(),
      'password'           => new sfWidgetFormFilterInput(),
      'data_attivazione'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'data_rinnovo'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'tipo'               => new sfWidgetFormFilterInput(),
      'stato'              => new sfWidgetFormFilterInput(),
      'fattura'            => new sfWidgetFormFilterInput(),
      'lastlogin'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'approva_contratto'  => new sfWidgetFormFilterInput(),
      'approva_policy'     => new sfWidgetFormFilterInput(),
      'sconto'             => new sfWidgetFormFilterInput(),
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
