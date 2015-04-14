<?php

require_once dirname(__FILE__).'/../lib/linkregionimageGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/linkregionimageGeneratorHelper.class.php';

/**
 * linkregionimage actions.
 *
 * @package    mysecondhome
 * @subpackage linkregionimage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class linkregionimageActions extends autoLinkregionimageActions
{
    public function executeIndex(sfWebRequest $oRequest){

        $iRegion = $oRequest->getParameter('region_id', NULL);
        if(!empty($iRegion))
            $this->getUser()->setAttribute('region.id',$iRegion, 'admin_module');
        $iRegion = $this->getUser()->getAttribute('region.id', NULL, 'admin_module');
        $this->region = RegionPeer::retrieveByPK($iRegion);
        parent::executeIndex($oRequest);
    }

    protected function buildCriteria(){

        $oCriteria = parent::buildCriteria();

        if ($this->getUser()->getAttribute('region.id', NULL, 'admin_module')) {
            $oCriteria = LinkRegionImagePeer::retrieveByRegionIdCriteria($this->getUser()->getAttribute('region.id', NULL, 'admin_module'), $oCriteria);
            $oCriteria->addAscendingOrderByColumn(LinkRegionImagePeer::SEQUENCE);
        }
        else {
            parent::forward404("No region supplied to show images of");
        }

        return $oCriteria;
    }

    public function executeNew(sfWebRequest $oRequest) {
        if ($this->getUser()->getAttribute('region.id', NULL, 'admin_module')) {
            $this->form = $this->configuration->getForm();
            $this->form->setDefault("region_id",$this->getUser()->getAttribute('region.id', NULL, 'admin_module'));
            $this->linkregionimage = $this->form->getObject();
        }
        else {
            parent::forward404("No region supplied to show images of");
        }
        $this->setTemplate('form');

    }



    public function executeListBack(sfWebRequest $oRequest) {
        $this->redirect('@region');
    }

    public function executeListUp(sfWebRequest $oRequest)
    {

        $oObject = LinkRegionImagePeer::retrieveByPk($oRequest->getParameter('id'));

        if($oObject->getSequence() > 1) {
            $iSequence = $oObject->getSequence() - 1;

            $oSwitchObject = LinkRegionImagePeer::retrieveBySequence($iSequence, $oObject->getRegionId());
            $oSwitchObject->setSequence($oObject->getSequence());
            $oSwitchObject->save();

            $oObject->setSequence($iSequence);
            $oObject->save();
        }

        $aImages = LinkRegionImagePeer::retrieveByRegionId($oObject->getRegionId());
        $iSequence = 1;
        foreach($aImages as $oImage) {
            $oImage->setSequence($iSequence);
            $oImage->save();
            $iSequence++;
        }

        $this->redirect('@linkregionimage');
    }

    public function executeListDown(sfWebRequest $oRequest)
    {
        $oObject = LinkRegionImagePeer::retrieveByPk($oRequest->getParameter('id'));
        $iMaxSequence = LinkRegionImagePeer::getMaxSequence($oObject->getRegionId());

        if($oObject->getSequence() < $iMaxSequence) {
            $iSequence = $oObject->getSequence() + 1;

            $oSwitchObject = LinkRegionImagePeer::retrieveBySequence($iSequence, $oObject->getRegionId());
            $oSwitchObject->setSequence($oObject->getSequence());
            $oSwitchObject->save();

            $oObject->setSequence($iSequence);
            $oObject->save();
        }

        $aImages = LinkRegionImagePeer::retrieveByRegionId($oObject->getRegionId());
        $iSequence = 1;
        foreach($aImages as $oImage) {
            $oImage->setSequence($iSequence);
            $oImage->save();
            $iSequence++;
        }

        $this->redirect('@linkregionimage');
    }
}
