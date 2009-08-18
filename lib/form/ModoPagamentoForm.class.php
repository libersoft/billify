<?php

/**
 * ModoPagamento form.
 *
 * @package    form
 * @subpackage modo_pagamento
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class ModoPagamentoForm extends BaseModoPagamentoForm
{
  public function configure()
  {
    unset(
      $this['id_utente']
    );
  }
}
