<?php

require_once 'lib/model/om/BaseInvitationCode.php';


/**
 * Skeleton subclass for representing a row from the 'invitation_code' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class InvitationCode extends BaseInvitationCode {

	public function check(){
		$criteria = new Criteria();
		$criteria->add(UtentePeer::ID_INVITATION_CODE, $this->id);
		
		if(is_null(UtentePeer::doSelectOne($criteria)))
			return true;
		else 
			return false;
	}
} // InvitationCode
