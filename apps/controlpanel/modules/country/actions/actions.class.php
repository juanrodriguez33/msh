<?php

require_once dirname(__FILE__).'/../lib/countryGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/countryGeneratorHelper.class.php';

/**
 * country actions.
 *
 * @package    mysecondhome
 * @subpackage country
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class countryActions extends autoCountryActions
{
    public function executeListImages(sfWebRequest $request) {
        $this->redirect('linkcountryimage/index?country_id=' . $request->getParameter('id'));
    }
}
