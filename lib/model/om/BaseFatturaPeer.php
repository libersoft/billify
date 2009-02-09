<?php


abstract class BaseFatturaPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'fattura';

	
	const CLASS_DEFAULT = 'lib.model.Fattura';

	
	const NUM_COLUMNS = 21;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'fattura.ID';

	
	const ID_UTENTE = 'fattura.ID_UTENTE';

	
	const NUM_FATTURA = 'fattura.NUM_FATTURA';

	
	const CLIENTE_ID = 'fattura.CLIENTE_ID';

	
	const DATA = 'fattura.DATA';

	
	const DATA_STATO = 'fattura.DATA_STATO';

	
	const MODO_PAGAMENTO_ID = 'fattura.MODO_PAGAMENTO_ID';

	
	const SCONTO = 'fattura.SCONTO';

	
	const VAT = 'fattura.VAT';

	
	const SPESE_ANTICIPATE = 'fattura.SPESE_ANTICIPATE';

	
	const IMPOSTE = 'fattura.IMPOSTE';

	
	const IMPONIBILE = 'fattura.IMPONIBILE';

	
	const STATO = 'fattura.STATO';

	
	const IVA_PAGATA = 'fattura.IVA_PAGATA';

	
	const IVA_DEPOSITATA = 'fattura.IVA_DEPOSITATA';

	
	const COMMERCIALISTA = 'fattura.COMMERCIALISTA';

	
	const NOTE = 'fattura.NOTE';

	
	const CALCOLA_RITENUTA_ACCONTO = 'fattura.CALCOLA_RITENUTA_ACCONTO';

	
	const INCLUDI_TASSE = 'fattura.INCLUDI_TASSE';

	
	const CALCOLA_TASSE = 'fattura.CALCOLA_TASSE';

	
	const CLASS_KEY = 'fattura.CLASS_KEY';

	
	const CLASSKEY_2 = '2';

	
	const CLASSKEY_ACQUISTO = '2';

	
	const CLASSNAME_2 = 'lib.model.Acquisto';

	
	const CLASSKEY_1 = '1';

	
	const CLASSKEY_VENDITA = '1';

	
	const CLASSNAME_1 = 'lib.model.Vendita';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'IdUtente', 'NumFattura', 'ClienteId', 'Data', 'DataStato', 'ModoPagamentoId', 'Sconto', 'Vat', 'SpeseAnticipate', 'Imposte', 'Imponibile', 'Stato', 'IvaPagata', 'IvaDepositata', 'Commercialista', 'Note', 'CalcolaRitenutaAcconto', 'IncludiTasse', 'CalcolaTasse', 'ClassKey', ),
		BasePeer::TYPE_COLNAME => array (FatturaPeer::ID, FatturaPeer::ID_UTENTE, FatturaPeer::NUM_FATTURA, FatturaPeer::CLIENTE_ID, FatturaPeer::DATA, FatturaPeer::DATA_STATO, FatturaPeer::MODO_PAGAMENTO_ID, FatturaPeer::SCONTO, FatturaPeer::VAT, FatturaPeer::SPESE_ANTICIPATE, FatturaPeer::IMPOSTE, FatturaPeer::IMPONIBILE, FatturaPeer::STATO, FatturaPeer::IVA_PAGATA, FatturaPeer::IVA_DEPOSITATA, FatturaPeer::COMMERCIALISTA, FatturaPeer::NOTE, FatturaPeer::CALCOLA_RITENUTA_ACCONTO, FatturaPeer::INCLUDI_TASSE, FatturaPeer::CALCOLA_TASSE, FatturaPeer::CLASS_KEY, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'id_utente', 'num_fattura', 'cliente_id', 'data', 'data_stato', 'modo_pagamento_id', 'sconto', 'vat', 'spese_anticipate', 'imposte', 'imponibile', 'stato', 'iva_pagata', 'iva_depositata', 'commercialista', 'note', 'calcola_ritenuta_acconto', 'includi_tasse', 'calcola_tasse', 'class_key', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'IdUtente' => 1, 'NumFattura' => 2, 'ClienteId' => 3, 'Data' => 4, 'DataStato' => 5, 'ModoPagamentoId' => 6, 'Sconto' => 7, 'Vat' => 8, 'SpeseAnticipate' => 9, 'Imposte' => 10, 'Imponibile' => 11, 'Stato' => 12, 'IvaPagata' => 13, 'IvaDepositata' => 14, 'Commercialista' => 15, 'Note' => 16, 'CalcolaRitenutaAcconto' => 17, 'IncludiTasse' => 18, 'CalcolaTasse' => 19, 'ClassKey' => 20, ),
		BasePeer::TYPE_COLNAME => array (FatturaPeer::ID => 0, FatturaPeer::ID_UTENTE => 1, FatturaPeer::NUM_FATTURA => 2, FatturaPeer::CLIENTE_ID => 3, FatturaPeer::DATA => 4, FatturaPeer::DATA_STATO => 5, FatturaPeer::MODO_PAGAMENTO_ID => 6, FatturaPeer::SCONTO => 7, FatturaPeer::VAT => 8, FatturaPeer::SPESE_ANTICIPATE => 9, FatturaPeer::IMPOSTE => 10, FatturaPeer::IMPONIBILE => 11, FatturaPeer::STATO => 12, FatturaPeer::IVA_PAGATA => 13, FatturaPeer::IVA_DEPOSITATA => 14, FatturaPeer::COMMERCIALISTA => 15, FatturaPeer::NOTE => 16, FatturaPeer::CALCOLA_RITENUTA_ACCONTO => 17, FatturaPeer::INCLUDI_TASSE => 18, FatturaPeer::CALCOLA_TASSE => 19, FatturaPeer::CLASS_KEY => 20, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'id_utente' => 1, 'num_fattura' => 2, 'cliente_id' => 3, 'data' => 4, 'data_stato' => 5, 'modo_pagamento_id' => 6, 'sconto' => 7, 'vat' => 8, 'spese_anticipate' => 9, 'imposte' => 10, 'imponibile' => 11, 'stato' => 12, 'iva_pagata' => 13, 'iva_depositata' => 14, 'commercialista' => 15, 'note' => 16, 'calcola_ritenuta_acconto' => 17, 'includi_tasse' => 18, 'calcola_tasse' => 19, 'class_key' => 20, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
	);

	
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.map.FatturaMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = FatturaPeer::getTableMap();
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
		return str_replace(FatturaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(FatturaPeer::ID);

		$criteria->addSelectColumn(FatturaPeer::ID_UTENTE);

		$criteria->addSelectColumn(FatturaPeer::NUM_FATTURA);

		$criteria->addSelectColumn(FatturaPeer::CLIENTE_ID);

		$criteria->addSelectColumn(FatturaPeer::DATA);

		$criteria->addSelectColumn(FatturaPeer::DATA_STATO);

		$criteria->addSelectColumn(FatturaPeer::MODO_PAGAMENTO_ID);

		$criteria->addSelectColumn(FatturaPeer::SCONTO);

		$criteria->addSelectColumn(FatturaPeer::VAT);

		$criteria->addSelectColumn(FatturaPeer::SPESE_ANTICIPATE);

		$criteria->addSelectColumn(FatturaPeer::IMPOSTE);

		$criteria->addSelectColumn(FatturaPeer::IMPONIBILE);

		$criteria->addSelectColumn(FatturaPeer::STATO);

		$criteria->addSelectColumn(FatturaPeer::IVA_PAGATA);

		$criteria->addSelectColumn(FatturaPeer::IVA_DEPOSITATA);

		$criteria->addSelectColumn(FatturaPeer::COMMERCIALISTA);

		$criteria->addSelectColumn(FatturaPeer::NOTE);

		$criteria->addSelectColumn(FatturaPeer::CALCOLA_RITENUTA_ACCONTO);

		$criteria->addSelectColumn(FatturaPeer::INCLUDI_TASSE);

		$criteria->addSelectColumn(FatturaPeer::CALCOLA_TASSE);

		$criteria->addSelectColumn(FatturaPeer::CLASS_KEY);

	}

	const COUNT = 'COUNT(fattura.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT fattura.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FatturaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FatturaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = FatturaPeer::doSelectRS($criteria, $con);
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
		$objects = FatturaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return FatturaPeer::populateObjects(FatturaPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			FatturaPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				while($rs->next()) {
		
						$cls = sfPropel::import(FatturaPeer::getOMClass($rs, 1));
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinModoPagamento(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FatturaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FatturaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FatturaPeer::MODO_PAGAMENTO_ID, ModoPagamentoPeer::ID);

		$rs = FatturaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinContatto(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FatturaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FatturaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FatturaPeer::CLIENTE_ID, ContattoPeer::ID);

		$rs = FatturaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinUtente(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FatturaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FatturaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FatturaPeer::ID_UTENTE, UtentePeer::ID);

		$rs = FatturaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinModoPagamento(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FatturaPeer::addSelectColumns($c);
		$startcol = (FatturaPeer::NUM_COLUMNS - FatturaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ModoPagamentoPeer::addSelectColumns($c);

		$c->addJoin(FatturaPeer::MODO_PAGAMENTO_ID, ModoPagamentoPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FatturaPeer::getOMClass($rs, 1);

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ModoPagamentoPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getModoPagamento(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addFattura($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initFatturas();
				$obj2->addFattura($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinContatto(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FatturaPeer::addSelectColumns($c);
		$startcol = (FatturaPeer::NUM_COLUMNS - FatturaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ContattoPeer::addSelectColumns($c);

		$c->addJoin(FatturaPeer::CLIENTE_ID, ContattoPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FatturaPeer::getOMClass($rs, 1);

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ContattoPeer::getOMClass($rs, $startcol);

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getContatto(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addFattura($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initFatturas();
				$obj2->addFattura($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinUtente(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FatturaPeer::addSelectColumns($c);
		$startcol = (FatturaPeer::NUM_COLUMNS - FatturaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UtentePeer::addSelectColumns($c);

		$c->addJoin(FatturaPeer::ID_UTENTE, UtentePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FatturaPeer::getOMClass($rs, 1);

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
										$temp_obj2->addFattura($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initFatturas();
				$obj2->addFattura($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FatturaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FatturaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FatturaPeer::MODO_PAGAMENTO_ID, ModoPagamentoPeer::ID);

		$criteria->addJoin(FatturaPeer::CLIENTE_ID, ContattoPeer::ID);

		$criteria->addJoin(FatturaPeer::ID_UTENTE, UtentePeer::ID);

		$rs = FatturaPeer::doSelectRS($criteria, $con);
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

		FatturaPeer::addSelectColumns($c);
		$startcol2 = (FatturaPeer::NUM_COLUMNS - FatturaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ModoPagamentoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ModoPagamentoPeer::NUM_COLUMNS;

		ContattoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ContattoPeer::NUM_COLUMNS;

		UtentePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + UtentePeer::NUM_COLUMNS;

		$c->addJoin(FatturaPeer::MODO_PAGAMENTO_ID, ModoPagamentoPeer::ID);

		$c->addJoin(FatturaPeer::CLIENTE_ID, ContattoPeer::ID);

		$c->addJoin(FatturaPeer::ID_UTENTE, UtentePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FatturaPeer::getOMClass($rs, 1);


			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = ModoPagamentoPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getModoPagamento(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addFattura($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initFatturas();
				$obj2->addFattura($obj1);
			}


					
			$omClass = ContattoPeer::getOMClass($rs, $startcol3);


			$cls = sfPropel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getContatto(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addFattura($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initFatturas();
				$obj3->addFattura($obj1);
			}


					
			$omClass = UtentePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getUtente(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addFattura($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initFatturas();
				$obj4->addFattura($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptModoPagamento(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FatturaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FatturaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FatturaPeer::CLIENTE_ID, ContattoPeer::ID);

		$criteria->addJoin(FatturaPeer::ID_UTENTE, UtentePeer::ID);

		$rs = FatturaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptContatto(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FatturaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FatturaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FatturaPeer::MODO_PAGAMENTO_ID, ModoPagamentoPeer::ID);

		$criteria->addJoin(FatturaPeer::ID_UTENTE, UtentePeer::ID);

		$rs = FatturaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptUtente(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FatturaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FatturaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FatturaPeer::MODO_PAGAMENTO_ID, ModoPagamentoPeer::ID);

		$criteria->addJoin(FatturaPeer::CLIENTE_ID, ContattoPeer::ID);

		$rs = FatturaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptModoPagamento(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FatturaPeer::addSelectColumns($c);
		$startcol2 = (FatturaPeer::NUM_COLUMNS - FatturaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ContattoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ContattoPeer::NUM_COLUMNS;

		UtentePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UtentePeer::NUM_COLUMNS;

		$c->addJoin(FatturaPeer::CLIENTE_ID, ContattoPeer::ID);

		$c->addJoin(FatturaPeer::ID_UTENTE, UtentePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FatturaPeer::getOMClass($rs, 1);

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ContattoPeer::getOMClass($rs, $startcol2);


			$cls = sfPropel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getContatto(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addFattura($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initFatturas();
				$obj2->addFattura($obj1);
			}

			$omClass = UtentePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUtente(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addFattura($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initFatturas();
				$obj3->addFattura($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptContatto(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FatturaPeer::addSelectColumns($c);
		$startcol2 = (FatturaPeer::NUM_COLUMNS - FatturaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ModoPagamentoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ModoPagamentoPeer::NUM_COLUMNS;

		UtentePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UtentePeer::NUM_COLUMNS;

		$c->addJoin(FatturaPeer::MODO_PAGAMENTO_ID, ModoPagamentoPeer::ID);

		$c->addJoin(FatturaPeer::ID_UTENTE, UtentePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FatturaPeer::getOMClass($rs, 1);

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ModoPagamentoPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getModoPagamento(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addFattura($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initFatturas();
				$obj2->addFattura($obj1);
			}

			$omClass = UtentePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUtente(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addFattura($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initFatturas();
				$obj3->addFattura($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptUtente(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FatturaPeer::addSelectColumns($c);
		$startcol2 = (FatturaPeer::NUM_COLUMNS - FatturaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ModoPagamentoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ModoPagamentoPeer::NUM_COLUMNS;

		ContattoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ContattoPeer::NUM_COLUMNS;

		$c->addJoin(FatturaPeer::MODO_PAGAMENTO_ID, ModoPagamentoPeer::ID);

		$c->addJoin(FatturaPeer::CLIENTE_ID, ContattoPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FatturaPeer::getOMClass($rs, 1);

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ModoPagamentoPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getModoPagamento(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addFattura($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initFatturas();
				$obj2->addFattura($obj1);
			}

			$omClass = ContattoPeer::getOMClass($rs, $startcol3);


			$cls = sfPropel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getContatto(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addFattura($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initFatturas();
				$obj3->addFattura($obj1);
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

	
	public static function getOMClass(ResultSet $rs, $colnum)
	{
		try {

			$omClass = null;
			$classKey = $rs->getString($colnum - 1 + 21);

			switch($classKey) {

				case self::CLASSKEY_2:
					$omClass = self::CLASSNAME_2;
					break;

				case self::CLASSKEY_1:
					$omClass = self::CLASSNAME_1;
					break;

				default:
					$omClass = self::CLASS_DEFAULT;

			} 
		} catch (Exception $e) {
			throw new PropelException('Unable to get OM class.', $e);
		}
		return $omClass;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(FatturaPeer::ID); 

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
			$comparison = $criteria->getComparison(FatturaPeer::ID);
			$selectCriteria->add(FatturaPeer::ID, $criteria->remove(FatturaPeer::ID), $comparison);

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
			$affectedRows += FatturaPeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(FatturaPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(FatturaPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Fattura) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(FatturaPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += FatturaPeer::doOnDeleteCascade($criteria, $con);
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected static function doOnDeleteCascade(Criteria $criteria, Connection $con)
	{
				$affectedRows = 0;

				$objects = FatturaPeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/DettagliFattura.php';

						$c = new Criteria();
			
			$c->add(DettagliFatturaPeer::FATTURA_ID, $obj->getId());
			$affectedRows += DettagliFatturaPeer::doDelete($c, $con);

			include_once 'lib/model/TagsFattura.php';

						$c = new Criteria();
			
			$c->add(TagsFatturaPeer::ID_FATTURA, $obj->getId());
			$affectedRows += TagsFatturaPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(Fattura $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(FatturaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(FatturaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(FatturaPeer::DATABASE_NAME, FatturaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = FatturaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(FatturaPeer::DATABASE_NAME);

		$criteria->add(FatturaPeer::ID, $pk);


		$v = FatturaPeer::doSelect($criteria, $con);

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
			$criteria->add(FatturaPeer::ID, $pks, Criteria::IN);
			$objs = FatturaPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseFatturaPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			Propel::registerMapBuilder('lib.model.map.FatturaMapBuilder');
}
