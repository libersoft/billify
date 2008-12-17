<?php



class ModoPagamentoMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ModoPagamentoMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('modo_pagamento');
		$tMap->setPhpName('ModoPagamento');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ID_UTENTE', 'IdUtente', 'int', CreoleTypes::INTEGER, 'utente', 'ID', false, null);

		$tMap->addColumn('NUM_GIORNI', 'NumGiorni', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('DESCRIZIONE', 'Descrizione', 'string', CreoleTypes::VARCHAR, false, 50);

	} 
} 