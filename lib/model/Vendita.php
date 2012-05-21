<?php

class Vendita extends Fattura
{
  
  const PEER = 'VenditaPeer';

  private $with_holding_tax_percentage = '0/100';
  private $max = false;
  private $validate = true;
  
  public function __construct()
  {
    parent::__construct();
    $this->setClassKey(FatturaPeer::CLASSKEY_1);
  }

  public function setValidate($v)
  {
    $this->validate = $v;
  }

  protected function validation($columns = null)
  {
    if (!$this->validate || $this->isProForma())
    {
      return;
    }

    try
    {
      $num_fattura_validator = new sfValidatorPropelUnique(array('model' => 'Vendita', 'column' => array('num_fattura', 'anno', 'class_key')));
      $num_fattura_validator->clean(array('id' => $this->getId(), 'num_fattura' => $this->num_fattura, 'anno' => $this->getAnno(), 'class_key' => $this->class_key));
    }
    catch(sfValidatorError $e)
    {
      throw new Exception('Esiste già una fattura con lo stesso numero');
    }

    try
    {
      $validator = new ValidatorDateInvoice();
      $validator->clean(array('num_fattura' => $this->num_fattura, 'data' => $this->getData(), 'anno' => $this->getData('Y'), 'class_key' => $this->class_key));

    }
    catch(sfValidatorError $e)
    {
      throw new Exception('La data della fattura deve essere consecutiva alle fatture già emesse');
    }

    try
    {
      $validator = new ValidatorConsecutiveInvoiceNumber(array('latest' => $this->max, 'is_new' => $this->isNew()));
      $validator->clean($this->num_fattura);
    }
    catch(sfValidatorError $e)
    {
      throw new Exception('Il numero della fattura '.$this->num_fattura.' deve essere consecutivo all\'ultimo numero emesso '.$this->max);
    }
    
  }
  
  public function save(PropelPDO $con = null)
  {
    $this->setDataScadenza($this->getDataPagamento());

    $this->validation();
    return parent::save($con);
  }
  
  public function getRoutingRule()
  {
      return 'fattura/show';
  }

  public function addToCashFlow(CashFlow $cf)
  {
    $this->calcolaFattura();
    if (!$this->getDataScadenza())
    {
      $this->save();
    }
    $cash_flow_vendita = new CashFlowSalesAdapter($this);
    $cf->addIncoming($cash_flow_vendita);
  }

  public function getPlainNumFattura()
  {
    return $this->num_fattura;
  }

  public function  getNumberDecorated()
  {
    if ($this->id_utente && $this->getUtente()->getImpostazione())
    {
      return $this->getUtente()->getImpostazione()->getInvoiceDecorator($this)->getNumFattura();
    }

    return $this->num_fattura;
  }

  public function checkWithHoldingTax()
  {
    list($percentage,) = explode('/', $this->with_holding_tax_percentage);
    
    if ($this->getCalcolaRitenutaAcconto() == 'n' || 
       ($this->getCliente() && ($this->getCliente()->getAzienda() != 's' || $this->getCliente()->getCalcolaRitenutaAcconto() == 'n')) ||
       0 === (int)$percentage)
    {
      return false;
    }
    return true;
  }

  public function getWithHoldingTaxPercentage()
  {
    return $this->with_holding_tax_percentage;
  }

  public function setWithHoldingTaxPercentage($v)
  {
    $this->with_holding_tax_percentage = $v;
  }

  public function calcolaFattura($tasse_ulteriori = array(), $tipo_ritenuta = null, $ritenuta_acconto = null)
  {
    $this->setWithHoldingTaxPercentage($ritenuta_acconto);
    parent::calcolaFattura($tasse_ulteriori, $tipo_ritenuta, $ritenuta_acconto);
  }

  public function reset()
  {
    $this->calcola = false;
    $this->imponibile = 0;
    $this->imponibile_scorporato = 0;
    $this->imponibile_fine_iva = 0;
    $this->sconto_totale = 0;
    $this->tasse_ulteriori = array();
    $this->tasse_ulteriori_array = array();
    $this->ritenuta_acconto = 0;
    $this->iva = 0;
    $this->totale = 0;
    $this->calcola = false;
    $this->tipo_ritenuta;
    $this->costo_tasse_ulteriori = 0;
  }

  public function setNewNumFattura()
  {
    $con = Propel::getConnection();
    $year = date('y', time());
    $num_fattura = 1;
    $data = time();

    //Select Invoice whit max ID
    if ($this->getData() != "")
    {
      $year = date('y', strtotime($this->getData()));
    }

    $query = 'SELECT MAX(CAST(' . FatturaPeer::NUM_FATTURA . ' AS UNSIGNED)) as max'
            .' FROM ' . FatturaPeer::TABLE_NAME
            .' WHERE ' . FatturaPeer::DATA . '>= "' . date('y-m-d', mktime(0, 0, 0, 1, 1, $year)) . '"'
            .' AND ' . FatturaPeer::DATA . ' <= "' . date('y-m-d', mktime(0, 0, 0, 12, 31, $year)) . '"'
            .' AND ' . FatturaPeer::CLASS_KEY . ' = ' . FatturaPeer::CLASSKEY_VENDITA;

    if(FatturaPeer::retrieveUserId())
    {
      $query .= ' AND ' . FatturaPeer::ID_UTENTE . '=' . FatturaPeer::retrieveUserId();
    }

    if (!$this->isNew())
    {
      $query .= ' AND '.FatturaPeer::NUM_FATTURA.' <> '.$this->num_fattura;
    }

    $stmt = $con->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $max = $row['max'];
    $this->max = $max;

    //Select Num Fattura and date of Invoice with Max ID
    if ($max != "")
    {
      $query2 = 'SELECT ' . VenditaPeer::ID . ' as id,' . VenditaPeer::DATA . ' as data'
               .' FROM ' . VenditaPeer::TABLE_NAME
               .' WHERE ' . FatturaPeer::NUM_FATTURA . '=' . $max
               .' AND ' . FatturaPeer::DATA . '>= "' . date('y-m-d', mktime(0, 0, 0, 1, 1, $year)) . '"'
               .' AND ' . FatturaPeer::DATA . ' <= "' . date('y-m-d', mktime(0, 0, 0, 12, 31, $year)) . '"'
               .' AND ' . FatturaPeer::CLASS_KEY . ' = ' . FatturaPeer::CLASSKEY_VENDITA;

      if(FatturaPeer::retrieveUserId())
      {
        $query2 .= ' AND ' . FatturaPeer::ID_UTENTE . '=' . FatturaPeer::retrieveUserId();
      }

      $stmt = $con->prepare($query2);
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $id_fattura = $row['id'];
      $data_fattura = $row['data'];

      $num_fattura = $max;
      $data = $data_fattura;

      $num_fattura = $num_fattura + 1;
    }

    $this->setData($data);
    $this->setNumFattura($num_fattura);
  }
}
