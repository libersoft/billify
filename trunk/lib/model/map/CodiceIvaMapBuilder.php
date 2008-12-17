<?php



class CodiceIvaMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.CodiceIvaMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('codice_iva');
		$tMap->setPhpName('CodiceIva');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ID_UTENTE', 'IdUtente', 'int', CreoleTypes::INTEGER, 'utente', 'ID', false, null);

		$tMap->addColumn('NOME', 'Nome', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('VALORE', 'Valore', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('DESCRIZIONE', 'Descrizione', 'string', CreoleTypes::LONGVARCHAR, true, null);

	} 
} 