<?php



class DettagliFatturaMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DettagliFatturaMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('dettagli_fattura');
		$tMap->setPhpName('DettagliFattura');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('FATTURA_ID', 'FatturaId', 'int', CreoleTypes::INTEGER, 'fattura', 'ID', true, null);

		$tMap->addColumn('DESCRIZIONE', 'Descrizione', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('QTY', 'Qty', 'string', CreoleTypes::VARCHAR, true, 10);

		$tMap->addColumn('SCONTO', 'Sconto', 'string', CreoleTypes::VARCHAR, true, 10);

		$tMap->addColumn('IVA', 'Iva', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PREZZO', 'Prezzo', 'string', CreoleTypes::VARCHAR, true, 50);

	} 
} 