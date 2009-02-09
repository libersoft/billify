<?php


abstract class BaseModoPagamentoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'modo_pagamento';

	
	const CLASS_DEFAULT = 'lib.model.ModoPagamento';

	
	const NUM_COLUMNS = 4;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'modo_pagamento.ID';

	
	const ID_UTENTE = 'modo_pagamento.ID_UTENTE';

	
	const NUM_GIORNI = 'modo_pagamento.NUM_GIORNI';

	
	const DESCRIZIONE = 'modo_pagamento.DESCRIZIONE';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'IdUtente', 'NumGiorni', 'Descrizione', ),
		BasePeer::TYPE_COLNAME => array (ModoPagamentoPeer::ID, ModoPagamentoPeer::ID_UTENTE, ModoPagamentoPeer::NUM_GIORNI, ModoPagamentoPeer::DESCRIZIONE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'id_utente', 'num_giorni', 'descrizione', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'IdUtente' => 1, 'NumGiorni' => 2, 'Descrizione' => 3, ),
		BasePeer::TYPE_COLNAME => array (ModoPagamentoPeer::ID => 0, ModoPagamentoPeer::ID_UTENTE => 1, ModoPagamentoPeer::NUM_GIORNI => 2, ModoPagamentoPeer::DESCRIZIONE => 3, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'id_utente' => 1, 'num_giorni' => 2, 'descrizione' => 3, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.map.ModoPagamentoMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ModoPagamentoPeer::getTableMap();
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
		return str_replace(ModoPagamentoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ModoPagamentoPeer::ID);

		$criteria->addSelectColumn(ModoPagamentoPeer::ID_UTENTE);

		$criteria->addSelectColumn(ModoPagamentoPeer::NUM_GIORNI);

		$criteria->addSelectColumn(ModoPagamentoPeer::DESCRIZIONE);

	}

	const COUNT = 'COUNT(modo_pagamento.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT modo_pagamento.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ModoPagamentoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ModoPagamentoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ModoPagamentoPeer::doSelectRS($criteria, $con);
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
		$objects = ModoPagamentoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ModoPagamentoPeer::populateObjects(ModoPagamentoPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ModoPagamentoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ModoPagamentoPeer::getOMClass();
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
			$criteria->addSelectColumn(ModoPagamentoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ModoPagamentoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ModoPagamentoPeer::ID_UTENTE, UtentePeer::ID);

		$rs = ModoPagamentoPeer::doSelectRS($criteria, $con);
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

		ModoPagamentoPeer::addSelectColumns($c);
		$startcol = (ModoPagamentoPeer::NUM_COLUMNS - ModoPagamentoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UtentePeer::addSelectColumns($c);

		$c->addJoin(ModoPagamentoPeer::ID_UTENTE, UtentePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ModoPagamentoPeer::getOMClass();

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
										$temp_obj2->addModoPagamento($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initModoPagamentos();
				$obj2->addModoPagamento($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ModoPagamentoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ModoPagamentoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ModoPagamentoPeer::ID_UTENTE, UtentePeer::ID);

		$rs = ModoPagamentoPeer::doSelectRS($criteria, $con);
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

		ModoPagamentoPeer::addSelectColumns($c);
		$startcol2 = (ModoPagamentoPeer::NUM_COLUMNS - ModoPagamentoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UtentePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UtentePeer::NUM_COLUMNS;

		$c->addJoin(ModoPagamentoPeer::ID_UTENTE, UtentePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ModoPagamentoPeer::getOMClass();


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
					$temp_obj2->addModoPagamento($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initModoPagamentos();
				$obj2->addModoPagamento($obj1);
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
		return ModoPagamentoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(ModoPagamentoPeer::ID); 

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
			$comparison = $criteria->getComparison(ModoPagamentoPeer::ID);
			$selectCriteria->add(ModoPagamentoPeer::ID, $criteria->remove(ModoPagamentoPeer::ID), $comparison);

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
			ModoPagamentoPeer::doOnDeleteSetNull(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(ModoPagamentoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ModoPagamentoPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof ModoPagamento) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ModoPagamentoPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			ModoPagamentoPeer::doOnDeleteSetNull($criteria, $con);
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected static function doOnDeleteSetNull(Criteria $criteria, Connection $con)
	{

				$objects = ModoPagamentoPeer::doSelect($criteria, $con);
		foreach($objects as $obj) {

						$selectCriteria = new Criteria(ModoPagamentoPeer::DATABASE_NAME);
			$updateValues = new Criteria(ModoPagamentoPeer::DATABASE_NAME);
			$selectCriteria->add(ContattoPeer::MODO_PAGAMENTO_ID, $obj->getId());
			$updateValues->add(ContattoPeer::MODO_PAGAMENTO_ID, null);

			BasePeer::doUpdate($selectCriteria, $updateValues, $con); 
						$selectCriteria = new Criteria(ModoPagamentoPeer::DATABASE_NAME);
			$updateValues = new Criteria(ModoPagamentoPeer::DATABASE_NAME);
			$selectCriteria->add(FatturaPeer::MODO_PAGAMENTO_ID, $obj->getId());
			$updateValues->add(FatturaPeer::MODO_PAGAMENTO_ID, null);

			BasePeer::doUpdate($selectCriteria, $updateValues, $con); 
		}
	}

	
	public static function doValidate(ModoPagamento $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ModoPagamentoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ModoPagamentoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ModoPagamentoPeer::DATABASE_NAME, ModoPagamentoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ModoPagamentoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ModoPagamentoPeer::DATABASE_NAME);

		$criteria->add(ModoPagamentoPeer::ID, $pk);


		$v = ModoPagamentoPeer::doSelect($criteria, $con);

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
			$criteria->add(ModoPagamentoPeer::ID, $pks, Criteria::IN);
			$objs = ModoPagamentoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseModoPagamentoPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			Propel::registerMapBuilder('lib.model.map.ModoPagamentoMapBuilder');
}
