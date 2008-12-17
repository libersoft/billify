<?php


abstract class BaseImpostazionePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'impostazione';

	
	const CLASS_DEFAULT = 'lib.model.Impostazione';

	
	const NUM_COLUMNS = 23;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID_UTENTE = 'impostazione.ID_UTENTE';

	
	const NUM_CLIENTI = 'impostazione.NUM_CLIENTI';

	
	const NUM_FATTURE = 'impostazione.NUM_FATTURE';

	
	const RIGHE_DETTAGLI = 'impostazione.RIGHE_DETTAGLI';

	
	const RITENUTA_ACCONTO = 'impostazione.RITENUTA_ACCONTO';

	
	const TIPO_RITENUTA = 'impostazione.TIPO_RITENUTA';

	
	const RIEPILOGO_HOME = 'impostazione.RIEPILOGO_HOME';

	
	const CONSEGNA_COMMERCIALISTA = 'impostazione.CONSEGNA_COMMERCIALISTA';

	
	const DEPOSITA_IVA = 'impostazione.DEPOSITA_IVA';

	
	const FATTURA_AUTOMATICA = 'impostazione.FATTURA_AUTOMATICA';

	
	const CODICE_CLIENTE = 'impostazione.CODICE_CLIENTE';

	
	const LABEL_IMPONIBILE = 'impostazione.LABEL_IMPONIBILE';

	
	const LABEL_SPESE = 'impostazione.LABEL_SPESE';

	
	const LABEL_IMPONIBILE_IVA = 'impostazione.LABEL_IMPONIBILE_IVA';

	
	const LABEL_IVA = 'impostazione.LABEL_IVA';

	
	const LABEL_TOTALE_FATTURA = 'impostazione.LABEL_TOTALE_FATTURA';

	
	const LABEL_RITENUTA_ACCONTO = 'impostazione.LABEL_RITENUTA_ACCONTO';

	
	const LABEL_NETTO_LIQUIDARE = 'impostazione.LABEL_NETTO_LIQUIDARE';

	
	const LABEL_QUANTITA = 'impostazione.LABEL_QUANTITA';

	
	const LABEL_DESCRIZIONE = 'impostazione.LABEL_DESCRIZIONE';

	
	const LABEL_PREZZO_SINGOLO = 'impostazione.LABEL_PREZZO_SINGOLO';

	
	const LABEL_PREZZO_TOTALE = 'impostazione.LABEL_PREZZO_TOTALE';

	
	const LABEL_SCONTO = 'impostazione.LABEL_SCONTO';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('IdUtente', 'NumClienti', 'NumFatture', 'RigheDettagli', 'RitenutaAcconto', 'TipoRitenuta', 'RiepilogoHome', 'ConsegnaCommercialista', 'DepositaIva', 'FatturaAutomatica', 'CodiceCliente', 'LabelImponibile', 'LabelSpese', 'LabelImponibileIva', 'LabelIva', 'LabelTotaleFattura', 'LabelRitenutaAcconto', 'LabelNettoLiquidare', 'LabelQuantita', 'LabelDescrizione', 'LabelPrezzoSingolo', 'LabelPrezzoTotale', 'LabelSconto', ),
		BasePeer::TYPE_COLNAME => array (ImpostazionePeer::ID_UTENTE, ImpostazionePeer::NUM_CLIENTI, ImpostazionePeer::NUM_FATTURE, ImpostazionePeer::RIGHE_DETTAGLI, ImpostazionePeer::RITENUTA_ACCONTO, ImpostazionePeer::TIPO_RITENUTA, ImpostazionePeer::RIEPILOGO_HOME, ImpostazionePeer::CONSEGNA_COMMERCIALISTA, ImpostazionePeer::DEPOSITA_IVA, ImpostazionePeer::FATTURA_AUTOMATICA, ImpostazionePeer::CODICE_CLIENTE, ImpostazionePeer::LABEL_IMPONIBILE, ImpostazionePeer::LABEL_SPESE, ImpostazionePeer::LABEL_IMPONIBILE_IVA, ImpostazionePeer::LABEL_IVA, ImpostazionePeer::LABEL_TOTALE_FATTURA, ImpostazionePeer::LABEL_RITENUTA_ACCONTO, ImpostazionePeer::LABEL_NETTO_LIQUIDARE, ImpostazionePeer::LABEL_QUANTITA, ImpostazionePeer::LABEL_DESCRIZIONE, ImpostazionePeer::LABEL_PREZZO_SINGOLO, ImpostazionePeer::LABEL_PREZZO_TOTALE, ImpostazionePeer::LABEL_SCONTO, ),
		BasePeer::TYPE_FIELDNAME => array ('id_utente', 'num_clienti', 'num_fatture', 'righe_dettagli', 'ritenuta_acconto', 'tipo_ritenuta', 'riepilogo_home', 'consegna_commercialista', 'deposita_iva', 'fattura_automatica', 'codice_cliente', 'label_imponibile', 'label_spese', 'label_imponibile_iva', 'label_iva', 'label_totale_fattura', 'label_ritenuta_acconto', 'label_netto_liquidare', 'label_quantita', 'label_descrizione', 'label_prezzo_singolo', 'label_prezzo_totale', 'label_sconto', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('IdUtente' => 0, 'NumClienti' => 1, 'NumFatture' => 2, 'RigheDettagli' => 3, 'RitenutaAcconto' => 4, 'TipoRitenuta' => 5, 'RiepilogoHome' => 6, 'ConsegnaCommercialista' => 7, 'DepositaIva' => 8, 'FatturaAutomatica' => 9, 'CodiceCliente' => 10, 'LabelImponibile' => 11, 'LabelSpese' => 12, 'LabelImponibileIva' => 13, 'LabelIva' => 14, 'LabelTotaleFattura' => 15, 'LabelRitenutaAcconto' => 16, 'LabelNettoLiquidare' => 17, 'LabelQuantita' => 18, 'LabelDescrizione' => 19, 'LabelPrezzoSingolo' => 20, 'LabelPrezzoTotale' => 21, 'LabelSconto' => 22, ),
		BasePeer::TYPE_COLNAME => array (ImpostazionePeer::ID_UTENTE => 0, ImpostazionePeer::NUM_CLIENTI => 1, ImpostazionePeer::NUM_FATTURE => 2, ImpostazionePeer::RIGHE_DETTAGLI => 3, ImpostazionePeer::RITENUTA_ACCONTO => 4, ImpostazionePeer::TIPO_RITENUTA => 5, ImpostazionePeer::RIEPILOGO_HOME => 6, ImpostazionePeer::CONSEGNA_COMMERCIALISTA => 7, ImpostazionePeer::DEPOSITA_IVA => 8, ImpostazionePeer::FATTURA_AUTOMATICA => 9, ImpostazionePeer::CODICE_CLIENTE => 10, ImpostazionePeer::LABEL_IMPONIBILE => 11, ImpostazionePeer::LABEL_SPESE => 12, ImpostazionePeer::LABEL_IMPONIBILE_IVA => 13, ImpostazionePeer::LABEL_IVA => 14, ImpostazionePeer::LABEL_TOTALE_FATTURA => 15, ImpostazionePeer::LABEL_RITENUTA_ACCONTO => 16, ImpostazionePeer::LABEL_NETTO_LIQUIDARE => 17, ImpostazionePeer::LABEL_QUANTITA => 18, ImpostazionePeer::LABEL_DESCRIZIONE => 19, ImpostazionePeer::LABEL_PREZZO_SINGOLO => 20, ImpostazionePeer::LABEL_PREZZO_TOTALE => 21, ImpostazionePeer::LABEL_SCONTO => 22, ),
		BasePeer::TYPE_FIELDNAME => array ('id_utente' => 0, 'num_clienti' => 1, 'num_fatture' => 2, 'righe_dettagli' => 3, 'ritenuta_acconto' => 4, 'tipo_ritenuta' => 5, 'riepilogo_home' => 6, 'consegna_commercialista' => 7, 'deposita_iva' => 8, 'fattura_automatica' => 9, 'codice_cliente' => 10, 'label_imponibile' => 11, 'label_spese' => 12, 'label_imponibile_iva' => 13, 'label_iva' => 14, 'label_totale_fattura' => 15, 'label_ritenuta_acconto' => 16, 'label_netto_liquidare' => 17, 'label_quantita' => 18, 'label_descrizione' => 19, 'label_prezzo_singolo' => 20, 'label_prezzo_totale' => 21, 'label_sconto' => 22, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, )
	);

	
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.map.ImpostazioneMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ImpostazionePeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(ImpostazionePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ImpostazionePeer::ID_UTENTE);

		$criteria->addSelectColumn(ImpostazionePeer::NUM_CLIENTI);

		$criteria->addSelectColumn(ImpostazionePeer::NUM_FATTURE);

		$criteria->addSelectColumn(ImpostazionePeer::RIGHE_DETTAGLI);

		$criteria->addSelectColumn(ImpostazionePeer::RITENUTA_ACCONTO);

		$criteria->addSelectColumn(ImpostazionePeer::TIPO_RITENUTA);

		$criteria->addSelectColumn(ImpostazionePeer::RIEPILOGO_HOME);

		$criteria->addSelectColumn(ImpostazionePeer::CONSEGNA_COMMERCIALISTA);

		$criteria->addSelectColumn(ImpostazionePeer::DEPOSITA_IVA);

		$criteria->addSelectColumn(ImpostazionePeer::FATTURA_AUTOMATICA);

		$criteria->addSelectColumn(ImpostazionePeer::CODICE_CLIENTE);

		$criteria->addSelectColumn(ImpostazionePeer::LABEL_IMPONIBILE);

		$criteria->addSelectColumn(ImpostazionePeer::LABEL_SPESE);

		$criteria->addSelectColumn(ImpostazionePeer::LABEL_IMPONIBILE_IVA);

		$criteria->addSelectColumn(ImpostazionePeer::LABEL_IVA);

		$criteria->addSelectColumn(ImpostazionePeer::LABEL_TOTALE_FATTURA);

		$criteria->addSelectColumn(ImpostazionePeer::LABEL_RITENUTA_ACCONTO);

		$criteria->addSelectColumn(ImpostazionePeer::LABEL_NETTO_LIQUIDARE);

		$criteria->addSelectColumn(ImpostazionePeer::LABEL_QUANTITA);

		$criteria->addSelectColumn(ImpostazionePeer::LABEL_DESCRIZIONE);

		$criteria->addSelectColumn(ImpostazionePeer::LABEL_PREZZO_SINGOLO);

		$criteria->addSelectColumn(ImpostazionePeer::LABEL_PREZZO_TOTALE);

		$criteria->addSelectColumn(ImpostazionePeer::LABEL_SCONTO);

	}

	const COUNT = 'COUNT(impostazione.ID_UTENTE)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT impostazione.ID_UTENTE)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ImpostazionePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ImpostazionePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ImpostazionePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = ImpostazionePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ImpostazionePeer::populateObjects(ImpostazionePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ImpostazionePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ImpostazionePeer::getOMClass();
		$cls = sfPropel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinUtente(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ImpostazionePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ImpostazionePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ImpostazionePeer::ID_UTENTE, UtentePeer::ID);

		$rs = ImpostazionePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinUtente(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ImpostazionePeer::addSelectColumns($c);
		$startcol = (ImpostazionePeer::NUM_COLUMNS - ImpostazionePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UtentePeer::addSelectColumns($c);

		$c->addJoin(ImpostazionePeer::ID_UTENTE, UtentePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ImpostazionePeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UtentePeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUtente(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addImpostazione($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initImpostaziones();
				$obj2->addImpostazione($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ImpostazionePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ImpostazionePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ImpostazionePeer::ID_UTENTE, UtentePeer::ID);

		$rs = ImpostazionePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ImpostazionePeer::addSelectColumns($c);
		$startcol2 = (ImpostazionePeer::NUM_COLUMNS - ImpostazionePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UtentePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UtentePeer::NUM_COLUMNS;

		$c->addJoin(ImpostazionePeer::ID_UTENTE, UtentePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ImpostazionePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = UtentePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUtente(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addImpostazione($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initImpostaziones();
				$obj2->addImpostazione($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


  static public function getUniqueColumnNames()
  {
    return array();
  }
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return ImpostazionePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}


				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(ImpostazionePeer::ID_UTENTE);
			$selectCriteria->add(ImpostazionePeer::ID_UTENTE, $criteria->remove(ImpostazionePeer::ID_UTENTE), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(ImpostazionePeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(ImpostazionePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Impostazione) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ImpostazionePeer::ID_UTENTE, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(Impostazione $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ImpostazionePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ImpostazionePeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(ImpostazionePeer::DATABASE_NAME, ImpostazionePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ImpostazionePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(ImpostazionePeer::DATABASE_NAME);

		$criteria->add(ImpostazionePeer::ID_UTENTE, $pk);


		$v = ImpostazionePeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(ImpostazionePeer::ID_UTENTE, $pks, Criteria::IN);
			$objs = ImpostazionePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseImpostazionePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			Propel::registerMapBuilder('lib.model.map.ImpostazioneMapBuilder');
}
