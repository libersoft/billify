<?php



class BugMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.BugMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('bug');
		$tMap->setPhpName('Bug');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ID_UTENTE', 'IdUtente', 'int', CreoleTypes::INTEGER, 'utente', 'ID', true, null);

		$tMap->addColumn('PRIORITA', 'Priorita', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('MODULO', 'Modulo', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('TESTO', 'Testo', 'string', CreoleTypes::LONGVARCHAR, true, null);

		$tMap->addColumn('DATA', 'Data', 'int', CreoleTypes::DATE, true, null);

		$tMap->addColumn('STATO', 'Stato', 'string', CreoleTypes::VARCHAR, true, 255);

	} 
} 