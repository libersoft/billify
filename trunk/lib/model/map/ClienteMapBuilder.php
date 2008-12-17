<?php



class ClienteMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ClienteMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('cliente');
		$tMap->setPhpName('Cliente');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ID_UTENTE', 'IdUtente', 'int', CreoleTypes::INTEGER, 'utente', 'ID', true, null);

		$tMap->addColumn('AZIENDA', 'Azienda', 'string', CreoleTypes::CHAR, true, null);

		$tMap->addColumn('RAGIONE_SOCIALE', 'RagioneSociale', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('VIA', 'Via', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('CITTA', 'Citta', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('PROVINCIA', 'Provincia', 'string', CreoleTypes::VARCHAR, false, 5);

		$tMap->addColumn('CAP', 'Cap', 'string', CreoleTypes::VARCHAR, false, 5);

		$tMap->addColumn('PIVA', 'Piva', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('CF', 'Cf', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('COGNOME', 'Cognome', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('NOME', 'Nome', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('TELEFONO', 'Telefono', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('FAX', 'Fax', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('CELLULARE', 'Cellulare', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('EMAIL', 'Email', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addForeignKey('MODO_PAGAMENTO_ID', 'ModoPagamentoId', 'int', CreoleTypes::INTEGER, 'modo_pagamento', 'ID', false, null);

		$tMap->addColumn('STATO', 'Stato', 'string', CreoleTypes::CHAR, true, null);

		$tMap->addColumn('NOTE', 'Note', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignKey('ID_TEMA_FATTURA', 'IdTemaFattura', 'int', CreoleTypes::INTEGER, 'tema_fattura', 'ID', false, null);

		$tMap->addForeignKey('ID_BANCA', 'IdBanca', 'int', CreoleTypes::INTEGER, 'banca', 'ID', false, null);

		$tMap->addColumn('CALCOLA_RITENUTA_ACCONTO', 'CalcolaRitenutaAcconto', 'string', CreoleTypes::CHAR, true, null);

		$tMap->addColumn('INCLUDI_TASSE', 'IncludiTasse', 'string', CreoleTypes::CHAR, true, null);

		$tMap->addColumn('CALCOLA_TASSE', 'CalcolaTasse', 'string', CreoleTypes::CHAR, true, null);

		$tMap->addColumn('COD', 'Cod', 'string', CreoleTypes::VARCHAR, false, 255);

	} 
} 