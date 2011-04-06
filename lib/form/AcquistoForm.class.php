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
  static $states = array(Acquisto::PAGATA => 'Pagata', Acquisto::NON_PAGATA => 'Non Pagata');

  public function configure()
  {
    parent::configure();


    $providerCriteria = new Criteria();
    $providerCriteria->add(ContattoPeer::CLASS_KEY, ContattoPeer::CLASSKEY_FORNITORE);
    $providerCriteria->addAscendingOrderByColumn(ContattoPeer::RAGIONE_SOCIALE);

    $this->widgetSchema['cliente_id']->setOption('criteria', $providerCriteria);

    $widgets = $this->getWidgetSchema();
    $widgets['vat'] = new sfWidgetFormPropelChoice(array('model' => 'CodiceIva', 'key_method' => 'getValore'));
    $widgets['class_key'] = new sfWidgetFormInputHidden();
    $widgets['stato'] = new sfWidgetFormSelect(array('choices' => self::$states));
    $widgets['data_stato'] = new sfWidgetFormDate(array('format'  => '%day%/%month%/%year%'));

    $this->widgetSchema->moveField('data_stato', sfWidgetFormSchema::AFTER, 'stato');

    $this->widgetSchema->setLabel('modo_pagamento_id', 'Modo pagamento');
    $this->widgetSchema->setLabel('cliente_id', 'Fornitore');
    $this->widgetSchema->setLabel('num_fattura', 'N.');

    $this->setDefault('class_key', FatturaPeer::CLASSKEY_ACQUISTO);
    $this->setDefault('num_fattura', '');
    
    $this->validatorSchema['vat']->setOption('required', true);
    $this->validatorSchema['num_fattura']->setOption('required', true);
    $this->validatorSchema['cliente_id']->setOption('required', true);
    
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
      $this['calcola_tasse']
    );

    $this->validatorSchema->setPostValidator(new ValidatorPaidInvoce());

  }

  public function getModelName()
  {
    return 'Acquisto';
  }

  protected function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if($this->isNew())
    {
      return;
    }

    if(!is_null($this->getObject()->getDataStato()))
    {
      return;
    }

    $this->setDefault('data_stato', $this->getObject()->getDataPagamento('Y-m-d'));

  }

  public function getJavascripts()
  {
    return array('purchase_form.js');
  }

}
