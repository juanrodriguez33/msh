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
	
	
        $this->getResponse()->setSlot('is_homepage', true);
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();

        if($oRequest->hasParameter('resetcountry')) {
            $oUser->setCountry(null);
            $this->redirect($this->generateUrl('homepage'));
        }

        if($oRequest->isXmlHttpRequest()) {
        
            //
            $this->clearFilters();
        
            $sBox = $oRequest->getParameter("box",null);
            if($sBox !== null) {
                if($sBox == "suggest") {
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


                             /* commented this to enable search box
                              
                                if(stripos($sLabel, $sTerm) === false)
                                    continue;*/

                                $aLocations[$aResult['attrs']['type']][$aResult['attrs']['object_id']] = $sLabel;
                                $aLocationsCounted[$aResult['attrs']['type']][] = $aResult['attrs']['object_id'];
                                
                            }
                        }
                    }

                    $aLocationsCounted = MSHPropertySphinxSearcher::calculateSuggestCounts($this->getUser(),$aLocations);

                    $aParms = array();
                    $aParms['sTerm'] = $sTerm;
                    $aParms['iTotal'] = sizeof($aLocations['country'])+sizeof($aLocations['region'])+sizeof($aLocations['city']);
                    $aParms['bMultiple'] = sizeof($aTypes) > 0;
                    $aParms['aLocations'] = $aLocationsCounted['places'];
                    
                    return $this->renderPartial('property/suggestHome', $aParms);
                }
            }
        }
		if($oRequest->isMethod('POST')) {

            $bDemoSet = false;


            $sDemography = $oRequest->getParameter('demography');
            if(strlen($sDemography)>0) {
                $aDemo = explode('#', $sDemography);
                $bDemoSet = false;
                if($aDemo[0] == 'city') {
                    $oCity = CityPeer::retrieveByPK($aDemo[1]);
                    if(null!==$oCity) {
                        $oUser->setCountry($oCity->getCountry()->getId());
                        $oUser->resetFilters();
                        $oUser->setPlace(array('city' =>$oCity->getId()));
                        $bDemoSet = true;
                    }
                } else if($aDemo[0] == 'region') {
                    $oRegion = RegionPeer::retrieveByPK($aDemo[1]);
                    if(null!==$oRegion) {
                        $oUser->setCountry($oRegion->getCountry()->getId());
                        $oUser->resetFilters();
                        $oUser->setPlace(array('region' =>$oRegion->getId()));
                        $bDemoSet = true;
                    }
                } else if($aDemo[0] == 'country') {
                    $oCountry = CountryPeer::retrieveByPK($aDemo[1]);
                    if(null!==$oCountry) {
                        $oUser->setCountry($oCountry->getId());
                        $oUser->setPlace(array('country' => $oCountry->getId()));
                        $bDemoSet = true;
                    }
                }

            }
            $aFilter = $oRequest->getParameter('filter');
            if(strlen($aFilter['search'])>2) {

                $aLocations = array();

                if($aFilter['search'] !== null && strlen($aFilter['search']) > 0) {
                    $aResults = MSHLocationSphinxSearcher::searchLocation($aFilter['search']);

                    foreach($aResults as $aResult) {
                        $aLocations[$aResult['attrs']['type']][$aResult['attrs']['object_id']] = $aResult['attrs']['title'];
                    }
                }
                //if(sizeof($aLocations['city'])+sizeof($aLocations['country'])+sizeof($aLocations['region']) ==1 ) {
                    // single location found so we can redirect
                    foreach($aLocations as $sType => $aMatches) {
                        $aIds = array_keys($aMatches);
                        if($sType == 'city') {
                            $oCity = CityPeer::retrieveByPK($aIds[0]);
                            if(null!==$oCity) {
                                $oUser->setCountry($oCity->getCountry()->getId());
                                $oUser->resetFilters();
                                $oUser->setPlace(array('city' =>$oCity->getId()));
                                $bDemoSet = true;
                            }
                        } else if($sType == 'region') {
                            $oRegion = RegionPeer::retrieveByPK($aIds[0]);
                            if(null!==$oRegion) {
                                $oUser->setCountry($oRegion->getCountry()->getId());
                                $oUser->resetFilters();
                                $oUser->setPlace(array('region' =>$oRegion->getId()));
                                $bDemoSet = true;
                            }
                        } else if($sType == 'country') {
                            $oCountry = CountryPeer::retrieveByPK($aIds[0]);
                            if(null!==$oCountry) {
                                $oUser->setCountry($oCountry->getId());
                                $oUser->setPlace(array('country' =>  $oCountry->getId()));
                                $bDemoSet = true;
                            }
                        }
                    }
                //}

            }

            if($bDemoSet) {
                $iPriceMin = $oRequest->getParameter('filter_price_min');
                $iPriceMax = $oRequest->getParameter('filter_price_max');
                if($iPriceMin>-1) {
                    $oUser->setRangeFilterMin('price',$iPriceMin);
                }
                if($iPriceMax>-1) {
                    $oUser->setRangeFilterMax('price',$iPriceMax);
                }
                $this->redirect(MSHTools::getCountryPropertiesUrl($oUser->getCountry()), 301);
            }
        }

		
		
        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_homepage'));
		
        if(null!==$oPageType) {
            $aSeoReplacements = array();
            $this->getResponse()->setSlot('seoReplacements', $aSeoReplacements);
            $this->getResponse()->setSlot('meta_title', $oPageType->getMetaTitle());
            $this->getResponse()->setSlot('meta_description', $oPageType->getMetaDescription());
            $this->getResponse()->setSlot('doubleclick', $oPageType->getDoubleclickAd());
            $this->getResponse()->setSlot('doubleclick_head', $oPageType->getDoubleclickHead());
        }
		
    }

    public function executeLogin(sfWebRequest $oRequest)
    {
        //
        $this->getResponse()->setSlot('bDisableBreadcrumb', true);
    
        $oI18n = $this->getContext()->getI18N();
        //$this->forward404Unless(sfConfig::get('app_login_enabled') === true);
    
        if($this->getUser()->isAuthenticated()) $this->redirect('homepage');

        $oForm = new LoginForm();
        if($oRequest->isMethod('post')) {
            $oForm->bind($oRequest->getParameter('sign_in'));
            if($oForm->isValid()) {
                $this->getUser()->signIn($oForm->getValue('user'));
                if($this->getUser()->hasCredential('ROLE_ASSOCIATION') || $this->getUser()->hasCredential('ROLE_CONSUMER')) {
                    $this->doRedirect('portal_overview');
                }
                $this->redirect('homepage');
            } else {
                $this->getUser()->setNotification('error', $oI18n->__('notification.loginfailed'));
            }
        }

        $this->getResponse()->setSlot('bDisableBanner', true);
        $this->getResponse()->setSlot('bDisableFooterTopProperties', true);
        $this->getResponse()->setSlot('bDisableFooterPhaseOverview', true);
        $this->getResponse()->setSlot('bDisableFooterNews', true);
        $this->getResponse()->setSlot('is_login', true);
		$this->getResponse()->setSlot('bDisableFooterMostPopular',true);


        $this->form = $oForm;

        $oI18n = $this->getContext()->getI18N();
        $aBc = array();
        $aBc[$this->generateUrl('level1', array('level1' => Functions::slugify($oI18n->__('url.login'))))] = $oI18n->__('menu.sign-in');
        $this->getResponse()->setSlot('bc', $aBc);
    }

    public function executeLogout(sfWebRequest $oRequest)
    {
        $oUser = $this->getUser();
        $oCountry = $oUser->getCountry();
        if($this->getUser()->isAuthenticated()) {
            $this->getUser()->signOut();

        }
        if(null!==$oCountry) {
            $this->redirect($this->generateUrl('homepage', array('ignorecookie' => true)));
        } else {
            $this->redirect('homepage');
        }
    }

    public function executeNotFound(sfWebRequest $oRequest)
    {

    }

    public function executeCountryWarning(sfWebRequest $oRequest)
    {
        return $this->renderPartial('system/countryWarning');
    }

    public function executeStaticPage(sfWebRequest $oRequest) {
        /** @var StaticPage $oStaticPage */
        $oStaticPage = $oRequest->getAttribute('content.staticPage');

        $this->oStaticPage = $oStaticPage;

        if(false!==stripos($oStaticPage->getMetaTitle(),'contact')) {
            $oContactForm = new ContactRequestForm();

            if($oRequest->isMethod("POST")) {
                $oContactForm->bind($oRequest->getParameter($oContactForm->getName()));
                if($oContactForm->isValid()) {
                    /** @var ContactRequest $oContactRequest */
                    $oContactRequest = $oContactForm->save();
                    $oContactRequest->save();
                    $oMailer = new MSHMailer();
                    $oMailer->mailContactRequestSent($oContactRequest);
                    $oMailer->mailContactRequestReceived($oContactRequest);
                }
            }

            $this->oForm = $oContactForm;
        }

        $this->getResponse()->setSlot('meta_title', $oStaticPage->getMetaTitle());
        $this->getResponse()->setSlot('meta_description', $oStaticPage->getMetaDescription());
    }

    public function executeRouter(sfWebRequest $oRequest) {
        /** @var myUser $oUser  */
        $oUser = $this->getUser();

        $oI18n = $this->getContext()->getI18N();

        $oLogger = $this->getLogger();

        $sRoute = $oRequest->getPathInfo();
        $aRoute = explode('/',$sRoute);
        if(trim($aRoute[sizeof($aRoute)-1]) == '') {
            array_pop($aRoute);
        }
        if(trim($aRoute[0]) == '') {
            array_shift($aRoute);
        }
        

        if($aRoute[0] == Functions::slugify($oI18n->__('url.login'))) {
            $this->forward('system', 'login');
        } else if($aRoute[0] == Functions::slugify($oI18n->__('url.forgot.login'))){
            $this->forward('system', 'forgotLogin');
        } else if($aRoute[0] == Functions::slugify($oI18n->__('url.logout'))) {
            $this->forward('system', 'logout');
        } else if($aRoute[0] == Functions::slugify($oI18n->__('url.chooseCountry'))) {
            $this->forward('content', 'chooseCountry');
        } else if($aRoute[0] == Functions::slugify($oI18n->__('url.phaseOrient'))) {
            $oLogger->info('Orient phase');
            $oUser->setPhase(0);

            if(sizeof($aRoute) == 1) {
                $this->forward('content', 'orient');
            } else {    
                if($aRoute[1] == Functions::slugify($oI18n->__('url.themes'))) {
                    $oLogger->info('themes');
                    if(sizeof($aRoute) == 2) {
                        $this->forward('content', 'orientThemes');
                    } else if(sizeof($aRoute) == 3){
                        $oTheme = ThemeI18nPeer::retrieveBySlug($oUser->getCulture(),$aRoute[2]);
                        if(null!==$oTheme) {
                            $oLogger->info('theme detail');
                            $this->getRequest()->setAttribute('content.theme', $oTheme);
                            $this->forward('content', 'orientThemeDetail');
                        }
                    }
                } else {
                
                    $this->getResponse()->setSlot('bDisableFooterTopProperties', true);
                
                    // check subject
                    if($aRoute[1] == Functions::slugify($oI18n->__('url.subjectall'))) {
                        $oLogger->info('all articles');
                        $oUser->setContentTab('all');
                        $this->forward('content', 'subjectOverview');
                    } elseif($aRoute[1] == Functions::slugify($oI18n->__('url.subjectsearch'))) {
                        $oLogger->info('search');
                        $oUser->setContentTab('search');
                        $this->forward('content', 'searchContent');
                    } else {
                        $oCategory = CategoryI18nPeer::retrieveMainCategoryForPhaseBySlug($oUser->getPhase(),$oUser->getCulture(),$aRoute[1]);
                        if(null!=$oCategory) {
                            if(sizeof($aRoute) == 2) {
                                $oUser->setContentTab($oCategory->getSlug());
                                $oLogger->info('article category');
                                $this->forward('content', 'subjectOverview');
                            } else if(sizeof($aRoute) == 3 ){
                                $oLogger->info('article detail');
                                $oContent = PagePeer::retrieveBySlug($aRoute[2],$oUser->getPhase(),$oUser->getCulture());
                                if(null!==$oContent) {
                                    $this->getRequest()->setAttribute('content.article', $oContent);
                                    $this->forward('content', 'contentDetail');
                                }
                            }
                        }
                    }
                }
            }


        } else if($aRoute[0] == Functions::slugify($oI18n->__('url.phaseInform'))) {
            $oUser->setPhase(1);
            $sToStrip = Functions::slugify($oI18n->__('url.buyhouse')) .'-';
            $oCountry = MSHTools::checkCountry(substr($aRoute[1],strlen($sToStrip)));
            if(null===$oCountry) {
                $this->forward404();
            }
            $oUser->setCountry($oCountry->getId());
            if(sizeof($aRoute)==2) {
                $this->forward('content', 'inform');
            }
            else {
                $oCountry = MSHTools::checkCountry(substr($aRoute[1],strlen($sToStrip)));
                $oRegion = RegionI18nPeer::retrieveBySlug($aRoute[2], $oCountry->getId());
                if(sizeof($aRoute)==4 && $oCountry !=null && $oRegion !=null){
                    $sToStrip = Functions::slugify($oI18n->__('url.buyhouse')) .'-';
                    $this->getRequest()->setAttribute('content.region', $oRegion->getRegion());
                    $this->getRequest()->setAttribute('content.city', $aRoute[3]);
                    $this->forward('content', 'cityDetail');
                }
                else{
                
                    if($aRoute[2] == Functions::slugify($oI18n->__('url.regions'))) {
                        $this->forward('content', 'countryRegions');
                    } else if($aRoute[2] == Functions::slugify($oI18n->__('url.subjectall'))) {
                        $oLogger->info('all articles');
                        $oUser->setContentTab('all');
                        $this->forward('content', 'subjectOverview');
                    } elseif($aRoute[2] == Functions::slugify($oI18n->__('url.subjectsearch'))) {
                        $oLogger->info('search');
                        $oUser->setContentTab('search');
                        $this->forward('content', 'searchContent');
                    } else {
                        $oCategory = CategoryI18nPeer::retrieveMainCategoryForPhaseBySlug($oUser->getPhase(),$oUser->getCulture(),$aRoute[2]);
                        if(null!=$oCategory) {
                            if(sizeof($aRoute) == 3) {
                                $oUser->setContentTab($oCategory->getSlug());
                                $oLogger->info('article category');
                                $this->forward('content', 'subjectOverview');
                            } else if(sizeof($aRoute) == 4 ){
                                $oLogger->info('article detail');
                                $oContent = PagePeer::retrieveBySlug($aRoute[3],$oUser->getPhase(),$oUser->getCulture(), $oCountry);
                                if(null!==$oContent) {
                                    $this->getRequest()->setAttribute('content.article', $oContent);
                                    $this->forward('content', 'contentDetail');
                                }
                            }
                        }
                        $oRegion = RegionI18nPeer::retrieveBySlug($aRoute[2], $oCountry->getId());
                        if(null!==$oRegion) {
                            $this->getRequest()->setAttribute('content.region', $oRegion->getRegion());
                            $this->forward('content', 'regionDetail');
                        }
                    }
                }
            }

        } else if($aRoute[0] == Functions::slugify($oI18n->__('url.phaseAdvice'))) {
            $oUser->setPhase(2);

            $sToStripQA = Functions::slugify($oI18n->__('url.questionandanswers')) .'-';
            $sToStripExp = Functions::slugify($oI18n->__('url.experiences')) .'-';
            $sToStripNews = Functions::slugify($oI18n->__('url.news')) .'-';

            if(strpos($aRoute[1],$sToStripQA)===0) {
                // q-and-a
                $oCountry = MSHTools::checkCountry(substr($aRoute[1],strlen($sToStripQA)));
                if(null===$oCountry) {
                    $this->forward404();
                }
                $oUser->setCountry($oCountry->getId());
                if(sizeof($aRoute)==2) {
                    $this->forward('content', 'advice');
                } else {

                    if($aRoute[2] == Functions::slugify($oI18n->__('url.subjectall'))) {

                        $oUser->setContentTab('all');

                        if(sizeof($aRoute) == 3) {
                            $oLogger->info('all questions');
                            $this->forward('content', 'questions');
                        } else {
                            if($aRoute[3] == Functions::slugify($oI18n->__('url.askquestion'))) {
                                $oLogger->info('ask question');
                                $this->forward('content', 'askQuestion');
                            }
                        }
                    } elseif($aRoute[2] == Functions::slugify($oI18n->__('url.subjectsearch'))) {
                        $oLogger->info('search questions');
                        $oUser->setContentTab('search');
                        $this->forward('content', 'searchQuestions');
                    } else {
                        $oCategory = CategoryI18nPeer::retrieveMainCategoryForPhaseBySlug($oUser->getPhase(),$oUser->getCulture(),$aRoute[2]);
                        if(null!=$oCategory) {
                            if(sizeof($aRoute) == 3) {
                                $oLogger->info('category questions');
                                $oUser->setContentTab($oCategory->getSlug());
                                $this->forward('content', 'questions');
                            } else {
                                if($aRoute[3] == Functions::slugify($oI18n->__('url.askquestion'))) {
                                    $oLogger->info('ask question');
                                    $oUser->setContentTab($oCategory->getSlug());
                                    $this->forward('content', 'askQuestion');
                                } else {
                                    $iQuestion = substr($aRoute[3],strrpos($aRoute[3],'-')+1);
                                    $oQuestion = QuestionPeer::retrieveByPK($iQuestion);

                                    if(null!==$oQuestion && $oQuestion->getSlug() == substr($aRoute[3],0,strrpos($aRoute[3],'-'))) {
                                        $oLogger->info('question detail');
                                        $this->getRequest()->setAttribute('content.question', $oQuestion);
                                        $this->forward('content', 'questionDetail');
                                    }
                                }
                            }
                        }
                    }
                }
            } else if (strpos($aRoute[1],$sToStripExp)===0) {
                // experiences
                $oCountry = MSHTools::checkCountry(substr($aRoute[1],strlen($sToStripExp)));
                if(null===$oCountry) {
                    $this->forward404();
                }
                $oUser->setCountry($oCountry->getId());
                if(sizeof($aRoute)==2) {
                    $this->forward('content', 'experiences');
                } else {
                    $oReference = UserReferencePeer::retrieveBySlug($aRoute[2]);
                    if(null!==$oReference) {
                        $this->getRequest()->setAttribute('content.experience', $oReference);
                        $this->forward('content', 'experienceDetail');
                    }
                }

            } else if (strpos($aRoute[1],$sToStripNews)===0) {
                // news
                $oCountry = MSHTools::checkCountry(substr($aRoute[1],strlen($sToStripNews)));
                if(null===$oCountry) {
                    $this->forward404();
                }
                $oUser->setCountry($oCountry->getId());
                if(sizeof($aRoute)==2) {

                } else {
                    if($aRoute[2] == Functions::slugify($oI18n->__('url.subjectall'))) {
                        $oLogger->info('all news');
                        $oUser->setContentTab('all');
                        $this->forward('content', 'subjectOverview');
                    } elseif($aRoute[2] == Functions::slugify($oI18n->__('url.subjectsearch'))) {
                        $oLogger->info('search news');
                        $oUser->setContentTab('search');
                        $this->forward('content', 'searchContent');
                    } else {
                        $oCategory = CategoryI18nPeer::retrieveMainCategoryForPhaseBySlug($oUser->getPhase(),$oUser->getCulture(),$aRoute[2]);
                        if(null!=$oCategory) {
                            if(sizeof($aRoute) == 3) {
                                $oUser->setContentTab($oCategory->getSlug());
                                $oLogger->info('news category');
                                $this->forward('content', 'subjectOverview');
                            } else if(sizeof($aRoute) == 4 ){
                                $oLogger->info('article detail');
                                $oContent = PagePeer::retrieveBySlug($aRoute[3],$oUser->getPhase(),$oUser->getCulture(), $oCountry);
                                if(null!==$oContent) {
                                    $this->getRequest()->setAttribute('content.article', $oContent);
                                    $this->forward('content', 'contentDetail');
                                }
                            }
                        }
                    }
                }
            }

        } else if($aRoute[0] == Functions::slugify($oI18n->__('url.phaseFind'))) {
            $oUser->setPhase(3);
            
            if(sizeof($aRoute)==1) {
                // step 4 home
                $this->forward('property', 'findHome');
            }
            
            $oCountry = MSHTools::checkCountry($aRoute[1]);
            
            if(null!==$oCountry) {
                $oUser->setCountry($oCountry->getId());
                if(sizeof($aRoute)==2) {
                    // property index
                    $oLogger->info('property index');
                    $this->forward('property', 'propertyIndex');

                } else {
                    $oRegion = RegionI18nPeer::retrieveBySlug($aRoute[2], $oCountry->getId());                    
                    if($oRegion!==null) {
                        if(sizeof($aRoute)==3) {
                            // properties in region
                            $oLogger->info('property index, set region');
                            $oUser->setCheckboxFilter('region_id',$oRegion->getRegion()->getId(), true);
                            $this->getRequest()->setAttribute('content.region', $oRegion->getRegion());
                            $this->forward('property', 'propertyRegionIndex');
                        } else if(sizeof($aRoute)==4){
                            
                            $oCity = CityI18nPeer::retrieveBySlug($aRoute[3], $oRegion->getId());
                            
                            if(null!==$oCity) {
                                // properties in city
                                $oLogger->info('property index, set city');
                                $oUser->setCheckboxFilter('city_id',$oCity->getCity()->getId(), true);
                                $this->getRequest()->setAttribute('content.city', $oCity->getCity());
                                $this->getRequest()->setAttribute('content.region', $oRegion->getRegion());   
                                                         
                                $this->forward('property', 'propertyCityIndex');
                                $this->redirect(MSHTools::getCountryPropertiesUrl($oCity->getCity()->getCountry()));
                            }
                        }
                    }
                }

            } else {
                $sToStripDev = Functions::slugify($oI18n->__('url.developments')) .'-';
                $sToStripProv = Functions::slugify($oI18n->__('url.providers')) .'-';
                if (strpos($aRoute[1],$sToStripDev)===0) {

                    $oCountry = MSHTools::checkCountry(substr($aRoute[1],strlen($sToStripDev)));
                    if(null===$oCountry) {
                        $this->forward404();
                    }
                    $oUser->setCountry($oCountry->getId());
                    if(sizeof($aRoute)==2) {
                        // show developments for country
                        $oLogger->info('development index');
                        $this->forward('property', 'developmentIndex');
                    }
                } else if (strpos($aRoute[1],$sToStripProv)===0) {
                    $oCountry = MSHTools::checkCountry(substr($aRoute[1],strlen($sToStripProv)));
                    if(null===$oCountry) {
                        $this->forward404();
                    }
                    $oUser->setCountry($oCountry->getId());
                    if(sizeof($aRoute)==2) {
                        // show providers for country
                        $oLogger->info('provider index');
                        $this->forward('property', 'providerIndex');
                    } else if(sizeof($aRoute) == 3) {
                        $oProvider = AssociationPeer::retrieveBySlug($aRoute[2]);
                        if(null!==$oProvider) {
                            // show provider detail page
                            $oLogger->info('provider detail');
                            $this->getRequest()->setAttribute('content.provider', $oProvider);
                            $this->forward('property', 'providerDetail');
                        }
                    }
                }
            }
        }

        if(sizeof($aRoute)==5 && $aRoute[0] == Functions::slugify($oI18n->__('url.properties'))) {

            $oCity = $this->getCity($aRoute);

            $iProperty = substr($aRoute[4],0,strpos($aRoute[4],'-'));
            $oProperty = PropertyPeer::retrieveByPK($iProperty);
            if(!$oProperty->getOnline() || $oProperty->getCityId()!==$oCity->getId()) {
                $this->forward404();
            }

            $oUser->setPhase(3);
            $oUser->setCountry($oProperty->getCountry()->getId());
            $this->getRequest()->setAttribute('content.property', $oProperty);
            $this->forward('property', 'propertyDetail');
        } else if(sizeof($aRoute)==5 && $aRoute[0] == Functions::slugify($oI18n->__('url.developments'))) {
            $oCity = $this->getCity($aRoute);

            $iDevelopment = substr($aRoute[4],0,strpos($aRoute[4],'-'));
            $oDevelopment = DevelopmentPeer::retrieveByPK($iDevelopment);
            if($oDevelopment->getCityId()!==$oCity->getId()) {
                $this->forward404();
            }
            $oUser->setPhase(3);
            $oUser->setCountry($oDevelopment->getCountry()->getId());
            $this->getRequest()->setAttribute('content.development', $oDevelopment);
            $this->forward('property', 'developmentDetail');
        } else {
            if(sizeof($aRoute)==1) {
                $oStaticPage = StaticPagePeer::retrieveByCultureAndSlug($aRoute[0], $oUser->getCulture());
                if(null!==$oStaticPage) {
                    $this->getRequest()->setAttribute('content.staticPage', $oStaticPage);
                    $this->forward('system', 'staticPage');
                }
            }
        }

        $this->forward404('404');
    }


    private function getCity($aRoute) {
        $oCountry = MSHTools::checkCountry($aRoute[1]);
        if(null===$oCountry) {
            $this->forward404();
        }
        $oRegion = RegionI18nPeer::retrieveBySlug($aRoute[2],$oCountry->getId());
        if(null===$oRegion) {
            $this->forward404();
        }
        $oCity = CityI18nPeer::retrieveBySlug($aRoute[3], $oRegion->getId());
        if(null===$oCity) {
            $this->forward404();
        }
        return $oCity;
    }

    
    /**
     *
     */
    private function clearFilters() {
        
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        
        /** Clear */
        $oUser->resetFilters();
        $oUser->resetPlace();
    }
}
