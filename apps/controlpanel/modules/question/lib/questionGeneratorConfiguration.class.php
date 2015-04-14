<?php

/**
 * question module configuration.
 *
 * @package    mysecondhome
 * @subpackage question
 * @author     Your name here
 * @version    SVN: $Id: configuration.php 12474 2008-10-31 10:41:27Z fabien $
 */
class questionGeneratorConfiguration extends BaseQuestionGeneratorConfiguration
{

  public function getForm($object = null)
  {

    $oForm = new QuestionForm($object, $this->getFormOptions());
    unset($oForm['captcha']);
    
    return $oForm;
  }
  
}
