<?php



class TemaFatturaMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TemaFatturaMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('tema_fattura');
		$tMap->setPhpName('TemaFattura');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ID_UTENTE', 'IdUtente', 'int', CreoleTypes::INTEGER, 'utente', 'ID', true, null);

		$tMap->addColumn('NOME', 'Nome', 'string', CreoleTypes::VARCHAR, true, 100);

		$tMap->addColumn('TEMPLATE', 'Template', 'string', CreoleTypes::LONGVARCHAR, true, null);

		$tMap->addColumn('CSS', 'Css', 'string', CreoleTypes::LONGVARCHAR, true, null);

		$tMap->addColumn('LOGO', 'Logo', 'string', CreoleTypes::VARCHAR, false, 255);

	} 
} 