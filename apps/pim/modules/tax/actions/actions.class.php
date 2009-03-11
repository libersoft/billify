<?php

/**
 * tax actions.
 *
 * @package    sf_sandbox
 * @subpackage tax
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class taxActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->tassa_list = TassaPeer::doSelect(new Criteria());
    
    if(!count($this->tassa_list))
    {
      return 'NoResults';
    }
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TassaForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new TassaForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($tassa = TassaPeer::retrieveByPk($request->getParameter('id')), sprintf('Object tassa does not exist (%s).', $request->getParameter('id')));
    $this->form = new TassaForm($tassa);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($tassa = TassaPeer::retrieveByPk($request->getParameter('id')), sprintf('Object tassa does not exist (%s).', $request->getParameter('id')));
    $this->form = new TassaForm($tassa);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($tassa = TassaPeer::retrieveByPk($request->getParameter('id')), sprintf('Object tassa does not exist (%s).', $request->getParameter('id')));
    $tassa->delete();

    $this->redirect('tax/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $tassa = $form->getObject();
      $tassa->setIdUtente($this->getUser()->getId());
      $form->save();

      $this->redirect('tax/edit?id='.$tassa->getId());
    }
  }
}
