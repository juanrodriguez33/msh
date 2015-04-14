<?php
/**
 * Created by JetBrains PhpStorm.
 * User: simonsabelis
 * Date: 12/9/11
 * Time: 11:56
 * To change this template use File | Settings | File Templates.
 */
class systemComponents extends kmComponents
{
    public function executeCreditsBlock() {

    }

    public function executeInactiveProperties() {
        if($this->getUser()->hasCredential("ROLE_ADMIN")) {
            $this->aProperty = PropertyPeer::retrieveInactive(null, isset($this->iLimit) ? $this->iLimit : null);
        } else if($this->getUser()->hasCredential("ROLE_ASSOCIATION")) {
            $this->aProperty = PropertyPeer::retrieveInactive($this->getUser()->getAssociation()->getId());
        }
    }

    public function executeLatestContactRequests() {
        if($this->getUser()->hasCredential('ROLE_ADMIN')) {
            $this->aRequest = ContactRequestPeer::getLatestPropertyRequests();
        } else if($this->getUser()->hasCredential('ROLE_ASSOCIATION')) {
            $this->aRequest = ContactRequestPeer::getLatestPropertyRequests($this->getUser()->getAssociation()->getId());
        }
    }

    public function executeTotalBlock() {
    }

    /** admin dashboard */
    public function executeLowCreditAssociationsBlock() {
        $this->aAssociation = AssociationPeer::retrieveOrderByActiveProperties();
    }

}
