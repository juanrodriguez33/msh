<?php

require_once dirname(__FILE__).'/../lib/bannerGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/bannerGeneratorHelper.class.php';

/**
 * banner actions.
 *
 * @package    mysecondhome
 * @subpackage banner
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class bannerActions extends autoBannerActions
{
    public function executeIndex(sfWebRequest $oRequest)
    {
        if ($oRequest->hasParameter('tab') && in_array($oRequest->getParameter('tab'), array('home', 'other'))) {
            $this->getUser()->setAttribute('banner.filters', $this->configuration->getFilterDefaults(), 'admin_module');
            $this->getUser()->setAttribute('banner.tab', $oRequest->getParameter('tab'), 'admin_module');
        } elseif (!$this->getUser()->hasAttribute('banner.tab', 'admin_module')) {
            $this->getUser()->setAttribute('banner.tab', 'home', 'admin_module');
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
        $this->active = $this->getUser()->getAttribute('banner.tab', 'home', 'admin_module');
    }

    protected function buildCriteria()
    {
        if (is_null($this->filters)) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $oCriteria = $this->filters->buildCriteria($this->getFilters());

        $this->addSortCriteria($oCriteria);

        $sTab = $this->getUser()->getAttribute('banner.tab', 'orient', 'admin_module');
        if ($sTab == 'home') {
            $oCriteria->add(BannerPeer::COUNTRY_ID, null, Criteria::ISNULL);
            $oCriteria->add(BannerPeer::THEME_ID, null, Criteria::ISNULL);
        }
        else if($sTab == 'other') {
            $oCrit1 = $oCriteria->getNewCriterion(BannerPeer::COUNTRY_ID, null, Criteria::ISNOTNULL);
            $oCrit2 = $oCriteria->getNewCriterion(BannerPeer::THEME_ID, null, Criteria::ISNOTNULL);
            $oCrit1->addOr($oCrit2);
            $oCriteria->add($oCrit1);
        }

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_criteria'), $oCriteria);
        $criteria = $event->getReturnValue();

        return $criteria;
    }
}
