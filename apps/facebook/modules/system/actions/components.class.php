<?php
/**
 * Created by JetBrains PhpStorm.
 * User: simonsabelis
 * Date: 3/27/13
 * Time: 12:22
 * To change this template use File | Settings | File Templates.
 */

class systemComponents extends kmComponents{

    /** search */

    public function executePropertyResults() {
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();

        $oSearcher = MSHPropertySphinxSearcher::getTotal($this->getUser());
        $this->iTotal = $oSearcher->getResultCount();

        $this->sUrl = $this->generateUrl('facebook_home', array('country' => $oUser->getAttribute('facebook.country')));

        $oUser->setResultsDisplay("photos");
        $oSearcher = MSHPropertySphinxSearcher::searchResultsWithUserFilters($this->getUser(), $oUser->getResultsPage());

        $this->oResult = $oSearcher->getResults();
        $this->iPageCount = ceil($oSearcher->getResultCount()/$oSearcher->getMaxPerPage());
        $this->iCurPage = $oUser->getResultsPage();
    }

    public function executePropertyResultsExtend() {
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        $oSearcher = MSHPropertySphinxSearcher::searchFavorites($oUser, $this->iPage);
        $this->oResult = $oSearcher->getResults();
    }


    public function executeDisplayAndSort() {
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        $this->searchType = $oUser->getSearchSection();
        $this->sUrl = $this->generateUrl('facebook_home', array('country' => $oUser->getAttribute('facebook.country')));

        $oSearcher = MSHPropertySphinxSearcher::getTotal($this->getUser());
        $this->iTotal = $oSearcher->getResultCount();
        $this->iFavorite = MSHPropertySphinxSearcher::countFavorites($oUser);

        $this->aUserSort = $oUser->getSort();

    }

    public function executeFilter() {
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        $oSearcher = MSHPropertySphinxSearcher::getTotal($this->getUser());

        $this->searchType = $oUser->getSearchSection();
        $this->sUrl = $this->generateUrl('facebook_home', array('country' => $oUser->getAttribute('facebook.country')));



        $aFacets = MSHPropertySphinxSearcher::calculateFacets($this->getUser());

        $this->aMax = MSHPropertySphinxSearcher::calculateMaxPerField(array('price','surface','rooms'));

        $this->aFacets = $aFacets;
        $aFilters = $oUser->getFilters();
        $this->aFilters = $aFilters;
        //$this->bCityLevel = sizeof($aFilters['region_id']) > 0;

        $this->sPlace = '';
        $aPlace = $oUser->getPlace();
        if(is_array($aPlace)) {
            $sType = array_pop(array_keys($aPlace));
            $iObject = array_pop($aPlace);
            if($sType == 'region') {
                $oObject = RegionPeer::retrieveByPK($iObject);
                $this->sPlace = $oObject->getDisplay();
            } else if($sType == 'city') {
                $oObject = CityPeer::retrieveByPK($iObject);
                $this->sPlace = $oObject->getDisplay();
            }

        }

        $this->iTotal = $oSearcher->getResultCount();
    }

    /** suggest */
    public function executeSuggest() {

        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        $oRequest = $this->getRequest();

        $this->sBaseLink = MSHTools::getCountryPropertiesUrl($oUser->getCountry());


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

        $this->sTerm = $sTerm;
        $this->sUrl = $this->generateUrl('facebook_home', array('country' => $oUser->getAttribute('facebook.country')));
        //$this->iTotal = (isset($aLocationsCounted['places']['region']) && sizeof($aLocationsCounted['places']['region']) > 0 ? 1 : 0)+(isset($aLocationsCounted['places']['country']) && sizeof($aLocationsCounted['places']['country']) > 0 ? 1 : 0)+(isset($aLocationsCounted['places']['city']) ? sizeof($aLocationsCounted['places']['city']) : 0);
        $this->iTotal = sizeof($aLocations['region'])+sizeof($aLocations['city']);
        $this->bMultiple = sizeof($aTypes) > 0;
        $this->aLocations = $aLocations;
    }
}