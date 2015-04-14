<?php

class myUser extends sfBasicSecurityUser
{

    const COOKIE_TIME = 15552000; //3600 * 24 * 180; // 180 days
    const SALT = "@V1NDJ3PL3K#S8LT!";

    protected $aCookieAttributes = array('favorites','places','last_visited');


    public function getSearchCategory() {
        return $this->getAttribute("search_category",Property::CATEGORY_BUY);
    }

    public function setSearchCategory($iCategory) {
        $this->setAttribute("search_category", $iCategory);
    }


    public function getLocation() {
        return;
        //if($this->getAttribute('user_location') === NULL) {
            // trying to get region out of user ip
            $aLocation = array();
            $aLocation['lat'] = 52.5;
            $aLocation['long'] = 5.75;

            try {
                $oGeoIP = GeoIP::geoip_open(sfConfig::get("sf_plugins_dir").'/kmRealEstatePlugin/lib/geoip/GeoLiteCity.dat', 0);
                $record = $oGeoIP->record_by_addr(sfContext::getInstance()->getRequest()->getRemoteAddress());
                if($record->country_code == "NL" && isset($record->latitude) && $record->latitude !== NULL
                   && isset($record->longitude) && $record->longitude !== NULL) {
                    $aLocation['lat'] = $record->latitude;
                    $aLocation['long'] = $record->longitude;
                    $aLocation['city'] = VindjeplekLocationSphinxSearcher::getNearestCity($aLocation['lat'],$aLocation['long']);
                }
            }
            catch(Exception $oErr) {
                throw new Exception("ERROR: Could not determine location:" . $oErr->getMessage());
            }
            $this->setAttribute('user_location',$aLocation);
        //}
        return $this->getAttribute('user_location');
    }

    public function setNotification($sClass, $sMessage) {
        $this->setAttribute('notification',array('sClass' => $sClass, 'sMessage' => $sMessage));
    }

    public function getNotification() {
        $aNotification = $this->getAttribute('notification', array());
        $this->setAttribute('notification',array());
        if(!isset($aNotification['sClass']) || !isset($aNotification['sMessage'])) {
            return null;
        } else {
            return $aNotification;
        }
    }

    public function getAttribute($sKey, $sDefault = null, $sNs = null)
    {
        $sSessionVal = parent::getAttribute($sKey, null, $sNs);
        if($sSessionVal !== null) {
            return $sSessionVal;
        }
        else if(in_array($sKey, $this->aCookieAttributes)){
            $sCookieVal = sfContext::getInstance()->getRequest()->getCookie(Functions::slugify($sKey));

            if($sCookieVal != null) {
                $sDecryptedVal = $this->decrypt($sCookieVal);
                $unserializedVal = @unserialize($sDecryptedVal);

                if($unserializedVal)
                    return $unserializedVal;
                else
                    //issue error ? cookie value has been altered
                    return $sDefault;
            }
        }
        return $sDefault;
    }

    public function setAttribute($sKey, $sVal, $sNs = null) {
        parent::setAttribute($sKey, $sVal, $sNs);

        if(in_array($sKey, $this->aCookieAttributes)) {
            sfContext::getInstance()->getResponse()->setCookie(Functions::slugify($sKey), $this->encrypt(serialize($sVal)), time()+self::COOKIE_TIME);
        }

    }

    public function encrypt($sVal) {
        return base64_encode($sVal);
        //return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(self::SALT), $sVal, MCRYPT_MODE_CBC, md5(md5(self::SALT))));
    }

    public function decrypt($sVal) {
        return base64_decode($sVal);
        //return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(self::SALT), base64_decode($sVal), MCRYPT_MODE_CBC, md5(md5(self::SALT))), "\0");
    }

    /**
     * @param User $oAdmin
     * @return void
     */
    public function signIn($oAdmin){
        $this->setAuthenticated(true);
        $this->setCulture('en');
        $sLevel = $oAdmin->getUserType()->getTitle();
        $this->setAttribute('admin.id', $oAdmin->getId(), 'admin_module');
        $this->setAttribute("google.auth.refresh_token", sfConfig::get('app_kmrealestate_google_refresh_token',"1/JIFjIbNORwth46nyb7MJTDD4Vvrz8OsTgwJKYnDpskU"), "admin_module");
        switch($sLevel) {
            case "admin":
                $this->addCredential("ROLE_ADMIN");
                break;
            case "association":
                $this->setAttribute('association.id', $oAdmin->getAssociationId(), 'admin_module');
                $this->addCredential("ROLE_ASSOCIATION");
                break;
            case "agency":
                $this->setAttribute('agency.id', $oAdmin->getAgencyId(), 'admin_module');
                $this->addCredential("ROLE_AGENCY");
                break;
            case "property":
                $this->addCredential("ROLE_PROPERTY");
                break;
        }
    }

    public function signOut(){
        $this->clearCredentials();
        $this->setAuthenticated(false);
        session_destroy();
    }

    public function getAdmin() {
        $iAdmin = $this->getAttribute('admin.id', null, 'admin_module');
        if($iAdmin !== null) {
            return UserPeer::retrieveByPK($iAdmin);
        }
        return "";
    }

    public function getAssociationId() {
        return sfConfig::get('app_kmrealestate_association_id');
    }

    public function getAssociation() {
        $iAssociation = $this->getAssociationId();
        if($iAssociation !== null) {
            return AssociationPeer::retrieveByPK($iAssociation);
        }
        return "";
    }

    public function getGraphStartDate() {
        return $this->getAttribute('graph.startDate', date("Y-m-d",strtotime("-1 month")));
    }

    public function setGraphStartDate($sDate) {
        $this->setAttribute('graph.startDate', $sDate);
    }

    public function getGraphEndDate() {
        return $this->getAttribute('graph.endDate', date("Y-m-d"));
    }

    public function setGraphEndDate($sDate) {
        $this->setAttribute('graph.endDate', $sDate);
    }

    public function getGraphMetric() {
        return $this->getAttribute('graph.metric', "displayed");
    }

    public function setGraphMetric($sMetric) {
        $this->setAttribute('graph.metric', $sMetric);
    }

    public function getGraphCountry() {
        return $this->getAttribute('graph.country', "");
    }

    public function setGraphCountry($sCountry) {
        $this->setAttribute('graph.country', $sCountry);
    }

    public function getGraphProperty() {
        return $this->getAttribute('graph.property_id', null);
    }

    public function setGraphProperty($iProperty) {
        $this->setAttribute('graph.property_id', $iProperty);
    }

    public function getGraphAssociation() {
        return $this->getAttribute('graph.association_id', null);
    }

    public function setGraphAssociation($iAssociation) {
        $this->setAttribute('graph.association_id', $iAssociation);
    }
}
