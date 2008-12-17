<?php



class PaginaMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PaginaMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('pagina');
		$tMap->setPhpName('Pagina');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TITOLO', 'Titolo', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('CORPO', 'Corpo', 'string', CreoleTypes::LONGVARCHAR, true, null);

	} 
} 