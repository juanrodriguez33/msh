<?php

require_once dirname(__FILE__).'/../lib/staticpageGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/staticpageGeneratorHelper.class.php';

/**
 * staticpage actions.
 *
 * @package    mysecondhome
 * @subpackage staticpage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class staticpageActions extends autoStaticpageActions
{
    public function executeListUp(sfWebRequest $oRequest)
    {

        $oObject = StaticPagePeer::retrieveByPk($oRequest->getParameter('id'));

        if($oObject->getSequence() > 1) {
            $iSequence = $oObject->getSequence() - 1;

            $oSwitchObject = StaticPagePeer::retrieveBySequence($iSequence, $oObject->getLanguageId());
            $oSwitchObject->setSequence($oObject->getSequence());
            $oSwitchObject->save();

            $oObject->setSequence($iSequence);
            $oObject->save();
        }

        $aStaticPage = StaticPagePeer::retrieveByLanguage($oObject->getLanguageId());
        $iSequence = 1;
        /** @var StaticPage $oStaticPage */
        foreach($aStaticPage as $oStaticPage) {
            $oStaticPage->setSequence($iSequence);
            $oStaticPage->save();
            $iSequence++;
        }

        $this->redirect('@staticpage');
    }

    public function executeListDown(sfWebRequest $oRequest)
    {
        $oObject = StaticPagePeer::retrieveByPk($oRequest->getParameter('id'));
        $iMaxSequence = StaticPagePeer::getMaxSequence($oObject->getLanguageId());

        if($oObject->getSequence() < $iMaxSequence) {
            $iSequence = $oObject->getSequence() + 1;

            $oSwitchObject = StaticPagePeer::retrieveBySequence($iSequence, $oObject->getLanguageId());
            $oSwitchObject->setSequence($oObject->getSequence());
            $oSwitchObject->save();

            $oObject->setSequence($iSequence);
            $oObject->save();
        }

        $aStaticPage = StaticPagePeer::retrieveByLanguage($oObject->getLanguageId());
        $iSequence = 1;
        /** @var StaticPage $oStaticPage */
        foreach($aStaticPage as $oStaticPage) {
            $oStaticPage->setSequence($iSequence);
            $oStaticPage->save();
            $iSequence++;
        }

        $this->redirect('@staticpage');
    }
}
