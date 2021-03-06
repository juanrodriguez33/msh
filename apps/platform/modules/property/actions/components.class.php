<?php
/**
 * Created by JetBrains PhpStorm.
 * User: simonsabelis
 * Date: 3/27/13
 * Time: 12:22
 * To change this template use File | Settings | File Templates.
 */

class propertyComponents extends kmComponents{

    public function executeProviderAppreciation(sfWebRequest $oRequest) {

        $oProvider = $oRequest->getAttribute('content.provider');

        $oProviderAppreciation = new AssociationAppreciation();
        $oProviderAppreciation->setAssociation($oProvider);
        $oForm = new AssociationAppreciationForm($oProviderAppreciation);

        $bValid = false;
        $bSubmitted = false;
        $bAlreadySubmitted = false;

        $iCountryKnowledge = 0;
        $iCommunication = 0;
        $iFinancialKnowledge = 0;
        $iGuidance = 0;

        if($oRequest->isMethod('POST') && $oRequest->isXmlHttpRequest()) {
            $bSubmitted = true;
            $oForm->bind($oRequest->getParameter($oForm->getName()));
            $aData = $oRequest->getParameter($oForm->getName());
            $iCountryKnowledge = isset($aData['country_knowledge']) ? $aData['country_knowledge'] : 0;
            $iCommunication = isset($aData['communication']) ? $aData['communication'] : 0;
            $iFinancialKnowledge = isset($aData['financial_knowledge']) ? $aData['financial_knowledge'] : 0;
            $iGuidance = isset($aData['guidance']) ? $aData['guidance'] : 0;
            
            // added
            $sEmailAddress = isset($aData['email_address']) ? $aData['email_address'] : NULL;
            
            // check
            if(count(AssociationAppreciationPeer::retrieveByAssociationAndEmail($oProvider->getId(), $sEmailAddress)) >= 1){
                $bAlreadySubmitted = true;
            }else{

                if($oForm->isValid()) {
                    $bValid = true;
                    $oProviderAppreciation = $oForm->save();
                    $oProviderAppreciation->setAssociation($oProvider);
                    $oProviderAppreciation->save();
                }
            }
        }

        $this->iCountryKnowledge = $iCountryKnowledge;
        $this->iCommunication = $iCommunication;
        $this->iFinancialKnowledge = $iFinancialKnowledge;
        $this->iGuidance = $iGuidance;


        $this->bAlreadySubmitted = $bAlreadySubmitted;
        $this->bSubmitted = $bSubmitted;
        $this->bValid = $bValid;
        $this->oForm = $oForm;
        $this->oProvider = $oProvider;
    }

    public function executeBarProviders() {
        $oUser = $this->getUser();
        $this->aProvider = MSHPropertySphinxSearcher::getTopRatedProviders($oUser, 4)->getResults();
        $this->iCountProvider = MSHPropertySphinxSearcher::getTotalProviders($oUser, false)->getResultCount();
    }

    public function executeBarDevelopments() {
        $oUser = $this->getUser();
        $this->aDevelopment = MSHPropertySphinxSearcher::getTopRatedDevelopments($oUser, 4)->getResults();
        $this->iCountDevelopment = MSHPropertySphinxSearcher::getTotalDevelopments($oUser, false)->getResultCount();
    }

    public function executeBarTopProperties() {
        $oUser = $this->getUser();
        $this->oCountry = $oUser->getPhase() > 0 ? $oUser->getCountry() : null;

        $oSearcher = MSHPropertySphinxSearcher::getTopRated($oUser, 4);
        $this->aProperty = $oSearcher;
        $this->iTotal = MSHPropertySphinxSearcher::getTotal($oUser, null, false)->getResultCount();
    }

    public function executeFooterTopProperties() {
        $oRequest = $this->getRequest();
        $oRegion = $oRequest->getAttribute('region_properties', null);
        $oUser = $this->getUser();
        $this->oCountry = $oUser->getPhase() > 0 ? $oUser->getCountry() : null;
        $oCity = $oRequest->getAttribute('city_properties', null);

        $oSearcher = MSHPropertySphinxSearcher::getTopRated($oUser, 4, $oRegion, $oCity);
        $this->aProperty = $oSearcher;
        $this->iTotal = MSHPropertySphinxSearcher::getTotal($oUser, $oRegion, false, $oCity)->getResultCount();
        $this->oRegion = $oRegion;
        $this->oCity = $oCity;
    }

    public function executeFooterTopPropertiesSmall($oRequest) {
        $oUser = $this->getUser();
        $this->oCountry = $oUser->getPhase() > 0 ? $oUser->getCountry() : null;
        
        $sRoute = $oRequest->getPathInfo();
        $aRoute = explode('/',$sRoute);
        
        $this->oRegion = empty($aRoute[3]) ? null : RegionI18nPeer::retrieveBySlug($aRoute[3], $this->oCountry->getId()); 
        $this->oCity = empty($aRoute[4]) ? null : CityI18nPeer::retrieveBySlug($aRoute[4], $this->oRegion->getId());
        if (empty($this->oRegion) && !empty($this->oCity)) {
            $this->oRegion = RegionPeer::retrieveByPK($this->oCity->getRegionId()); 
        }
        
        $cacheData = CacheManager::getInstance()->getFooterTopProperties($this->oCountry, $this->oRegion, $this->oCity);
        if (!empty($cacheData)) {
            $this->aProperty = $cacheData;
        } else {
            $this->aProperty = MSHPropertySphinxSearcher::getTopRated($oUser, 8, $this->oRegion, $this->oCity);
            CacheManager::getInstance()->setFooterTopProperties($this->aProperty, $this->oCountry, $this->oRegion, $this->oCity, CacheManager::aWeek); 
        } 
        
        //$this->iTotal = MSHPropertySphinxSearcher::getTotal($oUser, null, false)->getResultCount();
    }

    public function executeAsideTopProperties() {        
        $oUser = $this->getUser();
        $this->oCountry = $oUser->getPhase() > 0 ? $oUser->getCountry() : null;
        $oSearcher = MSHPropertySphinxSearcher::getTopRated($oUser, 4);
        $this->aProperty = $oSearcher;
        $this->iTotal = MSHPropertySphinxSearcher::getTotal($oUser, null, false)->getResultCount();
    }


    /** search */

    public function executeProviderResults() {
        $oUser = $this->getUser();
        $this->sUrl = MSHTools::getCountryProvidersUrl($oUser->getCountry());

        $oSearcher = MSHPropertySphinxSearcher::getTotalProviders($this->getUser());
        $this->iTotal = $oSearcher->getResultCount();


        $oSearcher = MSHPropertySphinxSearcher::searchProvidersWithUserFilters($this->getUser(), $this->iPage !== NULL ? $this->iPage : 1);
        $this->iFavorite = 0;

        $this->oResult = $oSearcher->getResults();
        $this->iPageCount = ceil($oSearcher->getResultCount()/$oSearcher->getMaxPerPage());
    }

    public function executeProviderResultsExtend() {
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();

        $oSearcher = MSHPropertySphinxSearcher::searchProvidersWithUserFilters($this->getUser(), $this->iPage);

        $this->oResult = $oSearcher->getResults();
    }

    public function executeDevelopmentResults() {
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        $this->sUrl = MSHTools::getCountryPropertiesUrl($oUser->getCountry());


        $oSearcher = MSHPropertySphinxSearcher::getTotalDevelopments($this->getUser());
        $this->iTotal = $oSearcher->getResultCount();

        $oSearcher = MSHPropertySphinxSearcher::searchDevelopmentsWithUserFilters($this->getUser(), $this->iPage !== NULL ? $this->iPage : 1);
        $this->iFavorite = 0;


        $this->oResult = $oSearcher->getResults();
        $this->iPageCount = ceil($oSearcher->getResultCount()/$oSearcher->getMaxPerPage());
    }



    public function executePropertyResults(sfWebRequest $oRequest) {
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        $this->sUrl = MSHTools::getCountryPropertiesUrl($oUser->getCountry());

        $oSearcher = MSHPropertySphinxSearcher::getTotal($this->getUser());
        $this->iTotal = $oSearcher->getResultCount();

        $this->iFavorite = MSHPropertySphinxSearcher::countFavorites($this->getUser());

        if (empty($this->pages)) {
                $this->pages = 1;
        }
        $max = $this->pages * MSHPropertySphinxSearcher::MAXPERPAGEPHOTOLIST;
        $oSearcher = MSHPropertySphinxSearcher::searchResultsWithUserFilters($this->getUser(), $this->iPage !== NULL ? $this->iPage : 1, $max);
        
        if($oUser->getRefine() == 'favorite') {
            if($this->iFavorite > 0) {
                $oFavoritesSearcher = MSHPropertySphinxSearcher::searchFavorites($oUser, $this->iPage !== NULL ? $this->iPage : 1);
                $this->oResult = $oFavoritesSearcher->getResults();
                $this->iPageCount = ceil($oFavoritesSearcher->getResultCount()/$oSearcher->getMaxPerPage());
            } else {
                $this->oResult = array();
                $this->iPageCount = 0;
            }
        } else {
            $this->oResult = $oSearcher->getResults();
            $this->iPageCount = ceil($oSearcher->getResultCount() / $max);
        }
    }

    public function executePropertyResultsExtend() {
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        if($oUser->getRefine() == 'favorite') {
            $oSearcher = MSHPropertySphinxSearcher::searchFavorites($oUser, $this->iPage);
        } else {
            $oSearcher = MSHPropertySphinxSearcher::searchResultsWithUserFilters($this->getUser(), $this->iPage);
        }

        $this->oResult = $oSearcher->getResults();
    }


    public function executeDisplayAndSort() {
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        if($oUser->getSearchSection() == 'provider') {
            $this->sUrl = MSHTools::getCountryProvidersUrl($oUser->getCountry());
        } else if($oUser->getSearchSection() == 'property') {
            $this->sUrl = MSHTools::getCountryPropertiesUrl($oUser->getCountry());
        } else if($oUser->getSearchSection() == 'development') {
            $this->sUrl = MSHTools::getCountryDevelopmentsUrl($oUser->getCountry());
        }
        $this->searchType = $oUser->getSearchSection();

        $oSearcher = MSHPropertySphinxSearcher::getTotal($this->getUser());
        $this->iTotal = $oSearcher->getResultCount();
        $this->iFavorite = MSHPropertySphinxSearcher::countFavorites($oUser);

        $this->aUserSort = $oUser->getSort();

    }

    public function executeFilter() {
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        if($oUser->getSearchSection() == 'provider') {
            $this->sUrl = MSHTools::getCountryProvidersUrl($oUser->getCountry());
            $oSearcher = MSHPropertySphinxSearcher::getTotalProviders($this->getUser());
        } else if($oUser->getSearchSection() == 'property') {
            $this->sUrl = MSHTools::getCountryPropertiesUrl($oUser->getCountry());
            $oSearcher = MSHPropertySphinxSearcher::getTotal($this->getUser());
        } else if($oUser->getSearchSection() == 'development') {
            $this->sUrl = MSHTools::getCountryDevelopmentsUrl($oUser->getCountry());
            $oSearcher = MSHPropertySphinxSearcher::getTotalDevelopments($this->getUser());
        }
        $this->searchType = $oUser->getSearchSection();



        $aFacets = MSHPropertySphinxSearcher::calculateFacets($this->getUser());

        $this->aMax = MSHPropertySphinxSearcher::calculateMaxPerField(array('price','surface','bedrooms'));

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


        $oI18n = $this->getContext()->getI18N();

        $aExtraFilter = $oUser->getExtraFilter();
        if(isset($aExtraFilter['type'])) {
            if($aExtraFilter['type'] == 'development') {
                $oDevelopment = DevelopmentPeer::retrieveByPK($aExtraFilter['id']);
                if(null!==$oDevelopment) {
                    $this->aExtraFilter = array($oI18n->__('filter.development'), $oDevelopment->getTitle());
                }
            } else if($aExtraFilter['type'] == 'provider') {
                $oProvider = AssociationPeer::retrieveByPK($aExtraFilter['id']);
                if(null!==$oProvider) {
                    $this->aExtraFilter = array($oI18n->__('filter.provider'), $oProvider->getTitle());
                }
            }
        }

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

        //var_dump($aLocations);
        //$aLocationsCounted = MSHPropertySphinxSearcher::calculateSuggestCounts($this->getUser(),$aLocations);
        //var_dump($aLocationsCounted);

        $this->sTerm = $sTerm;
        //$this->iTotal = (isset($aLocationsCounted['places']['region']) && sizeof($aLocationsCounted['places']['region']) > 0 ? 1 : 0)+(isset($aLocationsCounted['places']['country']) && sizeof($aLocationsCounted['places']['country']) > 0 ? 1 : 0)+(isset($aLocationsCounted['places']['city']) ? sizeof($aLocationsCounted['places']['city']) : 0);
        $this->iTotal = sizeof($aLocations['region'])+sizeof($aLocations['city']);
        $this->bMultiple = sizeof($aTypes) > 0;
        $this->aLocations = $aLocations;
    }

    /** suggest */
    public function executeSuggestHome() {

        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        $oRequest = $this->getRequest();

        $sTerm = $oRequest->getParameter('input', null);

        $aLocations = array(
            'country' => array(),
            'region' => array(),
            'city' => array(),
        );
        $aLocationsCounted = $aLocations;
        $aTypes = array();

        if(!preg_match("/\s{2,}/",$sTerm)) {

            if($sTerm !== null && strlen($sTerm) > 0) {
                $aResults = MSHLocationSphinxSearcher::searchLocation($sTerm);

                foreach($aResults as $aResult) {

                    if($aResult['attrs']['type'] == 'city') {
                        $oCity = CityPeer::retrieveByPK($aResult['attrs']['object_id']);

                        $sLabel = $aResult['attrs']['title'] . ', ' . $oCity->getRegion() . ', ' . $oCity->getCountry()->getTitle();
                    } else if($aResult['attrs']['type'] == 'region') {
                        $oRegion = RegionPeer::retrieveByPK($aResult['attrs']['object_id']);

                        $sLabel = $aResult['attrs']['title'] . ', ' . $oRegion->getCountry()->getTitle();
                    } else {
                        $oCountry = CountryPeer::retrieveByPK($aResult['attrs']['object_id']);
                        if(false !== stripos($oCountry->getTitle(), $sTerm)) {
                            $sLabel = $oCountry->getTitle();
                        } else {
                            $sLabel = $aResult['attrs']['title'];
                        }

                    }

                    if(stripos($sLabel, $sTerm) === false)
                        continue;

                    $aLocations[$aResult['attrs']['type']][$aResult['attrs']['object_id']] = $sLabel;
                    $aLocationsCounted[$aResult['attrs']['type']][] = $aResult['attrs']['object_id'];
                }
            }
        }

        //var_dump($aLocations);
        $aLocationsCounted = MSHPropertySphinxSearcher::calculateSuggestCounts($this->getUser(),$aLocations);

        $this->sTerm = $sTerm;
        //$this->iTotal = (isset($aLocationsCounted['places']['region']) && sizeof($aLocationsCounted['places']['region']) > 0 ? 1 : 0)+(isset($aLocationsCounted['places']['country']) && sizeof($aLocationsCounted['places']['country']) > 0 ? 1 : 0)+(isset($aLocationsCounted['places']['city']) ? sizeof($aLocationsCounted['places']['city']) : 0);
        $this->iTotal = sizeof($aLocationsCounted['places']['country'])+sizeof($aLocationsCounted['places']['region'])+sizeof($aLocationsCounted['places']['city']);
        $this->bMultiple = sizeof($aTypes) > 0;
        $this->aLocations = $aLocationsCounted['places'];
    }

    
    /** search box **/
    public function executeSearchBox() {
           /** @var MSHWebsiteUser $oUser */
        $oRequest = $this->getRequest();
        $oUser = $this->getUser();
        
        $aFacets = MSHPropertySphinxSearcher::calculateFacets($this->getUser());
        $this->aMax = MSHPropertySphinxSearcher::calculateMaxPerField(array('price','bedrooms'));
        $this->aFacets = $aFacets;
        $aFilters = $oUser->getFilters();
        $this->aFilters = $aFilters;

        $this->sPlace = '';
        $aPlace = $oUser->getPlace();

        $oRegion = $oRequest->getAttribute('content.region');
        if (!empty($oRegion)) {
            $this->selectedRegionId = $oRegion->getId(); 
        
            $oCity = $oRequest->getAttribute('content.city');
            if (!empty($oCity)) {
				if (!is_object($oCity)) {
					$oCity = CityI18nPeer::searchByTitle($oCity);
					$oCity = $oCity[0];
				}
								
				$this->selectedCityId = $oCity->getId(); 
				$this->selectedCity = $oCity->getTitle();				
            }
            
            if (!empty($this->selectedRegionId)){
                $this->aCity = CityPeer::retrieveByRegion($this->selectedRegionId, $oUser->getCulture(), true);
            }
        } else {
            if(is_array($aPlace)) {
                $sType = array_pop(array_keys($aPlace));
                $iObject = array_pop($aPlace);
                if($sType == 'region') {
                    $oObject = RegionPeer::retrieveByPK($iObject);
                    $this->selectedRegionId = $iObject;
                    $this->sPlace = $oObject->getDisplay();
                }
                if($sType == 'city') {
                    $oObject = CityPeer::retrieveByPK($iObject);
                    $this->sPlace = $oObject->getDisplay();
                    $city = CityPeer::retrieveForList($iObject, $oUser->getCulture());
                    $this->selectedCity = $city[0]->getTitle();
                    $this->selectedRegionId = $city[0]->getRegionId();
                }
            }
        }

        $this->aRegion = $oUser->getCountry()->getRegions($oUser->getCulture());
        $this->currentCountrySlug = $oUser->getCountry()->getSlug();
        $this->sUrl = "";
    }
    
}