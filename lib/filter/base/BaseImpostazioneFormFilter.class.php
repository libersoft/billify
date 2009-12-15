<?php

/**
 * Impostazione filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseImpostazioneFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'num_clienti'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'num_fatture'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'righe_dettagli'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ritenuta_acconto'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tipo_ritenuta'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'riepilogo_home'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'consegna_commercialista' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'deposita_iva'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fattura_automatica'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'codice_cliente'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'label_imponibile'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'label_spese'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'label_imponibile_iva'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'label_iva'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'label_totale_fattura'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'label_ritenuta_acconto'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'label_netto_liquidare'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'label_quantita'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'label_descrizione'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'label_prezzo_singolo'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'label_prezzo_totale'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'label_sconto'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'num_clienti'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'num_fatture'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'righe_dettagli'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ritenuta_acconto'        => new sfValidatorPass(array('required' => false)),
      'tipo_ritenuta'           => new sfValidatorPass(array('required' => false)),
      'riepilogo_home'          => new sfValidatorPass(array('required' => false)),
      'consegna_commercialista' => new sfValidatorPass(array('required' => false)),
      'deposita_iva'            => new sfValidatorPass(array('required' => false)),
      'fattura_automatica'      => new sfValidatorPass(array('required' => false)),
      'codice_cliente'          => new sfValidatorPass(array('required' => false)),
      'label_imponibile'        => new sfValidatorPass(array('required' => false)),
      'label_spese'             => new sfValidatorPass(array('required' => false)),
      'label_imponibile_iva'    => new sfValidatorPass(array('required' => false)),
      'label_iva'               => new sfValidatorPass(array('required' => false)),
      'label_totale_fattura'    => new sfValidatorPass(array('required' => false)),
      'label_ritenuta_acconto'  => new sfValidatorPass(array('required' => false)),
      'label_netto_liquidare'   => new sfValidatorPass(array('required' => false)),
      'label_quantita'          => new sfValidatorPass(array('required' => false)),
      'label_descrizione'       => new sfValidatorPass(array('required' => false)),
      'label_prezzo_singolo'    => new sfValidatorPass(array('required' => false)),
      'label_prezzo_totale'     => new sfValidatorPass(array('required' => false)),
      'label_sconto'            => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('impostazione_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Impostazione';
  }

  public function getFields()
  {
    return array(
      'id_utente'               => 'ForeignKey',
      'num_clienti'             => 'Number',
      'num_fatture'             => 'Number',
      'righe_dettagli'          => 'Number',
      'ritenuta_acconto'        => 'Text',
      'tipo_ritenuta'           => 'Text',
      'riepilogo_home'          => 'Text',
      'consegna_commercialista' => 'Text',
      'deposita_iva'            => 'Text',
      'fattura_automatica'      => 'Text',
      'codice_cliente'          => 'Text',
      'label_imponibile'        => 'Text',
      'label_spese'             => 'Text',
      'label_imponibile_iva'    => 'Text',
      'label_iva'               => 'Text',
      'label_totale_fattura'    => 'Text',
      'label_ritenuta_acconto'  => 'Text',
      'label_netto_liquidare'   => 'Text',
      'label_quantita'          => 'Text',
      'label_descrizione'       => 'Text',
      'label_prezzo_singolo'    => 'Text',
      'label_prezzo_totale'     => 'Text',
      'label_sconto'            => 'Text',
    );
  }
}
