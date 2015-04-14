<?php

/**
 * comment module configuration.
 *
 * @package    mysecondhome
 * @subpackage comment
 * @author     Your name here
 * @version    SVN: $Id: configuration.php 12474 2008-10-31 10:41:27Z fabien $
 */
class commentGeneratorConfiguration extends BaseCommentGeneratorConfiguration
{

  public function getForm($object = null)
  {
    $class = $this->getFormClass();

    $oForm = new $class($object, $this->getFormOptions());
    unset($oForm['captcha']);
    
    return $oForm;
  }

}
