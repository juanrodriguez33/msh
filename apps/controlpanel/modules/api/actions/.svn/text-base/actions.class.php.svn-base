<?php
/**
 * Created by JetBrains PhpStorm.
 * User: simonsabelis
 * Date: 2/14/13
 * Time: 10:22
 * To change this template use File | Settings | File Templates.
 */
class apiActions extends sfActions
{
    public function executeCountry(sfWebRequest $oRequest) {

        $sInput = $oRequest->getParameter('input');

        $this->aCountry = CountryI18nPeer::searchByTitle($sInput);

    }

    public function executeRegion(sfWebRequest $oRequest) {

        $sInput = $oRequest->getParameter('input');

        $iCountry = $oRequest->getParameter('country',null);

        if(null!==$iCountry) {
            $this->aRegion = RegionI18nPeer::searchByTitleInCountry($sInput, $iCountry);
        } else {
            $this->aRegion = RegionI18nPeer::searchByTitle($sInput);
        }

        $this->bAllowAdd = $oRequest->getParameter('allow_add',false);
        $this->sTerm = $sInput;

    }

    public function executeCity(sfWebRequest $oRequest) {

        $sInput = $oRequest->getParameter('input');

        $iRegion = $oRequest->getParameter('region',null);

        if(null!==$iRegion) {
            $this->aCity = CityI18nPeer::searchByTitleInRegion($sInput, $iRegion);
        } else {
            $this->aCity = CityI18nPeer::searchByTitle($sInput);
        }


        $this->bAllowAdd = $oRequest->getParameter('allow_add',false);
        $this->sTerm = $sInput;

    }

}
