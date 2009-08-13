<?php

/**
 * payment actions.
 *
 * @package    sf_sandbox
 * @subpackage payment
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class paymentActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->modo_pagamento_list = ModoPagamentoPeer::doSelect(new Criteria());

    if(!count($this->modo_pagamento_list))
    {
      return 'NoResults';
    }
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ModoPagamentoForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new ModoPagamentoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($modo_pagamento = ModoPagamentoPeer::retrieveByPk($request->getParameter('id')), sprintf('Object modo_pagamento does not exist (%s).', $request->getParameter('id')));
    $this->form = new ModoPagamentoForm($modo_pagamento);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($modo_pagamento = ModoPagamentoPeer::retrieveByPk($request->getParameter('id')), sprintf('Object modo_pagamento does not exist (%s).', $request->getParameter('id')));
    $this->form = new ModoPagamentoForm($modo_pagamento);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($modo_pagamento = ModoPagamentoPeer::retrieveByPk($request->getParameter('id')), sprintf('Object modo_pagamento does not exist (%s).', $request->getParameter('id')));
    $modo_pagamento->delete();

    $this->redirect('payment/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $modo_pagamento = $form->save();

      $this->redirect('payment/edit?id='.$modo_pagamento->getId());
    }
  }
}
