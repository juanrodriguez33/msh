<?php
/**
 * Created by JetBrains PhpStorm.
 * User: simonsabelis
 * Date: 3/27/13
 * Time: 13:51
 * To change this template use File | Settings | File Templates.
 */

class contentComponents extends kmComponents{

    public function executeStepHeader(sfWebRequest $oRequest) {

    }

    public function executeAskExpert(sfWebRequest $oRequest) {
        $oI18n = $this->getContext()->getI18N();
        /** @var myUser $oUser  */
        $oUser = $this->getUser();
        $oCategory = CategoryI18nPeer::retrieveMainCategoryForPhaseBySlug($oUser->getPhase(),$oUser->getCulture(),$oUser->getContentTab());
        if(null===$oCategory) {
            $this->sCat = Functions::slugify($oI18n->__('url.subjectall'));
        } else {
            $this->sCat = $oCategory->getSlug();
        }
        $this->aExpert = UserPeer::retrieveExpertsForCountryAndLanguage($oUser->getCountry(), $oUser->getLanguage());
    }

    public function executeSubjectSelection(sfWebRequest $oRequest) {
        /** @var myUser $oUser  */
        $oUser = $this->getUser();
        $this->sCurrent = $oUser->getContentTab();
        $this->aCategory = CategoryI18nPeer::retrieveMainCategoryForPhase($oUser->getPhase(), $oUser->getCulture());
        $this->iPhase = $oUser->getPhase();

        if(!isset($this->bQuestion)) {
            $this->bQuestion = false;
        }
    }

    public function executeTagsAndOrdering(sfWebRequest $oRequest) {
        /** @var myUser $oUser  */
        $oUser = $this->getUser();

        $aTag = CategoryPeer::retrieveTags();
        $oCat = CategoryI18nPeer::retrieveMainCategoryForPhaseBySlug($oUser->getPhase(),$oUser->getCulture(),$oUser->getContentTab());

        $aTagWithContent = array();
        /** @var Category $oTag */
        foreach($aTag as $oTag) {
            if(PagePeer::countByPhaseCultureAndSubject($oUser->getPhase(), $oUser->getCulture(), $oCat, $oUser->getCountry(), $oTag->getId()) > 0) {
                $aTagWithContent[]=$oTag;
            }
        }
        $this->aTag = $aTagWithContent;

        if(!isset($this->bQuestion)) {
            $this->bQuestion = false;
        }
    }

    public function executeFooterRecentNews(sfWebRequest $oRequest) {
        /** @var myUser $oUser  */
        $oUser = $this->getUser();

        $this->aNews = PagePeer::retrieveByPhaseCultureAndSubject(2,$oUser->getCulture(),null, $oUser->getCountry(), 7);

    }

    public function executeRecentContent(sfWebRequest $oRequest) {
        /**
         * we should have
         *
         * - partial to use (single line, small result with photo)
         * AND
         * - phase
         * - category
         * OR
         * - article
         *
         */

    }

}