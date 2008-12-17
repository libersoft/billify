<?php



class ImpostazioneMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ImpostazioneMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('impostazione');
		$tMap->setPhpName('Impostazione');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID_UTENTE', 'IdUtente', 'int' , CreoleTypes::INTEGER, 'utente', 'ID', true, null);

		$tMap->addColumn('NUM_CLIENTI', 'NumClienti', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NUM_FATTURE', 'NumFatture', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('RIGHE_DETTAGLI', 'RigheDettagli', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('RITENUTA_ACCONTO', 'RitenutaAcconto', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('TIPO_RITENUTA', 'TipoRitenuta', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('RIEPILOGO_HOME', 'RiepilogoHome', 'string', CreoleTypes::CHAR, true, null);

		$tMap->addColumn('CONSEGNA_COMMERCIALISTA', 'ConsegnaCommercialista', 'string', CreoleTypes::CHAR, true, null);

		$tMap->addColumn('DEPOSITA_IVA', 'DepositaIva', 'string', CreoleTypes::CHAR, true, null);

		$tMap->addColumn('FATTURA_AUTOMATICA', 'FatturaAutomatica', 'string', CreoleTypes::CHAR, true, null);

		$tMap->addColumn('CODICE_CLIENTE', 'CodiceCliente', 'string', CreoleTypes::CHAR, true, null);

		$tMap->addColumn('LABEL_IMPONIBILE', 'LabelImponibile', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('LABEL_SPESE', 'LabelSpese', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('LABEL_IMPONIBILE_IVA', 'LabelImponibileIva', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('LABEL_IVA', 'LabelIva', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('LABEL_TOTALE_FATTURA', 'LabelTotaleFattura', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('LABEL_RITENUTA_ACCONTO', 'LabelRitenutaAcconto', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('LABEL_NETTO_LIQUIDARE', 'LabelNettoLiquidare', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('LABEL_QUANTITA', 'LabelQuantita', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('LABEL_DESCRIZIONE', 'LabelDescrizione', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('LABEL_PREZZO_SINGOLO', 'LabelPrezzoSingolo', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('LABEL_PREZZO_TOTALE', 'LabelPrezzoTotale', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('LABEL_SCONTO', 'LabelSconto', 'string', CreoleTypes::VARCHAR, true, 255);

	} 
} 