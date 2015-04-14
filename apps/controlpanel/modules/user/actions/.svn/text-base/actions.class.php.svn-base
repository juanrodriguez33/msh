<?php

require_once dirname(__FILE__).'/../lib/userGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/userGeneratorHelper.class.php';

/**
 * user actions.
 *
 * @package    mysecondhome
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class userActions extends autoUserActions
{

    public function executeListDisable(sfWebRequest $oRequest) {

        $user_id = $oRequest->getParameter('id');
        
        $oProvider = UserPeer::retrieveById($user_id);
        
        $oCriteria = new Criteria();
        $oCriteria ->add(PropertyPeer::ASSOCIATION_ID, $oProvider->getAssociationId(), Criteria::EQUAL);
        $aProperty = PropertyPeer::doSelect($oCriteria);
        
        foreach($aProperty as $oProperty){
            
            $oProperty->setOnline(0);
            $oProperty->save();
        }
        
        //
        $this->getUser()->setAttribute('user.tab', 'provider', 'admin_module');
        $this->getUser()->setNotification('info', 'Alle huizen van deze provider zijn offline geplaatst');
        $this->redirect('user/index');
    }

    public function executeIndex(sfWebRequest $oRequest)
    {
    
        if ($oRequest->hasParameter('tab') && in_array($oRequest->getParameter('tab'), array('admin', 'expert', 'provider', 'consumer'))) {
            $this->getUser()->setAttribute('user.filters', $this->configuration->getFilterDefaults(), 'admin_module');
            $this->getUser()->setAttribute('user.tab', $oRequest->getParameter('tab'), 'admin_module');
        } elseif (!$this->getUser()->hasAttribute('user.tab', 'admin_module')) {
            $this->getUser()->setAttribute('user.tab', 'admin', 'admin_module');
        }

        if ($oRequest->hasParameter('association_id')) {
            $this->getUser()->setAttribute('user.filters', array('association_id' => $oRequest->getParameter('association_id')), 'admin_module');
        }


        // sorting
        if ($oRequest->getParameter('sort')) {
            $this->setSort(array($oRequest->getParameter('sort'), $oRequest->getParameter('sort_type')));
        }

        // pager
        if ($oRequest->getParameter('page')) {
            $this->setPage($oRequest->getParameter('page'));
        }

        $this->pager = $this->getPager();
        $this->sort = $this->getSort();
        $this->active = $this->getUser()->getAttribute('user.tab', 'admin', 'admin_module');
    }

    protected function buildCriteria()
    {
        if (is_null($this->filters)) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $criteria = $this->filters->buildCriteria($this->getFilters());

        $this->addSortCriteria($criteria);

        $sTab = $this->getUser()->getAttribute('user.tab', 'admin', 'admin_module');
        if ($sTab == 'admin') {
            $oCriteria = UserPeer::retrieveByAdminTypeCriteria(1, $criteria);
        }
        else if($sTab == 'expert') {
            $oCriteria = UserPeer::retrieveByAdminTypeCriteria(2, $criteria);
        }
        else if($sTab == 'provider') {
            $oCriteria = UserPeer::retrieveByAdminTypeCriteria(3, $criteria);
        }
        else if($sTab == 'consumer') {
            $oCriteria = UserPeer::retrieveByAdminTypeCriteria(4, $criteria);
        }

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_criteria'), $oCriteria);
        $oCriteria = $event->getReturnValue();

        return $oCriteria;
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = $this->configuration->getForm();
        $this->user = $this->form->getObject();

        $sType = $this->getUser()->getAttribute('user.tab', 'admin', 'admin_module');
        if($sType == 'admin') {
            $this->user->setTypeId(1);
        } else if($sType == 'expert'){
            $this->user->setTypeId(2);
        } else if($sType == 'provider'){
            $this->user->setTypeId(3);
        }  else if($sType == 'consumer'){
            $this->user->setTypeId(4);
        }


        $this->form = $this->configuration->getForm($this->user);

        $this->setTemplate('form');
    }
}
