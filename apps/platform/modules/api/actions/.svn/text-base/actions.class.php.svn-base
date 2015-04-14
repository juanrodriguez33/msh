<?php

/**
 * api actions.
 *
 * @package    mysecondhome
 * @subpackage api
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class apiActions extends kmActions
{
    public function executeCountry(sfWebRequest $oRequest) {
        sfConfig::set('sf_web_debug', false);

        $sInput = $oRequest->getParameter('input');

        $this->aCountry = CountryI18nPeer::searchByTitle($sInput, 'en', true);

    }

    public function executeRegion(sfWebRequest $oRequest) {
        sfConfig::set('sf_web_debug', false);

        $sInput = $oRequest->getParameter('input');

        $iCountry = $oRequest->getParameter('country',null);

        if(null!==$iCountry) {
            $this->aRegion = RegionI18nPeer::searchByTitleInCountry($sInput, $iCountry, 'en', true);
        } else {
            $this->aRegion = RegionI18nPeer::searchByTitle($sInput, true);
        }

        $this->bAllowAdd = $oRequest->getParameter('allow_add',false);
        $this->sTerm = $sInput;

    }

    public function executeCity(sfWebRequest $oRequest) {
        sfConfig::set('sf_web_debug', false);

        $sInput = $oRequest->getParameter('input');

        $iRegion = $oRequest->getParameter('region',null);

        if(null!==$iRegion) {
            $this->aCity = CityI18nPeer::searchByTitleInRegion($sInput, $iRegion, 'en', true);
        } else {
            $this->aCity = CityI18nPeer::searchByTitle($sInput, true);
        }


        $this->bAllowAdd = $oRequest->getParameter('allow_add',false);
        $this->sTerm = $sInput;

    }

    public function executeRegionOfCountry(sfWebRequest $oRequest) {
        sfConfig::set('sf_web_debug', false);

        $iCountry = $oRequest->getParameter('country',null);

        $this->bAllowNew = intval($oRequest->getParameter('allow_new', 0)) == 1;

        if(null!==$iCountry) {
            $this->aRegion = RegionPeer::retrieveByCountry($iCountry, 'en', true);
        } else {
            $this->aRegion = array();
        }
    }

    public function executeCityOfRegion(sfWebRequest $oRequest) {
        sfConfig::set('sf_web_debug', false);

        $iRegion = $oRequest->getParameter('region',null);

        $this->bAllowNew = intval($oRequest->getParameter('allow_new', 0)) == 1;

        if(null!==$iRegion) {
            $this->aCity = CityPeer::retrieveByRegion($iRegion, 'en', true);
        } else {
            $this->aCity = array();
        }
    }

    public function executeDevelopmentInfo(sfWebRequest $oRequest) {
        sfConfig::set('sf_web_debug', false);

        $iDevelopment = $oRequest->getParameter('development_id',null);

        $oDevelopment = DevelopmentPeer::retrieveByPK($iDevelopment);


        $this->getResponse()->setContentType('application/json');

        $data_array = array(
            "country_id" => $oDevelopment->getCountryId(),
            "region_id" => $oDevelopment->getRegionId(),
            "region_title" => $oDevelopment->getRegion()->getTitle(),
            "city_id" => $oDevelopment->getCityId(),
            "city_title" => $oDevelopment->getCity()->getTitle(),
        );

        $data_json=json_encode($data_array);
        return $this->renderText($data_json);
    }
}