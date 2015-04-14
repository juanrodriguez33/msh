<?php

require_once dirname(__FILE__).'/../lib/transactionGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/transactionGeneratorHelper.class.php';

/**
 * transaction actions.
 *
 * @package    mysecondhome
 * @subpackage transaction
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class transactionActions extends autoTransactionActions
{
    public function preExecute()
    {
        //
        #$this->getResponse()->setSlot('menu', strtolower($this->getModuleName()));
        
        //
        parent::preExecute();
    }

    public function executeCreate(sfWebRequest $request)
    {

        $this->form = $this->configuration->getForm();
        $this->transaction = $this->form->getObject();
        $this->transaction->setState(Transaction::STATE_PAID);
        $this->transaction->setType(Transaction::TRANS_ADDCREDITS);

        $this->processForm($request, $this->form);

        $this->setTemplate('form');



    }
}
