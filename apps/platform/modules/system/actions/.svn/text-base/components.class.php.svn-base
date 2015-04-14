<?php
/**
 * Created by JetBrains PhpStorm.
 * User: simonsabelis
 * Date: 3/27/13
 * Time: 11:54
 * To change this template use File | Settings | File Templates.
 */

class systemComponents extends kmComponents {

    public function executeHeader(sfWebRequest $oRequest) {
        /** @var myUser $oUser  */
        $oUser = $this->getUser();

        $aCategoryI18n = CategoryI18nPeer::retrieveMainCategoryForPhase(0, $oUser->getCulture());
        $aCat = array();
        foreach($aCategoryI18n as $oCatI18n) {

            $aCat[] = $oCatI18n->getCategory();
        }
        $this->aCategoryOrient = $aCat;
        $oCriteria = new Criteria();
        $oCriteria->setLimit(4);
        $this->aTheme = ThemePeer::getIndex($oCriteria);

        $aCategoryI18n = CategoryI18nPeer::retrieveMainCategoryForPhase(1, $oUser->getCulture());
        $aCat = array();
        foreach($aCategoryI18n as $oCatI18n) {
            $aCat[] = $oCatI18n->getCategory();
        }
        $this->aCategoryInform = $aCat;

        if($oUser->hasCountry()) {
            $this->aQuestion = QuestionPeer::retrieveByCultureAndSubject($oUser->getCulture(), null, $oUser->getCountry(),5,0, "dateDesc");
            $this->aExperience = UserReferencePeer::retrieveByCountryAndCulture($oUser->getCountry(), $oUser->getCulture(),5,0);
            $this->aNews = PagePeer::retrieveByPhaseCultureAndSubject(2,$oUser->getCulture(), null, $oUser->getCountry(),5,0, "dateDesc");
        }


        $this->aCountryMenu = CountryPeer::retrieveForMenu($this->getUser()->getCulture());
        $this->aCountryPopular = CountryPeer::retrievePopular($this->getUser()->getCulture());

        $this->aLanguage = LanguagePeer::getIndex();

		$this->aStaticPage = StaticPagePeer::retrieveByCulture($this->getUser()->getCulture());
		
        /*$aRegionCountResults = MSHPropertySphinxSearcher::getRandomFieldCounts('region_id');
        $aRegion = array();
        $aRegionResults = array();
        if($aRegionCountResults['total'] > 0) {
            $aRegionSelected = array_rand($aRegionCountResults['matches'],min(sizeof($aRegionCountResults['matches']),4));
            if(is_array($aRegionSelected) && sizeof($aRegionSelected) > 0 ) {
                foreach($aRegionSelected as $iResultKey) {
                    $aRegionResult = $aRegionCountResults['matches'][$iResultKey];
                    $aRegion[$aRegionResult['attrs']['region_id']] = RegionPeer::retrieveByPK($aRegionResult['attrs']['region_id']);
                    $aRegionResults[] = array('id' => $aRegionResult['attrs']['region_id'], 'count' => $aRegionResult['attrs']['@count']);
                }
            }

        }

        $this->aRegion = $aRegion;
        $this->aRegionResults = $aRegionResults;

        $aTypeCountResults = MSHPropertySphinxSearcher::getRandomFieldCounts('type_id');
        $aType = array();
        $aTypeResults = array();
        if($aTypeCountResults['total'] > 0) {

            $aTypeSelected = array_rand($aTypeCountResults['matches'],min(sizeof($aTypeCountResults['matches']),4));
            if(is_array($aTypeSelected) && sizeof($aTypeSelected)> 0) {
                foreach($aTypeSelected as $iResultKey) {
                    $aTypeResult = $aTypeCountResults['matches'][$iResultKey];
                    $aType[$aTypeResult['attrs']['type_id']] = PropertyTypePeer::retrieveByPK($aTypeResult['attrs']['type_id']);
                    $aTypeResults[] = array('id' => $aTypeResult['attrs']['type_id'], 'count' => $aTypeResult['attrs']['@count']);
                }
            }

        }

        $this->aType = $aType;
        $this->aTypeResults = $aTypeResults;

        $this->aPriceCountResults = MSHPropertySphinxSearcher::getPriceCounts();*/
    }

    public function executeBanner(sfWebRequest $oRequest) {
        if($this->bIsHomepage) {
            $this->aBanner = BannerPeer::retrieveForHomepage();
        } else if(null!==$this->oTheme) {
            $this->aBanner = BannerPeer::retrieveForTheme($this->oTheme->getId());
        } else if(null!==$this->oCountry) {
            $this->aBanner = BannerPeer::retrieveForCountry($this->oCountry->getId());
        } else {
            $this->aBanner = BannerPeer::retrieveForNonStartPage();
        }
    }

    public function executeBreadcrumb(sfWebRequest $oRequest) {
        
    }

    public function executeFilter(sfWebRequest $oRequest) {
        $this->iTotal = MSHPropertySphinxSearcher::getTotalForFilters($this->getUser(), array(), false, true);
        $this->iCountry = CountryPeer::getCount(CountryPeer::getDefaultCriteria());

        $this->aMax = MSHPropertySphinxSearcher::calculateMaxPerField(array('price'));
    }

    public function executeFooter(sfWebRequest $oRequest) {
        $this->aStaticPage = StaticPagePeer::retrieveByCulture($this->getUser()->getCulture());
    }
    
    public function executeMostPopular(sfWebRequest $oRequest) {
        
        //COUNTRIES
        //france, italy, ned, Austria,Portugal,Spanje, Turkije, Bulgaria, Curacao 
        $countriesPk = array("1", "4", "14", "7", "6", "2", "8", "48", "12");
        $countriesList = array(); 
        foreach ($countriesPk as $countryPk) {
            $countriesList = array_merge($countriesList, CountryPeer::retrieveForList($countryPk, $this->getUser()->getCulture()));
        }
        
        //REGIONS
        //Algarve, Lisboa, Provence, Aquitaine, Toscane, Lombardia, Tirol, Vorarlberg, Alicante, Malaga
        $regionsPk = array("23", "54", "11", "10", "60", "65", "44", "46", "212", "219");
        $regionsList = array(); 
        foreach ($regionsPk as $regionPk) {
            $regionsList = array_merge($regionsList, RegionPeer::retrieveForList($regionPk, $this->getUser()->getCulture()));
        }
        
        //Cities
        //Denia, Mallorca, Albufeira, Lissabon, Kusadasi, Alanya, Belek, Fontanella, Kirchberg, Florence 
        $citiesPk = array("94", "887", "111", "154", "137", "13", "202", "183", "198", "1003");
        $citiesList = array(); 
        foreach ($citiesPk as $cityPk) {
            $citiesList = array_merge($citiesList, CityPeer::retrieveForList($cityPk, $this->getUser()->getCulture()));
        }
        
        $this->aCountryList = $countriesList;
        $this->aRegionList = $regionsList;
        $this->aCityList = $citiesList;
        
    }

}