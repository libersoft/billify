<?php

/**
 * Fattura form.
 *
 * @package    form
 * @subpackage fattura
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class FatturaForm extends BaseFatturaForm
{
  public function configure()
  {
    $widget_schema = $this->getWidgetSchema();
    $widget_schema['data'] = new sfWidgetFormDate(array('format' => '%day%/%month%/%year%'));
    $widget_schema['data_scadenza'] = new sfWidgetFormDate(array('format' => '%day%/%month%/%year%'));

    unset($this['anno']);
    }
}
