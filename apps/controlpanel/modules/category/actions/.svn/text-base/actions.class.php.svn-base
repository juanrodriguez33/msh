<?php

require_once dirname(__FILE__).'/../lib/categoryGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/categoryGeneratorHelper.class.php';

/**
 * category actions.
 *
 * @package    mysecondhome
 * @subpackage category
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class categoryActions extends autoCategoryActions
{
    public function executeIndex(sfWebRequest $oRequest)
    {
        if ($oRequest->hasParameter('tab') && in_array($oRequest->getParameter('tab'), array('main', 'sub'))) {
            $this->getUser()->setAttribute('category.filters', $this->configuration->getFilterDefaults(), 'admin_module');
            $this->getUser()->setAttribute('category.tab', $oRequest->getParameter('tab'), 'admin_module');
        } elseif (!$this->getUser()->hasAttribute('category.tab', 'admin_module')) {
            $this->getUser()->setAttribute('category.tab', 'main', 'admin_module');
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
        $this->active = $this->getUser()->getAttribute('category.tab', 'main', 'admin_module');
    }

    protected function buildCriteria()
    {
        if (is_null($this->filters)) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $criteria = $this->filters->buildCriteria($this->getFilters());

        $this->addSortCriteria($criteria);

        $sTab = $this->getUser()->getAttribute('category.tab', 'main', 'admin_module');
        if ($sTab == 'main') {
            $oCriteria = CategoryPeer::retrieveByMainCriteria($criteria);
        }
        else if($sTab == 'sub') {
            $oCriteria = CategoryPeer::retrieveByTagCriteria($criteria);
        } else {
            $oCriteria = $criteria;
        }

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_criteria'), $oCriteria);
        $criteria = $event->getReturnValue();

        return $criteria;
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = $this->configuration->getForm();

        $this->category = $this->form->getObject();

        $sCat = $this->getUser()->getAttribute('category.tab', 'main', 'admin_module');
        if($sCat == 'main') {
            $this->category->setMain(true);
        } else if($sCat == 'sub'){
            $this->category->setMain(false);
        }

        $this->form = $this->configuration->getForm($this->category);

        $this->setTemplate('form');
    }

    public function executeListUp(sfWebRequest $oRequest)
    {

        $oObject = CategoryPeer::retrieveByPk($oRequest->getParameter('id'));

        if($oObject->getSequence() > 1) {
            $iSequence = $oObject->getSequence() - 1;

            $oSwitchObject = CategoryPeer::retrieveBySequence($iSequence,$oObject->getMain());
            $oSwitchObject->setSequence($oObject->getSequence());
            $oSwitchObject->save();

            $oObject->setSequence($iSequence);
            $oObject->save();
        }

        if($oObject->getMain()) {
            $aObject = CategoryPeer::retrieveMain();
        } else {
            $aObject = CategoryPeer::retrieveTags();
        }
        $iSequence = 1;
        /** @var Category $oObject */
        foreach($aObject as $oObject) {
            $oObject->setSequence($iSequence);
            $oObject->save();
            $iSequence++;
        }

        $this->redirect('@category');
    }

    public function executeListDown(sfWebRequest $oRequest)
    {
        $oObject = CategoryPeer::retrieveByPk($oRequest->getParameter('id'));
        $iMaxSequence = CategoryPeer::getMaxSequence($oObject->getMain());

        if($oObject->getSequence() < $iMaxSequence) {
            $iSequence = $oObject->getSequence() + 1;

            $oSwitchObject = CategoryPeer::retrieveBySequence($iSequence, $oObject->getMain());
            $oSwitchObject->setSequence($oObject->getSequence());
            $oSwitchObject->save();

            $oObject->setSequence($iSequence);
            $oObject->save();
        }

        if($oObject->getMain()) {
            $aObject = CategoryPeer::retrieveMain();
        } else {
            $aObject = CategoryPeer::retrieveTags();
        }

        $iSequence = 1;
        /** @var Category $oObject */
        foreach($aObject as $oObject) {
            $oObject->setSequence($iSequence);
            $oObject->save();
            $iSequence++;
        }

        $this->redirect('@category');
    }
}
