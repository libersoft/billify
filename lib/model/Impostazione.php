<?php

class Impostazione extends BaseImpostazione
{

  public function getBoolCodiceCliente()
  {
    if ($this->codice_cliente == 's')
    {
      return true;
    }

    return false;
  }

  public function getBoolDepositaIva()
  {
    if ($this->deposita_iva == 's')
    {
      return true;
    }
    
    return false;
  }

  public function getBoolRiepilogoHome()
  {
    if ($this->riepilogo_home == 's')
    {
      return true;
    }
    
    return false;
  }

  public function getBoolFatturaAutomatica()
  {
    if ($this->fattura_automatica == 's')
    {
      return true;
    }
    
    return false;
  }

  public function getBoolConsegnaCommercialista()
  {
    if ($this->consegna_commercialista == 's')
    {
      return true;
    }
    
    return false;
  }

  public function setInvoiceDecoratorType($v)
  {
    if (!isset(ImpostazionePeer::$available_decorator_classes[$v]))
    {
      throw new Exception('Invalid invoice decorator class');
    }

    parent::setInvoiceDecoratorType($v);
  }

  public function getInvoiceDecorator(Vendita $invoice)
  {
    $class_name = ImpostazionePeer::$available_decorator_classes[$this->invoice_decorator_type];
    return new $class_name($invoice);
  }

}
