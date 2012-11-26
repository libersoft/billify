<?php

/**
 * payment actions.
 *
 * @package    sf_sandbox
 * @subpackage categoria
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class categoriaActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->categoria_list = CategoriaPeer::doSelect(new Criteria());

    if(!count($this->categoria_list))
    {
      return 'NoResults';
    }
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CategoriaForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new CategoriaForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($categoria = CategoriaPeer::retrieveByPk($request->getParameter('id')), sprintf('Object categoria does not exist (%s).', $request->getParameter('id')));
    $this->form = new CategoriaForm($categoria);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($categoria = CategoriaPeer::retrieveByPk($request->getParameter('id')), sprintf('Object categoria does not exist (%s).', $request->getParameter('id')));
    $this->form = new CategoriaForm($categoria);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($categoria = CategoriaPeer::retrieveByPk($request->getParameter('id')), sprintf('Object categoria does not exist (%s).', $request->getParameter('id')));
    $categoria->delete();

    $this->redirect('categoria/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $categoria = $form->getObject();
      $form->save();

      $this->redirect('categoria/edit?id='.$categoria->getId());
    }
  }
}
