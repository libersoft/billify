<?php

abstract class DocumentForm extends FatturaForm
{
  protected static $states = array('p' => 'Pagata', 'n' => 'Non Pagata');

  public function configure()
  {
    parent::configure();

    $widgets = $this->getWidgetSchema();
    $widgets['class_key'] = new sfWidgetFormInputHidden();
    $widgets['stato'] = new sfWidgetFormSelect(array('choices' => self::$states));

    $this->setDefault('class_key', $this->getClassKey());

    $this->widgetSchema->setLabel('contatto_string', 'Contatto');
    $this->validatorSchema['data_scadenza']->setOption('required', true);
    $this->validatorSchema['contatto_string']->setOption('required', true);
    $this->validatorSchema['descrizione']->setOption('required', true);

    unset(
      $this['num_fattura'],
      $this['modo_pagamento_id'],
      $this['cliente_id'],
      $this['id_utente'],
      $this['sconto'],
      $this['vat'],
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

  abstract protected function getClassKey();
  
  abstract public function getRoute();
}

