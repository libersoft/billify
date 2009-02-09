<?php



class FatturaMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.FatturaMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('fattura');
		$tMap->setPhpName('Fattura');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ID_UTENTE', 'IdUtente', 'int', CreoleTypes::INTEGER, 'utente', 'ID', true, null);

		$tMap->addColumn('NUM_FATTURA', 'NumFattura', 'string', CreoleTypes::VARCHAR, true, 10);

		$tMap->addForeignKey('CLIENTE_ID', 'ClienteId', 'int', CreoleTypes::INTEGER, 'contatto', 'ID', true, null);

		$tMap->addColumn('DATA', 'Data', 'int', CreoleTypes::DATE, true, null);

		$tMap->addColumn('DATA_STATO', 'DataStato', 'int', CreoleTypes::DATE, false, null);

		$tMap->addForeignKey('MODO_PAGAMENTO_ID', 'ModoPagamentoId', 'int', CreoleTypes::INTEGER, 'modo_pagamento', 'ID', false, null);

		$tMap->addColumn('SCONTO', 'Sconto', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('VAT', 'Vat', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SPESE_ANTICIPATE', 'SpeseAnticipate', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('IMPOSTE', 'Imposte', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('IMPONIBILE', 'Imponibile', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('STATO', 'Stato', 'string', CreoleTypes::CHAR, false, null);

		$tMap->addColumn('IVA_PAGATA', 'IvaPagata', 'string', CreoleTypes::CHAR, false, null);

		$tMap->addColumn('IVA_DEPOSITATA', 'IvaDepositata', 'string', CreoleTypes::CHAR, false, null);

		$tMap->addColumn('COMMERCIALISTA', 'Commercialista', 'string', CreoleTypes::CHAR, false, null);

		$tMap->addColumn('NOTE', 'Note', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CALCOLA_RITENUTA_ACCONTO', 'CalcolaRitenutaAcconto', 'string', CreoleTypes::CHAR, false, null);

		$tMap->addColumn('INCLUDI_TASSE', 'IncludiTasse', 'string', CreoleTypes::CHAR, false, null);

		$tMap->addColumn('CALCOLA_TASSE', 'CalcolaTasse', 'string', CreoleTypes::CHAR, false, null);

		$tMap->addColumn('CLASS_KEY', 'ClassKey', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 