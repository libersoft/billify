<?php

/**
 * Paypal form base class.
 *
 * @package    form
 * @subpackage paypal
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BasePaypalForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'date'            => new sfWidgetFormDateTime(),
      'item_name'       => new sfWidgetFormInput(),
      'receiver_email'  => new sfWidgetFormInput(),
      'item_number'     => new sfWidgetFormInput(),
      'quantity'        => new sfWidgetFormInput(),
      'id_utente'       => new sfWidgetFormInput(),
      'payment_status'  => new sfWidgetFormInput(),
      'pending_reason'  => new sfWidgetFormInput(),
      'payment_gross'   => new sfWidgetFormInput(),
      'payment_fee'     => new sfWidgetFormInput(),
      'payment_type'    => new sfWidgetFormInput(),
      'payment_date'    => new sfWidgetFormInput(),
      'txn_id'          => new sfWidgetFormInput(),
      'payer_email'     => new sfWidgetFormInput(),
      'payer_status'    => new sfWidgetFormInput(),
      'txn_type'        => new sfWidgetFormInput(),
      'first_name'      => new sfWidgetFormInput(),
      'last_name'       => new sfWidgetFormInput(),
      'address_city'    => new sfWidgetFormInput(),
      'address_street'  => new sfWidgetFormInput(),
      'address_state'   => new sfWidgetFormInput(),
      'address_zip'     => new sfWidgetFormInput(),
      'address_country' => new sfWidgetFormInput(),
      'address_status'  => new sfWidgetFormInput(),
      'subscr_date'     => new sfWidgetFormInput(),
      'period1'         => new sfWidgetFormInput(),
      'period2'         => new sfWidgetFormInput(),
      'period3'         => new sfWidgetFormInput(),
      'amount1'         => new sfWidgetFormInput(),
      'amount2'         => new sfWidgetFormInput(),
      'amount3'         => new sfWidgetFormInput(),
      'recurring'       => new sfWidgetFormInput(),
      'reattempt'       => new sfWidgetFormInput(),
      'retry_at'        => new sfWidgetFormInput(),
      'recur_times'     => new sfWidgetFormInput(),
      'subscr_id'       => new sfWidgetFormInput(),
      'entirepost'      => new sfWidgetFormTextarea(),
      'paypal_verified' => new sfWidgetFormInput(),
      'verify_sign'     => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorPropelChoice(array('model' => 'Paypal', 'column' => 'id', 'required' => false)),
      'date'            => new sfValidatorDateTime(array('required' => false)),
      'item_name'       => new sfValidatorString(array('max_length' => 130, 'required' => false)),
      'receiver_email'  => new sfValidatorString(array('max_length' => 125, 'required' => false)),
      'item_number'     => new sfValidatorString(array('max_length' => 130, 'required' => false)),
      'quantity'        => new sfValidatorInteger(array('required' => false)),
      'id_utente'       => new sfValidatorInteger(array('required' => false)),
      'payment_status'  => new sfValidatorString(array('required' => false)),
      'pending_reason'  => new sfValidatorString(array('required' => false)),
      'payment_gross'   => new sfValidatorNumber(array('required' => false)),
      'payment_fee'     => new sfValidatorNumber(array('required' => false)),
      'payment_type'    => new sfValidatorString(array('required' => false)),
      'payment_date'    => new sfValidatorString(array('max_length' => 50)),
      'txn_id'          => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'payer_email'     => new sfValidatorString(array('max_length' => 125, 'required' => false)),
      'payer_status'    => new sfValidatorString(array('max_length' => 255)),
      'txn_type'        => new sfValidatorString(array('max_length' => 255)),
      'first_name'      => new sfValidatorString(array('max_length' => 35, 'required' => false)),
      'last_name'       => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'address_city'    => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'address_street'  => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'address_state'   => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'address_zip'     => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'address_country' => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'address_status'  => new sfValidatorString(array('max_length' => 255)),
      'subscr_date'     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'period1'         => new sfValidatorString(array('max_length' => 20)),
      'period2'         => new sfValidatorString(array('max_length' => 20)),
      'period3'         => new sfValidatorString(array('max_length' => 20)),
      'amount1'         => new sfValidatorNumber(),
      'amount2'         => new sfValidatorNumber(),
      'amount3'         => new sfValidatorNumber(),
      'recurring'       => new sfValidatorInteger(),
      'reattempt'       => new sfValidatorInteger(),
      'retry_at'        => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'recur_times'     => new sfValidatorInteger(),
      'subscr_id'       => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'entirepost'      => new sfValidatorString(array('required' => false)),
      'paypal_verified' => new sfValidatorString(array('max_length' => 255)),
      'verify_sign'     => new sfValidatorString(array('max_length' => 125, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('paypal[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Paypal';
  }


}
