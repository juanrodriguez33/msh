<?php

require_once dirname(__FILE__).'/../lib/linkpropertyimageGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/linkpropertyimageGeneratorHelper.class.php';

/**
 * linkpropertyimage actions.
 *
 * @package    mysecondhome
 * @subpackage linkpropertyimage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class linkpropertyimageActions extends autoLinkpropertyimageActions
{
    public function executeIndex(sfWebRequest $oRequest){

        $iProperty = $oRequest->getParameter('property_id', NULL);
        if(!empty($iProperty))
            $this->getUser()->setAttribute('property.id',$iProperty, 'admin_module');
        $iProperty = $this->getUser()->getAttribute('property.id', NULL, 'admin_module');
        $this->property = PropertyPeer::retrieveByPK($iProperty);
        parent::executeIndex($oRequest);
    }

    protected function buildCriteria(){

        $oCriteria = parent::buildCriteria();

        if ($this->getUser()->getAttribute('property.id', NULL, 'admin_module')) {
            $oCriteria = LinkPropertyImagePeer::retrieveByPropertyIdCriteria($this->getUser()->getAttribute('property.id', NULL, 'admin_module'), $oCriteria);
            $oCriteria->addAscendingOrderByColumn(LinkPropertyImagePeer::SEQUENCE);
        }
        else {
            parent::forward404("No property supplied to show images of");
        }

        return $oCriteria;
    }

    public function executeNew(sfWebRequest $oRequest) {
        if ($this->getUser()->getAttribute('property.id', NULL, 'admin_module')) {
            $this->form = $this->configuration->getForm();
            $this->form->setDefault("property_id",$this->getUser()->getAttribute('property.id', NULL, 'admin_module'));
            $this->linkpropertyimage = $this->form->getObject();
        }
        else {
            parent::forward404("No property supplied to show images of");
        }
        $this->setTemplate('form');

    }



    public function executeListBack(sfWebRequest $oRequest) {
        $this->redirect('@property');
    }

    public function executeListUp(sfWebRequest $oRequest)
    {

        $oObject = LinkPropertyImagePeer::retrieveByPk($oRequest->getParameter('id'));

        if($oObject->getSequence() > 1) {
            $iSequence = $oObject->getSequence() - 1;

            $oSwitchObject = LinkPropertyImagePeer::retrieveBySequence($iSequence, $oObject->getPropertyId());
            $oSwitchObject->setSequence($oObject->getSequence());
            $oSwitchObject->save();

            $oObject->setSequence($iSequence);
            $oObject->save();
        }

        $aImages = LinkPropertyImagePeer::retrieveByPropertyId($oObject->getPropertyId());
        $iSequence = 1;
        foreach($aImages as $oImage) {
            $oImage->setSequence($iSequence);
            $oImage->save();
            $iSequence++;
        }

        $this->redirect('@linkpropertyimage');
    }

    public function executeListDown(sfWebRequest $oRequest)
    {
        $oObject = LinkPropertyImagePeer::retrieveByPk($oRequest->getParameter('id'));
        $iMaxSequence = LinkPropertyImagePeer::getMaxSequence($oObject->getPropertyId());

        if($oObject->getSequence() < $iMaxSequence) {
            $iSequence = $oObject->getSequence() + 1;

            $oSwitchObject = LinkPropertyImagePeer::retrieveBySequence($iSequence, $oObject->getPropertyId());
            $oSwitchObject->setSequence($oObject->getSequence());
            $oSwitchObject->save();

            $oObject->setSequence($iSequence);
            $oObject->save();
        }

        $aImages = LinkPropertyImagePeer::retrieveByPropertyId($oObject->getPropertyId());
        $iSequence = 1;
        foreach($aImages as $oImage) {
            $oImage->setSequence($iSequence);
            $oImage->save();
            $iSequence++;
        }

        $this->redirect('@linkpropertyimage');
    }
}
