<?php



class InvitationCodeMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.InvitationCodeMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('invitation_code');
		$tMap->setPhpName('InvitationCode');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CODICE', 'Codice', 'string', CreoleTypes::VARCHAR, true, 10);

		$tMap->addColumn('INVIATO', 'Inviato', 'string', CreoleTypes::CHAR, true, null);

		$tMap->addColumn('EMAIL', 'Email', 'string', CreoleTypes::VARCHAR, false, 255);

	} 
} 