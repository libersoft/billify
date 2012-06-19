<?php

/**
 * Vendita form.
 *
 * @package    form
 * @subpackage fattura
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class VenditaForm extends FatturaForm
{
  protected static $calcola_ritenuta_choices = array('a' => 'Auto', 's' => 'Si', 'n' => 'No');
  protected static $choices = array('s' => 'Si', 'n' => 'No');
  static $states = array(
      Vendita::NON_PAGATA => 'non inviata',
      Vendita::INVIATA => 'inviata',
      Vendita::PAGATA => 'pagata',
      Vendita::RIFIUTATA => 'rifiutata',
  );
  
  public function configure()
  {
    parent::configure();
    
    $providerCriteria = new Criteria();
    $providerCriteria->add(ContattoPeer::CLASS_KEY, ContattoPeer::CLASSKEY_CLIENTE);
    $providerCriteria->addAscendingOrderByColumn(ContattoPeer::RAGIONE_SOCIALE);

    $this->widgetSchema['cliente_id']->setOption('criteria', $providerCriteria);
    
    $widgets = $this->getWidgetSchema();
    $widgets['pro_forma'] = new sfWidgetFormSelect(array('choices' => self::$choices));
    $widgets['class_key'] = new sfWidgetFormInputHidden();
    $widgets['data'] = new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true, 'culture' => 'it'));
    $widgets['vat'] = new sfWidgetFormPropelChoice(array('model' => 'CodiceIva', 'key_method' => 'getValore'));
    $widgets['calcola_ritenuta_acconto'] = new sfWidgetFormSelect(array('choices' => self::$calcola_ritenuta_choices));
    $widgets['includi_tasse'] = new sfWidgetFormSelect(array('choices' => self::$choices));
    $widgets['calcola_tasse'] = new sfWidgetFormSelect(array('choices' => self::$choices));

    $this->setDefault('calcola_ritenuta_acconto', 'n');
    $this->setDefault('includi tasse', 'n');
    $this->setDefault('calcola_tasse', 'n');
    $this->setDefault('class_key', FatturaPeer::CLASSKEY_VENDITA);
  
    $this->widgetSchema->moveField('pro_forma', sfWidgetFormSchema::FIRST);
  
    $this->widgetSchema->setLabel('modo_pagamento_id', 'Modo pagamento');
    $this->widgetSchema->setLabel('id_tema_fattura', 'Tema fattura');
    $this->widgetSchema->setLabel('num_fattura', 'Num Fattura');
    $this->widgetSchema->setLabel('vat', 'Iva');
    $this->widgetSchema->setLabel('includi_tasse', 'Scorpora tasse');
    $this->widgetSchema->setLabel('calcola_ritenuta_acconto', 'Calcola ritenuta');
    
    $this->widgetSchema->moveField('note', sfWidgetFormSchema::LAST);
    
    $validators = $this->getValidatorSchema();
    
    $validators['pro_forma'] = new sfValidatorString();
    $validators['num_fattura']->setOptions(array('required' => true));
    $validators['num_fattura']->setMessages(array('required' => 'Il numero di fattura non pu&ograve; essere vuoto'));
    $validators['cliente_id']->setOption('required', 'true');
    $validators['cliente_id']->setMessages(array('required' => 'Seleziona un cliente'));
    $validators['data']->setOption('date_format', '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~');
    $validators['data']->setMessages(array('required' => 'La data di emissione fattura non pu&ograve; essere vuota', 'date_format' => 'Formato non valido, formato riconosciuto d/m/y'));
    $validators['sconto']->setOptions(array('required'=> true));
    $validators['sconto']->setMessages(array('required' => 'Lo sconto non pu&ograve; essere vuoto'));
    $validators['vat']->setOptions(array('required' => true));
    $validators['vat']->setMessages(array('required' => 'L iva non pu&ograve; essere vuota'));
    $validators['spese_anticipate']->setOptions(array('required' => true));
    $validators['spese_anticipate']->setMessages(array('required' => 'Le spese anticipate non possono essere vuote'));
    
    
    unset(
      $this['id_utente'],
      $this['contatto_string'],
      $this['descrizione'],
      $this['imposte'],
      $this['data_stato'],
      $this['data_scadenza'],
      $this['imponibile'],
      $this['stato'],
      $this['iva_pagata'],
      $this['iva_depositata'],
      $this['commercialista'],
      $this['categoria_id']
      );
  }

  public function getModelName()
  {
    return 'Vendita';
  }
}
