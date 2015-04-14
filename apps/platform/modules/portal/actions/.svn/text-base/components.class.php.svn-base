<?php
/**
 * Created by JetBrains PhpStorm.
 * User: simonsabelis
 * Date: 3/27/13
 * Time: 11:54
 * To change this template use File | Settings | File Templates.
 */

class portalComponents extends kmComponents {

    public function executeHeader(sfWebRequest $oRequest) {
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();

        $oSiteUser = $oUser->getUser();

        if($oUser->hasCredential('ROLE_ASSOCIATION')) {
            $this->iMaxProperties = $oUser->getUser()->getAssociation()->getMaxProperties();
            $this->iActiveProperties = PropertyPeer::retrieveCountForProvider($oSiteUser->getAssociationId(), true);
            $this->iDevelopment = DevelopmentPeer::retrieveCountForProvider($oSiteUser->getAssociationId());
            $this->iMaxDevelopment = $oUser->getUser()->getAssociation()->getMaxDevelopments();
            $this->fMonthly = $oUser->getUser()->getAssociation()->getContract()->getPrice();

            $this->iMaxCredits = $oUser->getUser()->getAssociation()->getCredits();
            $this->iCredits = $oUser->getUser()->getAssociation()->getAvailableCredits();
        } else {
            $this->iActiveProperties = PropertyPeer::retrieveCountForUser($oSiteUser->getId(), true);

            $this->iMaxCredits = $oUser->getUser()->getCredits();
            $this->iCredits = $oUser->getUser()->getAvailableCredits();
        }
    }

    public function executeTotalBlock() {
        /** @var myUser $oUser  */
        $oUser = $this->getUser();

        if($oUser->hasCredential("ROLE_ASSOCIATION")) {
            $sSearch = 'p#a:'.$oUser->getUser()->getAssociationId() .'#';
        } else {
            $sSearch = 'p#u:'.$oUser->getUser()->getId() .'#';
        }

        $oAnalytics = GoogleAnalytics::getInstance($this->getUser());
        $aResults = array();

        if(!$oAnalytics->needsAccess()) {
            if(isset($this->bFullperiod) && $this->bFullperiod) {
                $aTotals = $oAnalytics->getTotals($sSearch, '2013-01-01', date('Y-m-d'));
            } else {
                $aTotals = $oAnalytics->getTotals($sSearch, $oUser->getGraphStartDate(), $oUser->getGraphEndDate());
            }
            foreach($aTotals as $oTotals) {
                if(isset($oTotals->rows)) {
                    foreach($oTotals->rows as $aRow) {
                        if(isset($aResults[$aRow[0]])) {
                            $aResults[$aRow[0]] += $aRow[1];
                        } else {
                            $aResults[$aRow[0]] = $aRow[1];
                        }

                    }
                }
            }
        }
        $this->aTotals = $aResults;
    }

    public function executeDemographyBlock() {

        /** @var myUser $oUser  */
        $oUser = $this->getUser();

        if($oUser->hasCredential("ROLE_ASSOCIATION")) {
            $sSearch = 'p#a:'.$oUser->getUser()->getAssociationId() .'#';
        } else {
            $sSearch = 'p#u:'.$oUser->getUser()->getId() .'#';
        }

        $oAnalytics = GoogleAnalytics::getInstance($this->getUser());
        $aResults = array();

        $aCountry = CountryPeer::retrieveActive();

        foreach($aCountry as $oCountry) {
            $aResults[$oCountry->getTitle('en')] = array("iTotal" => 0, "iPerc" => 0.00);
        }
        //$aResults["Buitenland"] = array("iTotal" => 0, "iPerc" => 0.00);
        //$aResults["Onbekend"] = array("iTotal" => 0, "iPerc" => 0.00);

        if(!$oAnalytics->needsAccess()) {
            $aTotals = $oAnalytics->getEventActionDemographicData($sSearch, $oUser->getGraphMetric(), $oUser->getGraphStartDate(), $oUser->getGraphEndDate());

            $aCountry = array();

            $iTotalForall = 0;

            foreach($aTotals as $oTotals) {
                if(isset($oTotals->rows)) {
                    $oTotalForAll = $oTotals->totalsForAllResults;

                    foreach($oTotalForAll as $sKey => $sValue) {
                        if($sKey == "ga:totalEvents")
                            $iTotalForall += intval($sValue);
                    }
                    foreach($oTotals->rows as $aRow) {
                        if(isset($aCountry[$aRow[0]])) {
                            $aCountry[$aRow[0]] += intval($aRow[1]);
                        } else {
                            $aCountry[$aRow[0]] = intval($aRow[1]);
                        }
                    }
                }
            }
            arsort($aCountry);

            $i=0;
            foreach($aCountry as $sCountry => $iTotalCountry) {
                $aResults[$sCountry] = array("iTotal" => $iTotalCountry, "iPerc" => ($iTotalForall > 0 ? (intval($iTotalCountry)/$iTotalForall * 100) : 0));
                $i++;
                if($i == 10) {
                    break;
                }
            }
            arsort($aResults);
        }

        $this->aTotals = $aResults;
    }

    public function executeBestShownBlock() {
        /** @var myUser $oUser  */
        $oUser = $this->getUser();

        if($oUser->hasCredential("ROLE_ASSOCIATION")) {
            $sSearch = 'p#a:'.$oUser->getUser()->getAssociationId() .'#';
        } else {
            $sSearch = 'p#u:'.$oUser->getUser()->getId() .'#';
        }

        $oAnalytics = GoogleAnalytics::getInstance($this->getUser());
        $aResults = array();

        if(!$oAnalytics->needsAccess()) {
            $aTotals = $oAnalytics->getEventActionBestShownData($sSearch, $oUser->getGraphMetric(), $oUser->getGraphStartDate(), $oUser->getGraphEndDate(), $oUser->getGraphCountry());

            $aProperty = array();

            $iTotalForall = 0;

            foreach($aTotals as $oTotals) {
                if(isset($oTotals->rows)) {
                    $oTotalForAll = $oTotals->totalsForAllResults;
                    foreach($oTotalForAll as $sKey => $sValue) {
                        if($sKey == "ga:totalEvents")
                            $iTotalForall += intval($sValue);
                    }
                    foreach($oTotals->rows as $aRow) {
                        $iId = substr($aRow[0],strrpos($aRow[0],'#')+1);
                        if(isset($aProperty[$iId])) {
                            $aProperty[$iId] += intval($aRow[2]);
                        } else {
                            $aProperty[$iId] = intval($aRow[2]);
                        }
                    }
                    arsort($aProperty);
                }
            }
            $i=0;
            foreach($aProperty as $iProperty => $iTotalProperty) {

                /** @var Property $oProperty */
                $oProperty = PropertyPeer::retrieveById($iProperty, true);
                if(null!==$oProperty) {
                    $aResults[] = array("sLabel" => $oProperty->getAddress1().', '. $oProperty->getCity(), "iTotal" => $iTotalProperty, "iPerc" => ($iTotalForall > 0 ? (intval($iTotalProperty)/$iTotalForall * 100) : 0));
                } else {
                    continue;
                }
                $i++;
                if($i == 10) {
                    break;
                }
            }
            arsort($aProperty);
        }
        $this->aTotals = $aResults;
    }
}