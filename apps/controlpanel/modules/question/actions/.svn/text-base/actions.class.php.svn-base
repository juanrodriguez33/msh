<?php

require_once dirname(__FILE__).'/../lib/questionGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/questionGeneratorHelper.class.php';

/**
 * question actions.
 *
 * @package    mysecondhome
 * @subpackage question
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class questionActions extends autoQuestionActions
{
    public function executeListComments(sfWebRequest $request) {
        $this->redirect('comment/index?question_id=' . $request->getParameter('id'));
    }
}
