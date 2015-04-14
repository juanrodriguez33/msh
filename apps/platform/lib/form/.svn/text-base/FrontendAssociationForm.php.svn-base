<?php
/**
 * Created by JetBrains PhpStorm.
 * User: simonsabelis
 * Date: 4/26/13
 * Time: 10:43
 * To change this template use File | Settings | File Templates.
 */

class FrontendAssociationForm extends AssociationForm{

    public function configure()
    {
    
        unset($this['founded']);
        //unset($this['contact1_id']);
        //unset($this['contact2_id']);
        unset($this['contract_id']);
        unset($this['contract_period']);
        
        if($this->isNew()) {
            unset($this['contact1_id']);
            unset($this['contact2_id']);
        } else {
            $oCriteria = UserPeer::retrieveByAssociationIdCriteria($this->getObject()->getId()); // provider Users
            $this->widgetSchema['contact1_id']->setOption('criteria', $oCriteria);
            $this->widgetSchema['contact1_id']->setOption('method', 'getName');
            $this->widgetSchema['contact2_id']->setOption('criteria', $oCriteria);
            $this->widgetSchema['contact2_id']->setOption('method', 'getName');
        }

        /** @var MSHWebsiteUser $oUser */
        $oUser = sfContext::getInstance()->getUser();
        $oI18n = sfContext::getInstance()->getI18N();
        $oRequest = sfContext::getInstance()->getRequest();


        /** @var Criteria $oCriteriaCountry */
        $oCriteriaCountry = CountryPeer::getDefaultCriteria();
        $oCriteriaCountry->addJoin(CountryPeer::ID, CountryI18nPeer::ID, Criteria::LEFT_JOIN);
        $oCriteriaCountry->add(CountryI18nPeer::CULTURE, $oUser->getCulture(), Criteria::EQUAL);
        $oCriteriaCountry->addAscendingOrderByColumn(CountryI18nPeer::TITLE);

        $this->widgetSchema['country_id']->setOption('method', 'getTitle');
        $this->widgetSchema['country_id']->setOption('criteria', $oCriteriaCountry);
        
        // IMPORT XML SYSTEM! (not in base :S WTF)...
        $this->widgetSchema['import_xml_system'] = new sfWidgetFormPropelChoice(array('model' => 'XmlSystem', 'add_empty' => true));

        $aSubmittedValues = $oRequest->getParameter($this->getName());

        $iCountry = $aSubmittedValues['country_id'] !== NULL ? $aSubmittedValues['country_id'] : $this->getObject()->getCountryId();
        $iRegion = $aSubmittedValues['region_id'] !== NULL ? $aSubmittedValues['region_id'] : $this->getObject()->getRegionId();

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




        $this->widgetSchema['title'] = new sfWidgetFormInputText(array(),array('class' => 'w205'));
        $this->widgetSchema['email_address'] = new sfWidgetFormInputText(array(),array('class' => 'w205'));
        $this->widgetSchema['url'] = new sfWidgetFormInputText(array(),array('class' => 'w205'));
        $this->widgetSchema['address1'] = new sfWidgetFormInputText(array(),array('class' => 'w205'));
        $this->widgetSchema['address2'] = new sfWidgetFormInputText(array(),array('class' => 'w205'));

        $this->widgetSchema['region_new'] = new sfWidgetFormInputText(array(),array('class' => 'w205'));
        $this->widgetSchema['city_new'] = new sfWidgetFormInputText(array(),array('class' => 'w205'));

        
        // oud: $this->validatorSchema['country_id'] = new sfValidatorPass();
        $this->validatorSchema['country_id'] = new sfValidatorPropelChoice(array('model' => 'Country', 'column' => 'id', 'required' => true));        
        $this->validatorSchema['region_id'] = new sfValidatorPass();
        $this->validatorSchema['city_id'] = new sfValidatorPass();


        $this->validatorSchema['city_new'] = new sfValidatorString(array('max_length' => 255, 'required' => false));
        $this->validatorSchema['region_new'] = new sfValidatorString(array('max_length' => 255, 'required' => false));


        $this->widgetSchema['image_id'] = new sfWidgetFormInputFileEditable(array(
            'file_src'     => $this->getObject()->getImage() ? $this->getObject()->getImage()->getOriginalFormatUrl() : '',
            'is_image'     => true,
            'edit_mode'    => $this->getObject()->getImage(),
            'with_delete'  => false,
            'delete_label' => 'Delete logo',
            'template'     => '%file%<br />%delete% %delete_label%<br /><br />%input%'
        ), array(
            'style'        => 'max-width:360px;max-height:240px;'
        ));
        $this->validatorSchema['image_id'] = new sfValidatorFile(
            array(
                'required'   => false,
                'path'       => sfConfig::get('sf_upload_dir') . '/temp',
                'mime_types' => 'web_images'
            ),
            array(
                'required'   => 'No image has been uploaded',
                'invalid'    => 'The image is invalid',
                'max_size'   => 'The image is to big in size (max %max_size% bytes)',
                'mime_types' => 'The image has an incorrect extension'
            )
        );
        $this->validatorSchema['image_id_delete'] = new sfValidatorPass();


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

    public function updateObject($oConnection = NULL){

        $oUser = sfContext::getInstance()->getUser();

        if($this->getValue('region_id') == -1) {
            // new region
            $oRegion = RegionI18nPeer::retrieveBySlug(Functions::slugify($this->getValue('region_new')), $this->getValue('country_id'));
            if(null===$oRegion) {
                $oRegion = new Region();
                $oRegion->setCountryId($this->getValue('country_id'));
                $oRegion->setTitle($this->getValue('region_new'));
                if($oUser->getCulture() !== 'en') {
                    $oRegion->setTitle($this->getValue('region_new'), 'en');
                }
                $oRegion->setActive(false);
                $oRegion->save();
            } else {
                $oRegion = $oRegion->getRegion();
            }
            $this->getObject()->setRegion($oRegion);
            $this->values['region_id'] = $oRegion->getId();
        }
        if($this->getValue('city_id') == -1) {
            // new city
            $oCity = CityI18nPeer::retrieveBySlug(Functions::slugify($this->getValue('city_new')), $this->values['region_id']);
            if(null===$oCity) {
                $oCity = new City();
                $oCity->setRegionId($this->values['region_id']);
                $oCity->setTitle($this->getValue('city_new'));
                if($oUser->getCulture() !== 'en') {
                    $oCity->setTitle($this->getValue('city_new'), 'en');
                }
                $oCity->setActive(false);
                $oCity->save();
            } else {
                $oCity = $oCity->getcity();
            }
            $this->getObject()->setCity($oCity);
            $this->values['city_id'] = $oCity->getId();
        }

        parent::updateObject();

        $oImage = $this->getObject()->getImage();

        if($this->isValid() && ($this->getValue('image_id') !== NULL || $this->getValue('image_id_delete') !== NULL)){

            $this->getObject()->setImageId(NULL);
            $this->getObject()->save      ();

            if($oImage) $oImage->delete();

            $oUpload = $this->getValue('image_id');
            if(is_object($oUpload) && !$this->getValue('image_id_delete')){

                $oSfImage = new sfImage($oUpload->getSavedName());
                $oImage = Image::newFromSfImageWithWidthHeight($oSfImage,"association","",720,480,(string)$this->getObject());
                $this->getObject()->setImageId($oImage->getId());
            }
        }


        $this->getObject()->save();

    }

}