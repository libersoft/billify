<?php



class ProdottoMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ProdottoMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('prodotto');
		$tMap->setPhpName('Prodotto');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ID_UTENTE', 'IdUtente', 'int', CreoleTypes::INTEGER, 'utente', 'ID', true, null);

		$tMap->addColumn('CODICE', 'Codice', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('NOME', 'Nome', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('PREZZO', 'Prezzo', 'double', CreoleTypes::FLOAT, true, null);

	} 
} 