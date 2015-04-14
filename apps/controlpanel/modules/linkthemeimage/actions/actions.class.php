<?php

require_once dirname(__FILE__).'/../lib/linkthemeimageGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/linkthemeimageGeneratorHelper.class.php';

/**
 * linkthemeimage actions.
 *
 * @package    mysecondhome
 * @subpackage linkthemeimage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class linkthemeimageActions extends autoLinkthemeimageActions
{
    public function executeIndex(sfWebRequest $oRequest){

        $iTheme = $oRequest->getParameter('theme_id', NULL);
        if(!empty($iTheme))
            $this->getUser()->setAttribute('theme.id',$iTheme, 'admin_module');
        $iTheme = $this->getUser()->getAttribute('theme.id', NULL, 'admin_module');
        $this->theme = ThemePeer::retrieveByPK($iTheme);
        parent::executeIndex($oRequest);
    }

    protected function buildCriteria(){

        $oCriteria = parent::buildCriteria();

        if ($this->getUser()->getAttribute('theme.id', NULL, 'admin_module')) {
            $oCriteria = LinkThemeImagePeer::retrieveByThemeIdCriteria($this->getUser()->getAttribute('theme.id', NULL, 'admin_module'), $oCriteria);
            $oCriteria->addAscendingOrderByColumn(LinkThemeImagePeer::SEQUENCE);
        }
        else {
            parent::forward404("No theme supplied to show images of");
        }

        return $oCriteria;
    }

    public function executeNew(sfWebRequest $oRequest) {
        if ($this->getUser()->getAttribute('theme.id', NULL, 'admin_module')) {
            $this->form = $this->configuration->getForm();
            $this->form->setDefault("theme_id",$this->getUser()->getAttribute('theme.id', NULL, 'admin_module'));
            $this->linkthemeimage = $this->form->getObject();
        }
        else {
            parent::forward404("No theme supplied to show images of");
        }
        $this->setTemplate('form');

    }



    public function executeListBack(sfWebRequest $oRequest) {
        $this->redirect('@theme');
    }

    public function executeListUp(sfWebRequest $oRequest)
    {

        $oObject = LinkThemeImagePeer::retrieveByPk($oRequest->getParameter('id'));

        if($oObject->getSequence() > 1) {
            $iSequence = $oObject->getSequence() - 1;

            $oSwitchObject = LinkThemeImagePeer::retrieveBySequence($iSequence, $oObject->getThemeId());
            $oSwitchObject->setSequence($oObject->getSequence());
            $oSwitchObject->save();

            $oObject->setSequence($iSequence);
            $oObject->save();
        }

        $aImages = LinkThemeImagePeer::retrieveByThemeId($oObject->getThemeId());
        $iSequence = 1;
        foreach($aImages as $oImage) {
            $oImage->setSequence($iSequence);
            $oImage->save();
            $iSequence++;
        }

        $this->redirect('@linkthemeimage');
    }

    public function executeListDown(sfWebRequest $oRequest)
    {
        $oObject = LinkThemeImagePeer::retrieveByPk($oRequest->getParameter('id'));
        $iMaxSequence = LinkThemeImagePeer::getMaxSequence($oObject->getThemeId());

        if($oObject->getSequence() < $iMaxSequence) {
            $iSequence = $oObject->getSequence() + 1;

            $oSwitchObject = LinkThemeImagePeer::retrieveBySequence($iSequence, $oObject->getThemeId());
            $oSwitchObject->setSequence($oObject->getSequence());
            $oSwitchObject->save();

            $oObject->setSequence($iSequence);
            $oObject->save();
        }

        $aImages = LinkThemeImagePeer::retrieveByThemeId($oObject->getThemeId());
        $iSequence = 1;
        foreach($aImages as $oImage) {
            $oImage->setSequence($iSequence);
            $oImage->save();
            $iSequence++;
        }

        $this->redirect('@linkthemeimage');
    }
}
