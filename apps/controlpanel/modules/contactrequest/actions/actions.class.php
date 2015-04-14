<?php

require_once dirname(__FILE__).'/../lib/contactrequestGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/contactrequestGeneratorHelper.class.php';

/**
 * contactrequest actions.
 *
 * @package    mysecondhome
 * @subpackage contactrequest
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class contactrequestActions extends autoContactrequestActions
{
    public function preExecute()
    {
        parent::preExecute();
        $this->getResponse()->setSlot('menu','contact');
    }

    public function executeListShow(sfWebRequest $oRequest) {
        $this->oContactRequest = ContactRequestPeer::retrieveByPK($oRequest->getParameter('id',null));
    }
}
