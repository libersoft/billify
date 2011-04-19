<?php

class EntrataForm extends DocumentForm
{
  protected function getClassKey()
  {
    return FatturaPeer::CLASSKEY_ENTRATA;
  }

  public function getModelName()
  {
    return 'Entrata';
  }
  
  public function getRoute()
  {
    return '@document_sales_create';
  }
}
