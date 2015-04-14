<?php

/**
 * Development form.
 *
 * @package    mysecondhome
 * @subpackage form
 * @author     Your name here
 */
class FrontendDevelopmentForm extends BaseDevelopmentForm
{
    public function configure()
    {
        unset($this['association_id']);

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



        $this->widgetSchema->setLabels(array(
            'address1' => $oI18n->__('portal.formlabel.address1'),
            'address2' => $oI18n->__('portal.formlabel.address2'),
            'country_id' => $oI18n->__('portal.formlabel.country_id'),
            'region_id' => $oI18n->__('portal.formlabel.region_id'),
            'city_id' => $oI18n->__('portal.formlabel.city_id'),


        ));


        $this->widgetSchema['address1']->setAttributes(array(
            'class' => 'w205',
        ));
        $this->widgetSchema['address2']->setAttributes(array(
            'class' => 'w205',
        ));

        $this->validatorSchema['address1']->setOption('required', true);
        $this->validatorSchema['country_id']->setOption('required', true);


        $this->validatorSchema['region_id'] = new sfValidatorPass();
        $this->validatorSchema['city_id'] = new sfValidatorPass();

        $this->widgetSchema['region_new'] = new sfWidgetFormInputText(array(),array('class' => 'w205'));
        $this->widgetSchema['city_new'] = new sfWidgetFormInputText(array(),array('class' => 'w205'));

        $this->validatorSchema['city_new'] = new sfValidatorString(array('max_length' => 255, 'required' => false));
        $this->validatorSchema['region_new'] = new sfValidatorString(array('max_length' => 255, 'required' => false));

        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array(
            'callback' => array($this, 'checkDevelopment'),
        )));
    }

    public function checkDevelopment($validator, $values) {

        $oI18n = sfContext::getInstance()->getI18N();

        $errors = array();

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
                $oCity->setRegionId($this->getValue('region_id'));
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
            $oCity->save();
            $this->getObject()->setRegionId($oCity->getRegionId());
            $this->values['city_id'] = $oCity->getId();
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
