<?php

/**
 * sfValidatorSchemaCompare
 *
 * @package    ideato.lib
 * @subpackage validator
 * @version    0.1
 */
class sfValidatorSchemaConditional extends sfValidatorSchema
{
 /**
   * Constructor.
   *
   * Available options:
   *
   *  * left_field:         The left field name
   *  * operator:           The comparison operator
   *                          * self::EQUAL
   *                          * self::NOT_EQUAL
   *                          * self::LESS_THAN
   *                          * self::LESS_THAN_EQUAL
   *                          * self::GREATER_THAN
   *                          * self::GREATER_THAN_EQUAL
   *  * right_field:        The right field name
   *  * throw_global_error: Whether to throw a global error (false by default) or an error tied to the left field
   *
   * @param string $leftField   The left field name
   * @param string $operator    The operator to apply
   * @param string $rightField  The right field name
   * @param array  $options     An array of options
   * @param array  $messages    An array of error messages
   *
   * @see sfValidatorBase
   */
  public function __construct($radioField, $validatorArray, $options = array(), $messages = array())
  {
    if (!is_array($validatorArray)) {
      throw new InvalidArgumentException('$validatorArray is not an array');
    }

    $this->addOption('radio_field', $radioField);
    $this->addOption('validator_array', $validatorArray);

    $this->addOption('throw_global_error', false);

    parent::__construct(null, $options, $messages);
  }

  /**
   * @see sfValidatorBase
   */
  protected function doClean($values)
  {
    if (is_null($values)) {
      $values = array();
    }

    if (!is_array($values)) {
      throw new InvalidArgumentException('You must pass an array parameter to the clean() method');
    }

    $radioValue = isset($values[$this->getOption('radio_field')]) ? $values[$this->getOption('radio_field')] : null;

    $validator_array = $this->getOptions('validator_array');

    $checkedValidator = $validator_array['validator_array'][$radioValue];

    $errors = array();

    if ($checkedValidator) {
      foreach($checkedValidator as $field => $validator){
        $fieldValue = isset($values[$field]) ? $values[$field] : null;

        if (is_null($fieldValue)) {
          throw new sfValidatorError($this, 'no value for '.$field);
        }

        try{
          $fieldValue = $validator->clean($fieldValue);
        }
        catch (sfValidatorError $e){
          throw new sfValidatorError($this, $field.' did not validate. Field validator says: '.$e);
        }
      }
    }

    return $values;
  }
}