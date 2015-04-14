<?php

require_once dirname(__FILE__).'/../lib/cityGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/cityGeneratorHelper.class.php';

/**
 * city actions.
 *
 * @package    mysecondhome
 * @subpackage city
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class cityActions extends autoCityActions
{
    public function executeListExport() {
        $this->getResponse()->setContentType('applications/msexcel');
        $this->getResponse()->setHttpHeader('Content-Disposition', 'attachment; filename=export.csv');


        $sCsv = "";

        $oPager = $this->getPager();
        $oPager->setMaxPerPage(9999999999);
        $oPager->setMaxRecordLimit(999999999);
        $oPager->init();


        $sCsv = "ID;City;Region;Country;#Properties;#Association;#Development";
        $sCsv .= "\n";

        /** @var City $oCity */
        foreach($oPager->getResults() as $oCity) {

            $sCsv .= "\"" . $oCity->getId() . "\";";
            $sCsv .= "\"" . $oCity->getTitle('en') . "\";";
            if ($oCity->getRegion() != null)
                $sCsv .= "\"" . $oCity->getRegion()->getTitle('en') . "\";";
            if ($oCity->getCountry() != null)
                $sCsv .= "\"" . $oCity->getCountry()->getTitle('en') . "\";";
            $sCsv .= "\"" . sizeof($oCity->getPropertys()) . "\";";
            $sCsv .= "\"" . sizeof($oCity->getAssociations()) . "\";";
            $sCsv .= "\"" . sizeof($oCity->getDevelopments()) . "\";";
            $sCsv .= "\n";
        }


        $this->getResponse()->setContent($sCsv);

        return sfView::NONE;
    }

    public function executeListImport() {

        ini_set('memory_limit',-1);
        set_time_limit(0);

        /** @var sfWebRequest $oRequest */
        $oRequest = $this->getRequest();

        $form = new ImportCityForm();

        $this->form = $form;

        $sUpdateText = '';

        if($oRequest->isMethod("POST")) {
            $form->bind($oRequest->getParameter($form->getName()),$oRequest->getFiles($form->getName()));
            if($form->isValid()) {
                /** @var sfValidatedFile $oCsvFile */
                $oCsvFile = $form->getValue('file');
                $oCsvReader = new CSVReader($oCsvFile->getTempName(),";");
                $oCsvReader->open();

                $i=0;
                while($aRow = $oCsvReader->read()) {
                    if(strlen($aRow[0]) > 0 && $aRow[0] != "ID" && intval($aRow[0])>0) {
                        $oCity = CityPeer::retrieveByPK(intval($aRow[0]));

                        if(null===$oCity) {
                            $sUpdateText .= "invalid city on line #".($i+1) . "<br />";
                            continue;
                        }

                        $oCountry = CountryI18nPeer::retrieveByTitle($aRow[3]);
                        if($oCity->getCountry()->getId()!==$oCountry->getId()) {
                            $sUpdateText .= "updating country of " . $oCity . " to " . $aRow[3] . "<br />";
                        }

                        if(null===$oCountry) {
                            $sUpdateText .= "invalid country on line #".($i+1) . "<br />";
                            continue;
                        }
                        $oRegion = RegionI18nPeer::retrieveByTitle($aRow[2],$oCountry->getId());
                        if(null===$oRegion || $oCity->getRegionId()!==$oRegion->getId()) {
                            $sUpdateText .= "updating region of " . $oCity . " to " . $aRow[2] . "<br />";
                            if(null===$oRegion) {
                                $sUpdateText .= "creating new region" . $aRow[2] . " for country " . $oCountry->getCountry() . "<br />";
                                // creating new region
                                $oRegion = new Region();
                                $oRegion->setCountry($oCountry->getCountry());
                                $oRegion->setTitle($aRow[2],'en');
                                $oRegion->save();
                            } else {
                                $oRegion = $oRegion->getRegion();
                            }
                            $oCity->setRegion($oRegion);
                            $oCity->save();
                            /** @var Property $oProperty */
                            foreach($oCity->getPropertys() as $oProperty) {
                                $oProperty->setCity($oCity);
                                $oProperty->save();
                            }
                            /** @var Association $oAssociation */
                            foreach($oCity->getAssociations() as $oAssociation) {
                                $oAssociation->setCity($oCity);
                                $oAssociation->save();
                            }
                            /** @var Development $oDevelopment */
                            foreach($oCity->getDevelopments() as $oDevelopment) {
                                $oDevelopment->setCity($oCity);
                                $oDevelopment->save();
                            }
                        }
                    }
                    $i++;
                }
            }
        }
        $this->sUpdateText = $sUpdateText;


        /*$sCsv = "";

        $oPager = $this->getPager();
        $oPager->setMaxPerPage(9999999999);
        $oPager->setMaxRecordLimit(999999999);
        $oPager->init();


        $sCsv = "ID;City;Country;Region;#Properties;#Association;#Development";
        $sCsv .= "\n";

        foreach($oPager->getResults() as $oCity) {

            $sCsv .= "\"" . $oCity->getId() . "\";";
            $sCsv .= "\"" . $oCity->getTitle('en') . "\";";
            $sCsv .= "\"" . $oCity->getRegion()->getTitle('en') . "\";";
            $sCsv .= "\"" . $oCity->getCountry()->getTitle('en') . "\";";
            $sCsv .= "\"" . sizeof($oCity->getPropertys()) . "\";";
            $sCsv .= "\"" . sizeof($oCity->getAssociations()) . "\";";
            $sCsv .= "\"" . sizeof($oCity->getDevelopments()) . "\";";
            $sCsv .= "\n";
        }


        $this->getResponse()->setContent($sCsv);*/
    }
}
