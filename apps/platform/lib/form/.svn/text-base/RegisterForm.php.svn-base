<?php
/**
 * Created by JetBrains PhpStorm.
 * User: simonsabelis
 * Date: 4/26/13
 * Time: 10:43
 * To change this template use File | Settings | File Templates.
 */

class RegisterForm extends sfForm{

    public function setup() {

        $oI18n = sfContext::getInstance()->getI18N();

        $this->setWidgets(array(
            'company_name'     => new sfWidgetFormInputText(array(),array('class' => 'w280')),
            'email'            => new sfWidgetFormInputText(array(),array('class' => 'w280')),
            'address1'         => new sfWidgetFormInputText(array(),array('class' => 'w280')),
            'address2'         => new sfWidgetFormInputText(array(),array('class' => 'w280')),
            'country_id'       => new sfWidgetFormPropelChoice(array('model' => 'Country', 'add_empty' => true)),
            //'region_id'        => new sfWidgetFormChoice(),
            //'city_id'          => new sfWidgetFormChoice(),
            'phone'            => new sfWidgetFormInputText(array(),array('class' => 'w280')),

            'country_new'      => new sfWidgetFormInputText(array(),array('class' => 'w280')),
            'region_new'       => new sfWidgetFormInputText(array(),array('class' => 'w280')),
            'city_new'         => new sfWidgetFormInputText(array(),array('class' => 'w280')),

            'personal_email'                => new sfWidgetFormInputText(array(),array('class' => 'w280')),
            'personal_firstname'            => new sfWidgetFormInputText(array(),array('class' => 'w280')),
            'personal_surname'              => new sfWidgetFormInputText(array(),array('class' => 'w280')),
            'personal_function'             => new sfWidgetFormInputText(array(),array('class' => 'w280')),

        ));
        $this->setValidators(array(
            'company_name'     => new sfValidatorString(array('max_length' => 255, 'required' => true)),
            'email'            => new sfValidatorString(array('max_length' => 255, 'required' => true)),
            'address1'         => new sfValidatorString(array('max_length' => 255, 'required' => true)),
            'address2'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'country_id'       => new sfValidatorPropelChoice(array('model' => 'Country', 'column' => 'id', 'required' => true)),
            'region_id'        => new sfValidatorPropelChoice(array('model' => 'Region', 'column' => 'id', 'required' => false)),
            'city_id'          => new sfValidatorPropelChoice(array('model' => 'City', 'column' => 'id', 'required' => false)),
            'phone'            => new sfValidatorString(array('max_length' => 255, 'required' => true)),

            'country_new'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'region_new'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'city_new'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),

            'personal_email'          => new sfValidatorString(array('max_length' => 255, 'required' => true)),
            'personal_firstname'      => new sfValidatorString(array('max_length' => 255, 'required' => true)),
            'personal_surname'        => new sfValidatorString(array('max_length' => 255, 'required' => true)),
            'personal_function'       => new sfValidatorString(array('max_length' => 255, 'required' => true)),
        ));

        $this->widgetSchema->setLabels(array(
            'company_name' => $oI18n->__('portal.formlabel.company_name'),
            'email' => $oI18n->__('portal.formlabel.email'),
            'phone' => $oI18n->__('portal.formlabel.phone'),
            'address1' => $oI18n->__('portal.formlabel.address1'),
            'address2' => $oI18n->__('portal.formlabel.address2'),
            'country_id' => $oI18n->__('portal.formlabel.country'),
            'region_id' => $oI18n->__('portal.formlabel.region'),
            'city_id' => $oI18n->__('portal.formlabel.city'),

            'personal_email' => $oI18n->__('portal.formlabel.personal_email'),
            'personal_firstname' => $oI18n->__('portal.formlabel.personal_firstname'),
            'personal_surname' => $oI18n->__('portal.formlabel.personal_surname'),
            'personal_function' => $oI18n->__('portal.formlabel.personal_function'),
        ));

        $this->widgetSchema->setNameFormat("register[%s]");

    }

    public function configure()
    {
        /** @var MSHWebsiteUser $oUser */
        $oUser = sfContext::getInstance()->getUser();
        $oI18n = sfContext::getInstance()->getI18N();
        $oRequest = sfContext::getInstance()->getRequest();

        if($this->getOption('type') == 'business') {
            /** @var Criteria $oCriteriaCountry */
            $oCriteriaCountry = CountryPeer::getDefaultCriteria();
            $oCriteriaCountry->addJoin(CountryPeer::ID, CountryI18nPeer::ID, Criteria::LEFT_JOIN);
            $oCriteriaCountry->add(CountryI18nPeer::CULTURE, $oUser->getCulture(), Criteria::EQUAL);
            $oCriteriaCountry->addAscendingOrderByColumn(CountryI18nPeer::TITLE);

            $this->widgetSchema['country_id']->setOption('method', 'getTitle');
            $this->widgetSchema['country_id']->setOption('criteria', $oCriteriaCountry);

            $aSubmittedValues = $oRequest->getParameter($this->getName());

            $iCountry = $aSubmittedValues['country_id'] !== NULL ? $aSubmittedValues['country_id'] : $this->getDefault('country_id');
            $iRegion = $aSubmittedValues['region_id'] !== NULL ? $aSubmittedValues['region_id'] : $this->getDefault('region_id');

            $aRegion = array('' => '', -1 => $oI18n->__('portal.text.addnewregion'));
            $aCity = array('' => '', -1 => $oI18n->__('portal.text.addnewcity'));

            if(null!==$iCountry) {

                /** @var Criteria $oCriteriaRegion */
                $oCriteriaRegion = RegionPeer::getDefaultCriteria();

                $oCriteriaRegion->add(RegionPeer::COUNTRY_ID, $iCountry, Criteria::EQUAL);
                $oCriteriaRegion->addJoin(RegionPeer::ID, RegionI18nPeer::ID, Criteria::LEFT_JOIN);
                $oCriteriaRegion->add(RegionI18nPeer::CULTURE, 'en', Criteria::EQUAL);
                $oCriteriaRegion->addAscendingOrderByColumn(RegionI18nPeer::TITLE);
                foreach(RegionPeer::getIndex($oCriteriaRegion) as $oRegion) {
                    $aRegion[$oRegion->getId()] = $oRegion->getTitle();
                }

                $oCriteriaCity = CityPeer::getDefaultCriteria();

                if(null!==$iRegion) {
                    /** @var Criteria $oCriteriaCity */
                    $oCriteriaCity->add(CityPeer::REGION_ID, $iRegion, Criteria::EQUAL);
                    $oCriteriaCity->addJoin(CityPeer::ID, CityI18nPeer::ID, Criteria::LEFT_JOIN);
                    $oCriteriaCity->add(CityI18nPeer::CULTURE, 'en', Criteria::EQUAL);
                    $oCriteriaCity->addAscendingOrderByColumn(CityI18nPeer::TITLE);
                } else {
                    $oCriteriaCity->add(CityPeer::ID, 0, Criteria::EQUAL);
                }

                foreach(CityPeer::getIndex($oCriteriaCity) as $oCity) {
                    $aCity[$oCity->getId()] = $oCity->getTitle();
                }
            }

            $this->widgetSchema['region_id'] = new sfWidgetFormChoice(array('choices' => $aRegion));
            $this->widgetSchema['city_id'] = new sfWidgetFormChoice(array('choices' => $aCity));

            $this->widgetSchema['country_id']->setOption('method', 'getTitle');
            $this->widgetSchema['country_id']->setOption('criteria', $oCriteriaCountry);



            $this->validatorSchema['city_id'] = new sfValidatorPass();
            $this->validatorSchema['region_id'] = new sfValidatorPass();
        } else {

            unset($this['city_id']);
            unset($this['region_id']);
            unset($this['country_id']);
            unset($this['company_name']);
            unset($this['email']);
            unset($this['address1']);
            unset($this['phone']);
            unset($this['personal_function']);
        }







        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array(
            'callback' => array($this, 'checkRegistration'),
        )));
    }

    public function checkRegistration($validator, $values) {

        $oI18n = sfContext::getInstance()->getI18N();

        $errors = array();

        if($this->getOption('type') == 'business') {

            if(intval($values['country_id']) === -1) {

            } else {
                $oCountry = CountryPeer::retrieveByPK($values['country_id']);
                if(null===$oCountry) {
                    $errors['country_id'] = new sfValidatorError($validator, $oI18n->__('portal.form.error.nocountryselected'));
                    $values['country_id'] = '';
                }
            }

            if(intval($values['region_id']) === -1) {

                if(strlen(trim($values['region_new'])) == 0) {
                    $errors['region_new'] = new sfValidatorError($validator, $oI18n->__('portal.form.error.nonewregionnamesupplied'));
                }
            } else {
                $oRegion = RegionPeer::retrieveByPK($values['region_id']);
                $bError = false;

                if(null===$oRegion) {
                    $bError = true;
                } else if($oRegion->getCountryId() !== $oCountry->getId()){
                    $bError = true;
                }

                if($bError) {
                    $errors['region_id'] = new sfValidatorError($validator, $oI18n->__('portal.form.error.noregionselected'));
                    $values['region_id'] = '';
                    $values['city_id'] = '';
                }

            }

            if(intval($values['city_id']) === -1) {

                if(strlen(trim($values['city_new'])) == 0) {
                    $errors['city_new'] = new sfValidatorError($validator, $oI18n->__('portal.form.error.nonewcitynamesupplied'));
                }
            } else {
                $oCity = CityPeer::retrieveByPK($values['city_id']);
                $bError = false;

                if(null===$oCity) {
                    $bError = true;
                } else if($oCity->getRegionId() !== intval($values['region_id'])){
                    $bError = true;
                }

                if($bError) {
                    $errors['city_id'] = new sfValidatorError($validator, $oI18n->__('portal.form.error.nocityselected'));
                    $values['city_id'] = '';
                }
            }
        }

        $oExistingUser = UserPeer::retrieveByEmail($values['personal_email']);
        if(null!==$oExistingUser) {
            $errors['personal_email'] = new sfValidatorError($validator, $oI18n->__('portal.form.error.emailadressinuse'));
        }


        if(sizeof($errors) > 0) {
            throw new sfValidatorErrorSchema($validator, $errors);
        }
        return $values;
    }

}