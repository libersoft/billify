<?php


abstract class BaseTagsFatturaPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tags_fattura';

	
	const CLASS_DEFAULT = 'lib.model.TagsFattura';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'tags_fattura.ID';

	
	const ID_FATTURA = 'tags_fattura.ID_FATTURA';

	
	const ID_UTENTE = 'tags_fattura.ID_UTENTE';

	
	const TAG = 'tags_fattura.TAG';

	
	const TAG_NORMALIZZATO = 'tags_fattura.TAG_NORMALIZZATO';

	
	const DATA = 'tags_fattura.DATA';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'IdFattura', 'IdUtente', 'Tag', 'TagNormalizzato', 'Data', ),
		BasePeer::TYPE_COLNAME => array (TagsFatturaPeer::ID, TagsFatturaPeer::ID_FATTURA, TagsFatturaPeer::ID_UTENTE, TagsFatturaPeer::TAG, TagsFatturaPeer::TAG_NORMALIZZATO, TagsFatturaPeer::DATA, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'id_fattura', 'id_utente', 'tag', 'tag_normalizzato', 'data', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'IdFattura' => 1, 'IdUtente' => 2, 'Tag' => 3, 'TagNormalizzato' => 4, 'Data' => 5, ),
		BasePeer::TYPE_COLNAME => array (TagsFatturaPeer::ID => 0, TagsFatturaPeer::ID_FATTURA => 1, TagsFatturaPeer::ID_UTENTE => 2, TagsFatturaPeer::TAG => 3, TagsFatturaPeer::TAG_NORMALIZZATO => 4, TagsFatturaPeer::DATA => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'id_fattura' => 1, 'id_utente' => 2, 'tag' => 3, 'tag_normalizzato' => 4, 'data' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.map.TagsFatturaMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = TagsFatturaPeer::getTableMap();
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
		return str_replace(TagsFatturaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(TagsFatturaPeer::ID);

		$criteria->addSelectColumn(TagsFatturaPeer::ID_FATTURA);

		$criteria->addSelectColumn(TagsFatturaPeer::ID_UTENTE);

		$criteria->addSelectColumn(TagsFatturaPeer::TAG);

		$criteria->addSelectColumn(TagsFatturaPeer::TAG_NORMALIZZATO);

		$criteria->addSelectColumn(TagsFatturaPeer::DATA);

	}

	const COUNT = 'COUNT(tags_fattura.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tags_fattura.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(TagsFatturaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TagsFatturaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = TagsFatturaPeer::doSelectRS($criteria, $con);
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
		$objects = TagsFatturaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return TagsFatturaPeer::populateObjects(TagsFatturaPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			TagsFatturaPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = TagsFatturaPeer::getOMClass();
		$cls = sfPropel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinFattura(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(TagsFatturaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TagsFatturaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(TagsFatturaPeer::ID_FATTURA, FatturaPeer::ID);

		$rs = TagsFatturaPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(TagsFatturaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TagsFatturaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(TagsFatturaPeer::ID_UTENTE, UtentePeer::ID);

		$rs = TagsFatturaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinFattura(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TagsFatturaPeer::addSelectColumns($c);
		$startcol = (TagsFatturaPeer::NUM_COLUMNS - TagsFatturaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		FatturaPeer::addSelectColumns($c);

		$c->addJoin(TagsFatturaPeer::ID_FATTURA, FatturaPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = TagsFatturaPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = FatturaPeer::getOMClass($rs, $startcol);

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getFattura(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addTagsFattura($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initTagsFatturas();
				$obj2->addTagsFattura($obj1); 			}
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

		TagsFatturaPeer::addSelectColumns($c);
		$startcol = (TagsFatturaPeer::NUM_COLUMNS - TagsFatturaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UtentePeer::addSelectColumns($c);

		$c->addJoin(TagsFatturaPeer::ID_UTENTE, UtentePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = TagsFatturaPeer::getOMClass();

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
										$temp_obj2->addTagsFattura($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initTagsFatturas();
				$obj2->addTagsFattura($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(TagsFatturaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TagsFatturaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(TagsFatturaPeer::ID_FATTURA, FatturaPeer::ID);

		$criteria->addJoin(TagsFatturaPeer::ID_UTENTE, UtentePeer::ID);

		$rs = TagsFatturaPeer::doSelectRS($criteria, $con);
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

		TagsFatturaPeer::addSelectColumns($c);
		$startcol2 = (TagsFatturaPeer::NUM_COLUMNS - TagsFatturaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		FatturaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + FatturaPeer::NUM_COLUMNS;

		UtentePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UtentePeer::NUM_COLUMNS;

		$c->addJoin(TagsFatturaPeer::ID_FATTURA, FatturaPeer::ID);

		$c->addJoin(TagsFatturaPeer::ID_UTENTE, UtentePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = TagsFatturaPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = FatturaPeer::getOMClass($rs, $startcol2);


			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getFattura(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addTagsFattura($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initTagsFatturas();
				$obj2->addTagsFattura($obj1);
			}


					
			$omClass = UtentePeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUtente(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addTagsFattura($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initTagsFatturas();
				$obj3->addTagsFattura($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptFattura(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(TagsFatturaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TagsFatturaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(TagsFatturaPeer::ID_UTENTE, UtentePeer::ID);

		$rs = TagsFatturaPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(TagsFatturaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TagsFatturaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(TagsFatturaPeer::ID_FATTURA, FatturaPeer::ID);

		$rs = TagsFatturaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptFattura(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TagsFatturaPeer::addSelectColumns($c);
		$startcol2 = (TagsFatturaPeer::NUM_COLUMNS - TagsFatturaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UtentePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UtentePeer::NUM_COLUMNS;

		$c->addJoin(TagsFatturaPeer::ID_UTENTE, UtentePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = TagsFatturaPeer::getOMClass();

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
					$temp_obj2->addTagsFattura($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initTagsFatturas();
				$obj2->addTagsFattura($obj1);
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

		TagsFatturaPeer::addSelectColumns($c);
		$startcol2 = (TagsFatturaPeer::NUM_COLUMNS - TagsFatturaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		FatturaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + FatturaPeer::NUM_COLUMNS;

		$c->addJoin(TagsFatturaPeer::ID_FATTURA, FatturaPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = TagsFatturaPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = FatturaPeer::getOMClass($rs, $startcol2);


			$cls = sfPropel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getFattura(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addTagsFattura($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initTagsFatturas();
				$obj2->addTagsFattura($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


  static public function getUniqueColumnNames()
  {
    return array(array('id_fattura', 'id_utente', 'tag_normalizzato'));
  }
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return TagsFatturaPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(TagsFatturaPeer::ID); 

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
			$comparison = $criteria->getComparison(TagsFatturaPeer::ID);
			$selectCriteria->add(TagsFatturaPeer::ID, $criteria->remove(TagsFatturaPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(TagsFatturaPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(TagsFatturaPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof TagsFattura) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(TagsFatturaPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(TagsFattura $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(TagsFatturaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(TagsFatturaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(TagsFatturaPeer::DATABASE_NAME, TagsFatturaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = TagsFatturaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(TagsFatturaPeer::DATABASE_NAME);

		$criteria->add(TagsFatturaPeer::ID, $pk);


		$v = TagsFatturaPeer::doSelect($criteria, $con);

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
			$criteria->add(TagsFatturaPeer::ID, $pks, Criteria::IN);
			$objs = TagsFatturaPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseTagsFatturaPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			Propel::registerMapBuilder('lib.model.map.TagsFatturaMapBuilder');
}
