<?php

/**
 * taxescode actions.
 *
 * @package    sf_sandbox
 * @subpackage taxescode
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class taxescodeActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->codice_iva_list = CodiceIvaPeer::doSelect(new Criteria());
    
    if(!count($this->codice_iva_list))
    {
      return 'NoResults';
    }
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CodiceIvaForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new CodiceIvaForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($codice_iva = CodiceIvaPeer::retrieveByPk($request->getParameter('id')), sprintf('Object codice_iva does not exist (%s).', $request->getParameter('id')));
    $this->form = new CodiceIvaForm($codice_iva);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($codice_iva = CodiceIvaPeer::retrieveByPk($request->getParameter('id')), sprintf('Object codice_iva does not exist (%s).', $request->getParameter('id')));
    $this->form = new CodiceIvaForm($codice_iva);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($codice_iva = CodiceIvaPeer::retrieveByPk($request->getParameter('id')), sprintf('Object codice_iva does not exist (%s).', $request->getParameter('id')));
    $codice_iva->delete();

    $this->redirect('taxescode/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $codice_iva = $form->save();

      $this->redirect('taxescode/edit?id='.$codice_iva->getId());
    }
  }
}
