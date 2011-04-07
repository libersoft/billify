<?php

class Vendita extends Fattura
{
  
  const PEER = 'VenditaPeer';

  private $with_holding_tax_percentage = '0/100';
  private $max;
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
  
  public function applyDefaultValues()
  {
    parent::applyDefaultValues();
    $this->setNewNumFattura();
  }

  protected function validation($columns = null)
  {
    if (!$this->validate)
    {
      return;
    }
    
    $num_fattura_validator = new sfValidatorPropelUnique(array('model' => 'Fattura', 'column' => array('num_fattura', 'anno')));
    $num_fattura_validator->clean(array('id' => $this->getId(), 'num_fattura' => $this->num_fattura, 'anno' => $this->getAnno()));

    if ($this->isProForma())
    {
      return;
    }
    
    $criteria = new Criteria();
    $c1 = $criteria->getNewCriterion(FatturaPeer::NUM_FATTURA, $this->num_fattura-1);
    $c2 = $criteria->getNewCriterion(FatturaPeer::DATA, $this->getData(), Criteria::GREATER_THAN);

    $c1->addAnd($c2);
    $criteria->add($c1);

    $c3 = $criteria->getNewCriterion(FatturaPeer::NUM_FATTURA, $this->num_fattura+1);
    $c4 = $criteria->getNewCriterion(FatturaPeer::DATA, $this->getData(), Criteria::LESS_THAN);

    $c3->addAnd($c4);
    $criteria->addOr($c3);
    $criteria->addAnd(FatturaPeer::NUM_FATTURA, 0, Criteria::NOT_EQUAL);
    $criteria->addAnd(FatturaPeer::ANNO, $this->getData('Y'), Criteria::EQUAL);

    
    if (FatturaPeer::doCount($criteria) > 0)
    {
      throw new Exception('1 - Some errors occured with '.$this->num_fattura);
    };

    if ($this->max && ($this->num_fattura - $this->max) > 1)
    {
      throw new Exception('2 - Some errors occurred with '.$this->num_fattura);
    }
    
  }
  
  public function save(PropelPDO $con = null)
  {
    $this->setAnno(date('Y', $this->getData('U')));
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
    if ($this->id_utente)
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
