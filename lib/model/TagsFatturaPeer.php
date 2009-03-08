<?php

  // include base peer class
  require_once 'lib/model/om/BaseTagsFatturaPeer.php';
  
  // include object class
  include_once 'lib/model/TagsFattura.php';


/**
 * Skeleton subclass for performing query and update operations on the 'tags_fattura' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class TagsFatturaPeer extends BaseTagsFatturaPeer {
	public static function getTagsForUserLike($user_id, $tag, $max = 10)
	{
		$tags = array();

		$con = Propel::getConnection();
		$query = '
    SELECT DISTINCT %s AS tag
    FROM %s
    WHERE %s = ? AND %s LIKE ?
    ORDER BY %s
  ';

		$query = sprintf($query,
		TagsFatturaPeer::TAG,
		TagsFatturaPeer::TABLE_NAME,
		TagsFatturaPeer::ID_UTENTE ,
		TagsFatturaPeer::TAG,
		TagsFatturaPeer::TAG
		);

		$stmt = $con->prepare($query);
		$stmt->setInt(1, $user_id);
		$stmt->setString(2, $tag.'%');
		$stmt->setLimit($max);
		$rs = $stmt->execute();
		while ($rs->next())
		{
			$tags[] = $rs->getString('tag');
		}

		return $tags;
	}
	
	public static function getPopularTags($max = 5)
	{
		$tags = array();

		$con = Propel::getConnection();
		$query = '
    SELECT '.TagsFatturaPeer::TAG_NORMALIZZATO.' AS tag,
    COUNT('.TagsFatturaPeer::TAG_NORMALIZZATO.') AS count
    FROM '.TagsFatturaPeer::TABLE_NAME.'
    WHERE '.TagsFatturaPeer::ID_UTENTE .' = '.sfContext::getInstance()->getUser()->getAttribute('id_utente').'
    GROUP BY '.TagsFatturaPeer::TAG_NORMALIZZATO.'
    ORDER BY count DESC';
//echo $query;
		$stmt = $con->prepare($query);
		$stmt->setLimit($max);
		$rs = $stmt->execute();
		$max_popularity = 0;
		while ($rs->next())
		{
			if (!$max_popularity)
			{
				$max_popularity = $rs->getInt('count');
			}

			$tags[$rs->getString('tag')] = floor(($rs->getInt('count') / $max_popularity * 3) + 1);
		}

		ksort($tags);

		return $tags;
	}
} // TagsFatturaPeer
