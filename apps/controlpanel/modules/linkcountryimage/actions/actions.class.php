<?php

require_once dirname(__FILE__).'/../lib/linkcountryimageGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/linkcountryimageGeneratorHelper.class.php';

/**
 * linkcountryimage actions.
 *
 * @package    mysecondhome
 * @subpackage linkcountryimage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class linkcountryimageActions extends autoLinkcountryimageActions
{
    public function executeIndex(sfWebRequest $oRequest){

        $iCountry = $oRequest->getParameter('country_id', NULL);
        if(!empty($iCountry))
            $this->getUser()->setAttribute('country.id',$iCountry, 'admin_module');
        $iCountry = $this->getUser()->getAttribute('country.id', NULL, 'admin_module');
        $this->country = CountryPeer::retrieveByPK($iCountry);
        parent::executeIndex($oRequest);
    }

    protected function buildCriteria(){

        $oCriteria = parent::buildCriteria();

        if ($this->getUser()->getAttribute('country.id', NULL, 'admin_module')) {
            $oCriteria = LinkCountryImagePeer::retrieveByCountryIdCriteria($this->getUser()->getAttribute('country.id', NULL, 'admin_module'), $oCriteria);
            $oCriteria->addAscendingOrderByColumn(LinkCountryImagePeer::SEQUENCE);
        }
        else {
            parent::forward404("No country supplied to show images of");
        }

        return $oCriteria;
    }

    public function executeNew(sfWebRequest $oRequest) {
        if ($this->getUser()->getAttribute('country.id', NULL, 'admin_module')) {
            $this->form = $this->configuration->getForm();
            $this->form->setDefault("country_id",$this->getUser()->getAttribute('country.id', NULL, 'admin_module'));
            $this->linkcountryimage = $this->form->getObject();
        }
        else {
            parent::forward404("No country supplied to show images of");
        }
        $this->setTemplate('form');

    }



    public function executeListBack(sfWebRequest $oRequest) {
        $this->redirect('@country');
    }

    public function executeListUp(sfWebRequest $oRequest)
    {

        $oObject = LinkCountryImagePeer::retrieveByPk($oRequest->getParameter('id'));

        if($oObject->getSequence() > 1) {
            $iSequence = $oObject->getSequence() - 1;

            $oSwitchObject = LinkCountryImagePeer::retrieveBySequence($iSequence, $oObject->getCountryId());
            $oSwitchObject->setSequence($oObject->getSequence());
            $oSwitchObject->save();

            $oObject->setSequence($iSequence);
            $oObject->save();
        }

        $aImages = LinkCountryImagePeer::retrieveByCountryId($oObject->getCountryId());
        $iSequence = 1;
        foreach($aImages as $oImage) {
            $oImage->setSequence($iSequence);
            $oImage->save();
            $iSequence++;
        }

        $this->redirect('@linkcountryimage');
    }

    public function executeListDown(sfWebRequest $oRequest)
    {
        $oObject = LinkCountryImagePeer::retrieveByPk($oRequest->getParameter('id'));
        $iMaxSequence = LinkCountryImagePeer::getMaxSequence($oObject->getCountryId());

        if($oObject->getSequence() < $iMaxSequence) {
            $iSequence = $oObject->getSequence() + 1;

            $oSwitchObject = LinkCountryImagePeer::retrieveBySequence($iSequence, $oObject->getCountryId());
            $oSwitchObject->setSequence($oObject->getSequence());
            $oSwitchObject->save();

            $oObject->setSequence($iSequence);
            $oObject->save();
        }

        $aImages = LinkCountryImagePeer::retrieveByCountryId($oObject->getCountryId());
        $iSequence = 1;
        foreach($aImages as $oImage) {
            $oImage->setSequence($iSequence);
            $oImage->save();
            $iSequence++;
        }

        $this->redirect('@linkcountryimage');
    }
}
