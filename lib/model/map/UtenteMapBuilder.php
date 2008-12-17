<?php



class UtenteMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.UtenteMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('utente');
		$tMap->setPhpName('Utente');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('ID_INVITATION_CODE', 'IdInvitationCode', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('USERNAME', 'Username', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('NOME', 'Nome', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('COGNOME', 'Cognome', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('RAGIONE_SOCIALE', 'RagioneSociale', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('PARTITA_IVA', 'PartitaIva', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('CODICE_FISCALE', 'CodiceFiscale', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('EMAIL', 'Email', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('PASSWORD', 'Password', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('DATA_ATTIVAZIONE', 'DataAttivazione', 'int', CreoleTypes::DATE, true, null);

		$tMap->addColumn('DATA_RINNOVO', 'DataRinnovo', 'int', CreoleTypes::DATE, true, null);

		$tMap->addColumn('TIPO', 'Tipo', 'string', CreoleTypes::CHAR, true, null);

		$tMap->addColumn('STATO', 'Stato', 'string', CreoleTypes::CHAR, true, null);

		$tMap->addColumn('FATTURA', 'Fattura', 'string', CreoleTypes::CHAR, true, null);

		$tMap->addColumn('LASTLOGIN', 'Lastlogin', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('APPROVA_CONTRATTO', 'ApprovaContratto', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('APPROVA_POLICY', 'ApprovaPolicy', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('SCONTO', 'Sconto', 'int', CreoleTypes::INTEGER, true, null);

	} 
} 