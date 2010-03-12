<?php

/**
 * Acquisto form.
 *
 * @package    form
 * @subpackage fattura
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class AcquistoForm extends FatturaForm
{
  protected static $states = array('p' => 'Pagata', 'n' => 'Non Pagata');

  public function configure()
  {
    parent::configure();
    
    $providerCriteria = new Criteria();
    $providerCriteria->add(ContattoPeer::CLASS_KEY, ContattoPeer::CLASSKEY_FORNITORE);

    $this->widgetSchema['cliente_id']->setOption('criteria', $providerCriteria);

    $widgets = $this->getWidgetSchema();
    $widgets['vat'] = new sfWidgetFormPropelChoice(array('model' => 'CodiceIva', 'add_empty' => true, 'key_method' => 'getValore'));
    $widgets['class_key'] = new sfWidgetFormInputHidden();
    $widgets['stato'] = new sfWidgetFormSelect(array('choices' => self::$states));

    $this->widgetSchema->setLabel('modo_pagamento_id', 'Modo pagamento');
    $this->widgetSchema->setLabel('cliente_id', 'Fornitore');
    $this->widgetSchema->setLabel('num_fattura', 'N.');
    
    $this->setDefault('class_key', FatturaPeer::CLASSKEY_ACQUISTO);
    $this->setDefault('num_fattura', '');
    
    $this->validatorSchema['num_fattura']->setOption('required', true);
    
    unset(
      $this['id_utente'],
      $this['contatto_string'],
      $this['descrizione'],
      $this['data_scadenza'],
      $this['sconto'],
      $this['spese_anticipate'],
      $this['iva_pagata'],
      $this['iva_depositata'],
      $this['commercialista'],
      $this['calcola_ritenuta_acconto'],
      $this['includi_tasse'],
      $this['calcola_tasse'],
      $this['data_stato']
    );
  }
}
