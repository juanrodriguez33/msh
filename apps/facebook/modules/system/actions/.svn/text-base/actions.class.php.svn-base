<?php

/**
 * system actions.
 *
 * @package    mysecondhome
 * @subpackage system
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class systemActions extends kmActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $oRequest)
    {
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        $oUser->setSearchSection('property');
        $oUser->setResultsDisplay("photos");

        $sCountry = $oRequest->getParameter('country');
        $oCountry = MSHTools::checkCountry($sCountry);
        if(null==$oCountry) {
            $this->forward404();
        }
        $oUser->setCountry($oCountry->getId());

        $oUser->setAttribute('facebook.country', $sCountry);

        $this->processRequest($oRequest);

        if($oRequest->isXmlHttpRequest()) {
            $sBox = $oRequest->getParameter("box",null);
            if($sBox !== null) {
                if($sBox == "suggest") {

                    /** @var MSHWebsiteUser $oUser */
                    $oUser = $this->getUser();
                    $oRequest = $this->getRequest();

                    $sTerm = $oRequest->getParameter('input', null);

                    $aLocations = array(
                        'region' => array(),
                        'city' => array(),
                    );
                    $aLocationsCounted = $aLocations;
                    $aTypes = array();

                    if(!preg_match("/\s{2,}/",$sTerm)) {

                        if($sTerm !== null && strlen($sTerm) > 0) {
                            $aResults = MSHLocationSphinxSearcher::searchLocation($sTerm, $oUser->getCountry()->getId());
                            foreach($aResults as $aResult) {

                                if(stripos($aResult['attrs']['title'], $sTerm) === false)
                                    continue;

                                $aLocations[$aResult['attrs']['type']][$aResult['attrs']['object_id']] = $aResult['attrs']['title'];
                                $aLocationsCounted[$aResult['attrs']['type']][] = $aResult['attrs']['object_id'];
                            }
                        }
                    }

                    $aParms = array();
                    $aParms['sUrl'] = $this->generateUrl('facebook_home', array('country' => $oUser->getAttribute('facebook.country')));
                    $aParms['sTerm'] = $sTerm;
                    $aParms['iTotal'] = sizeof($aLocations['region'])+sizeof($aLocations['city']);
                    $aParms['bMultiple'] = sizeof($aTypes) > 0;
                    $aParms['aLocations'] = $aLocations;
                    $aParms['sTerm'] = $sTerm;
                    return $this->renderPartial('system/suggest', $aParms);
                    //return $this->renderComponent('property', 'suggest');
                } else if($sBox == "filter") {
                    $this->getResponse()->setContent($this->getComponent('system', 'filter'));
                    return sfView::NONE;
                }
            }

            $this->getResponse()->setContent($this->getComponent('system', 'propertyResults'));
            return sfView::NONE;
        }
        else {

            $aPlace = $oUser->getPlace();
            foreach($aPlace as $sType => $iObject) {
                if($sType=='region') {
                    $oRegion = RegionPeer::retrieveByPK($iObject);
                    if(null!==$oRegion) {
                        if($oRegion->getCountryId()!==$oUser->getCountry()->getId() ) {
                            $oUser->resetPlace();
                        }
                    }
                } else if($sType == 'city') {
                    $oCity = CityPeer::retrieveByPK($iObject);
                    if(null!==$oCity) {
                        if($oCity->getRegion()->getCountryId()!==$oUser->getCountry()->getId() ) {
                            $oUser->resetPlace();
                        }
                    }
                }
            }

        }

        $this->iFavorite = MSHPropertySphinxSearcher::countFavorites($oUser);
        $this->sUrl = $this->generateUrl('facebook_home', array('country' => $oUser->getAttribute('facebook.country')));

        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase4_property_index'));
        if(null!==$oPageType) {
            $aSeoReplacements = array();
            $aSeoReplacements['country'] = $oCountry->getTitle();
            $sCustomMetaTitle = '';
            $sCustomMetaDesc = '';
            $this->getResponse()->setSlot('seoReplacements', $aSeoReplacements);
            $this->getResponse()->setSlot('meta_title', (null!==$sCustomMetaTitle&&strlen($sCustomMetaTitle)>0) ? $sCustomMetaTitle : $oPageType->getMetaTitle());
            $this->getResponse()->setSlot('meta_description', (null!==$sCustomMetaDesc&&strlen($sCustomMetaDesc)>0) ? $sCustomMetaDesc : $oPageType->getMetaDescription());
        }
    }

    private function processRequest(sfWebRequest $oRequest) {

        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();

        $bClearFilters = $oRequest->getParameter('clearfilters', null);
        if($bClearFilters !== null && $bClearFilters == "true") {
            $oUser->resetFilters();
            $oUser->resetPlace();
            $oUser->setResultsPage(0);
            //$oUser->resetEnabledPlaces();
            if(!$oRequest->isXmlHttpRequest()) {
                $this->redirect($this->generateUrl('facebook_home', array('country' => $oUser->getAttribute('facebook.country'))));
            }
        }
        $bClearFilters = $oRequest->getParameter('clear', null);
        if($bClearFilters !== null && $bClearFilters == "clear") {
            $oUser->resetFilters();
            $oUser->resetPlace();
            $oUser->setResultsPage(0);
            //$oUser->resetEnabledPlaces();
            if(!$oRequest->isXmlHttpRequest()) {
                $this->redirect($this->generateUrl('facebook_home', array('country' => $oUser->getAttribute('facebook.country'))));
            }
        }

        $aFilters = $oRequest->getParameter('filter',array());
        if(is_array($aFilters)) {
            $oUser->setResultsPage(0);
            foreach($aFilters as $sKey => $aFilter) {
                foreach($aFilter as $sFilterKey => $val) {

                    if($sFilterKey === "from") {
                        $oUser->setRangeFilterMin($sKey, doubleval($val));
                    } else if($sFilterKey === "till") {
                        $oUser->setRangeFilterMax($sKey, doubleval($val));
                    } else {
                        $oUser->setCheckboxFilter($sKey, $sFilterKey, $val == "on");

                    }
                }
            }
        }

        $aSort = $oRequest->getParameter('sort', array());
        foreach($aSort as $sKey => $sDir) {
            $oUser->setResultsPage(0);
            $oUser->setSort($sKey, $sDir);
        }

        $sPage = $oRequest->getParameter('page', "");
        if($sPage !== "") {
            $oUser->setResultsPage(intval($sPage));
        }

        $aSetPlace = $oRequest->getParameter('setPlace',null);
        if($aSetPlace !== null && is_array($aSetPlace)) {

            $oUser->setResultsPage(0);
            $oUser->resetCheckboxFilter('region_id');

            foreach($aSetPlace as $sType => $iObject) {
                if($sType=='region') {
                    $oRegion = RegionPeer::retrieveByPK($iObject);
                    if(null!==$oRegion) {
                        $oUser->setCountry($oRegion->getCountry()->getId());
                        $oUser->setPlace($aSetPlace);
                    }
                } else if($sType == 'city') {
                    $oCity = CityPeer::retrieveByPK($iObject);
                    if(null!==$oCity) {
                        $oUser->setCountry($oCity->getCountry()->getId());
                        $oUser->setPlace($aSetPlace);
                    }
                }
            }
        }
    }
}
