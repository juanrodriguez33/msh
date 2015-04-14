<?php
/**
 * Created by JetBrains PhpStorm.
 * User: simonsabelis
 * Date: 12/10/11
 * Time: 15:09
 * To change this template use File | Settings | File Templates.
 */
class PortalStatisticsForm extends sfForm {

    public static $aTypes = array(
        "displayed" => "Properties shown",
        "found" => "Properties found",
        "viewed" => "Properties viewed",
        "contact" => "Contact",
        "phone" => "Phonenumber requested",
        "brochure" => "Brochure downloads",
        "website" => "Website views",
    );

    public static $aTypes_single = array(
        "displayed" => "Shown",
        "found" => "Found",
        "viewed" => "Viewed",
        "contact" => "Contacted",
        "phone" => "Phonenumber requested",
        "brochure" => "Brochure downloaded",
    );

    public function configure(){

        $oContext = sfContext::getInstance();
        $oI18n = $oContext->getI18N();
        /** @var myUser $oUser */
        $oUser = $oContext->getUser();

        $aTypes = self::$aTypes;
        
        // ADDED BY SMINK
        
        if($this->getOption('culture') !== null) 
            $_culture = $this->getOption('culture');
        else
            $_culture = $oUser->getCulture();
        
        // END
        

        foreach($aTypes as $sKey => $sType) {
            $aTypes[$sKey] = $oI18n->__('portal.stats.stat.'.$sKey);
        }


        /*if($oUser->getGraphProperty() != null) {
            $aTypes = self::$aTypes_single;
        }*/

        $aCountryDB = CountryPeer::retrieveActive();

        $aCountry = array('' => '');
        foreach($aCountryDB as $oCountry) {
            $aCountry[$oCountry->getId()] = $oCountry->getTitle($_culture);
        }
        $this->setWidgets(array(
            'startDate'           => new sfWidgetFormInputText(array(), array('class' => 'datepicker w130')),
            'endDate'             => new sfWidgetFormInputText(array(), array('class' => 'datepicker w130')),
            'type'                => new sfWidgetFormChoice(array('choices' => $aTypes)),
            'country'             => new sfWidgetFormChoice(array('choices' => $aCountry)),
        ));
/*        $iYear = date("Y");
        $aYears = array();
        for($i=2013;$i<=$iYear;$i++) {
            $aYears[$i] = $i;
        }
        $this->widgetSchema['startDate']->setOption("years", array_combine($aYears,$aYears));
        $this->widgetSchema['endDate']->setOption("years", array_combine($aYears,$aYears));*/
        $this->widgetSchema->setNameFormat('statistics[%s]');

        $sCountryDefault = "";

        /*if($oUser->getGraphProvince() != '') {
            foreach(ProvincePeer::retrieveAll() as $oProvince) {
                if((string)$oProvince == $oUser->getGraphProvince()) {
                    $sProvinceDefault = $oProvince->getId();
                }
            }
        }*/





        $this->widgetSchema->setDefaults(array(
            'startDate'           => $oUser->getGraphStartDate(),
            'endDate'             => $oUser->getGraphEndDate(),
            'type'                => $oUser->getGraphMetric(),
            'country'             => $sCountryDefault,
        ));


        $this->setValidators(array(
            'startDate'         => new sfValidatorString(),
            'endDate'           => new sfValidatorString(),
            'type'              => new sfValidatorChoice(array('choices' => array_keys($aTypes))),
            'country'          => new sfValidatorPropelChoice(array('model' => 'Country', 'required' => false)),
        ));
    }

}
