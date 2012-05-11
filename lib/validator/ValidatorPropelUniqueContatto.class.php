<?php

class sfValidatorPropelUniqueContatto extends sfValidatorPropelUnique
{
  protected function doClean($values)
  {
    if (!is_array($values))
    {
      throw new InvalidArgumentException('You must pass an array parameter to the clean() method (this validator can only be used as a post validator).');
    }

    if (!is_array($this->getOption('column')))
    {
      $this->setOption('column', array($this->getOption('column')));
    }
    $columns = $this->getOption('column');

    if (!is_array($field = $this->getOption('field')))
    {
      $this->setOption('field', $field ? array($field) : array());
    }
    $fields = $this->getOption('field');

    $criteria = new Criteria();
    // validation based on contact class
    $criteria -> add('class_key', $values['class_key']);
    foreach ($columns as $i => $column)
    {
      $name = isset($fields[$i]) ? $fields[$i] : $column;
      if (!array_key_exists($name, $values))
      {
        // one of the columns has be removed from the form
        return $values;
      }

      $colName = call_user_func(array(constant($this->getOption('model').'::PEER'), 'translateFieldName'), $column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);

      if(!empty($values[$name]))
      {
        // validation only on non empty values
        $criteria->add($colName, $values[$name]);
      }
    }

    $object = call_user_func(array(constant($this->getOption('model').'::PEER'), 'doSelectOne'), $criteria, $this->getOption('connection'));

    // if no object or if we're updating the object, it's ok
    if (null === $object || $this->isUpdate($object, $values))
    {
      return $values;
    }

    $error = new sfValidatorError($this, 'invalid', array('column' => implode(', ', $this->getOption('column'))));

    if ($this->getOption('throw_global_error'))
    {
      throw $error;
    }

    throw new sfValidatorErrorSchema($this, array(isset($fields[0]) ? $fields[0] : $columns[0] => $error));
  }
}
