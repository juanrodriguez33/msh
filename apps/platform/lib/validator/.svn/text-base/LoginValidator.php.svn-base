<?php

class LoginValidator{
	
	public static function execute($oValidator, $sValue, $aArguments){
		$oUser = UserPeer::retrieveByEmail($sValue);
		if(!$oUser || sha1($oUser->getSalt().$aArguments['password']) != $oUser->getPassword()) throw new sfValidatorError($oValidator, 'invalid');
		else                                                                                      return $oUser;
	}
	
}