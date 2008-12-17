<?php



class TassaMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TassaMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('tassa');
		$tMap->setPhpName('Tassa');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ID_UTENTE', 'IdUtente', 'int', CreoleTypes::INTEGER, 'utente', 'ID', true, null);

		$tMap->addColumn('NOME', 'Nome', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('VALORE', 'Valore', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('DESCRIZIONE', 'Descrizione', 'string', CreoleTypes::VARCHAR, true, 255);

	} 
} 