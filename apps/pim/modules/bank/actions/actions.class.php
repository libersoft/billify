<?php

/**
 * bank actions.
 *
 * @package    sf_sandbox
 * @subpackage bank
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class bankActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->banca_list = BancaPeer::doSelect(new Criteria());
    
    if(!count($this->banca_list))
    {
      return 'NoResults';
    }
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new BancaForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new BancaForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($banca = BancaPeer::retrieveByPk($request->getParameter('id')), sprintf('Object banca does not exist (%s).', $request->getParameter('id')));
    $this->form = new BancaForm($banca);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($banca = BancaPeer::retrieveByPk($request->getParameter('id')), sprintf('Object banca does not exist (%s).', $request->getParameter('id')));
    $this->form = new BancaForm($banca);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($banca = BancaPeer::retrieveByPk($request->getParameter('id')), sprintf('Object banca does not exist (%s).', $request->getParameter('id')));
    $banca->delete();

    $this->redirect('bank/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $banca = $form->save();

      $this->redirect('bank/edit?id='.$banca->getId());
    }
  }
}
