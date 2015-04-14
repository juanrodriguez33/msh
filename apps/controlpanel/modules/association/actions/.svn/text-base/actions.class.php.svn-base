<?php

require_once dirname(__FILE__).'/../lib/associationGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/associationGeneratorHelper.class.php';

/**
 * association actions.
 *
 * @package    mysecondhome
 * @subpackage association
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class associationActions extends autoAssociationActions
{
    public function executeListDisable(sfWebRequest $oRequest) {

        $association_id = $oRequest->getParameter('id');
        
        $oCriteria = new Criteria();
        $oCriteria ->add(PropertyPeer::ASSOCIATION_ID, $association_id, Criteria::EQUAL);
        $aProperty = PropertyPeer::doSelect($oCriteria);
        
        foreach($aProperty as $oProperty){
            
            $oProperty->setOnline(0);
            $oProperty->save();
        }
        
        //
        $this->getUser()->setNotification('info', 'Alle huizen van deze provider zijn offline geplaatst');
        $this->redirect('association/index');
    }
    
	public function executeListEnable(sfWebRequest $oRequest) {

        $association_id = $oRequest->getParameter('id');
        
        $oCriteria = new Criteria();
        $oCriteria ->add(PropertyPeer::ASSOCIATION_ID, $association_id, Criteria::EQUAL);
        $aProperty = PropertyPeer::doSelect($oCriteria);
        
        foreach($aProperty as $oProperty){
            
            $oProperty->setOnline(1);
            $oProperty->save();
        }
        
        //
        $this->getUser()->setNotification('info', 'All properties of this provider have been set to Online');
        $this->redirect('association/index');
    }

    public function executeListLinkedusers(sfWebRequest $oRequest)
    {
        $this->redirect('user/index?tab=provider&association_id='.$oRequest->getParameter('id'));
    }
}
