<?php



class BancaMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.BancaMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('banca');
		$tMap->setPhpName('Banca');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ID_UTENTE', 'IdUtente', 'int', CreoleTypes::INTEGER, 'utente', 'ID', true, null);

		$tMap->addColumn('ABI', 'Abi', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('CAB', 'Cab', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('CIN', 'Cin', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('IBAN', 'Iban', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('NUMERO_CONTO', 'NumeroConto', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('NOME_BANCA', 'NomeBanca', 'string', CreoleTypes::VARCHAR, true, 255);

	} 
} 