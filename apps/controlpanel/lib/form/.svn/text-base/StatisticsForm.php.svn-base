<?php
/**
 * Created by JetBrains PhpStorm.
 * User: simonsabelis
 * Date: 12/10/11
 * Time: 15:09
 * To change this template use File | Settings | File Templates.
 */
class StatisticsForm extends sfForm {

    public static $aTypes = array(
        "displayed" => "Woningen getoond",
        "found" => "Woningen gevonden",
        "viewed" => "Woningen bekeken",
        "contact" => "Contact opgenomen",
        //"phone_number" => "Telefoonnummer opgevraagd",
        "brochure" => "Brochure gedownload",
        //"forward_social" => "Soc.media doorgestuurd",
        //"forward_email" => "E-mail doorgestuurd",
        //"favorite" => "Favoriet toegevoegd",
    );

    public static $aTypes_single = array(
        "displayed" => "Getoond",
        "found" => "Gevonden",
        "viewed" => "Bekeken",
        "contact" => "Contact opgenomen",
        "phone_number" => "Telefoonnummer opgevraagd",
        "brochure" => "Brochure gedownload",
        "forward_social" => "Soc.media doorgestuurd",
        "forward_email" => "E-mail doorgestuurd",
        "favorite" => "Favoriet toegevoegd",
    );

    public function configure(){

        $oContext = sfContext::getInstance();
        /** @var myUser $oUser */
        $oUser = $oContext->getUser();

        $aTypes = self::$aTypes;


        if($oUser->getGraphProperty() != null) {
            $aTypes = self::$aTypes_single;
        }

        $this->setWidgets(array(
            'startDate'           => new sfWidgetFormDate(array('format' => '%day%-%month%-%year%')),
            'endDate'             => new sfWidgetFormDate(array('format' => '%day%-%month%-%year%')),
            'type'                => new sfWidgetFormChoice(array('choices' => $aTypes)),
            'province'            => new sfWidgetFormPropelChoice(array('model'=>'Province', 'add_empty' => true, 'order_by' => array("Title","ASC"))),
            'association'         => new sfWidgetFormPropelChoice(array('model'=>'Association', 'add_empty' => true, 'order_by' => array("Name","ASC"))),
        ));
        $iYear = date("Y");
        $aYears = array();
        for($i=2011;$i<=$iYear;$i++) {
            $aYears[$i] = $i;
        }
        $this->widgetSchema['startDate']->setOption("years", array_combine($aYears,$aYears));
        $this->widgetSchema['endDate']->setOption("years", array_combine($aYears,$aYears));
        $this->widgetSchema->setNameFormat('statistics[%s]');

        $sProvinceDefault = "";

        if($oUser->getGraphProvince() != '') {
            foreach(ProvincePeer::retrieveAll() as $oProvince) {
                if((string)$oProvince == $oUser->getGraphProvince()) {
                    $sProvinceDefault = $oProvince->getId();
                }
            }
        }

        $this->widgetSchema->setDefaults(array(
            'startDate'           => $oUser->getGraphStartDate(),
            'endDate'             => $oUser->getGraphEndDate(),
            'type'                => $oUser->getGraphMetric(),
            'province'            => $sProvinceDefault,
            'association'         => $oUser->getGraphAssociation(),
        ));

        $this->widgetSchema->setLabels(array(
            'statDate'          => 'Start',
            'endDate'           => 'Einde',
            'type'              => 'Toon in grafiek',
            'province'          => 'Provincie',
            'association'       => 'Woningcorporatie',
        ));



        $this->setValidators(array(
            'startDate'         => new sfValidatorDate(),
            'endDate'           => new sfValidatorDate(),
            'type'              => new sfValidatorChoice(array('choices' => array_keys($aTypes))),
            //'province'          => new sfValidatorPropelChoice(array('model' => 'Province', 'required' => false)),
            //'association'       => new sfValidatorPropelChoice(array('model' => 'Association', 'required' => false)),
        ));
    }

}
