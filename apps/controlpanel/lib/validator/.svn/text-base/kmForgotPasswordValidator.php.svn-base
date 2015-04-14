<?php

class kmValidatorForgotPassword{
	
	public static function execute($oValidator, $sValue, $aArguments){
		$oAdmin = UserPeer::retrieveByEmail($sValue);
        if($oAdmin === null)
            throw new sfValidatorError($oValidator, 'invalid');
        else
		    return $oAdmin;
	}
	
}