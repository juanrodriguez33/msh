<?php

class kmValidatorSign_in{
	
	public static function execute($oValidator, $sValue, $aArguments){
		$oAdmin = UserPeer::retrieveAdminByEmail($sValue);
		if(!$oAdmin || sha1($oAdmin->getSalt().$aArguments['password']) != $oAdmin->getPassword()) throw new sfValidatorError($oValidator, 'invalid');
		else                                                                                      return $oAdmin;
	}
	
}