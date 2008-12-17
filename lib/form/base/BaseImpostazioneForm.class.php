<?php

/**
 * Impostazione form base class.
 *
 * @package    form
 * @subpackage impostazione
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseImpostazioneForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_utente'               => new sfWidgetFormInputHidden(),
      'num_clienti'             => new sfWidgetFormInput(),
      'num_fatture'             => new sfWidgetFormInput(),
      'righe_dettagli'          => new sfWidgetFormInput(),
      'ritenuta_acconto'        => new sfWidgetFormInput(),
      'tipo_ritenuta'           => new sfWidgetFormInput(),
      'riepilogo_home'          => new sfWidgetFormInput(),
      'consegna_commercialista' => new sfWidgetFormInput(),
      'deposita_iva'            => new sfWidgetFormInput(),
      'fattura_automatica'      => new sfWidgetFormInput(),
      'codice_cliente'          => new sfWidgetFormInput(),
      'label_imponibile'        => new sfWidgetFormInput(),
      'label_spese'             => new sfWidgetFormInput(),
      'label_imponibile_iva'    => new sfWidgetFormInput(),
      'label_iva'               => new sfWidgetFormInput(),
      'label_totale_fattura'    => new sfWidgetFormInput(),
      'label_ritenuta_acconto'  => new sfWidgetFormInput(),
      'label_netto_liquidare'   => new sfWidgetFormInput(),
      'label_quantita'          => new sfWidgetFormInput(),
      'label_descrizione'       => new sfWidgetFormInput(),
      'label_prezzo_singolo'    => new sfWidgetFormInput(),
      'label_prezzo_totale'     => new sfWidgetFormInput(),
      'label_sconto'            => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id_utente'               => new sfValidatorPropelChoice(array('model' => 'Utente', 'column' => 'id', 'required' => false)),
      'num_clienti'             => new sfValidatorInteger(),
      'num_fatture'             => new sfValidatorInteger(),
      'righe_dettagli'          => new sfValidatorInteger(),
      'ritenuta_acconto'        => new sfValidatorString(array('max_length' => 255)),
      'tipo_ritenuta'           => new sfValidatorString(array('max_length' => 255)),
      'riepilogo_home'          => new sfValidatorString(),
      'consegna_commercialista' => new sfValidatorString(),
      'deposita_iva'            => new sfValidatorString(),
      'fattura_automatica'      => new sfValidatorString(),
      'codice_cliente'          => new sfValidatorString(),
      'label_imponibile'        => new sfValidatorString(array('max_length' => 255)),
      'label_spese'             => new sfValidatorString(array('max_length' => 255)),
      'label_imponibile_iva'    => new sfValidatorString(array('max_length' => 255)),
      'label_iva'               => new sfValidatorString(array('max_length' => 255)),
      'label_totale_fattura'    => new sfValidatorString(array('max_length' => 255)),
      'label_ritenuta_acconto'  => new sfValidatorString(array('max_length' => 255)),
      'label_netto_liquidare'   => new sfValidatorString(array('max_length' => 255)),
      'label_quantita'          => new sfValidatorString(array('max_length' => 255)),
      'label_descrizione'       => new sfValidatorString(array('max_length' => 255)),
      'label_prezzo_singolo'    => new sfValidatorString(array('max_length' => 255)),
      'label_prezzo_totale'     => new sfValidatorString(array('max_length' => 255)),
      'label_sconto'            => new sfValidatorString(array('max_length' => 255)),
    ));

    $this->widgetSchema->setNameFormat('impostazione[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Impostazione';
  }


}
