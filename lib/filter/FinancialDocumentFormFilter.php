<?php

class FinancialDocumentFormFilter extends FatturaFormFilter
{
  public function getRoute()
  {
    return;
  }

  protected function doBuildCriteria(array $values)
  {
    $criteria = new FinancialDocumentCriteria();
    $peer = constant($this->getModelName().'::PEER');

    $fields = $this->getFields();

    // add those fields that are not represented in getFields() with a null type
    $names = array_merge($fields, array_diff(array_keys($this->validatorSchema->getFields()), array_keys($fields)));
    $fields = array_merge($fields, array_combine($names, array_fill(0, count($names), null)));

    foreach ($fields as $field => $type)
    {
      if (!isset($values[$field]) || null === $values[$field] || '' === $values[$field])
      {
        continue;
      }

      try
      {
        $method = sprintf('add%sColumnCriteria', call_user_func(array($peer, 'translateFieldName'), $field, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_PHPNAME));
      }
      catch (Exception $e)
      {
        // not a "real" column
        if (!method_exists($this, $method = sprintf('add%sColumnCriteria', self::camelize($field))))
        {
          throw new LogicException(sprintf('You must define a "%s" method to be able to filter with the "%s" field.', $method, $field));
        }
      }

      if (method_exists($this, $method))
      {
        $this->$method($criteria, $field, $values[$field]);
      }
      else
      {
        if (!method_exists($this, $method = sprintf('add%sCriteria', $type)))
        {
          throw new LogicException(sprintf('Unable to filter for the "%s" type.', $type));
        }

        $this->$method($criteria, $field, $values[$field]);
      }
    }

    return $criteria;
  }
}
