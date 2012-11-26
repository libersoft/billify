<?php

class categoriaComponents extends paComponents
{
  public function executeEditBread()
  {
    $this->categoria = CategoriaPeer::retrieveByPK($this->getRequestParameter('id'));
  }
}
