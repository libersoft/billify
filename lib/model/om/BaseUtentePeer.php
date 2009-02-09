<?php


abstract class BaseUtentePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'utente';

	
	const CLASS_DEFAULT = 'lib.model.Utente';

	
	const NUM_COLUMNS = 19;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'utente.ID';

	
	const ID_INVITATION_CODE = 'utente.ID_INVITATION_CODE';

	
	const USERNAME = 'utente.USERNAME';

	
	const NOME = 'utente.NOME';

	
	const COGNOME = 'utente.COGNOME';

	
	const RAGIONE_SOCIALE = 'utente.RAGIONE_SOCIALE';

	
	const PARTITA_IVA = 'utente.PARTITA_IVA';

	
	const CODICE_FISCALE = 'utente.CODICE_FISCALE';

	
	const EMAIL = 'utente.EMAIL';

	
	const PASSWORD = 'utente.PASSWORD';

	
	const DATA_ATTIVAZIONE = 'utente.DATA_ATTIVAZIONE';

	
	const DATA_RINNOVO = 'utente.DATA_RINNOVO';

	
	const TIPO = 'utente.TIPO';

	
	const STATO = 'utente.STATO';

	
	const FATTURA = 'utente.FATTURA';

	
	const LASTLOGIN = 'utente.LASTLOGIN';

	
	const APPROVA_CONTRATTO = 'utente.APPROVA_CONTRATTO';

	
	const APPROVA_POLICY = 'utente.APPROVA_POLICY';

	
	const SCONTO = 'utente.SCONTO';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'IdInvitationCode', 'Username', 'Nome', 'Cognome', 'RagioneSociale', 'PartitaIva', 'CodiceFiscale', 'Email', 'Password', 'DataAttivazione', 'DataRinnovo', 'Tipo', 'Stato', 'Fattura', 'Lastlogin', 'ApprovaContratto', 'ApprovaPolicy', 'Sconto', ),
		BasePeer::TYPE_COLNAME => array (UtentePeer::ID, UtentePeer::ID_INVITATION_CODE, UtentePeer::USERNAME, UtentePeer::NOME, UtentePeer::COGNOME, UtentePeer::RAGIONE_SOCIALE, UtentePeer::PARTITA_IVA, UtentePeer::CODICE_FISCALE, UtentePeer::EMAIL, UtentePeer::PASSWORD, UtentePeer::DATA_ATTIVAZIONE, UtentePeer::DATA_RINNOVO, UtentePeer::TIPO, UtentePeer::STATO, UtentePeer::FATTURA, UtentePeer::LASTLOGIN, UtentePeer::APPROVA_CONTRATTO, UtentePeer::APPROVA_POLICY, UtentePeer::SCONTO, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'id_invitation_code', 'username', 'nome', 'cognome', 'ragione_sociale', 'partita_iva', 'codice_fiscale', 'email', 'password', 'data_attivazione', 'data_rinnovo', 'tipo', 'stato', 'fattura', 'lastlogin', 'approva_contratto', 'approva_policy', 'sconto', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'IdInvitationCode' => 1, 'Username' => 2, 'Nome' => 3, 'Cognome' => 4, 'RagioneSociale' => 5, 'PartitaIva' => 6, 'CodiceFiscale' => 7, 'Email' => 8, 'Password' => 9, 'DataAttivazione' => 10, 'DataRinnovo' => 11, 'Tipo' => 12, 'Stato' => 13, 'Fattura' => 14, 'Lastlogin' => 15, 'ApprovaContratto' => 16, 'ApprovaPolicy' => 17, 'Sconto' => 18, ),
		BasePeer::TYPE_COLNAME => array (UtentePeer::ID => 0, UtentePeer::ID_INVITATION_CODE => 1, UtentePeer::USERNAME => 2, UtentePeer::NOME => 3, UtentePeer::COGNOME => 4, UtentePeer::RAGIONE_SOCIALE => 5, UtentePeer::PARTITA_IVA => 6, UtentePeer::CODICE_FISCALE => 7, UtentePeer::EMAIL => 8, UtentePeer::PASSWORD => 9, UtentePeer::DATA_ATTIVAZIONE => 10, UtentePeer::DATA_RINNOVO => 11, UtentePeer::TIPO => 12, UtentePeer::STATO => 13, UtentePeer::FATTURA => 14, UtentePeer::LASTLOGIN => 15, UtentePeer::APPROVA_CONTRATTO => 16, UtentePeer::APPROVA_POLICY => 17, UtentePeer::SCONTO => 18, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'id_invitation_code' => 1, 'username' => 2, 'nome' => 3, 'cognome' => 4, 'ragione_sociale' => 5, 'partita_iva' => 6, 'codice_fiscale' => 7, 'email' => 8, 'password' => 9, 'data_attivazione' => 10, 'data_rinnovo' => 11, 'tipo' => 12, 'stato' => 13, 'fattura' => 14, 'lastlogin' => 15, 'approva_contratto' => 16, 'approva_policy' => 17, 'sconto' => 18, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.map.UtenteMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = UtentePeer::getTableMap();
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
		return str_replace(UtentePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(UtentePeer::ID);

		$criteria->addSelectColumn(UtentePeer::ID_INVITATION_CODE);

		$criteria->addSelectColumn(UtentePeer::USERNAME);

		$criteria->addSelectColumn(UtentePeer::NOME);

		$criteria->addSelectColumn(UtentePeer::COGNOME);

		$criteria->addSelectColumn(UtentePeer::RAGIONE_SOCIALE);

		$criteria->addSelectColumn(UtentePeer::PARTITA_IVA);

		$criteria->addSelectColumn(UtentePeer::CODICE_FISCALE);

		$criteria->addSelectColumn(UtentePeer::EMAIL);

		$criteria->addSelectColumn(UtentePeer::PASSWORD);

		$criteria->addSelectColumn(UtentePeer::DATA_ATTIVAZIONE);

		$criteria->addSelectColumn(UtentePeer::DATA_RINNOVO);

		$criteria->addSelectColumn(UtentePeer::TIPO);

		$criteria->addSelectColumn(UtentePeer::STATO);

		$criteria->addSelectColumn(UtentePeer::FATTURA);

		$criteria->addSelectColumn(UtentePeer::LASTLOGIN);

		$criteria->addSelectColumn(UtentePeer::APPROVA_CONTRATTO);

		$criteria->addSelectColumn(UtentePeer::APPROVA_POLICY);

		$criteria->addSelectColumn(UtentePeer::SCONTO);

	}

	const COUNT = 'COUNT(utente.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT utente.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UtentePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UtentePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = UtentePeer::doSelectRS($criteria, $con);
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
		$objects = UtentePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return UtentePeer::populateObjects(UtentePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			UtentePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = UtentePeer::getOMClass();
		$cls = sfPropel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

  static public function getUniqueColumnNames()
  {
    return array(array('username'));
  }
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return UtentePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(UtentePeer::ID); 

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
			$comparison = $criteria->getComparison(UtentePeer::ID);
			$selectCriteria->add(UtentePeer::ID, $criteria->remove(UtentePeer::ID), $comparison);

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
			$affectedRows += UtentePeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(UtentePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(UtentePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Utente) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(UtentePeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += UtentePeer::doOnDeleteCascade($criteria, $con);
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

				$objects = UtentePeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/Banca.php';

						$c = new Criteria();
			
			$c->add(BancaPeer::ID_UTENTE, $obj->getId());
			$affectedRows += BancaPeer::doDelete($c, $con);

			include_once 'lib/model/Bug.php';

						$c = new Criteria();
			
			$c->add(BugPeer::ID_UTENTE, $obj->getId());
			$affectedRows += BugPeer::doDelete($c, $con);

			include_once 'lib/model/Contatto.php';

						$c = new Criteria();
			
			$c->add(ContattoPeer::ID_UTENTE, $obj->getId());
			$affectedRows += ContattoPeer::doDelete($c, $con);

			include_once 'lib/model/CodiceIva.php';

						$c = new Criteria();
			
			$c->add(CodiceIvaPeer::ID_UTENTE, $obj->getId());
			$affectedRows += CodiceIvaPeer::doDelete($c, $con);

			include_once 'lib/model/Fattura.php';

						$c = new Criteria();
			
			$c->add(FatturaPeer::ID_UTENTE, $obj->getId());
			$affectedRows += FatturaPeer::doDelete($c, $con);

			include_once 'lib/model/Impostazione.php';

						$c = new Criteria();
			
			$c->add(ImpostazionePeer::ID_UTENTE, $obj->getId());
			$affectedRows += ImpostazionePeer::doDelete($c, $con);

			include_once 'lib/model/ModoPagamento.php';

						$c = new Criteria();
			
			$c->add(ModoPagamentoPeer::ID_UTENTE, $obj->getId());
			$affectedRows += ModoPagamentoPeer::doDelete($c, $con);

			include_once 'lib/model/Prodotto.php';

						$c = new Criteria();
			
			$c->add(ProdottoPeer::ID_UTENTE, $obj->getId());
			$affectedRows += ProdottoPeer::doDelete($c, $con);

			include_once 'lib/model/TagsFattura.php';

						$c = new Criteria();
			
			$c->add(TagsFatturaPeer::ID_UTENTE, $obj->getId());
			$affectedRows += TagsFatturaPeer::doDelete($c, $con);

			include_once 'lib/model/Tassa.php';

						$c = new Criteria();
			
			$c->add(TassaPeer::ID_UTENTE, $obj->getId());
			$affectedRows += TassaPeer::doDelete($c, $con);

			include_once 'lib/model/TemaFattura.php';

						$c = new Criteria();
			
			$c->add(TemaFatturaPeer::ID_UTENTE, $obj->getId());
			$affectedRows += TemaFatturaPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(Utente $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(UtentePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(UtentePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(UtentePeer::DATABASE_NAME, UtentePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = UtentePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(UtentePeer::DATABASE_NAME);

		$criteria->add(UtentePeer::ID, $pk);


		$v = UtentePeer::doSelect($criteria, $con);

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
			$criteria->add(UtentePeer::ID, $pks, Criteria::IN);
			$objs = UtentePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseUtentePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			Propel::registerMapBuilder('lib.model.map.UtenteMapBuilder');
}
