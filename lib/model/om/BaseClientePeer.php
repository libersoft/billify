<?php


abstract class BaseClientePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'cliente';

	
	const CLASS_DEFAULT = 'lib.model.Cliente';

	
	const NUM_COLUMNS = 25;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'cliente.ID';

	
	const ID_UTENTE = 'cliente.ID_UTENTE';

	
	const AZIENDA = 'cliente.AZIENDA';

	
	const RAGIONE_SOCIALE = 'cliente.RAGIONE_SOCIALE';

	
	const VIA = 'cliente.VIA';

	
	const CITTA = 'cliente.CITTA';

	
	const PROVINCIA = 'cliente.PROVINCIA';

	
	const CAP = 'cliente.CAP';

	
	const PIVA = 'cliente.PIVA';

	
	const CF = 'cliente.CF';

	
	const COGNOME = 'cliente.COGNOME';

	
	const NOME = 'cliente.NOME';

	
	const TELEFONO = 'cliente.TELEFONO';

	
	const FAX = 'cliente.FAX';

	
	const CELLULARE = 'cliente.CELLULARE';

	
	const EMAIL = 'cliente.EMAIL';

	
	const MODO_PAGAMENTO_ID = 'cliente.MODO_PAGAMENTO_ID';

	
	const STATO = 'cliente.STATO';

	
	const NOTE = 'cliente.NOTE';

	
	const ID_TEMA_FATTURA = 'cliente.ID_TEMA_FATTURA';

	
	const ID_BANCA = 'cliente.ID_BANCA';

	
	const CALCOLA_RITENUTA_ACCONTO = 'cliente.CALCOLA_RITENUTA_ACCONTO';

	
	const INCLUDI_TASSE = 'cliente.INCLUDI_TASSE';

	
	const CALCOLA_TASSE = 'cliente.CALCOLA_TASSE';

	
	const COD = 'cliente.COD';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'IdUtente', 'Azienda', 'RagioneSociale', 'Via', 'Citta', 'Provincia', 'Cap', 'Piva', 'Cf', 'Cognome', 'Nome', 'Telefono', 'Fax', 'Cellulare', 'Email', 'ModoPagamentoId', 'Stato', 'Note', 'IdTemaFattura', 'IdBanca', 'CalcolaRitenutaAcconto', 'IncludiTasse', 'CalcolaTasse', 'Cod', ),
		BasePeer::TYPE_COLNAME => array (ClientePeer::ID, ClientePeer::ID_UTENTE, ClientePeer::AZIENDA, ClientePeer::RAGIONE_SOCIALE, ClientePeer::VIA, ClientePeer::CITTA, ClientePeer::PROVINCIA, ClientePeer::CAP, ClientePeer::PIVA, ClientePeer::CF, ClientePeer::COGNOME, ClientePeer::NOME, ClientePeer::TELEFONO, ClientePeer::FAX, ClientePeer::CELLULARE, ClientePeer::EMAIL, ClientePeer::MODO_PAGAMENTO_ID, ClientePeer::STATO, ClientePeer::NOTE, ClientePeer::ID_TEMA_FATTURA, ClientePeer::ID_BANCA, ClientePeer::CALCOLA_RITENUTA_ACCONTO, ClientePeer::INCLUDI_TASSE, ClientePeer::CALCOLA_TASSE, ClientePeer::COD, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'id_utente', 'azienda', 'ragione_sociale', 'via', 'citta', 'provincia', 'cap', 'piva', 'cf', 'cognome', 'nome', 'telefono', 'fax', 'cellulare', 'email', 'modo_pagamento_id', 'stato', 'note', 'id_tema_fattura', 'id_banca', 'calcola_ritenuta_acconto', 'includi_tasse', 'calcola_tasse', 'cod', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'IdUtente' => 1, 'Azienda' => 2, 'RagioneSociale' => 3, 'Via' => 4, 'Citta' => 5, 'Provincia' => 6, 'Cap' => 7, 'Piva' => 8, 'Cf' => 9, 'Cognome' => 10, 'Nome' => 11, 'Telefono' => 12, 'Fax' => 13, 'Cellulare' => 14, 'Email' => 15, 'ModoPagamentoId' => 16, 'Stato' => 17, 'Note' => 18, 'IdTemaFattura' => 19, 'IdBanca' => 20, 'CalcolaRitenutaAcconto' => 21, 'IncludiTasse' => 22, 'CalcolaTasse' => 23, 'Cod' => 24, ),
		BasePeer::TYPE_COLNAME => array (ClientePeer::ID => 0, ClientePeer::ID_UTENTE => 1, ClientePeer::AZIENDA => 2, ClientePeer::RAGIONE_SOCIALE => 3, ClientePeer::VIA => 4, ClientePeer::CITTA => 5, ClientePeer::PROVINCIA => 6, ClientePeer::CAP => 7, ClientePeer::PIVA => 8, ClientePeer::CF => 9, ClientePeer::COGNOME => 10, ClientePeer::NOME => 11, ClientePeer::TELEFONO => 12, ClientePeer::FAX => 13, ClientePeer::CELLULARE => 14, ClientePeer::EMAIL => 15, ClientePeer::MODO_PAGAMENTO_ID => 16, ClientePeer::STATO => 17, ClientePeer::NOTE => 18, ClientePeer::ID_TEMA_FATTURA => 19, ClientePeer::ID_BANCA => 20, ClientePeer::CALCOLA_RITENUTA_ACCONTO => 21, ClientePeer::INCLUDI_TASSE => 22, ClientePeer::CALCOLA_TASSE => 23, ClientePeer::COD => 24, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'id_utente' => 1, 'azienda' => 2, 'ragione_sociale' => 3, 'via' => 4, 'citta' => 5, 'provincia' => 6, 'cap' => 7, 'piva' => 8, 'cf' => 9, 'cognome' => 10, 'nome' => 11, 'telefono' => 12, 'fax' => 13, 'cellulare' => 14, 'email' => 15, 'modo_pagamento_id' => 16, 'stato' => 17, 'note' => 18, 'id_tema_fattura' => 19, 'id_banca' => 20, 'calcola_ritenuta_acconto' => 21, 'includi_tasse' => 22, 'calcola_tasse' => 23, 'cod' => 24, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, )
	);

	
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.map.ClienteMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ClientePeer::getTableMap();
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
		return str_replace(ClientePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ClientePeer::ID);

		$criteria->addSelectColumn(ClientePeer::ID_UTENTE);

		$criteria->addSelectColumn(ClientePeer::AZIENDA);

		$criteria->addSelectColumn(ClientePeer::RAGIONE_SOCIALE);

		$criteria->addSelectColumn(ClientePeer::VIA);

		$criteria->addSelectColumn(ClientePeer::CITTA);

		$criteria->addSelectColumn(ClientePeer::PROVINCIA);

		$criteria->addSelectColumn(ClientePeer::CAP);

		$criteria->addSelectColumn(ClientePeer::PIVA);

		$criteria->addSelectColumn(ClientePeer::CF);

		$criteria->addSelectColumn(ClientePeer::COGNOME);

		$criteria->addSelectColumn(ClientePeer::NOME);

		$criteria->addSelectColumn(ClientePeer::TELEFONO);

		$criteria->addSelectColumn(ClientePeer::FAX);

		$criteria->addSelectColumn(ClientePeer::CELLULARE);

		$criteria->addSelectColumn(ClientePeer::EMAIL);

		$criteria->addSelectColumn(ClientePeer::MODO_PAGAMENTO_ID);

		$criteria->addSelectColumn(ClientePeer::STATO);

		$criteria->addSelectColumn(ClientePeer::NOTE);

		$criteria->addSelectColumn(ClientePeer::ID_TEMA_FATTURA);

		$criteria->addSelectColumn(ClientePeer::ID_BANCA);

		$criteria->addSelectColumn(ClientePeer::CALCOLA_RITENUTA_ACCONTO);

		$criteria->addSelectColumn(ClientePeer::INCLUDI_TASSE);

		$criteria->addSelectColumn(ClientePeer::CALCOLA_TASSE);

		$criteria->addSelectColumn(ClientePeer::COD);

	}

	const COUNT = 'COUNT(cliente.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT cliente.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ClientePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClientePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ClientePeer::doSelectRS($criteria, $con);
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
		$objects = ClientePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ClientePeer::populateObjects(ClientePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ClientePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ClientePeer::getOMClass();
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
			$criteria->addSelectColumn(ClientePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClientePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ClientePeer::ID_UTENTE, UtentePeer::ID);

		$rs = ClientePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinModoPagamento(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ClientePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClientePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ClientePeer::MODO_PAGAMENTO_ID, ModoPagamentoPeer::ID);

		$rs = ClientePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinTemaFattura(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ClientePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClientePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ClientePeer::ID_TEMA_FATTURA, TemaFatturaPeer::ID);

		$rs = ClientePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinBanca(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ClientePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClientePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ClientePeer::ID_BANCA, BancaPeer::ID);

		$rs = ClientePeer::doSelectRS($criteria, $con);
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

		ClientePeer::addSelectColumns($c);
		$startcol = (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UtentePeer::addSelectColumns($c);

		$c->addJoin(ClientePeer::ID_UTENTE, UtentePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ClientePeer::getOMClass();

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
										$temp_obj2->addCliente($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initClientes();
				$obj2->addCliente($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinModoPagamento(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ClientePeer::addSelectColumns($c);
		$startcol = (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ModoPagamentoPeer::addSelectColumns($c);

		$c->addJoin(ClientePeer::MODO_PAGAMENTO_ID, ModoPagamentoPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ClientePeer::getOMClass();

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
										$temp_obj2->addCliente($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initClientes();
				$obj2->addCliente($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinTemaFattura(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ClientePeer::addSelectColumns($c);
		$startcol = (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TemaFatturaPeer::addSelectColumns($c);

		$c->addJoin(ClientePeer::ID_TEMA_FATTURA, TemaFatturaPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ClientePeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TemaFatturaPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTemaFattura(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addCliente($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initClientes();
				$obj2->addCliente($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinBanca(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ClientePeer::addSelectColumns($c);
		$startcol = (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		BancaPeer::addSelectColumns($c);

		$c->addJoin(ClientePeer::ID_BANCA, BancaPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ClientePeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = BancaPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getBanca(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addCliente($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initClientes();
				$obj2->addCliente($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ClientePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClientePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ClientePeer::ID_UTENTE, UtentePeer::ID);

		$criteria->addJoin(ClientePeer::MODO_PAGAMENTO_ID, ModoPagamentoPeer::ID);

		$criteria->addJoin(ClientePeer::ID_TEMA_FATTURA, TemaFatturaPeer::ID);

		$criteria->addJoin(ClientePeer::ID_BANCA, BancaPeer::ID);

		$rs = ClientePeer::doSelectRS($criteria, $con);
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

		ClientePeer::addSelectColumns($c);
		$startcol2 = (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UtentePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UtentePeer::NUM_COLUMNS;

		ModoPagamentoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ModoPagamentoPeer::NUM_COLUMNS;

		TemaFatturaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TemaFatturaPeer::NUM_COLUMNS;

		BancaPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + BancaPeer::NUM_COLUMNS;

		$c->addJoin(ClientePeer::ID_UTENTE, UtentePeer::ID);

		$c->addJoin(ClientePeer::MODO_PAGAMENTO_ID, ModoPagamentoPeer::ID);

		$c->addJoin(ClientePeer::ID_TEMA_FATTURA, TemaFatturaPeer::ID);

		$c->addJoin(ClientePeer::ID_BANCA, BancaPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ClientePeer::getOMClass();


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
					$temp_obj2->addCliente($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initClientes();
				$obj2->addCliente($obj1);
			}


					
			$omClass = ModoPagamentoPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getModoPagamento(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addCliente($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initClientes();
				$obj3->addCliente($obj1);
			}


					
			$omClass = TemaFatturaPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getTemaFattura(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addCliente($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initClientes();
				$obj4->addCliente($obj1);
			}


					
			$omClass = BancaPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getBanca(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addCliente($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initClientes();
				$obj5->addCliente($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptUtente(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ClientePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClientePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ClientePeer::MODO_PAGAMENTO_ID, ModoPagamentoPeer::ID);

		$criteria->addJoin(ClientePeer::ID_TEMA_FATTURA, TemaFatturaPeer::ID);

		$criteria->addJoin(ClientePeer::ID_BANCA, BancaPeer::ID);

		$rs = ClientePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptModoPagamento(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ClientePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClientePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ClientePeer::ID_UTENTE, UtentePeer::ID);

		$criteria->addJoin(ClientePeer::ID_TEMA_FATTURA, TemaFatturaPeer::ID);

		$criteria->addJoin(ClientePeer::ID_BANCA, BancaPeer::ID);

		$rs = ClientePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptTemaFattura(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ClientePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClientePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ClientePeer::ID_UTENTE, UtentePeer::ID);

		$criteria->addJoin(ClientePeer::MODO_PAGAMENTO_ID, ModoPagamentoPeer::ID);

		$criteria->addJoin(ClientePeer::ID_BANCA, BancaPeer::ID);

		$rs = ClientePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptBanca(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ClientePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClientePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ClientePeer::ID_UTENTE, UtentePeer::ID);

		$criteria->addJoin(ClientePeer::MODO_PAGAMENTO_ID, ModoPagamentoPeer::ID);

		$criteria->addJoin(ClientePeer::ID_TEMA_FATTURA, TemaFatturaPeer::ID);

		$rs = ClientePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptUtente(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ClientePeer::addSelectColumns($c);
		$startcol2 = (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ModoPagamentoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ModoPagamentoPeer::NUM_COLUMNS;

		TemaFatturaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TemaFatturaPeer::NUM_COLUMNS;

		BancaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + BancaPeer::NUM_COLUMNS;

		$c->addJoin(ClientePeer::MODO_PAGAMENTO_ID, ModoPagamentoPeer::ID);

		$c->addJoin(ClientePeer::ID_TEMA_FATTURA, TemaFatturaPeer::ID);

		$c->addJoin(ClientePeer::ID_BANCA, BancaPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ClientePeer::getOMClass();

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
					$temp_obj2->addCliente($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initClientes();
				$obj2->addCliente($obj1);
			}

			$omClass = TemaFatturaPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTemaFattura(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addCliente($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initClientes();
				$obj3->addCliente($obj1);
			}

			$omClass = BancaPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getBanca(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addCliente($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initClientes();
				$obj4->addCliente($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptModoPagamento(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ClientePeer::addSelectColumns($c);
		$startcol2 = (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UtentePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UtentePeer::NUM_COLUMNS;

		TemaFatturaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TemaFatturaPeer::NUM_COLUMNS;

		BancaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + BancaPeer::NUM_COLUMNS;

		$c->addJoin(ClientePeer::ID_UTENTE, UtentePeer::ID);

		$c->addJoin(ClientePeer::ID_TEMA_FATTURA, TemaFatturaPeer::ID);

		$c->addJoin(ClientePeer::ID_BANCA, BancaPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ClientePeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UtentePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUtente(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCliente($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initClientes();
				$obj2->addCliente($obj1);
			}

			$omClass = TemaFatturaPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTemaFattura(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addCliente($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initClientes();
				$obj3->addCliente($obj1);
			}

			$omClass = BancaPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getBanca(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addCliente($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initClientes();
				$obj4->addCliente($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptTemaFattura(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ClientePeer::addSelectColumns($c);
		$startcol2 = (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UtentePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UtentePeer::NUM_COLUMNS;

		ModoPagamentoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ModoPagamentoPeer::NUM_COLUMNS;

		BancaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + BancaPeer::NUM_COLUMNS;

		$c->addJoin(ClientePeer::ID_UTENTE, UtentePeer::ID);

		$c->addJoin(ClientePeer::MODO_PAGAMENTO_ID, ModoPagamentoPeer::ID);

		$c->addJoin(ClientePeer::ID_BANCA, BancaPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ClientePeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UtentePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUtente(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCliente($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initClientes();
				$obj2->addCliente($obj1);
			}

			$omClass = ModoPagamentoPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getModoPagamento(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addCliente($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initClientes();
				$obj3->addCliente($obj1);
			}

			$omClass = BancaPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getBanca(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addCliente($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initClientes();
				$obj4->addCliente($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptBanca(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ClientePeer::addSelectColumns($c);
		$startcol2 = (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UtentePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UtentePeer::NUM_COLUMNS;

		ModoPagamentoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ModoPagamentoPeer::NUM_COLUMNS;

		TemaFatturaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TemaFatturaPeer::NUM_COLUMNS;

		$c->addJoin(ClientePeer::ID_UTENTE, UtentePeer::ID);

		$c->addJoin(ClientePeer::MODO_PAGAMENTO_ID, ModoPagamentoPeer::ID);

		$c->addJoin(ClientePeer::ID_TEMA_FATTURA, TemaFatturaPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ClientePeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UtentePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUtente(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCliente($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initClientes();
				$obj2->addCliente($obj1);
			}

			$omClass = ModoPagamentoPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getModoPagamento(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addCliente($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initClientes();
				$obj3->addCliente($obj1);
			}

			$omClass = TemaFatturaPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getTemaFattura(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addCliente($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initClientes();
				$obj4->addCliente($obj1);
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
		return ClientePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(ClientePeer::ID); 

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
			$comparison = $criteria->getComparison(ClientePeer::ID);
			$selectCriteria->add(ClientePeer::ID, $criteria->remove(ClientePeer::ID), $comparison);

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
			$affectedRows += ClientePeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(ClientePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Cliente) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ClientePeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += ClientePeer::doOnDeleteCascade($criteria, $con);
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

				$objects = ClientePeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/Fattura.php';

						$c = new Criteria();
			
			$c->add(FatturaPeer::CLIENTE_ID, $obj->getId());
			$affectedRows += FatturaPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(Cliente $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ClientePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ClientePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ClientePeer::DATABASE_NAME, ClientePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ClientePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ClientePeer::DATABASE_NAME);

		$criteria->add(ClientePeer::ID, $pk);


		$v = ClientePeer::doSelect($criteria, $con);

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
			$criteria->add(ClientePeer::ID, $pks, Criteria::IN);
			$objs = ClientePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseClientePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			Propel::registerMapBuilder('lib.model.map.ClienteMapBuilder');
}
