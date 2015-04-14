<?php

/**
 * system actions.
 *
 * @package    vindjeplek
 * @subpackage system
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class systemActions extends sfActions
{
    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeNot_found(sfWebRequest $oRequest){
        $this->setLayout('splash');
    }
    
    public function executeIndex(sfWebRequest $oRequest)
    {
        $this->getUser()->setGraphProperty(null);

        if($this->getUser()->hasCredential("ROLE_ADMIN")) {
            $this->setTemplate("indexAdmin");
        }

    }

    public function executeOauth2(sfWebRequest $oRequest)
    {
        $oAnalytics = GoogleAnalytics::getInstance($this->getUser());


        if($oAnalytics->needsAccess()) {
            $sCode = $oRequest->getParameter("code",null);
            if($sCode == null) {
                $this->redirect($oAnalytics->getAccessRedirectUrl());
            }
            else {
                $oAnalytics->newAccess($sCode);
            }
        }

        $oAnalytics->getVisitors();
    }
    
    public function executeSign_in(sfWebRequest $oRequest) {
        if($this->getUser()->isAuthenticated()) die('test2');//$this->redirect('homepage');

        $oForm = new Sign_inForm();
        //die('test');
        if($oRequest->isMethod('post')) {
            $oForm->bind($oRequest->getParameter('sign_in'));
            if($oForm->isValid()) {
                $this->getUser()->signIn($oForm->getValue('user'));
                $this->redirect('homepage');
            }
        }

        $this->form = $oForm;
        
        $this->setLayout('splash');
    }

    public function executeForgotPassword(sfWebRequest $oRequest) {
        if($this->getUser()->isAuthenticated()) $this->redirect('homepage');

        $oForm = new ForgotPasswordForm();
        if($oRequest->isMethod('post')) {
            $oForm->bind($oRequest->getParameter('forgot_password'));
            if($oForm->isValid()) {
                $oAdmin = $oForm->getValue('user');
                $sNewPassword = $oAdmin->createNewPassword();
                $oMailer = new VindjeplekMailer();
                $oMailer->mailNewPassword($oAdmin, $sNewPassword);
                $this->getUser()->setNotification('info', 'Er is een nieuw wachtwoord verstuurd');
                $this->redirect('sign_in');
            }
        }

        $this->form = $oForm;

        $this->setLayout('splash');
    }

    public function executeSign_out(sfWebRequest $oRequest) {
        $this->getUser()->signOut();
        $this->redirect('sign_in');
    }
}
