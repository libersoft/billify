<?php

/**
 * Contatto form.
 *
 * @package    form
 * @subpackage contatto
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class ContattoForm extends BaseContattoForm
{
  public function configure()
  {
    $this->widgetSchema->setFormFormatterName('table');
  }
}
