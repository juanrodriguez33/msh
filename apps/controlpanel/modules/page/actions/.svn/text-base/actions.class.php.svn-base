<?php

require_once dirname(__FILE__) . '/../lib/pageGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/pageGeneratorHelper.class.php';

/**
 * page actions.
 *
 * @package    mysecondhome
 * @subpackage page
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class pageActions extends autoPageActions
{
    public function executeIndex(sfWebRequest $oRequest)
    {
        if ($oRequest->hasParameter('tab') && in_array($oRequest->getParameter('tab'), array('orient', 'inform', 'news'))) {
            $this->getUser()->setAttribute('page.filters', $this->configuration->getFilterDefaults(), 'admin_module');
            $this->getUser()->setAttribute('page.tab', $oRequest->getParameter('tab'), 'admin_module');
        } elseif (!$this->getUser()->hasAttribute('page.tab', 'admin_module')) {
            $this->getUser()->setAttribute('page.tab', 'orient', 'admin_module');
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
        $this->active = $this->getUser()->getAttribute('page.tab', 'orient', 'admin_module');
    }

    protected function buildCriteria()
    {
        if (is_null($this->filters)) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $criteria = $this->filters->buildCriteria($this->getFilters());

        $this->addSortCriteria($criteria);

        $sTab = $this->getUser()->getAttribute('page.tab', 'orient', 'admin_module');
        if ($sTab == 'orient') {
            $oCriteria = PagePeer::retrieveByPhaseCriteria(0, $criteria);
        }
        else if($sTab == 'inform') {
            $oCriteria = PagePeer::retrieveByPhaseCriteria(1, $criteria);
        }
        else if($sTab == 'news') {
            $oCriteria = PagePeer::retrieveByPhaseCriteria(2, $criteria);
        }

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_criteria'), $oCriteria);
        $criteria = $event->getReturnValue();

        return $criteria;
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = $this->configuration->getForm();
        $this->page = $this->form->getObject();

        $sPhase = $this->getUser()->getAttribute('page.tab', 'orient', 'admin_module');
        if($sPhase == 'orient') {
            $this->page->setPhase(0);
        } else if($sPhase == 'inform'){
            $this->page->setPhase(1);
        } else if($sPhase == 'news'){
            $this->page->setPhase(2);
        }

        $this->form = $this->configuration->getForm($this->page);

        $this->setTemplate('form');
    }

    public function executeListComments(sfWebRequest $request) {
        $this->redirect('comment/index?page_id=' . $request->getParameter('id'));
    }
}
