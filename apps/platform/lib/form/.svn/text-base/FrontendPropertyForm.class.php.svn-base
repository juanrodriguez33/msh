<?php

/**
 * Property form.
 *
 * @package    mysecondhome
 * @subpackage form
 * @author     Your name here
 */
class FrontendPropertyForm extends BasePropertyForm
{
    public function configure()
    {
        /** @var MSHWebsiteUser $oUser */
        $oUser = sfContext::getInstance()->getUser();

        $oI18n = sfContext::getInstance()->getI18N();

        unset($this['online']);
        unset($this['allowed']);
        unset($this['original_price']);
        unset($this['previous_price']);
        unset($this['promoted_until']);
        unset($this['paid_until']);
        unset($this['association_id']);
        unset($this['currency_id']);
        unset($this['user_id']);
        unset($this['import_id']);

        $aAvailabilityState = array(
            0 => $oI18n->__('form.option.available'),
            1 => $oI18n->__('form.option.soldunderconditions'),
            2 => $oI18n->__('form.option.sold'),
        );

        $this->widgetSchema['availability_state'] = new sfWidgetFormChoice(array('choices' => $aAvailabilityState, 'expanded' => true ));

        $aBooleanChoices = array(
            0 => $oI18n->__('form.option.no'),
            1 => $oI18n->__('form.option.yes')
        );

        $aStateChoices = array(
            4 => $oI18n->__('form.option.excellent'),
            3 => $oI18n->__('form.option.good'),
            2 => $oI18n->__('form.option.average'),
            1 => $oI18n->__('form.option.bad'),
            0 => $oI18n->__('form.option.unknown'),
        );

        $aServiceAvailability = array(
            3 => $oI18n->__('form.option.excellentchoice'),
            2 => $oI18n->__('form.option.goodchoice'),
            1 => $oI18n->__('form.option.limitedchoice'),
            0 => $oI18n->__('form.option.none'),
            -1 => $oI18n->__('form.option.unknown')
        );

        $this->widgetSchema['trial'] = new sfWidgetFormChoice(array('choices' => $aBooleanChoices, 'expanded' => true ));
        $this->widgetSchema['renting_allowed'] = new sfWidgetFormChoice(array('choices' => $aBooleanChoices, 'expanded' => true ));
        $this->widgetSchema['furnished'] = new sfWidgetFormChoice(array('choices' => $aBooleanChoices, 'expanded' => true ));
        $this->widgetSchema['isolation'] = new sfWidgetFormChoice(array('choices' => $aBooleanChoices, 'expanded' => true ));
        $this->widgetSchema['doubleglass'] = new sfWidgetFormChoice(array('choices' => $aBooleanChoices, 'expanded' => true ));
        $this->widgetSchema['wheelchair'] = new sfWidgetFormChoice(array('choices' => $aBooleanChoices, 'expanded' => true ));

        $this->widgetSchema['interior_state'] = new sfWidgetFormChoice(array('choices' => $aStateChoices, 'expanded' => true ));
        $this->widgetSchema['exterior_state'] = new sfWidgetFormChoice(array('choices' => $aStateChoices, 'expanded' => true ));

        $this->widgetSchema['horeca'] = new sfWidgetFormChoice(array('choices' => $aServiceAvailability, 'expanded' => false ));
        $this->widgetSchema['amusement'] = new sfWidgetFormChoice(array('choices' => $aServiceAvailability, 'expanded' => false ));

        $this->widgetSchema['online'] = new sfWidgetFormChoice(array('choices' => $aBooleanChoices, 'expanded' => true ));

        $this->widgetSchema['online'] = new sfWidgetFormChoice(array('choices' => $aBooleanChoices, 'expanded' => true ));
        $this->widgetSchema['wheelchair'] = new sfWidgetFormChoice(array('choices' => $aBooleanChoices, 'expanded' => true ));

        $this->widgetSchema['view'] = new sfWidgetFormPropelChoice(
            array('model' => 'PropertyView', 'multiple' => true, 'expanded' => true )
        );
        $aLinkView = $this->getObject()->getLinkPropertyViews();
        $aView = array();
        foreach($aLinkView as $oLink) {
            /** @var LinkPropertyView $oLink */
            $aView[] = $oLink->getPropertyView()->getId();
        }
        $this->widgetSchema['view']->setDefault($aView);

        $this->validatorSchema['view'] = new sfValidatorPropelChoice(
            array('model' => 'PropertyView', 'multiple' => true, 'required' => false )
        );

        $this->widgetSchema['surrounding'] = new sfWidgetFormPropelChoice(
            array('model' => 'PropertySurrounding', 'multiple' => true, 'expanded' => true )
        );

        $aLink = $this->getObject()->getLinkPropertySurroundings();
        $aView = array();
        foreach($aLink as $oLink) {
            /** @var LinkPropertySurrounding $oLink */
            $aView[] = $oLink->getPropertySurrounding()->getId();
        }
        $this->widgetSchema['surrounding']->setDefault($aView);

        $this->validatorSchema['surrounding'] = new sfValidatorPropelChoice(
            array('model' => 'PropertySurrounding', 'multiple' => true, 'required' => false )
        );

        $this->widgetSchema['pdf_map'] = new sfWidgetFormInputFileEditable(array(
            'file_src'     => $this->getObject()->getPdfMap() ? "<strong>Current: </strong><br/>".basename($this->getObject()->getPdfMap()) : '',
            'is_image'     => false,
            'edit_mode'    => $this->getObject()->getPdfMap(),
            'with_delete'  => true,
            'delete_label' => 'Delete',
            'template'     => '%file%<br />%delete% %delete_label%<br /><br />%input%'
        ));


        $this->validatorSchema['pdf_map'] = new sfValidatorFile(
        array(
            'required'   => false,
            'path'       => sfConfig::get('sf_upload_dir') . '/temp',
            'mime_types' => array('application/pdf'),
            ),
        array(
            'invalid'    => 'The file is invalid',
            'max_size'   => 'The file is too big (max %max_size% bytes)',
            'mime_types' => 'Incorrect file supplied'
            )
        );
        $this->validatorSchema['pdf_map_delete'] = new sfValidatorPass();


        /** @var Criteria $oCriteriaCountry */
        $oCriteriaCountry = CountryPeer::getDefaultCriteria();
        $oCriteriaCountry->addJoin(CountryPeer::ID, CountryI18nPeer::ID, Criteria::LEFT_JOIN);
        $oCriteriaCountry->add(CountryI18nPeer::CULTURE, $oUser->getCulture(), Criteria::EQUAL);
        $oCriteriaCountry->addAscendingOrderByColumn(CountryI18nPeer::TITLE);

        $this->widgetSchema['country_id']->setOption('method', 'getTitle');
        $this->widgetSchema['country_id']->setOption('criteria', $oCriteriaCountry);

        $oRequest = sfContext::getInstance()->getRequest();
        $aSubmittedValues = $oRequest->getParameter($this->getName());

        if($this->isNew()) {
            $iCountry = $aSubmittedValues['country_id'] !== NULL ? $aSubmittedValues['country_id'] : $this->getDefault('country_id');
            $iRegion = $aSubmittedValues['region_id'] !== NULL ? $aSubmittedValues['region_id'] : $this->getDefault('region_id');
        } else {
            $iCountry = $aSubmittedValues['country_id'] !== NULL ? $aSubmittedValues['country_id'] : $this->getObject()->getCountryId();
            $iRegion = $aSubmittedValues['region_id'] !== NULL ? $aSubmittedValues['region_id'] : $this->getObject()->getRegionId();
        }

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

        $iTabIndex = 1;

        if($oUser->hasCredential('ROLE_ASSOCIATION')) {
            /** @var Criteria $oCriteriaDevelopment */
            $oCriteriaDevelopment = DevelopmentPeer::retrieveByAssociationCriteria($oUser->getUser()->getAssociationId());
            $oCriteriaDevelopment->addJoin(DevelopmentPeer::ID, DevelopmentI18nPeer::ID, Criteria::LEFT_JOIN);
            $oCriteriaDevelopment->add(DevelopmentI18nPeer::CULTURE, $oUser->getCulture(), Criteria::EQUAL);
            $oCriteriaDevelopment->addAscendingOrderByColumn(DevelopmentI18nPeer::TITLE);
            $this->widgetSchema['development_id']->setOption('criteria', $oCriteriaDevelopment);
            $this->widgetSchema['development_id']->setOption('method', 'getTitle');

            $this->widgetSchema['isdevelopment']->setAttributes(array(
                'tabindex' => $iTabIndex++,
            ));

            $this->widgetSchema['development_id']->setAttributes(array(
                'tabindex' => $iTabIndex++,
            ));

            $this->widgetSchema['development_id']->setAttributes(array(
                'tabindex' => $iTabIndex++,
            ));

        } else {
            unset($this['isdevelopment']);
            unset($this['development_id']);
        }


        $this->widgetSchema['address1']->setAttributes(array(
            'tabindex' => $iTabIndex++,
            'class' => 'w205',
        ));
        $this->widgetSchema['address2']->setAttributes(array(
            'tabindex' => $iTabIndex++,
            'class' => 'w205',
        ));
        $this->widgetSchema['country_id']->setAttributes(array(
            'tabindex' => $iTabIndex++,
        ));
        $this->widgetSchema['region_id']->setAttributes(array(
            'tabindex' => $iTabIndex++,
        ));
        $this->widgetSchema['city_id']->setAttributes(array(
            'tabindex' => $iTabIndex++,
        ));
        $this->widgetSchema['price']->setAttributes(array(
            'tabindex' => $iTabIndex++,
            'class' => 'w115 currency',
        ));
        $this->widgetSchema['type_id']->setAttributes(array(
            'tabindex' => $iTabIndex++,
        ));
        $this->widgetSchema['volume']->setAttributes(array(
            'tabindex' => $iTabIndex++,
            'class' => 'w60',
        ));
        $this->widgetSchema['surface']->setAttributes(array(
            'tabindex' => $iTabIndex++,
            'class' => 'w60',
        ));
        $this->widgetSchema['rooms']->setAttributes(array(
            'tabindex' => $iTabIndex++,
            'class' => 'w60',
        ));
        $this->widgetSchema['bedrooms']->setAttributes(array(
            'tabindex' => $iTabIndex++,
            'class' => 'w60',
        ));
        $this->widgetSchema['bathrooms']->setAttributes(array(
            'tabindex' => $iTabIndex++,
            'class' => 'w60',
        ));

        $this->widgetSchema['trial']->setAttributes(array(
            'tabindex' => $iTabIndex++,
        ));
        $this->widgetSchema['renting_allowed']->setAttributes(array(
            'tabindex' => $iTabIndex++,
        ));
        $this->widgetSchema['max_renting_period']->setAttributes(array(
            'tabindex' => $iTabIndex++,
            'class' => 'w60',
        ));
        $this->widgetSchema['rent_indication']->setAttributes(array(
            'tabindex' => $iTabIndex++,
            'class' => 'w115 currency',
        ));

        $this->widgetSchema['furnished']->setAttributes(array(
            'tabindex' => $iTabIndex++,
        ));
        $this->widgetSchema['constructionyear']->setAttributes(array(
            'tabindex' => $iTabIndex++,
            'class' => 'w60',
        ));
        $this->widgetSchema['renovationyear']->setAttributes(array(
            'tabindex' => $iTabIndex++,
            'class' => 'w60',
        ));
        $this->widgetSchema['isolation']->setAttributes(array(
            'tabindex' => $iTabIndex++,
        ));
        $this->widgetSchema['doubleglass']->setAttributes(array(
            'tabindex' => $iTabIndex++,
        ));
        $this->widgetSchema['interior_state']->setAttributes(array(
            'tabindex' => $iTabIndex++,
        ));
        $this->widgetSchema['exterior_state']->setAttributes(array(
            'tabindex' => $iTabIndex++,
        ));
        $this->widgetSchema['wheelchair']->setAttributes(array(
            'tabindex' => $iTabIndex++,
        ));
        $this->widgetSchema['surrounding']->setAttributes(array(
            'tabindex' => $iTabIndex++,
        ));
        $this->widgetSchema['view']->setAttributes(array(
            'tabindex' => $iTabIndex++,
        ));
        $this->widgetSchema['horeca']->setAttributes(array(
            'tabindex' => $iTabIndex++,
        ));
        $this->widgetSchema['amusement']->setAttributes(array(
            'tabindex' => $iTabIndex++,
        ));
        $this->widgetSchema['email_address']->setAttributes(array(
            'tabindex' => $iTabIndex++,
            'class' => 'w205',
        ));
        $this->widgetSchema['phone_number']->setAttributes(array(
            'tabindex' => $iTabIndex++,
            'class' => 'w130',
        ));

        $this->widgetSchema->setLabels(array(
            'isdevelopment' => $oI18n->__('portal.formlabel.isdevelopment'),
            'development_id' => $oI18n->__('portal.formlabel.developmentproject'),
            'address1' => $oI18n->__('portal.formlabel.address1'),
            'address2' => $oI18n->__('portal.formlabel.address2'),
            'country_id' => $oI18n->__('portal.formlabel.country_id'),
            'region_id' => $oI18n->__('portal.formlabel.region_id'),
            'city_id' => $oI18n->__('portal.formlabel.city_id'),
            'price' => $oI18n->__('portal.formlabel.price'),
            'type_id' => $oI18n->__('portal.formlabel.propertytype'),
            'volume' => $oI18n->__('portal.formlabel.volume'),
            'surface' => $oI18n->__('portal.formlabel.surface'),
            'rooms' => $oI18n->__('portal.formlabel.rooms'),
            'bedrooms' => $oI18n->__('portal.formlabel.bedrooms'),
            'bathrooms' => $oI18n->__('portal.formlabel.bathrooms'),


            'trial' => $oI18n->__('portal.formlabel.trialperiod'),
            'renting_allowed' => $oI18n->__('portal.formlabel.renting_allowed'),
            'max_renting_period' => $oI18n->__('portal.formlabel.max_renting_period'),
            'rent_indication' => $oI18n->__('portal.formlabel.rent_indication'),

            'furnished' => $oI18n->__('portal.formlabel.furnished'),
            'constructionyear' => $oI18n->__('portal.formlabel.constructionyear'),
            'renovationyear' => $oI18n->__('portal.formlabel.renovationyear'),
            'isolation' => $oI18n->__('portal.formlabel.isolation'),
            'doubleglass' => $oI18n->__('portal.formlabel.doubleglass'),
            'interior_state' => $oI18n->__('portal.formlabel.interior_state'),
            'exterior_state' => $oI18n->__('portal.formlabel.exterior_state'),
            'wheelchair' => $oI18n->__('portal.formlabel.wheelchair'),

            'surrounding' => $oI18n->__('portal.formlabel.surrounding'),
            'view' => $oI18n->__('portal.formlabel.view'),
            'horeca' => $oI18n->__('portal.formlabel.horeca'),
            'amusement' => $oI18n->__('portal.formlabel.amusement'),

            'email_address' => $oI18n->__('portal.formlabel.email'),
            'phone_number' => $oI18n->__('portal.formlabel.phone'),



        ));

        $this->validatorSchema['price']->setOption('required', true);

        $this->widgetSchema->setDefaults(array(
            'interior_state' => 0,
            'exterior_state' => 0,
            'horeca' => -1,
            'amusement' => -1,
        ));

        $this->validatorSchema['country_id'] = new sfValidatorPass();
        $this->validatorSchema['region_id'] = new sfValidatorPass();
        $this->validatorSchema['city_id'] = new sfValidatorPass();

        $this->widgetSchema['region_new'] = new sfWidgetFormInputText(array(),array('class' => 'w205'));
        $this->widgetSchema['city_new'] = new sfWidgetFormInputText(array(),array('class' => 'w205'));

        $this->validatorSchema['city_new'] = new sfValidatorString(array('max_length' => 255, 'required' => false));
        $this->validatorSchema['region_new'] = new sfValidatorString(array('max_length' => 255, 'required' => false));

        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array(
            'callback' => array($this, 'checkProperty'),
        )));
    }

    public function checkProperty($validator, $values) {

        $oI18n = sfContext::getInstance()->getI18N();

        $errors = array();

        if(intval($this->getValue('isdevelopment')) == 0 && intval($values['development_id']) <= 0) {

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
                } else if(null===$oCountry || $oRegion->getCountryId() !== $oCountry->getId()){
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


        if(sizeof($errors) > 0) {
            throw new sfValidatorErrorSchema($validator, $errors);
        }
        return $values;
    }

    public function updateObject($oConnection = NULL){

        $oUser = sfContext::getInstance()->getUser();

        if(intval($this->getValue('isdevelopment')) == 1){
            $iDevelopment = $this->getValue('development_id');
            $oDevelopment = DevelopmentPeer::retrieveByPK($iDevelopment);
            if(null===$oDevelopment) {
                die("should not happen!");
            } else {
                $this->values['region_id'] = $oDevelopment->getRegionId();
                $this->values['city_id'] = $oDevelopment->getCityId();
            }

        }
        else {
            $this->values['development_id'] = null;
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
                $oCity->setRegionId($this->getValue('region_id'));
                $this->getObject()->setRegionId($oCity->getRegionId());
                $this->values['city_id'] = $oCity->getId();
            }
        }



        parent::updateObject();

        $sPreviousMap = $this->getObject()->getPdfMap();

        $oUpload = $this->getValue('pdf_map');
        if(is_object($oUpload)){

            if(is_readable(sfConfig::get('sf_web_dir') . $sPreviousMap)) {
                unlink(sfConfig::get('sf_web_dir') . $sPreviousMap);
            }
            $this->getObject()->setPdfMap(NULL);

            $sFilename = $this->storeFile($oUpload, 'map');
            $this->getObject()->setPdfMap($sFilename);

        } else if($this->getValue('pdf_map_delete')) {
            if(is_readable(sfConfig::get('sf_web_dir') . $sPreviousMap)) {
                unlink(sfConfig::get('sf_web_dir') . $sPreviousMap);
            }
            $this->getObject()->setPdfMap(NULL);
        }

        $aToDelete = array();
        $aCurrent = array();

        $aNew = $this->getValue('view');
        if(!is_array($aNew)) {
            $aNew = array();
        }
        foreach($this->getObject()->getLinkPropertyViews() as $oCurrentLink) {
            /** @var LinkPropertyView $oCurrentLink */
            $aCurrent[] = $oCurrentLink->getViewId();
            if(!in_array($oCurrentLink->getViewId(), $aNew)) {
                $aToDelete[] = $oCurrentLink;
            }
        }

        foreach($aToDelete as $oLink) {
            $oLink->delete();
        }

        foreach($aNew as $iNew) {
            if(!in_array(intval($iNew), $aCurrent)) {
                $oLink = new LinkPropertyView();
                $oLink->setViewId($iNew);
                $this->getObject()->addLinkPropertyView($oLink);
            }
        }

        $aToDelete = array();
        $aCurrent = array();

        $aNew = $this->getValue('surrounding');
        if(!is_array($aNew)) {
            $aNew = array();
        }
        foreach($this->getObject()->getLinkPropertySurroundings() as $oCurrentLink) {
            /** @var LinkPropertySurrounding $oCurrentLink */
            $aCurrent[] = $oCurrentLink->getSurroundingId();
            if(!in_array($oCurrentLink->getSurroundingId(), $aNew)) {
                $aToDelete[] = $oCurrentLink;
            }
        }

        foreach($aToDelete as $oLink) {
            $oLink->delete();
        }

        foreach($aNew as $iNew) {
            if(!in_array(intval($iNew), $aCurrent)) {
                $oLink = new LinkPropertySurrounding();
                $oLink->setSurroundingId($iNew);
                $this->getObject()->addLinkPropertySurrounding($oLink);
            }
        }
    }

    /**
    * put your comment there...
    *
    * @param sfValidatedFile $oUpload
    */
    protected function storeFile(sfValidatedFile $oUpload, $sType) {

        $sPath = '/files/' . $sType . '/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . date('H');

        if(!is_readable(sfConfig::get('sf_upload_dir') . $sPath)){
            mkdir(sfConfig::get('sf_upload_dir') . $sPath, 0777, true);
            chmod(sfConfig::get('sf_upload_dir') . $sPath, 0777);
        }

        $sFileName = '/uploads' . $sPath . '/' . time() . '-' . $oUpload->getOriginalName();
        $oUpload->save(sfConfig::get('sf_web_dir') . $sFileName);
        return $sFileName;
    }
}
