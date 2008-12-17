<?php



class TagsFatturaMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TagsFatturaMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('tags_fattura');
		$tMap->setPhpName('TagsFattura');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ID_FATTURA', 'IdFattura', 'int', CreoleTypes::INTEGER, 'fattura', 'ID', true, null);

		$tMap->addForeignKey('ID_UTENTE', 'IdUtente', 'int', CreoleTypes::INTEGER, 'utente', 'ID', true, null);

		$tMap->addColumn('TAG', 'Tag', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('TAG_NORMALIZZATO', 'TagNormalizzato', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('DATA', 'Data', 'int', CreoleTypes::DATE, true, null);

	} 
} 