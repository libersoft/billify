<?php

class UscitaForm extends DocumentForm
{
  protected function getClassKey()
  {
    return FatturaPeer::CLASSKEY_USCITA;
  }
  
  public function getModelName()
  {
    return 'Uscita';
  }
  
  public function getRoute()
  {
    return '@document_purchase_create';
  }
}
