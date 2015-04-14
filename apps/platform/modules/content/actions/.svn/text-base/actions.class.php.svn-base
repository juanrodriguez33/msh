<?php

/**
 * content actions.
 *
 * @package    mysecondhome
 * @subpackage content
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contentActions extends kmActions
{
    /**
     * Pre Execute
     */
    public function preExecute()
    {
        //
        $this->getResponse()->setSlot('bDisableFooterPhaseOverview',true);
		$this->getResponse()->setSlot('bDisableFooterMostPopular',true);
        //
        parent::preExecute();
    }
    

    /**
     * Phase 1 home
     *
     * @param sfWebRequest $oRequest
     */
    public function executeOrient(sfWebRequest $oRequest) {

        $oUser = $this->getUser();
        $aCategoryI18n = CategoryI18nPeer::retrieveMainCategoryForPhase(0, $oUser->getCulture());
        $aCat = array();
        foreach($aCategoryI18n as $oCatI18n) {
            $aCat[] = $oCatI18n->getCategory();
        }
        $this->aCategory = $aCat;
        $oUser->setContentSearch('');

        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase1_home'));
        if(null!==$oPageType) {
            $aSeoReplacements = array();
            $this->getResponse()->setSlot('seoReplacements', $aSeoReplacements);
            $this->getResponse()->setSlot('meta_title', $oPageType->getMetaTitle());
            $this->getResponse()->setSlot('meta_description', $oPageType->getMetaDescription());
            $this->getResponse()->setSlot('doubleclick', $oPageType->getDoubleclickAd());
            $this->getResponse()->setSlot('doubleclick_head', $oPageType->getDoubleclickHead());
        }


        $this->aTheme = ThemePeer::getIndex();
    }

    /**
     * Phase 1 / 2 / 3 article overview
     * @param sfWebRequest $oRequest
     * @return sfView
     */
    public function executeSubjectOverview(sfWebRequest $oRequest) {

        $iLimit = 5;
        /** @var myUser $oUser  */
        $oUser = $this->getUser();
        $oI18n = $this->getContext()->getI18N();
        $oCat = CategoryI18nPeer::retrieveMainCategoryForPhaseBySlug($oUser->getPhase(),$oUser->getCulture(),$oUser->getContentTab());

        $this->oCategory = $oCat;
        $this->sCurrentSubject = $oUser->getContentTab();
        $oUser->setContentSearch('');

        $sType = $oRequest->getParameter('type', null);
        if(null!==$sType) {
            if($sType==='') {
                $sType = null;
            }
            $oUser->setContentFilter($sType);
        }

        if($oRequest->isXmlHttpRequest()) {
            $sSort = $oRequest->getParameter('order',null);
            if(null!== $sSort) {
                $oUser->setContentSort($sSort);
            }

            $iPage = $oRequest->getParameter('page',0);
            return $this->renderPartial('content/contentArticles', array(
                'iPage' => $iPage,
                'aArticle' =>  PagePeer::retrieveByPhaseCultureAndSubject($oUser->getPhase(), $oUser->getCulture(), $oCat, $oUser->getCountry(), $iLimit, $iPage, $oUser->getContentSort(), $oUser->getContentFilter()),
                'iPages' => max(ceil(PagePeer::countByPhaseCultureAndSubject($oUser->getPhase(), $oUser->getCulture(), $oCat, $oUser->getCountry(), $oUser->getContentFilter()) / $iLimit) - 1,0)
            ));

        } else {
            $iFilterCat = $oUser->getContentFilter();

            /** @var Category $oTag */
            if(intval($iFilterCat) > 0) {
                $aTagWithContent = array();
                $aTag = CategoryPeer::retrieveTags();
                foreach($aTag as $oTag) {
                    if(PagePeer::countByPhaseCultureAndSubject($oUser->getPhase(), $oUser->getCulture(), $oCat, $oUser->getCountry(), $oTag->getId()) > 0) {
                        $aTagWithContent[]=$oTag->getId();
                    }
                }
                if(!in_array($iFilterCat,$aTagWithContent)) {
                    $oUser->setContentFilter(null);
                }
            }
        }

        $this->aArticle = PagePeer::retrieveByPhaseCultureAndSubject($oUser->getPhase(), $oUser->getCulture(), $oCat, $oUser->getCountry(), $iLimit, 0, $oUser->getContentSort(), $oUser->getContentFilter());
        $this->iPages = max((ceil(PagePeer::countByPhaseCultureAndSubject($oUser->getPhase(), $oUser->getCulture(), $oCat, $oUser->getCountry(), $oUser->getContentFilter()) / $iLimit) - 1),0);

        $aBc = array();
        if('all'!==$oUser->getContentTab() && 'search'!==$oUser->getContentTab()) {
            $aBc[MSHTools::getSubjectUrl($oCat->getSlug())] = $oCat->getTitle();
        } else {
            $aBc[MSHTools::getSubjectUrl(Functions::slugify($oUser->getContentTab()))] = $oUser->getContentTab();
        }
        $this->getResponse()->setSlot('bc', $aBc);

        $iPhase = $oUser->getPhase()+1;
        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase'.$iPhase.'_article_overview'));
        if(null!==$oPageType) {
            $aSeoReplacements = array();
            if('all'===$oUser->getContentTab()) {
                $aSeoReplacements['category'] = $oI18n->__('subject.all');
            } elseif( 'search'!==$oUser->getContentTab()) {
                $aSeoReplacements['category'] = $oI18n->__('subject.search');
            } else {
                $aSeoReplacements['category'] = $oCat->getTitle();
            }
            if($iPhase>1) {
                $aSeoReplacements['country'] = $oUser->getCountry()->getTitle();
            }
            $this->getResponse()->setSlot('seoReplacements', $aSeoReplacements);
            $this->getResponse()->setSlot('meta_title', $oPageType->getMetaTitle());
            $this->getResponse()->setSlot('meta_description', $oPageType->getMetaDescription());
            $this->getResponse()->setSlot('doubleclick', $oPageType->getDoubleclickAd());
            $this->getResponse()->setSlot('doubleclick_head', $oPageType->getDoubleclickHead());
        }
    }

    /**
     * Phase 1 / 2 / 3 Article search
     * @param sfWebRequest $oRequest
     * @return sfView
     */
    public function executeSearchContent(sfWebRequest $oRequest) {

        $iLimit = 5;
        $oI18n = $this->getContext()->getI18N();

        /** @var myUser $oUser  */
        $oUser = $this->getUser();

        $this->sCurrentSubject = 'search';
        $this->oCountry = $oUser->getCountry();

        $this->setTemplate('subjectOverview');

        if($oRequest->isMethod("POST")) {
            $sSearch = $oRequest->getParameter('search', null);
            if(null!==$sSearch) {
                $oUser->setContentSearch($sSearch);
            }
        }


        if($oRequest->isXmlHttpRequest()) {
            $sSort = $oRequest->getParameter('order',null);
            if(null!== $sSort) {
                $oUser->setContentSort($sSort);
            }
            $sType = $oRequest->getParameter('type', null);
            if(null!==$sType) {
                if($sType==='') {
                    $sType = null;
                }
                $oUser->setContentFilter($sType);
            }


            $iPage = $oRequest->getParameter('page',0);
            return $this->renderPartial('content/contentArticles', array(
                'iPage' => $iPage,
                'aArticle' =>  PagePeer::searchByPhaseCultureAndSubject($oUser->getContentSearch(), $oUser->getPhase(), $oUser->getCulture(), $oUser->getCountry(), $iLimit, $iPage, $oUser->getContentSort(), $oUser->getContentFilter()),
                'iPages' => max(ceil(PagePeer::countBySearchPhaseCultureAndSubject($oUser->getContentSearch(), $oUser->getPhase(), $oUser->getCulture(), $oUser->getCountry(), $oUser->getContentFilter()) / $iLimit) - 1,0)
            ));

        }

        $this->aArticle = PagePeer::searchByPhaseCultureAndSubject($oUser->getContentSearch(), $oUser->getPhase(), $oUser->getCulture(), $oUser->getCountry(), $iLimit, 0, $oUser->getContentSort(), $oUser->getContentFilter());
        $this->iPages = max((ceil(PagePeer::countBySearchPhaseCultureAndSubject($oUser->getContentSearch(), $oUser->getPhase(), $oUser->getCulture(), $oUser->getCountry(), $oUser->getContentFilter()) / $iLimit) - 1),0);

        $this->sSearch = $oUser->getContentSearch();
        $aBc = array();
        /*if('all'!==$oUser->getContentTab() && 'search'!==$oUser->getContentTab()) {
            $aBc[MSHTools::getSubjectUrl($oUser->getContentTab())] = $oCat->getTitle();
        } else {
            $aBc[MSHTools::getSubjectUrl($oUser->getContentTab())] = $oUser->getContentTab();
        }*/
        $this->getResponse()->setSlot('bc', $aBc);

        $iPhase = $oUser->getPhase()+1;
        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase'.$iPhase.'_article_search'));
        if(null!==$oPageType) {
            $aSeoReplacements = array();
            if($iPhase>1) {
                $aSeoReplacements['country'] = $oUser->getCountry()->getTitle();
            }
            $this->getResponse()->setSlot('seoReplacements', $aSeoReplacements);
            $this->getResponse()->setSlot('meta_title', $oPageType->getMetaTitle());
            $this->getResponse()->setSlot('meta_description', $oPageType->getMetaDescription());
            $this->getResponse()->setSlot('doubleclick', $oPageType->getDoubleclickAd());
            $this->getResponse()->setSlot('doubleclick_head', $oPageType->getDoubleclickHead());
        }
    }

    /**
     * Phase 1 / 2 / 3 article detail
     * @param sfWebRequest $oRequest
     * @return sfView
     */
    public function executeContentDetail(sfWebRequest $oRequest) {

        if($oRequest->hasParameter('confirm_comment')) {
            $oComment = CommentPeer::retrieveByHash($oRequest->getParameter('confirm_comment'));
            if(null!==$oComment) {
                $oComment->setActive(true);
                $oComment->save();
            }
        }

        /** @var myUser $oUser  */
        $oUser = $this->getUser();

        $this->sCurrentSubject = $oUser->getContentTab();
        $this->oArticle = $oRequest->getAttribute('content.article');

        if($this->sCurrentSubject !== 'search' && $this->sCurrentSubject !== 'all' && $this->oArticle->getCategory()->getSlug!==$this->sCurrentSubject) {
            $this->sCurrentSubject = $this->oArticle->getCategory()->getSlug();
            $oUser->setContentTab($this->oArticle->getCategory()->getSlug());
        }

        if($oRequest->isXmlHttpRequest()) {
            $iScore = $oRequest->getParameter('score',null);

            if(!$oUser->hasRated($this->oArticle->getId())) {

                if(null!==$iScore) {
                    $oAppreciation = new Appreciation();
                    $oAppreciation->setPageId($this->oArticle->getId());
                    $oAppreciation->setValue(intval($iScore));
                    $oAppreciation->save();
                    $oUser->markRated($this->oArticle->getId(), $iScore, $oAppreciation->getId());
                }
            } else {
                $aRate = $oUser->getRated($this->oArticle->getId());
                $oAppreciation = AppreciationPeer::retrieveByPK($aRate[0]);
                $oAppreciation->setValue(intval($iScore));
                $oAppreciation->save();
                $oUser->markRated($this->oArticle->getId(), $iScore, $oAppreciation->getId());
            }
            return $this->renderPartial('articleDetail', array('oArticle' => $this->oArticle, 'bShowRatingThanks' => true));
        }

        $oUser->markContentRead($this->oArticle->getId());

        /** @var Comment $oComment  */
        $oComment = new Comment();
        $oComment->setPageId($this->oArticle->getId());
        $oForm = new CommentForm($oComment);
        if($oRequest->isMethod("POST")) {
            $oForm->bind($oRequest->getParameter($oForm->getName()));
            if($oForm->isValid()) {
                $oComment = $oForm->save();
                $oComment->setContent(MSHTools::nl2br_limit($oComment->getContent(),2));
                if($oUser->isAuthenticated() && null!==$oUser->getUser()) {
                    $oComment->setUser($oUser->getUser());
                    $oComment->setActive(true);
                } else {
                    $oMailer = new MSHMailer();
                    $oMailer->mailConfirmComment($oComment);
                }

                $oComment->save();
            }
        }
        $this->oForm = $oForm;

        $aBc = array();
        $aBc[MSHTools::getSubjectUrl($this->oArticle->getCategory()->getSlug())] = $this->oArticle->getCategory();
        $aBc[MSHTools::getContentUrl($this->oArticle)] = $this->oArticle->getTitle();
        
        //
        $this->getResponse()->setSlot('bDisableFooterTopProperties', true);
        $this->getResponse()->setSlot('bc', $aBc);

        $iPhase = $oUser->getPhase()+1;
        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase'.$iPhase.'_article_detail'));
        if(null!==$oPageType) {
            $aSeoReplacements = array();
            $aSeoReplacements['category'] = $this->oArticle->getCategory()->getTitle();
            $aSeoReplacements['article'] = $this->oArticle->getTitle();
            if($iPhase>1) {
                $aSeoReplacements['country'] = $oUser->getCountry()->getTitle();
            }
            $sArtMetaTitle = $this->oArticle->getMetaTitle();
            $sArtMetaDesc = $this->oArticle->getMetaDescription();
            $this->getResponse()->setSlot('seoReplacements', $aSeoReplacements);
            $this->getResponse()->setSlot('meta_title', (null!==$sArtMetaTitle&&strlen($sArtMetaTitle)>0) ? $sArtMetaTitle : $oPageType->getMetaTitle());
            $this->getResponse()->setSlot('meta_description', (null!==$sArtMetaDesc&&strlen($sArtMetaDesc)>0) ? $sArtMetaDesc : $oPageType->getMetaDescription());
            $this->getResponse()->setSlot('doubleclick', $oPageType->getDoubleclickAd());
            $this->getResponse()->setSlot('doubleclick_head', $oPageType->getDoubleclickHead());
        }
    }

    /**
     * Phase 1 Theme overview
     *
     * @param sfWebRequest $oRequest
     */
    public function executeOrientThemes(sfWebRequest $oRequest) {
        $oI18n = $this->getContext()->getI18N();

        $this->aTheme = ThemePeer::getIndex();

        $aBc = array();
        $aBc[MSHTools::getThemesUrl()] = $oI18n->__('themes');
        $this->getResponse()->setSlot('bc', $aBc);

        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase1_theme_overview'));
        if(null!==$oPageType) {
            $aSeoReplacements = array();
            $this->getResponse()->setSlot('seoReplacements', $aSeoReplacements);
            $this->getResponse()->setSlot('meta_title', $oPageType->getMetaTitle());
            $this->getResponse()->setSlot('meta_description', $oPageType->getMetaDescription());
            $this->getResponse()->setSlot('doubleclick', $oPageType->getDoubleclickAd());
            $this->getResponse()->setSlot('doubleclick_head', $oPageType->getDoubleclickHead());
        }
    }

    /**
     * Phase 1 Theme detail
     * @param sfWebRequest $oRequest
     */
    public function executeOrientThemeDetail(sfWebRequest $oRequest) {
        $oI18n = $this->getContext()->getI18N();

        $oUser = $this->getUser();

        $this->aTheme = ThemePeer::getIndex();
        $this->oTheme = $oRequest->getAttribute('content.theme');

        $aBc = array();
        $aBc[MSHTools::getThemesUrl()] = $oI18n->__('themes');
        $aBc[MSHTools::getThemeUrl($this->oTheme)] = $this->oTheme;
        $this->getResponse()->setSlot('bc', $aBc);
        $this->getResponse()->setSlot('theme', $this->oTheme);

        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase1_theme_detail'));
        if(null!==$oPageType) {
            $aSeoReplacements = array();
            $aSeoReplacements['theme'] = $this->oTheme->getTitle();
            $sCustomMetaTitle = $this->oTheme->getMetaTitle($oUser->getCulture());
            $sCustomMetaDescription = $this->oTheme->getMetaDescription($oUser->getCulture());
            $this->getResponse()->setSlot('seoReplacements', $aSeoReplacements);
            $this->getResponse()->setSlot('meta_title', (null!==$sCustomMetaTitle&&strlen($sCustomMetaTitle)>0) ? $sCustomMetaTitle : $oPageType->getMetaTitle());
            $this->getResponse()->setSlot('meta_description', (null!==$sCustomMetaDescription&&strlen($sCustomMetaDescription)>0) ? $sCustomMetaDescription : $oPageType->getMetaDescription());
            $this->getResponse()->setSlot('doubleclick', $oPageType->getDoubleclickAd());
            $this->getResponse()->setSlot('doubleclick_head', $oPageType->getDoubleclickHead());
        }
    }

    /**
     * Choose Country Screen
     *
     * @param sfWebRequest $oRequest
     */
    public function executeChooseCountry(sfWebRequest $oRequest) {
        $iPhase = $oRequest->getParameter('phase', null);
        if(null!==$iPhase) {
            $this->getUser()->setPhase($iPhase);
        }
        $oI18n = $this->getContext()->getI18N();
        $this->aCountry = CountryPeer::retrieveActive($this->getUser()->getCulture());
        $aBc = array();
        $aBc[MSHTools::getChooseCountryUrl()] = $oI18n->__('orient.chooseCountry');
        $this->getResponse()->setSlot('bc', $aBc);
    }

    /**
     * Phase 2 Home
     * @param sfWebRequest $oRequest
     */
    public function executeInform(sfWebRequest $oRequest) {

        /** @var myUser $oUser  */
        $oUser = $this->getUser();
        $aCategoryI18n = CategoryI18nPeer::retrieveMainCategoryForPhase(1, $oUser->getCulture());
        $aCat = array();
        foreach($aCategoryI18n as $oCatI18n) {
            $aCat[] = $oCatI18n->getCategory();
        }

        $this->oCountry = $oUser->getCountry();
        $this->aRegion = $oUser->getCountry()->getRegions($oUser->getCulture());
        $this->aCategory = $aCat;
        $oUser->setContentSearch('');
        $this->getResponse()->setSlot('bDisableFooterTopProperties',true);

        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase2_home'));
        if(null!==$oPageType) {
            $aSeoReplacements = array();
            $aSeoReplacements['country'] = $this->oCountry->getTitle();
            $sCustomMetaTitle = $this->oCountry->getMetaTitle($oUser->getCulture());
            $sCustomMetaDescription = $this->oCountry->getMetaDescription($oUser->getCulture());
            $this->getResponse()->setSlot('seoReplacements', $aSeoReplacements);
            $this->getResponse()->setSlot('meta_title', (null!==$sCustomMetaTitle&&strlen($sCustomMetaTitle)>0) ? $sCustomMetaTitle : $oPageType->getMetaTitle());
            $this->getResponse()->setSlot('meta_description', (null!==$sCustomMetaDescription&&strlen($sCustomMetaDescription)>0) ? $sCustomMetaDescription : $oPageType->getMetaDescription());
            $this->getResponse()->setSlot('doubleclick', $oPageType->getDoubleclickAd());
            $this->getResponse()->setSlot('doubleclick_head', $oPageType->getDoubleclickHead());
        }
    }

    /**
     * Phase 2 region overview
     *
     * @param sfWebRequest $oRequest
     */
    public function executeCountryRegions(sfWebRequest $oRequest) {
        $oI18n = $this->getContext()->getI18N();

        /** @var myUser $oUser  */
        $oUser = $this->getUser();

        $this->sCurrentSubject = $oI18n->__('subject.countryInformation');
        $this->aRegion = $oUser->getCountry()->getRegions($oUser->getCulture());
        $this->oCountry = $oUser->getCountry();

        $aBc = array();
        $aBc[MSHTools::getCountryRegionsUrl($this->oCountry)] = $oI18n->__('subject.regions');
        $this->getResponse()->setSlot('bc', $aBc);

        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase2_region_overview'));
        if(null!==$oPageType) {
            $aSeoReplacements = array();
            $aSeoReplacements['country'] = $this->oCountry->getTitle();
            $this->getResponse()->setSlot('seoReplacements', $aSeoReplacements);
            $this->getResponse()->setSlot('meta_title', $oPageType->getMetaTitle());
            $this->getResponse()->setSlot('meta_description', $oPageType->getMetaDescription());
            $this->getResponse()->setSlot('doubleclick', $oPageType->getDoubleclickAd());
            $this->getResponse()->setSlot('doubleclick_head', $oPageType->getDoubleclickHead());
        }
    }

    /**
     * Phase 2 City overview
     *
     * @param sfWebRequest $oRequest
     */
    public function executeCountryRegionCities(sfWebRequest $oRequest) {
        $oI18n = $this->getContext()->getI18N();

        /** @var myUser $oUser  */
        $oUser = $this->getUser();

        $this->sCurrentSubject = $oI18n->__('subject.countryInformation');
        $this->oRegion = $oRequest->getAttribute('content.region');
        $this->aCity = CityPeer::retrieveByRegion($this->oRegion->getId(),$oUser->getCulture(), false );
        
        $aBc = array();
        $aBc[MSHTools::getCountryRegionsUrl($this->oRegion->getCountry())] = $oI18n->__('subject.regions');
        $aBc[MSHTools::getCountryRegionUrl($this->oRegion)] = $this->oRegion->getTitle();
        $aBc[MSHTools::getCountryRegionCitiesUrl($this->oRegion)] = $oI18n->__('Cities');
        $this->getResponse()->setSlot('bc', $aBc);

        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase2_region_city_overview'));
        if(null!==$oPageType) {
            $aSeoReplacements = array();
            $aSeoReplacements['country'] = $this->oCountry->getTitle();
            $this->getResponse()->setSlot('seoReplacements', $aSeoReplacements);
            $this->getResponse()->setSlot('meta_title', $oPageType->getMetaTitle());
            $this->getResponse()->setSlot('meta_description', $oPageType->getMetaDescription());
            $this->getResponse()->setSlot('doubleclick', $oPageType->getDoubleclickAd());
            $this->getResponse()->setSlot('doubleclick_head', $oPageType->getDoubleclickHead());
        }
    }
    
    /**
     * Phase 2 Region detail
     * @param sfWebRequest $oRequest
     */
    public function executeRegionDetail(sfWebRequest $oRequest) {
        $oI18n = $this->getContext()->getI18N();

        /** @var myUser $oUser  */
        $oUser = $this->getUser();
        $this->culture = $oUser->getCulture();
        
        $this->aRegion = $oUser->getCountry()->getRegions($this->culture);
        $this->oRegion = $oRequest->getAttribute('content.region');
        $oRequest->setAttribute('region_properties', $this->oRegion);
        $this->cities = CityPeer::retrieveByRegion($this->oRegion->getId(), 'en', true);

        $aBc = array();
        $aBc[MSHTools::getCountryRegionsUrl($this->oRegion->getCountry())] = $oI18n->__('subject.regions');
        $aBc[MSHTools::getCountryRegionUrl($this->oRegion)] = $this->oRegion->getTitle();
        $this->getResponse()->setSlot('bc', $aBc);
        $this->getResponse()->setSlot('bDisableFooterTopProperties',true);

        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase2_region_detail'));
        if(null!==$oPageType) {
            $aSeoReplacements = array();
            $aSeoReplacements['country'] = $this->oRegion->getCountry()->getTitle();
            $aSeoReplacements['region'] = $this->oRegion->getTitle();
            $sCustomMetaTitle = $this->oRegion->getMetaTitle($this->culture);
            $sCustomMetaDescription = $this->oRegion->getMetaDescription($this->culture);
            $this->getResponse()->setSlot('seoReplacements', $aSeoReplacements);
            $this->getResponse()->setSlot('meta_title', (null!==$sCustomMetaTitle&&strlen($sCustomMetaTitle)>0) ? $sCustomMetaTitle : $oPageType->getMetaTitle());
            $this->getResponse()->setSlot('meta_description', (null!==$sCustomMetaDescription&&strlen($sCustomMetaDescription)>0) ? $sCustomMetaDescription : $oPageType->getMetaDescription());
            $this->getResponse()->setSlot('doubleclick', $oPageType->getDoubleclickAd());
            $this->getResponse()->setSlot('doubleclick_head', $oPageType->getDoubleclickHead());
        }

    }
    
    /**
     * Phase 2 City detail
     * @param sfWebRequest $oRequest
     */
    public function executeCityDetail(sfWebRequest $oRequest) {
        $oI18n = $this->getContext()->getI18N();

        /** @var myUser $oUser  */
        $oUser = $this->getUser();
        
        $culture = $oUser->getCulture();
        
        $this->aRegion = $oUser->getCountry()->getRegions($culture);
        $this->oRegion = $oRequest->getAttribute('content.region');
        $oRequest->setAttribute('region_properties', $this->oRegion);
        $this->cCity = CityI18nPeer::retrieveBySlugAndCulture($oRequest->getAttribute('content.city'), $this->oRegion->getId(), $culture);
        $this->oCity = $this->cCity->getCity();
        $oRequest->setAttribute('city_properties', $this->oCity);

        $aBc = array();
        $aBc[MSHTools::getCountryRegionsUrl($this->oRegion->getCountry())] = $oI18n->__('subject.regions');
        $aBc[MSHTools::getCountryRegionUrl($this->oRegion)] = $this->oRegion->getTitle();
        $aBc[MSHTools::getCountryRegionCityInformUrl($this->oRegion, $this->oCity)] = $oI18n->__($this->oCity->getTitle());
        $this->getResponse()->setSlot('bc', $aBc);
        $this->getResponse()->setSlot('bDisableFooterTopProperties',true);
        
        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase2_city_detail'));
        if(null!==$oPageType) {
            $aSeoReplacements = array();
            $aSeoReplacements['city'] = $this->oCity->getTitle();
            $aSeoReplacements['country'] = $this->oRegion->getCountry()->getTitle();
            $aSeoReplacements['region'] = $this->oRegion->getTitle();
            $this->getResponse()->setSlot('seoReplacements', $aSeoReplacements);
            $this->getResponse()->setSlot('meta_title', $oPageType->getMetaTitle());
            $this->getResponse()->setSlot('meta_description', $oPageType->getMetaDescription());
            $this->getResponse()->setSlot('doubleclick', $oPageType->getDoubleclickAd());
            $this->getResponse()->setSlot('doubleclick_head', $oPageType->getDoubleclickHead());
        }
        
    }
    
    

    /**
     * Phase 3 home
     * @param sfWebRequest $oRequest
     */
    public function executeAdvice(sfWebRequest $oRequest) {

        /** @var myUser $oUser  */
        $oUser = $this->getUser();
        $aCategoryI18n = CategoryI18nPeer::retrieveMainCategoryForPhase(2, $oUser->getCulture());
        $aCat = array();
        foreach($aCategoryI18n as $oCatI18n) {
            $aCat[] = $oCatI18n->getCategory();
        }
        $oUser->setContentTab('all');
        $oUser->setContentSearch('');

        $this->aQuestion = QuestionPeer::retrieveByCultureAndSubject($oUser->getCulture(), null, $oUser->getCountry(), 5);
        $this->aCategory = $aCat;

        $this->aExperience = UserReferencePeer::retrieveByCountryAndCulture($oUser->getCountry(), $oUser->getCulture(), 2);

        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase3_home'));
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

    /**
     * Phase 3 question overview
     * @param sfWebRequest $oRequest
     * @return sfView
     */
    public function executeQuestions(sfWebRequest $oRequest) {

        $oI18n = $this->getContext()->getI18N();
        $iLimit = 5;
        /** @var myUser $oUser  */
        $oUser = $this->getUser();
        $oCat = CategoryI18nPeer::retrieveMainCategoryForPhaseBySlug($oUser->getPhase(),$oUser->getCulture(),$oUser->getContentTab());

        $this->oCategory = $oCat;
        $this->sCurrentSubject = $oUser->getContentTab();
        $oUser->setContentSearch('');

        if($oRequest->isXmlHttpRequest()) {
            $sSort = $oRequest->getParameter('order',null);
            if(null!== $sSort) {
                $oUser->setContentSort($sSort);
            }

            $iPage = $oRequest->getParameter('page',0);
            return $this->renderPartial('content/contentQuestions', array(
                'iPage' => $iPage,
                'aQuestion' =>  QuestionPeer::retrieveByCultureAndSubject($oUser->getCulture(), $oCat, $oUser->getCountry(), $iLimit, $iPage, $oUser->getContentSort()),
                'iPages' => ceil(QuestionPeer::countByCultureAndSubject($oUser->getCulture(), $oCat, $oUser->getCountry()) / $iLimit) - 1
            ));

        }

        $this->aQuestion = QuestionPeer::retrieveByCultureAndSubject($oUser->getCulture(), $oCat, $oUser->getCountry(), $iLimit, 0, $oUser->getContentSort());
        $this->iPages = ceil(QuestionPeer::countByCultureAndSubject($oUser->getCulture(), $oCat, $oUser->getCountry()) / $iLimit) - 1;

        $aBc = array();
        if('all'!==$oUser->getContentTab() && 'search'!==$oUser->getContentTab()) {
            $aBc[MSHTools::getSubjectUrl($oUser->getContentTab(), null, true)] = $oCat->getTitle();
        } else {
            $aBc[MSHTools::getSubjectUrl($oUser->getContentTab(), null, true)] = $oUser->getContentTab();
        }
        $this->getResponse()->setSlot('bc', $aBc);

        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase3_qa_overview'));
        if(null!==$oPageType) {
            $aSeoReplacements = array();
            $aSeoReplacements['country'] = $oUser->getCountry()->getTitle();
            if('all'===$oUser->getContentTab()) {
                $aSeoReplacements['category'] = $oI18n->__('subject.all');
            } elseif( 'search'!==$oUser->getContentTab()) {
                $aSeoReplacements['category'] = $oI18n->__('subject.search');
            } else {
                $aSeoReplacements['category'] = $oCat->getTitle();
            }
            $this->getResponse()->setSlot('seoReplacements', $aSeoReplacements);
            $this->getResponse()->setSlot('meta_title', $oPageType->getMetaTitle());
            $this->getResponse()->setSlot('meta_description', $oPageType->getMetaDescription());
            $this->getResponse()->setSlot('doubleclick', $oPageType->getDoubleclickAd());
            $this->getResponse()->setSlot('doubleclick_head', $oPageType->getDoubleclickHead());
        }
    }

    /**
     * Phase 3 Question detail
     * @param sfWebRequest $oRequest
     * @return sfView
     */
    public function executeQuestionDetail(sfWebRequest $oRequest) {

        /** @var myUser $oUser  */
        $oUser = $this->getUser();

        $this->oQuestion = $oRequest->getAttribute('content.question');

        if($oRequest->hasParameter('confirm_question')) {
            $oQuestion = QuestionPeer::retrieveByHash($oRequest->getParameter('confirm_question'));
            if(null!==$oQuestion && $oQuestion->getId() == $this->oQuestion->getId()) {
                $oQuestion->setActive(true);
                $oQuestion->save();
                $oMailer = new MSHMailer();
                $aExpert = UserPeer::retrieveExpertsForCountryAndLanguage($oQuestion->getCountry(), $oQuestion->getLanguage());
                foreach($aExpert as $oExpert) {
                    $oMailer->mailPostQuestion($oQuestion, $oExpert);
                }
            }
        }
        if($oRequest->hasParameter('confirm_comment')) {
            $oComment = CommentPeer::retrieveByHash($oRequest->getParameter('confirm_comment'));
            if(null!==$oComment) {
                $oComment->setActive(true);
                $oComment->save();
                $oMailer = new MSHMailer();
                $oMailer->mailAnswerReceived($oComment);
            }
        }

        $this->sCurrentSubject = $oUser->getContentTab();


        if($oRequest->isXmlHttpRequest()) {
            $iScore = $oRequest->getParameter('score',null);
            if(!$oUser->hasRated($this->oQuestion->getId(), 'question')) {
                if(null!==$iScore) {
                    $oAppreciation = new Appreciation();
                    $oAppreciation->setQuestionId($this->oQuestion->getId());
                    $oAppreciation->setValue(intval($iScore));
                    $oAppreciation->save();
                    $oUser->markRated($this->oQuestion->getId(), $iScore, $oAppreciation->getId(), 'question');
                }
            } else {
                $aRate = $oUser->getRated($this->oQuestion->getId(), 'question');
                $oAppreciation = AppreciationPeer::retrieveByPK($aRate[0]);
                $oAppreciation->setValue(intval($iScore));
                $oAppreciation->save();
                $oUser->markRated($this->oQuestion->getId(), $iScore, $oAppreciation->getId(), 'question');
            }
            return $this->renderPartial('questionDetail', array('oQuestion' => $this->oQuestion, 'bShowRatingThanks' => true));
        }



        $oUser->markContentRead($this->oQuestion->getId(), 'question');

        /** @var Comment $oComment  */
        $oComment = new Comment();
        $oComment->setQuestionId($this->oQuestion->getId());
        $oForm = new CommentForm($oComment);
        if($oRequest->isMethod("POST")) {
            $oForm->bind($oRequest->getParameter($oForm->getName()));
            if($oForm->isValid()) {
                $oComment = $oForm->save();
                $oComment->setContent(MSHTools::nl2br_limit($oComment->getContent(),2));

                if($oUser->isAuthenticated() && null!==$oUser->getUser()) {
                    $oComment->setUser($oUser->getUser());
                    $oComment->setActive(true);
                    $oMailer = new MSHMailer();
                    $oMailer->mailAnswerReceived($oComment);
                } else {
                    $oMailer = new MSHMailer();
                    $oMailer->mailConfirmComment($oComment);
                }

                $oComment->save();
            }
        }
        $this->oForm = $oForm;

        $aBc = array();
        $aBc[MSHTools::getSubjectUrl($oUser->getContentTab(), null, true)] = $this->oQuestion->getCategory();
        $aBc[MSHTools::getQuestionUrl($this->oQuestion)] = $this->oQuestion->getTitle();
        $this->getResponse()->setSlot('bc', $aBc);

        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase3_qa_detail'));
        if(null!==$oPageType) {
            $aSeoReplacements = array();
            $aSeoReplacements['country'] = $oUser->getCountry()->getTitle();
            $aSeoReplacements['question'] = $this->oQuestion->getTitle();
            $sQMetaTitle = $this->oQuestion->getMetaTitle();
            $sQMetaDesc = $this->oQuestion->getMetaDescription();
            $this->getResponse()->setSlot('seoReplacements', $aSeoReplacements);
            $this->getResponse()->setSlot('meta_title', (null!==$sQMetaTitle&&strlen($sQMetaTitle)>0) ? $sQMetaTitle : $oPageType->getMetaTitle());
            $this->getResponse()->setSlot('meta_description', (null!==$sQMetaDesc&&strlen($sQMetaDesc)>0) ? $sQMetaDesc : $oPageType->getMetaDescription());
            $this->getResponse()->setSlot('doubleclick', $oPageType->getDoubleclickAd());
            $this->getResponse()->setSlot('doubleclick_head', $oPageType->getDoubleclickHead());
        }
    }

    /**
     * Phase 3 Question search
     * @param sfWebRequest $oRequest
     * @return sfView
     */
    public function executeSearchQuestions(sfWebRequest $oRequest) {

        $oI18n = $this->getContext()->getI18N();
        $iLimit = 5;
        $oI18n = $this->getContext()->getI18N();

        /** @var myUser $oUser  */
        $oUser = $this->getUser();

        $this->sCurrentSubject = $oI18n->__('subject.search');
        $this->oCountry = $oUser->getCountry();

        $this->setTemplate('questions');

        if($oRequest->isMethod("POST")) {
            $sSearch = $oRequest->getParameter('search', null);
            if(null!==$sSearch) {
                $oUser->setContentSearch($sSearch);
            }
        }

        $sSearch = $oUser->getContentSearch();


        if($oRequest->isXmlHttpRequest()) {
            $sSort = $oRequest->getParameter('order',null);
            if(null!== $sSort) {
                $oUser->setContentSort($sSort);
            }

            $iPage = $oRequest->getParameter('page',0);
            return $this->renderPartial('content/contentQuestions', array(
                'iPage' => $iPage,
                'aQuestion' =>  QuestionPeer::searchByCultureAndSubject($sSearch, $oUser->getCulture(), $oUser->getCountry(), $iLimit, $iPage, $oUser->getContentSort()),
                'iPages' => ceil(QuestionPeer::countBySearchCultureAndSubject($sSearch, $oUser->getCulture(), $oUser->getCountry()) / $iLimit) - 1
            ));

        }

        $this->aQuestion = QuestionPeer::searchByCultureAndSubject($sSearch, $oUser->getCulture(), $oUser->getCountry(), $iLimit, 0, $oUser->getContentSort());
        $this->iPages = ceil(QuestionPeer::countBySearchCultureAndSubject($sSearch, $oUser->getCulture(), $oUser->getCountry()) / $iLimit) - 1;

        $aBc = array();
        $aBc[MSHTools::getSubjectUrl($oUser->getContentTab(), null, true)] = $oI18n->__('subject.search');
        $this->getResponse()->setSlot('bc', $aBc);

        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase3_qa_search'));
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

    /**
     * Phase 3 Question post
     * @param sfWebRequest $oRequest
     */
    public function executeAskQuestion(sfWebRequest $oRequest) {

        /** @var myUser $oUser  */
        $oUser = $this->getUser();

        $this->sCurrentSubject = $oUser->getContentTab();
        $oCat = CategoryI18nPeer::retrieveMainCategoryForPhaseBySlug($oUser->getPhase(),$oUser->getCulture(),$oUser->getContentTab());

        /** @var Question $oQuestion  */
        $oQuestion = new Question();
        $oQuestion->setCategory($oCat);
        $oQuestion->setCountry($oUser->getCountry());
        $oQuestion->setLanguage($oUser->getLanguage());
        $oForm = new AskQuestionForm($oQuestion);
        
        if($oRequest->isMethod("POST")) {
            $oForm->bind($oRequest->getParameter($oForm->getName()));
            //$oForm->bind(array_merge($oRequest->getParameter($oForm->getName()), array('captcha' => $oRequest->getParameter('captcha')))); 
            
            if($oForm->isValid()) {

                $oQuestion = $oForm->save();
                $oQuestion->setContent(MSHTools::nl2br_limit($oQuestion->getContent(),2));
                $oQuestion->save();
                $oMailer = new MSHMailer();
                $oMailer->mailConfirmQuestion($oQuestion);

                /**
                 * @Todo send email to experts!
                 */
            }
        }
        $this->oForm = $oForm;

        $aBc = array();
        /*if('all'!==$oUser->getContentTab() && 'search'!==$oUser->getContentTab()) {
            $aBc[MSHTools::getSubjectUrl($oUser->getContentTab())] = $this->oArticle->getCategory();
        } else {
            $aBc[MSHTools::getSubjectUrl($oUser->getContentTab())] = $oUser->getContentTab();
        }
        $aBc[MSHTools::getContentUrl($this->oArticle)] = $this->oArticle->getTitle();*/
        $this->getResponse()->setSlot('bc', $aBc);

        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase3_qa_post'));
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

    /**
     * Phase 3 Experience overview
     * @param sfWebRequest $oRequest
     * @return sfView
     */
    public function executeExperiences(sfWebRequest $oRequest) {

        $iLimit = 5;
        /** @var myUser $oUser  */
        $oUser = $this->getUser();
        $oI18n = $this->getContext()->getI18N();

        if($oRequest->isXmlHttpRequest()) {
            $iPage = $oRequest->getParameter('page',0);
            return $this->renderPartial('content/contentArticles', array(
                'aExperience' =>  UserReferencePeer::retrieveByCountryAndCulture($oUser->getCountry(), $oUser->getCulture(), $iLimit, $iPage),
                'iPages' => ceil(UserReferencePeer::countByCountry($oUser->getCountry(), $oUser->getCulture()) / $iLimit) - 1
            ));

        }

        $this->aExperience = UserReferencePeer::retrieveByCountryAndCulture($oUser->getCountry(), $oUser->getCulture(), $iLimit);
        $this->iPages = ceil(UserReferencePeer::countByCountry($oUser->getCountry(), $oUser->getCulture()) / $iLimit) - 1;

        $aBc = array();
        $aBc[MSHTools::getCountryExperiencesUrl($oUser->getCountry())] = $oI18n->__('experiences');
        $this->getResponse()->setSlot('bc', $aBc);

        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase3_experience_overview'));
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

    public function executeExperienceDetail(sfWebRequest $oRequest) {


        /** @var myUser $oUser  */
        $oUser = $this->getUser();
        $oI18n = $this->getContext()->getI18N();


        $this->oExperience = $oRequest->getAttribute('content.experience');

        $oUser->markContentRead($this->oExperience->getId(), 'experience');

        $this->aOtherExperiences = UserReferencePeer::getUnreadExperiences($this->oExperience->getCountry(), $oUser->getCulture(), 4, $this->oExperience->getId());

        $aBc = array();
        $aBc[MSHTools::getCountryExperiencesUrl($oUser->getCountry())] = $oI18n->__('experiences');
        $aBc[MSHTools::getCountryExperienceUrl($this->oExperience)] = $this->oExperience->getTitle();
        
        //
        $this->getResponse()->setSlot('bDisableFooterTopProperties', true);
        $this->getResponse()->setSlot('bc', $aBc);

        $oPageType = PageTypePeer::retrieveByPK(sfConfig::get('app_page_type_phase3_experience_detail'));
        if(null!==$oPageType) {
            $aSeoReplacements = array();
            $aSeoReplacements['country'] = $oUser->getCountry()->getTitle();
            $aSeoReplacements['experience'] = $this->oExperience->getTitle();
            $sExpMetaTitle = $this->oExperience->getMetaTitle();
            $sExpMetaDesc = $this->oExperience->getMetaDescription();
            $this->getResponse()->setSlot('seoReplacements', $aSeoReplacements);
            $this->getResponse()->setSlot('meta_title', (null!==$sExpMetaTitle&&strlen($sExpMetaTitle)>0) ? $sExpMetaTitle : $oPageType->getMetaTitle());
            $this->getResponse()->setSlot('meta_description', (null!==$sExpMetaDesc&&strlen($sExpMetaDesc)>0) ? $sExpMetaDesc : $oPageType->getMetaDescription());
            $this->getResponse()->setSlot('doubleclick', $oPageType->getDoubleclickAd());
            $this->getResponse()->setSlot('doubleclick_head', $oPageType->getDoubleclickHead());
        }
    }
}
