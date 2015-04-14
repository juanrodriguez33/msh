<?php

require_once dirname(__FILE__).'/../lib/commentGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/commentGeneratorHelper.class.php';

/**
 * comment actions.
 *
 * @package    mysecondhome
 * @subpackage comment
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class commentActions extends autoCommentActions
{
    public function executeIndex(sfWebRequest $oRequest){

        $iQuestion = $oRequest->getParameter('question_id', NULL);
        if(!empty($iQuestion)) {
            $this->getUser()->setAttribute('comment.question.id',$iQuestion, 'admin_module');
            $this->getUser()->setAttribute('comment.page.id',null, 'admin_module');
            $this->question = QuestionPeer::retrieveByPK($iQuestion);
        }
        $iPage = $oRequest->getParameter('page_id', NULL);
        if(!empty($iPage)) {
            $this->getUser()->setAttribute('comment.question.id',null, 'admin_module');
            $this->getUser()->setAttribute('comment.page.id',$iPage, 'admin_module');
            $this->page = PagePeer::retrieveByPK($iPage);
        }
        parent::executeIndex($oRequest);
    }

    protected function buildCriteria(){

        $oCriteria = parent::buildCriteria();

        if (null!==$this->getUser()->getAttribute('comment.page.id', NULL, 'admin_module')) {
            $oCriteria = CommentPeer::retrieveByPageCriteria($this->getUser()->getAttribute('comment.page.id', NULL, 'admin_module'), $oCriteria);
        } else if (null!==$this->getUser()->getAttribute('comment.question.id', NULL, 'admin_module')) {
            $oCriteria = CommentPeer::retrieveByQuestionCriteria($this->getUser()->getAttribute('comment.question.id', NULL, 'admin_module'), $oCriteria);
        } else {
            parent::forward404("No page/question supplied to show comments of");
        }

        return $oCriteria;
    }
}
