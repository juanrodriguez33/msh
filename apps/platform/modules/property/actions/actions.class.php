<?php

/**
 * property actions.
 *
 * @package    mysecondhome
 * @subpackage property
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class propertyActions extends kmActions
{
    private $voidEmails = array("mail@mail.com", "manrina.mcgallyster@yahoo.de");
    
    public function preExecute()
    {
        //
        $this->getResponse()->setSlot('bDisableFooterTopProperties', true);
        $this->getResponse()->setSlot('bDisableFooterPhaseOverview', true);
		$this->getResponse()->setSlot('bDisableFooterMostPopular',true);
        
        parent::preExecute();
    }

    public function executeFindHome(sfWebRequest $oRequest) {
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        if(null===$oUser->getCountry()) {
            $this->redirect(MSHTools::getChooseCountryUrl());
        }

        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase4_home'));
        if(null!==$oPageType) {
            $aSeoReplacements = array();
            $aSeoReplacements['country'] = $oUser->getCountry()->getTitle();
            $this->getResponse()->setSlot('seoReplacements', $aSeoReplacements);
            $this->getResponse()->setSlot('meta_title', $oPageType->getMetaTitle());
            $this->getResponse()->setSlot('meta_description', $oPageType->getMetaDescription());
            $this->getResponse()->setSlot('doubleclick', $oPageType->getDoubleclickAd());
            $this->getResponse()->setSlot('doubleclick_head', $oPageType->getDoubleclickHead());
        }

    }

    public function executeProviderIndex(sfWebRequest $oRequest) {

        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        $oUser->setSearchSection('provider');

        $iPage = $oRequest->getParameter("page", null);

        $this->processRequest($oRequest);

        $oUser->setExtraFilter(array());

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
                    $aParms['sBaseLink'] = MSHTools::getCountryPropertiesUrl($oUser->getCountry());
                    $aParms['sTerm'] = $sTerm;
                    $aParms['iTotal'] = sizeof($aLocations['region'])+sizeof($aLocations['city']);
                    $aParms['bMultiple'] = sizeof($aTypes) > 0;
                    $aParms['aLocations'] = $aLocations;
                    $aParms['sTerm'] = $sTerm;
                    return $this->renderPartial('property/suggest', $aParms);
                } else if($sBox == "filter") {
                    return $this->renderComponent('property', 'filter');
                }
            }

            $bExtend = false;
            if($iPage !== null) {
                $bExtend = true;
            }

            $sDisplayType = $this->getUser()->getResultsDisplay();
            if($sDisplayType == "map") {
                return $this->renderComponent('property', 'providerResults');
            } else {
                if($bExtend)
                    return $this->renderComponent('property', 'providerResultsExtend', array('iPage' => $iPage));
                else
                    return $this->renderComponent('property', 'providerResults');
            }
        }
        else {
            $this->iPage = $iPage;

            $sDisplayType = $this->getUser()->getResultsDisplay();
            if($sDisplayType == "photos") {
                $this->sResultsType = "photos";
            } else if($sDisplayType == "map") {
                $this->sResultsType = "map";
            } else {
                $this->sResultsType = "list";
            }

            $this->sTab = $this->getUser()->getRefine();

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
        $this->sUrl = MSHTools::getCountryPropertiesUrl($oUser->getCountry());

        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase4_provider_index'));
        if(null!==$oPageType) {
            $aSeoReplacements = array();
            $aSeoReplacements['country'] = $oUser->getCountry()->getTitle();
            $sCustomMetaTitle = '';
            $sCustomMetaDesc = '';
            $this->getResponse()->setSlot('seoReplacements', $aSeoReplacements);
            $this->getResponse()->setSlot('meta_title', (null!==$sCustomMetaTitle&&strlen($sCustomMetaTitle)>0) ? $sCustomMetaTitle : $oPageType->getMetaTitle());
            $this->getResponse()->setSlot('meta_description', (null!==$sCustomMetaDesc&&strlen($sCustomMetaDesc)>0) ? $sCustomMetaDesc : $oPageType->getMetaDescription());
            $this->getResponse()->setSlot('doubleclick', $oPageType->getDoubleclickAd());
            $this->getResponse()->setSlot('doubleclick_head', $oPageType->getDoubleclickHead());
        }
    }

    public function executeProviderDetail(sfWebRequest $oRequest) {
        /** @var Association $oProvider */
        $oProvider = $oRequest->getAttribute('content.provider');

        $oUser = $this->getUser();
        $this->oProvider = $oProvider;

        $this->iCountProperty = MSHPropertySphinxSearcher::getTotalForFilters($oUser, array('country_id' => array($oUser->getCountry()->getId()), 'association_id' =>array($oProvider->getId())));
        $this->aProperty = MSHPropertySphinxSearcher::searchResultsWithFilters($oUser, array('association_id' => array($oProvider->getId())), 8, 1, true)->getResults();

        $oContactForm = new ContactRequestForm();

        if($oRequest->isXmlHttpRequest()) {
            $sBox = $oRequest->getParameter('box');
            if($sBox == 'appreciation') {
                return $this->renderComponent('property', 'providerAppreciation');
            }
        }
        else if($oRequest->isMethod("POST") && $oRequest->hasParameter($oContactForm->getName())) {
            $oContactForm->bind($oRequest->getParameter($oContactForm->getName()));
            if($oContactForm->isValid()) {
                /** @var ContactRequest $oContactRequest */
                $oContactRequest = $oContactForm->save();
                
                //ugly check for void email addresses
                if (!in_array($oContactRequest->getEmailAddress(), $this->voidEmails)) {
                    $oContactRequest->setAssociation($oProvider);
                    $oContactRequest->save();
                    $oMailer = new MSHMailer();
                    $oMailer->mailContactRequestSent($oContactRequest);
                    $oMailer->mailContactRequestReceived($oContactRequest);
                }
            }
        }

        $this->oForm = $oContactForm;

        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase4_provider_detail'));
        if(null!==$oPageType) {
            $aSeoReplacements = array();
            $aSeoReplacements['country'] = $oUser->getCountry()->getTitle();
            $aSeoReplacements['provider'] = $oProvider->getTitle();
            $sCustomMetaTitle = '';
            $sCustomMetaDesc = '';
            $this->getResponse()->setSlot('seoReplacements', $aSeoReplacements);
            $this->getResponse()->setSlot('meta_title', (null!==$sCustomMetaTitle&&strlen($sCustomMetaTitle)>0) ? $sCustomMetaTitle : $oPageType->getMetaTitle());
            $this->getResponse()->setSlot('meta_description', (null!==$sCustomMetaDesc&&strlen($sCustomMetaDesc)>0) ? $sCustomMetaDesc : $oPageType->getMetaDescription());
            $this->getResponse()->setSlot('doubleclick', $oPageType->getDoubleclickAd());
            $this->getResponse()->setSlot('doubleclick_head', $oPageType->getDoubleclickHead());
        }
    }

    // development index
    public function executeDevelopmentIndex(sfWebRequest $oRequest) {
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        $oUser->setSearchSection('development');

        $iPage = $oRequest->getParameter("page", null);

        $oUser->setExtraFilter(array());

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
                    $aParms['sBaseLink'] = MSHTools::getCountryPropertiesUrl($oUser->getCountry());
                    $aParms['sTerm'] = $sTerm;
                    $aParms['iTotal'] = sizeof($aLocations['region'])+sizeof($aLocations['city']);
                    $aParms['bMultiple'] = sizeof($aTypes) > 0;
                    $aParms['aLocations'] = $aLocations;
                    $aParms['sTerm'] = $sTerm;
                    return $this->renderPartial('property/suggest', $aParms);
                } else if($sBox == "filter") {
                    return $this->renderComponent('property', 'filter');
                }
            }

            $bExtend = false;
            if($iPage !== null) {
                $bExtend = true;
            }

            $sDisplayType = $this->getUser()->getResultsDisplay();
            if($sDisplayType == "map") {
                return $this->renderComponent('property', 'developmentResults');
            } else {
                if($bExtend)
                    return $this->renderComponent('property', 'developmentResultsExtend', array('iPage' => $iPage));
                else
                    return $this->renderComponent('property', 'developmentResults');
            }
        }
        else {
            $this->iPage = $iPage;

            $sDisplayType = $this->getUser()->getResultsDisplay();
            if($sDisplayType == "photos") {
                $this->sResultsType = "photos";
            } else if($sDisplayType == "map") {
                $this->sResultsType = "map";
            } else {
                $this->sResultsType = "list";
            }

            $this->sTab = $this->getUser()->getRefine();

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
                    $oCity = CityPeer::retrieveByPK(intval($iObject));
                    if(null!==$oCity) {
                        $iUserCountry = $oUser->getCountry()->getId();
                        if($oCity->getCountry()->getId() !== $oUser->getCountry()->getId()) {
                            $oUser->resetPlace();
                        }
                    }
                }
            }

        }

        $this->iFavorite = MSHPropertySphinxSearcher::countFavorites($oUser);
        $this->sUrl = MSHTools::getCountryPropertiesUrl($oUser->getCountry());

        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase4_development_index'));
        if(null!==$oPageType) {
            $aSeoReplacements = array();
            $aSeoReplacements['country'] = $oUser->getCountry()->getTitle();
            $sCustomMetaTitle = '';
            $sCustomMetaDesc = '';
            $this->getResponse()->setSlot('seoReplacements', $aSeoReplacements);
            $this->getResponse()->setSlot('meta_title', (null!==$sCustomMetaTitle&&strlen($sCustomMetaTitle)>0) ? $sCustomMetaTitle : $oPageType->getMetaTitle());
            $this->getResponse()->setSlot('meta_description', (null!==$sCustomMetaDesc&&strlen($sCustomMetaDesc)>0) ? $sCustomMetaDesc : $oPageType->getMetaDescription());
            $this->getResponse()->setSlot('doubleclick', $oPageType->getDoubleclickAd());
            $this->getResponse()->setSlot('doubleclick_head', $oPageType->getDoubleclickHead());
        }
    }

    // development detail
    public function executeDevelopmentDetail(sfWebRequest $oRequest) {
        $oDevelopment = $oRequest->getAttribute('content.development');

        $oUser = $this->getUser();
        $this->oDevelopment = $oDevelopment;

        $this->iCountProperty = MSHPropertySphinxSearcher::getTotalForFilters($oUser, array('country_id' => array($oUser->getCountry()->getId()), 'development_id' =>array($oDevelopment->getId())));
        $this->aProperty = MSHPropertySphinxSearcher::searchResultsWithFilters($oUser, array('development_id' => array($oDevelopment->getId())), 8, 1, true)->getResults();

        $oContactForm = new ContactRequestForm();

        if($oRequest->isMethod("POST")) {
            $oContactForm->bind($oRequest->getParameter($oContactForm->getName()));
            if($oContactForm->isValid()) {
                /** @var ContactRequest $oContactRequest */
                $oContactRequest = $oContactForm->save();
                 //ugly check for void email addresses
                if (!in_array($oContactRequest->getEmailAddress(), $this->voidEmails)) {
                    $oContactRequest->setDevelopment($oDevelopment);
                    $oContactRequest->save();
                    $oMailer = new MSHMailer();
                    $oMailer->mailContactRequestSent($oContactRequest);
                    $oMailer->mailContactRequestReceived($oContactRequest);
                }
            }
        }

        $this->oForm = $oContactForm;

        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase4_development_detail'));
        if(null!==$oPageType) {
            $aSeoReplacements = array();
            $aSeoReplacements['country'] = $oUser->getCountry()->getTitle();
            $aSeoReplacements['development'] = $oDevelopment->getTitle();
            $sCustomMetaTitle = '';
            $sCustomMetaDesc = '';
            $this->getResponse()->setSlot('seoReplacements', $aSeoReplacements);
            $this->getResponse()->setSlot('meta_title', (null!==$sCustomMetaTitle&&strlen($sCustomMetaTitle)>0) ? $sCustomMetaTitle : $oPageType->getMetaTitle());
            $this->getResponse()->setSlot('meta_description', (null!==$sCustomMetaDesc&&strlen($sCustomMetaDesc)>0) ? $sCustomMetaDesc : $oPageType->getMetaDescription());
            $this->getResponse()->setSlot('doubleclick', $oPageType->getDoubleclickAd());
            $this->getResponse()->setSlot('doubleclick_head', $oPageType->getDoubleclickHead());
        }
    }

    public function executePropertyRegionIndex(sfWebRequest $oRequest) {
        $this->executePropertyIndex($oRequest);

        $oRegion = $oRequest->getAttribute('content.region');

        $oUser = $this->getUser();

        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase4_property_region_index'));
        
        if(null!==$oPageType) {
            $aSeoReplacements = array();
            $aSeoReplacements['country'] = $oUser->getCountry()->getTitle();
            $aSeoReplacements['region'] = $oRegion->getTitle();
            $sCustomMetaTitle = '';
            $sCustomMetaDesc = '';
            $this->getResponse()->setSlot('seoReplacements', $aSeoReplacements);
            $this->getResponse()->setSlot('meta_title', (null!==$sCustomMetaTitle&&strlen($sCustomMetaTitle)>0) ? $sCustomMetaTitle : $oPageType->getMetaTitle());
            $this->getResponse()->setSlot('meta_description', (null!==$sCustomMetaDesc&&strlen($sCustomMetaDesc)>0) ? $sCustomMetaDesc : $oPageType->getMetaDescription());
            $this->getResponse()->setSlot('doubleclick', $oPageType->getDoubleclickAd());
            $this->getResponse()->setSlot('doubleclick_head', $oPageType->getDoubleclickHead());
        }
        
        
        $oUser->resetPlace();
        $oUser->resetFilters();
        
        $oUser->setPlace(array('region' =>$oRegion->getId()));
        
        $this->setTemplate('propertyIndex');
    }
    
    public function executePropertyCityIndex(sfWebRequest $oRequest) {
        $this->executePropertyIndex($oRequest);

        $oUser = $this->getUser();
        $oCity = $oRequest->getAttribute('content.city');
        $oRegion = $oRequest->getAttribute('content.region');

        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase4_property_city_index'));
        
        if(null!==$oPageType) {
            $aSeoReplacements = array();
            $aSeoReplacements['country'] = $oUser->getCountry()->getTitle();
            $aSeoReplacements['region'] = $oRegion->getTitle();
            $aSeoReplacements['city'] = $oCity->getTitle();
            $sCustomMetaTitle = '';
            $sCustomMetaDesc = '';
            $this->getResponse()->setSlot('seoReplacements', $aSeoReplacements);
            $this->getResponse()->setSlot('meta_title', (null!==$sCustomMetaTitle&&strlen($sCustomMetaTitle)>0) ? $sCustomMetaTitle : $oPageType->getMetaTitle());
            $this->getResponse()->setSlot('meta_description', (null!==$sCustomMetaDesc&&strlen($sCustomMetaDesc)>0) ? $sCustomMetaDesc : $oPageType->getMetaDescription());
            $this->getResponse()->setSlot('doubleclick', $oPageType->getDoubleclickAd());
            $this->getResponse()->setSlot('doubleclick_head', $oPageType->getDoubleclickHead());
        }
        
        $oUser->resetPlace();

       // do not lose filter
       // $oUser->resetFilters();
        
        $oUser->setPlace(array('region' =>$oRegion->getId()));
        $oUser->setPlace(array('city' =>$oCity->getId()));
        
        $this->setTemplate('propertyIndex');
        $this->oRegion = $oRegion;
        $this->oCity = $oCity;
        
    }
    

    // property index
    public function executePropertyIndex(sfWebRequest $oRequest) {
        $this->getResponse()->addCacheControlHttpHeader('max_age=60');
        $this->getResponse()->addCacheControlHttpHeader('no-cache');
        $this->getResponse()->addCacheControlHttpHeader('must-revalidate');
        $this->getResponse()->addCacheControlHttpHeader('no-store');
                
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        $oUser->setSearchSection('property');
        
        $pathId = $oRequest->getPathInfo();
        $key = "last-viewed-page-" . $pathId;
        $iPage = empty($_COOKIE[$key]) ? null : $_COOKIE[$key];

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
                                
                               /*
                                 
                                  commented this to enable search box
                                  
                                  if(stripos($aResult['attrs']['title'], $sTerm) === false)
                                    continue;
*/
                                $aLocations[$aResult['attrs']['type']][$aResult['attrs']['object_id']] = $aResult['attrs']['title'];
                                $aLocationsCounted[$aResult['attrs']['type']][] = $aResult['attrs']['object_id'];
                            }
                        }
                    }

                    $aParms = array();
                    $aParms['sBaseLink'] = MSHTools::getCountryPropertiesUrl($oUser->getCountry());
                    $aParms['sTerm'] = $sTerm;
                    $aParms['iTotal'] = sizeof($aLocations['region'])+sizeof($aLocations['city']);
                    $aParms['bMultiple'] = sizeof($aTypes) > 0;
                    $aParms['aLocations'] = $aLocations;
                    $aParms['sTerm'] = $sTerm;
                    return $this->renderPartial('property/suggestAjax', $aParms);
                    //return $this->renderComponent('property', 'suggest');
                } else if($sBox == "filter") {
                    $this->getResponse()->setContent($this->getComponent('property', 'filter'));
                    return sfView::NONE;
                }
            }
            
            $bExtend = false;

            if($iPage !== null && !$oRequest->offsetExists("filter") && !$oRequest->offsetExists("refine") && !$oRequest->offsetExists("sort") && !$oRequest->hasParameter("setPlace") && !$oRequest->hasParameter("display")) {
                $bExtend = true;
            };

            $sDisplayType = $this->getUser()->getResultsDisplay();
            if($sDisplayType == "map") {
                $this->getResponse()->setContent($this->getComponent('property', 'propertyResults'));
                return sfView::NONE;
            } else {
                if($bExtend) {
                    $this->getResponse()->setContent($this->getComponent('property', 'propertyResultsExtend', array('iPage' => $iPage)));
                    return sfView::NONE;
                }
                else {
                    $this->getResponse()->setContent($this->getComponent('property', 'propertyResults'));
                    return sfView::NONE;
                }

            }
        }
        else {
            $this->iPage = empty($iPage) ? 1 : $iPage;
            $sDisplayType = $this->getUser()->getResultsDisplay();
            if($sDisplayType == "photos") {
                $this->sResultsType = "photos";
            } else if($sDisplayType == "map") {
                $this->sResultsType = "map";
            } else {
                $this->sResultsType = "list";
            }

            $this->sTab = $this->getUser()->getRefine();

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
        $this->sUrl = MSHTools::getCountryPropertiesUrl($oUser->getCountry());

        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase4_property_index'));
        if(null!==$oPageType) {
            $aSeoReplacements = array();
            $aSeoReplacements['country'] = $oUser->getCountry()->getTitle();
            $sCustomMetaTitle = '';
            $sCustomMetaDesc = '';
            $this->getResponse()->setSlot('seoReplacements', $aSeoReplacements);
            $this->getResponse()->setSlot('meta_title', (null!==$sCustomMetaTitle&&strlen($sCustomMetaTitle)>0) ? $sCustomMetaTitle : $oPageType->getMetaTitle());
            $this->getResponse()->setSlot('meta_description', (null!==$sCustomMetaDesc&&strlen($sCustomMetaDesc)>0) ? $sCustomMetaDesc : $oPageType->getMetaDescription());
            $this->getResponse()->setSlot('doubleclick', $oPageType->getDoubleclickAd());
            $this->getResponse()->setSlot('doubleclick_head', $oPageType->getDoubleclickHead());
        }
    }

    // property detail
    public function executePropertyDetail(sfWebRequest $oRequest) {
        /** @var Property $oProperty */
        $oProperty = $oRequest->getAttribute('content.property');

        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        $oUser->setSearchSection('property');
        $oUser->setViewed($oProperty->getId());
        $oUser->setLastViewedProperty($oProperty->getId());

        $this->oProperty = $oProperty;

        $oUser->setPlace(array(
                            'region' =>$this->oProperty->getRegion()->getId(), 
                            'city'   =>$this->oProperty->getCity()->getId()
                        ));

        
        $cacheData = CacheManager::getInstance()->getSimilarProperties($oProperty->getId(), $oUser);
        if (empty($cacheData)) {
            $this->aSimilarProperty = MSHPropertySphinxSearcher::getOtherResults($oUser, $oProperty->getId());
            CacheManager::getInstance()->setSimilarProperties($oProperty->getId(), $oUser, $this->aSimilarProperty);
        } else {
            $this->aSimilarProperty = $cacheData;
        }

        $oContactForm = new ContactRequestForm();

        if($oRequest->isMethod("POST")) {
            $oContactForm->bind($oRequest->getParameter($oContactForm->getName()));
            if($oContactForm->isValid()) {
                /** @var ContactRequest $oContactRequest */
                $oContactRequest = $oContactForm->save();
                 //ugly check for void email addresses
                if (!in_array($oContactRequest->getEmailAddress(), $this->voidEmails)) {
                    $oContactRequest->setProperty($oProperty);
                    $oContactRequest->save();
                    $oMailer = new MSHMailer();
                    $oMailer->mailContactRequestSent($oContactRequest);
                    $oMailer->mailContactRequestReceived($oContactRequest);
                }
            }
        }

        $this->oForm = $oContactForm;

        if($oRequest->isXmlHttpRequest()) {
            if($oRequest->getParameter('box') == 'infoWindow') {
                $aProperty = PropertyPeer::retrieveByLatLng($oProperty->getLocationLat(), $oProperty->getLocationLong());
                return $this->renderPartial('property/propertyInfoWindow', array('aProperty' => $aProperty));
            } else if($oRequest->getParameter('box') == 'map') {
                return $this->renderPartial('property/enlargedMap', array('oProperty' => $oProperty, 'bStreetview' => $oRequest->getParameter('mode','map') == 'streetview'));
            } else if($oRequest->getParameter('box') == 'favorite') {
                $bFavorite = $oRequest->getParameter("favorite","true") == "true";
                $oUser = $this->getUser();

                if($bFavorite) {
                    $oUser->addFavorite($oProperty->getId());
                } else {
                    $oUser->removeFavorite($oProperty->getId());
                }
                return $this->renderPartial('property/favorite',array("bFavorite" => $bFavorite, "oProperty" => $oProperty, 'bChanged' => true, 'iFavorite' => MSHPropertySphinxSearcher::countFavorites($oUser)));

            }
        }
        $this->iFavorite = MSHPropertySphinxSearcher::countFavorites($oUser);

        $this->altText = $oProperty->getCity();
        $bedrooms = $oProperty->getBedrooms();
        $oPageType = empty($bedrooms) ? 
                    PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase4_property_detail_noroom')) 
                    :
                    PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase4_property_detail'));
        if(null!==$oPageType) {
            $aSeoReplacements = array();
            $aSeoReplacements['country'] = $oUser->getCountry()->getTitle();
            $aSeoReplacements['bedrooms'] = $bedrooms;
            $aSeoReplacements['city'] = $oProperty->getCity();
            $this->getContext()->getConfiguration()->loadHelpers('MSHCurrency');
            $aSeoReplacements['euro'] = format_currency_msh($oProperty->getPrice());
            $aSeoReplacements['property'] = (string)$oProperty;
            $sCustomMetaTitle = '';
            $sCustomMetaDesc = '';
            $this->getResponse()->setSlot('seoReplacements', $aSeoReplacements);
            $this->getResponse()->setSlot('meta_title', (null!==$sCustomMetaTitle&&strlen($sCustomMetaTitle)>0) ? $sCustomMetaTitle : $oPageType->getMetaTitle());
            $this->getResponse()->setSlot('meta_description', (null!==$sCustomMetaDesc&&strlen($sCustomMetaDesc)>0) ? $sCustomMetaDesc : $oPageType->getMetaDescription());
            $this->getResponse()->setSlot('doubleclick', $oPageType->getDoubleclickAd());
            $this->getResponse()->setSlot('doubleclick_head', $oPageType->getDoubleclickHead());
            
            $altText = sfContext::getInstance()->getI18n()->__('alt.image.property');
            $this->altText = MSHTools::seoReplace($altText, $aSeoReplacements);
        }
    }

    private function processRequest(sfWebRequest $oRequest) {

        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();

        $bClearFilters = $oRequest->getParameter('clearfilters', null);
        if($bClearFilters !== null && $bClearFilters == "true") {
            $oUser->resetFilters();
            $oUser->resetPlace();
            //$oUser->resetEnabledPlaces();
            if(!$oRequest->isXmlHttpRequest()) {
                $this->redirect(MSHTools::getCountryPropertiesUrl($oUser->getCountry()));
            }
        }
        $bClearFilters = $oRequest->getParameter('clear', null);
        if($bClearFilters !== null && $bClearFilters == "clear") {
            $oUser->resetFilters();
            $oUser->resetPlace();
            //$oUser->resetEnabledPlaces();
            if(!$oRequest->isXmlHttpRequest()) {
                $this->redirect(MSHTools::getCountryPropertiesUrl($oUser->getCountry()));
            }
        }

        if($oRequest->hasParameter('provider')) {
            $oProvider = AssociationPeer::retrieveByPK($oRequest->getParameter('provider'));
            if(null!==$oProvider) {
                $oUser->resetPlace();
                $oUser->resetFilters();
                $oUser->setExtraFilter(array('type' => 'provider', 'id' => $oProvider->getId()));
                $this->redirect(MSHTools::getCountryPropertiesUrl($oUser->getCountry()));
            }
        }

        if($oRequest->hasParameter('development')) {
            $oDevelopment = DevelopmentPeer::retrieveByPK($oRequest->getParameter('development'));
            if(null!==$oDevelopment) {
                $oUser->resetPlace();
                $oUser->resetFilters();
                $oUser->setExtraFilter(array('type' => 'development', 'id' => $oDevelopment->getId()));
                $this->redirect(MSHTools::getCountryPropertiesUrl($oUser->getCountry()));
            }
        }

        $aFilters = $oRequest->getParameter('filter',array());
        if(is_array($aFilters)) {
            
            foreach($aFilters as $sKey => $aFilter) {
                if(is_array($aFilter)) {
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
        }

        $aSort = $oRequest->getParameter('sort', array());
        foreach($aSort as $sKey => $sDir) {
            $oUser->setSort($sKey, $sDir);
        }

        $sRefine = $oRequest->getParameter('refine', "");
        if($sRefine !== "") {
            $oUser->setRefine($sRefine);
        }

        $sDisplay = $oRequest->getParameter('display', "");
        if($sDisplay !== "") {
            $oUser->setResultsDisplay($sDisplay);
        }

        $aSetPlace = $oRequest->getParameter('setPlace',null);
        if($aSetPlace !== null && is_array($aSetPlace)) {

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
        
        $iRegion = $oRequest->getParameter('region_dd', null);
        if (!empty($iRegion)) {
            $oRegion = RegionPeer::retrieveByPK($iRegion);
            if(null!==$oRegion) {
                $oUser->resetCheckboxFilter('region_id');
                $oUser->setCountry($oRegion->getCountry()->getId());
                $oUser->setPlace(array('region' => (int)$iRegion));
            }
        
            $sCity = $oRequest->getParameter('city_input', null);
            if (!empty($sCity)) {
                $location = explode(',',$sCity);
                $cityName = $location[0];
                if (!empty($cityName)) {
                    $oCity = CityI18nPeer::retrieveByTitleInRegion($cityName, $iRegion, true);
                    if(null!==$oCity) {
                        $oUser->setCountry($oRegion->getCountry()->getId());
                        $oUser->setPlace(array('city' => (int)$oCity->getId()));
                    }
                }
            }
        }
        
        
        
        
        /*$aSearch = $oRequest->getParameter('search',null);
        if($aSearch != null && isset($aSearch['term'])) {
            $sSearchTerm = $aSearch['term'];
            if($sSearchTerm != null && $sSearchTerm != '') {
                $aResults = VindjeplekLocationSphinxSearcher::searchLocation($sSearchTerm);
                if(sizeof($aResults) >= 1) {
                    // found matching place
                    $aResult = $aResults[0];
                    $this->getUser()->addPlace($aResult["attrs"]["type"],$aResult["attrs"]["object_id"],$aResult["attrs"]["title"]);
                    $this->getUser()->togglePlace($aResult["attrs"]["type"],$aResult["attrs"]["object_id"], true);
                } else {

                    //$this->getUser()->addPlace("city",0,$sSearchTerm);
                    //$this->getResponse()->setSlot('sSearchFailed', $sSearchTerm);
                }
            }
        }*/

        /*$aPlace = $oRequest->getParameter('place', null);
        if($aPlace != null && is_array($aPlace)) {
            foreach($aPlace as $sType => $aAction) {
                foreach($aAction as $iValue => $sAction) {
                    if($sAction == "toggle") {
                        $this->getUser()->togglePlace($sType, $iValue);
                    } else if($sAction == "remove") {
                        $this->getUser()->removePlace($sType, $iValue);
                    }
                }
            }
        }



        $aAddPlace = $oRequest->getParameter('addPlace',null);
        if($aAddPlace !== null && is_array($aAddPlace)) {
            foreach($aAddPlace as $sType => $iValue) {
                $oObj = $this->getUser()->checkPlace($sType, $iValue);
                if($oObj !== null)
                    $this->getUser()->addPlace($sType, $iValue, (string) $oObj);
            }
        }*/
    }
}
