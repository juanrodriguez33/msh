<?php

/**
 * system actions.
 *
 * @package    mysecondhome
 * @subpackage system
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class portalActions extends kmActions
{
    public function preExecute() {
        $this->getResponse()->setSlot('bDisableBanner', true);
        $this->getResponse()->setSlot('bDisableFooterTopProperties', true);
        $this->getResponse()->setSlot('bDisableFooterPhaseOverview', true);
        $this->getResponse()->setSlot('bDisableFooterNews', true);
		$this->getResponse()->setSlot('bDisableFooterMostPopular',true);

        $this->getResponse()->setSlot('is_portal', true);
        $this->getResponse()->setSlot('menu_portal', 'portal');

        //
        $oUser = $this->getUser();

        // Conversions
        if($oUser->hasCredential('ROLE_ASSOCIATION'))
            $aContact = ContactRequestPeer::retrieveForProvider($oUser->getUser()->getAssociationId(), 999999);
        else if($oUser->hasCredential('ROLE_CONSUMER'))
            $aContact = ContactRequestPeer::retrieveForUser($oUser->getUser()->getId(), 999999);
        else
            $aContact = array();
        $this->getResponse()->setSlot('portal.new-conversions', count($aContact));

    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeRegistration(sfWebRequest $oRequest) {
        //
        $this->getResponse()->setSlot('bDisableBreadcrumb', true);

        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        $oI18n = $this->getContext()->getI18N();

        $iStep = $oRequest->getParameter('step', 1);
        $this->getResponse()->setSlot('is_portal', false);
        $this->getResponse()->setSlot('is_login', true);

        $oForm = new SimpleRegisterForm();

        if($oRequest->isMethod("POST")) {
            $oForm->bind($oRequest->getParameter($oForm->getName()));
            if($oForm->isValid()) {
                $aRegisterArray = $oUser->getAttribute('portal.register.data', array());

                $oUser->setAttribute('register.accounttype', $oForm['account_type']->getValue());
                $aRegisterArray['personal_email'] = $oForm['personal_email']->getValue();
                $aRegisterArray['company_name'] = $oForm['company_name']->getValue();
                $aRegisterArray['personal_surname'] = $oForm['personal_surname']->getValue();
                $oUser->setAttribute('portal.register.data', $aRegisterArray);
                return $this->redirect($this->generateUrl('portal_register'));
            }
        }

        $this->form = $oForm;

    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeRegister(sfWebRequest $oRequest) {

        //
        $this->getResponse()->setSlot('bDisableBreadcrumb', true);

        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        $oI18n = $this->getContext()->getI18N();

        $iStep = $oRequest->getParameter('step', 1);
        
        $this->getResponse()->setSlot('is_portal', false);
        $this->getResponse()->setSlot('is_login', true);

        $sType = $oUser->getAttribute('register.accounttype');

        if($iStep == 1) {

            if(null===$sType) {
                $oUser->setNotification('info', $oI18n->__('portal.notification.chooseaccounttype'));
                $this->redirect($this->generateUrl('portal_registration'));
            }
            if($sType =='private') {
                $iStep = 2;
            }
        }
        $this->sType = $oUser->getAttribute('register.accounttype');


        $aRegisterArray = $oUser->getAttribute('portal.register.data', array());
        $oRegisterForm = new RegisterForm($aRegisterArray, array('type' => $oUser->getAttribute('register.accounttype')));
        $this->oForm = $oRegisterForm;

        $iPackage = $oUser->getAttribute('register.package');
        $oPackage = ContractPeer::retrieveByPK($iPackage);

        $bAccepted = $oUser->getAttribute('portal.tandcaccepted', false);



        if($iStep == 2) {
            $iNewPackage = $oRequest->getPostParameter('package', null);
            $iPackagePeriod = $oRequest->getParameter('contract_period', $oUser->getAttribute('register.package.period', null));

            $oUser->setAttribute('register.package.period', $iPackagePeriod);
            if(null!==$iNewPackage) {
                $oUser->setAttribute('register.package', $iNewPackage);
                $iPackage = $oUser->getAttribute('register.package');
            }
            if($sType == 'business' && null===$iPackagePeriod) {
                $oUser->setNotification('error', $oI18n->__('portal.notification.choosecontractperiod'));
                $this->redirect($this->generateUrl('portal_register', array('step' => 1)));
            }
        }
        else if($iStep == 3 ) {
            if($oRequest->isMethod("POST")) {
                // received a submit
                $oRegisterForm->bind($oRequest->getParameter($oRegisterForm->getName()));
                $aRegisterArray = $oRegisterForm->getValues();
                if($oRegisterForm->isValid()) {
                    $oUser->setAttribute('portal.register.data', $aRegisterArray);
                } else {
                    $iStep = 2;
                }

            } else {
                $aRegisterArray['_csrf_token'] = $oRegisterForm->getCSRFToken();
                $oRegisterForm->bind($aRegisterArray);
                if(!$oRegisterForm->isValid()) {
                    $oUser->setNotification('info', $oI18n->__('portal.notification.fillinyourregistrationdatafirst'));
                    $this->redirect($this->generateUrl('portal_register', array('step' => 2)));
                }
            }
        }
        else if($iStep == 4) {
            $bAcceptedNew = intval($oRequest->getParameter('accept', 0)) === 1;
            if($bAcceptedNew) {
                $oUser->setAttribute('portal.tandcaccepted', true);
                $bAccepted = true;
            }
            $aRegisterArray['_csrf_token'] = $oRegisterForm->getCSRFToken();
            $oRegisterForm->bind($aRegisterArray);
            if(!$oRegisterForm->isValid()) {
                $oUser->setNotification('info', $oI18n->__('portal.notification.fillinyourregistrationdatafirst'));
                $this->redirect($this->generateUrl('portal_register', array('step' => 2)));
            }
        }
        else if($iStep == 5) {


            if($this->sType == 'business') {
                $oTransaction = new Transaction();
                $oTransaction->setType(Transaction::TRANS_CONTRACT);
                $oTransaction->setPrice($oPackage->getPrice()*1.21);
                $oTransaction->setState(Transaction::STATE_NEW);
                $oTransaction->setDescription("Purchase of new contract for new provider");
                $oTransaction->save();
            } else {
                $oTransaction = new Transaction();
                $oTransaction->setType(Transaction::TRANS_CONSUMERPROPERTY);
                $oTransaction->setPrice(9.95*1.21);
                $oTransaction->setState(Transaction::STATE_NEW);
                $oTransaction->setDescription("Purchase of first property for consumer");
                $oTransaction->save();
            }


            $oPaymentProvider = new MSHPaymentProvider();

            $aExtraParams = array();
            $aExtraParams['brq_return'] = $this->generateUrl('portal_register', array('step' => 6), true);
            $aExtraParams['brq_culture'] = $oUser->getCulture();


            $this->aParams = $oPaymentProvider->getPaymentParams($oTransaction, $aExtraParams);
            $this->sPaymentUrl = $oPaymentProvider->getPaymentGateway();


        } else if($iStep == 6) {

            $sTransaction = $oRequest->getParameter('BRQ_INVOICENUMBER');
            $oTransaction = TransactionPeer::retrieveByPK(substr($sTransaction,12));
            $iStatus = $oRequest->getParameter('BRQ_STATUSCODE');

            $oTransaction->setPaymentKey($oRequest->getParameter('BRQ_PAYMENT', null));

            switch ($iStatus) {
                case 190:
                    // ok
                    if($this->sType == 'business') {
                        $oAssociation = new Association();
                        $oAssociation->setTitle($aRegisterArray['company_name']);
                        $oAssociation->setAddress1($aRegisterArray['address1']);
                        $oAssociation->setAddress2($aRegisterArray['address2']);
                        $oAssociation->setEmailAddress($aRegisterArray['email']);
                        $oAssociation->setPhoneNumber($aRegisterArray['phone']);
                        $oAssociation->setCountryId($aRegisterArray['country_id']);
                        $oAssociation->setRegionId($aRegisterArray['region_id']);
                        if(intval($aRegisterArray['region_id']) == -1) {
                            $oRegion = RegionI18nPeer::retrieveBySlug(Functions::slugify($aRegisterArray['region_new']), $aRegisterArray['country_id']);
                            if(null===$oRegion) {
                                $oRegion = new Region();
                                $oRegion->setCountryId($aRegisterArray['country_id']);
                                $oRegion->setTitle($aRegisterArray['region_new']);
                                if($oUser->getCulture() !== 'en') {
                                    $oRegion->setTitle($aRegisterArray['region_new'], 'en');
                                }
                                $oRegion->setActive(false);
                                $oRegion->save();
                            } else {
                                $oRegion = $oRegion->getRegion();
                            }
                            $oAssociation->setRegion($oRegion);
                        } else {
                            $oAssociation->setRegionId($aRegisterArray['region_id']);
                        }
                        if(intval($aRegisterArray['city_id']) == -1) {
                            $oCity = CityI18nPeer::retrieveBySlug(Functions::slugify($aRegisterArray['city_new']), $oAssociation->getRegionId());
                            if(null===$oCity) {
                                $oCity = new City();
                                $oCity->setRegionId($oAssociation->getRegionId());
                                $oCity->setTitle($aRegisterArray['city_new']);
                                if($oUser->getCulture() !== 'en') {
                                    $oCity->setTitle($aRegisterArray['city_new'], 'en');
                                }
                                $oCity->setActive(false);
                                $oCity->save();
                            } else {
                                $oCity = $oCity->getCity();
                            }
                            $oAssociation->setCity($oCity);
                        } else {
                            $oAssociation->setCityId($aRegisterArray['city_id']);
                        }

                        $oAssociationUser = new User();
                        $oAssociation->setContract($oPackage);
                        $oAssociation->setContractPeriod($oUser->getAttribute('register.package.period'));
                        $oAssociationUser->setTypeId(User::TYPE_PROVIDER);
                        $oAssociationUser->setEmailAddress($aRegisterArray['personal_email']);
                        $oAssociationUser->setFirstName($aRegisterArray['personal_firstname']);
                        $oAssociationUser->setSurname($aRegisterArray['personal_surname']);
                        $oAssociationUser->setAssociationFunction($aRegisterArray['personal_function']);
                        $oAssociationUser->setAssociation($oAssociation);
                        $oAssociationUser->setLang($oUser->getCulture());
                        $oAssociation->save();
                        $oAssociationUser->save();
                        $oAssociation->setContact1Id($oAssociationUser->getId());
                        $oAssociation->save();
                        $oTransaction->setState(Transaction::STATE_PAID);
                        $oTransaction->setAssociationId($oAssociation->getId());
                        $oTransaction->setUserId($oAssociationUser->getId());
                        $oTransaction->save();

                    } else {
                        $oConsumerUser = new User();
                        $oConsumerUser->setTypeId(User::TYPE_CONSUMER);
                        $oConsumerUser->setEmailAddress($aRegisterArray['personal_email']);
                        $oConsumerUser->setFirstName($aRegisterArray['personal_firstname']);
                        $oConsumerUser->setSurname($aRegisterArray['personal_surname']);
                        $oConsumerUser->setLang($oUser->getCulture());
                        $oConsumerUser->save();

                        $oTransaction->setState(Transaction::STATE_PAID);
                        $oTransaction->setUserId($oConsumerUser->getId());
                        $oTransaction->save();
                    }




                    if($this->sType == 'business') {
                        // contract transaction, so send account information
                        $sNewPassword = MSHTools::generatePassword(8);
                        $oAssociationUser = $oTransaction->getUser();
                        $oAssociationUser->setPassword($sNewPassword);
                        $oAssociationUser->save();
                        $oMailer =new MSHMailer();
                        $oMailer->mailProviderAccount($oAssociationUser, $sNewPassword);
                    } else {
                        // contract transaction, so send account information
                        $sNewPassword = MSHTools::generatePassword(8);
                        $oAssociationUser = $oTransaction->getUser();
                        $oAssociationUser->setPassword($sNewPassword);
                        $oAssociationUser->save();
                        $oMailer =new MSHMailer();
                        $oMailer->mailConsumerAccount($oAssociationUser, $sNewPassword);
                    }
                    $oUser->setAttribute('portal.register.data', array());
                    $oUser->setAttribute('portal.tandcaccepted', false);
                    $oUser->setAttribute('register.package', null);
                    break;
                case 490:
                case 491:
                case 492:
                case 690:
                    $oTransaction->setState(Transaction::STATE_ERROR);
                    break;
                case 790:
                case 791:
                case 792:
                case 793:
                    $oTransaction->setState(Transaction::STATE_PROCESSING);
                    break;
                case 890:
                case 891:
                    $oTransaction->setState(Transaction::STATE_CANCELLED);
                    break;
            }

            $oTransaction->save();

            $this->oTransaction = $oTransaction;
        }
        $aBc = array();

        switch($iStep) {
            case 1:
                $this->setTemplate('registerStep1');
                $this->aPackage = ContractPeer::getActive();
                $this->iPackage = $oUser->getAttribute('register.package');
                $this->iPackagePeriod = $oUser->getAttribute('register.package.period', sfConfig::get('app_portal_default_period'));
                break;
            case 2:
                $this->iPackage = $oUser->getAttribute('register.package');
                $this->oSelectedPackage = ContractPeer::retrieveById($this->iPackage);
                
                if($sType == 'business' && null===$iPackage) {
                    $oUser->setNotification('info', $oI18n->__('portal.notification.selectpackagefirst'));
                    $this->redirect($this->generateUrl('portal_register', array('step' => 1)));
                }

                $this->setTemplate('registerStep2');

                break;
            case 3:
                if($sType == 'business' && null===$iPackage) {
                    $oUser->setNotification('info', $oI18n->__('portal.notification.selectpackagefirst'));
                    $this->redirect($this->generateUrl('portal_register', array('step' => 1)));
                }

                $this->oPageTerms = StaticPagePeer::retrieveByPK(sfConfig::get('app_page_terms'));
                $this->setTemplate('registerStep3');

                break;
            case 4:
                if($sType == 'business' && null===$iPackage) {
                    $oUser->setNotification('info', $oI18n->__('portal.notification.selectpackagefirst'));
                    $this->redirect($this->generateUrl('portal_register', array('step' => 1)));
                } else if(!$bAccepted) {
                    $oUser->setNotification('info', $oI18n->__('portal.notification.acceptthetermsandconditionsfirst'));
                    $this->redirect($this->generateUrl('portal_register', array('step' => 3)));
                }

                $this->aValues = $aRegisterArray;
                $this->oPackage = $oPackage;
                $this->oRegion = RegionPeer::retrieveByPK($aRegisterArray['region_id']);
                $this->oCity = CityPeer::retrieveByPK($aRegisterArray['city_id']);
                $this->setTemplate('registerStep4');
                break;
            case 5:
                $this->setTemplate('registerStep5');
                break;
            case 6:
                $this->setTemplate('registerStep6');
                break;
        }

        $this->getResponse()->setSlot('bc', $aBc);
    }


    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $oRequest) {
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        if($oUser->hasCredential('ROLE_ASSOCIATION')) {
            $this->aProperty = PropertyPeer::retrieveForProvider($oUser->getUser()->getAssociationId());
            $this->aDevelopment = DevelopmentPeer::retrieveForProvider($oUser->getUser()->getAssociationId());
            $this->aContact = ContactRequestPeer::retrieveForProvider($oUser->getUser()->getAssociationId());
            $iDevelopment = DevelopmentPeer::retrieveCountForProvider($oUser->getUser()->getAssociation()->getId());
            $iMaxDev = $oUser->getUser()->getAssociation()->getContract()->getDevelopments();
            $this->bAllowAddDev = $iDevelopment < $iMaxDev;
        } else {
            $this->aProperty = PropertyPeer::retrieveForUser($oUser->getUser()->getId());
            $this->aContact = ContactRequestPeer::retrieveForUser($oUser->getUser()->getId());
        }

        $oI18n = $this->getContext()->getI18N();
        $aBc = array();
        $this->getResponse()->setSlot('bc', $aBc);

    }

    public function executeBuyCredits(sfWebRequest $oRequest) {
        $this->getResponse()->setSlot('menu_portal', 'profile');
        $oI18n = $this->getContext()->getI18N();

        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        if($oUser->hasCredential('ROLE_ASSOCIATION') || $oUser->hasCredential('ROLE_CONSUMER')) {

        } else {
            $this->redirect404();
        }

        if($oRequest->isMethod("POST")) {
            $iPackage = $oRequest->getParameter('buy_credits', null);
            $oPackage = CreditspackagePeer::retrieveByPK($iPackage);
            if(null!==$oPackage) {

                $oPaymentProvider = new MSHPaymentProvider();
                $oTransaction = new Transaction();
                $oTransaction->setType(Transaction::TRANS_ADDCREDITS);
                $oTransaction->setCredits($oPackage->getCredits());
                $oTransaction->setPrice($oPackage->getPrice()*1.21);
                $oTransaction->setState(Transaction::STATE_NEW);
                $oTransaction->setUserId($oUser->getUser()->getId());
                $oTransaction->setDescription("Purchase of credits package " . $oPackage->getTitle());
                if($oUser->hasCredential('ROLE_ASSOCIATION')) {
                    $oTransaction->setAssociationId($oUser->getUser()->getAssociationId());
                }

                $oTransaction->save();

                $aExtraParams = array();
                $aExtraParams['brq_return'] = $this->generateUrl('portal_buycredits_return', array(), true);
                $aExtraParams['brq_culture'] = $oUser->getCulture();


                $this->aParams = $oPaymentProvider->getPaymentParams($oTransaction, $aExtraParams);
                $this->sPaymentUrl = $oPaymentProvider->getPaymentGateway();
                $this->setTemplate('buyCreditsPayment');
            }
        }

        $this->aCreditsPackage = CreditspackagePeer::getActive();
    }

    public function executeBuyCreditsReturn(sfWebRequest $oRequest) {
        $this->getResponse()->setSlot('menu_portal', 'profile');
        $oI18n = $this->getContext()->getI18N();

        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        if($oUser->hasCredential('ROLE_ASSOCIATION') || $oUser->hasCredential('ROLE_CONSUMER')) {

        } else {
            $this->redirect404();
        }

        if($oRequest->isMethod("POST")) {

            $sTransaction = $oRequest->getParameter('BRQ_INVOICENUMBER');
            $oTransaction = TransactionPeer::retrieveByPK(substr($sTransaction,12));
            $iStatus = $oRequest->getParameter('BRQ_STATUSCODE');

            $oTransaction->setPaymentKey($oRequest->getParameter('BRQ_PAYMENT', null));

            switch ($iStatus) {
                case 190:
                    // ok
                    $oTransaction->setState(Transaction::STATE_PAID);
                    $oMailer = new MSHMailer();
                    $oMailer->mailCreditsBought($oTransaction);
                    $oUser->setNotification('info', $oI18n->__('portal.notification.creditsadded'));
                    break;
                case 490:
                case 491:
                case 492:
                case 690:
                    $oTransaction->setState(Transaction::STATE_ERROR);
                    $oUser->setNotification('info', $oI18n->__('portal.notification.errorduringpaymenttryagain'));
                    break;
                case 790:
                case 791:
                case 792:
                case 793:
                    $oTransaction->setState(Transaction::STATE_PROCESSING);
                    $oUser->setNotification('info', $oI18n->__('portal.notification.paymentinprocess'));
                    break;
                case 890:
                case 891:
                    $oTransaction->setState(Transaction::STATE_CANCELLED);
                    $oUser->setNotification('info', $oI18n->__('portal.notification.errorduringpaymenttryagain'));
                    break;
            }

            $oTransaction->save();

            $this->redirect($this->generateUrl('portal_overview'));
        }
    }

    public function executeDevelopments(sfWebRequest $oRequest) {
        $this->getResponse()->setSlot('menu_portal', 'developments');
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        if($oUser->hasCredential('ROLE_ASSOCIATION')) {
            $this->aDevelopment = DevelopmentPeer::retrieveForProvider($oUser->getUser()->getAssociationId(), 999999);
        } else {
            $this->redirect404();
        }

        $iDevelopment = DevelopmentPeer::retrieveCountForProvider($oUser->getUser()->getAssociation()->getId());
        $iMaxDev = $oUser->getUser()->getAssociation()->getContract()->getDevelopments();
        $this->bAllowAdd = $iDevelopment < $iMaxDev;

        $oI18n = $this->getContext()->getI18N();
        $aBc = array();
        $aBc[$this->generateUrl('portal_developments')] = $oI18n->__('portal.developments');
        $this->getResponse()->setSlot('bc', $aBc);
    }

    public function executeAddDevelopment(sfWebRequest $oRequest) {
        $this->getResponse()->setSlot('menu_portal', 'developments');
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();

        $oI18n = $this->getContext()->getI18N();

        $iTempDevelopmentId = $oUser->getAttribute('portal.temp_development_id',null);
        if(null===$iTempDevelopmentId) {
            $oUser->setAttribute('portal.temp_development_id', sha1($oUser->getUser()->getId().time()));
        }
        $iTempDevelopmentId = $oUser->getAttribute('portal.temp_development_id',null);

        $oForm = new FrontendDevelopmentForm();
        $this->form = $oForm;

        $this->aLang = LanguagePeer::getForPortal();



        if($oRequest->isMethod('POST')) {
            $oForm->bind($oRequest->getParameter($oForm->getName()), $oRequest->getFiles($oForm->getName()));
            if($oForm->isValid()) {
                /** @var Development $oDevelopment */
                $oDevelopment = $oForm->save();

                $iTempDevelopmentId = $oUser->getAttribute('portal.temp_development_id',null);
                $aImage = LinkDevelopmentImagePeer::retrieveByTempRef($iTempDevelopmentId);
                /** @var LinkDevelopmentImage $oImage */
                foreach($aImage as $oImage) {
                    $oImage->setDevelopment($oDevelopment);
                    $oImage->setTempRef(null);
                    $oImage->save();
                }


                // save image order
                $oDevelopment->sequenceImagesByOrder(explode(',',$oRequest->getParameter('development_image_order')));
                $oUser->setAttribute('portal.temp_development_id', sha1($oUser->getUser()->getId().time()));
                $iTempDevelopmentId = $oUser->getAttribute('portal.temp_development_id',null);

                $oDevelopment->setAssociation($oUser->getUser()->getAssociation());
                $oDevelopment->save();
                $oUser->setNotification('info', $oI18n->__('portal.notification.developmentadded'));
                $this->redirect('portal_developments');
            } else {
                $oUser->setNotification('error', $oI18n->__('notice.errorsinform'));
            }
        }

        $this->aImage = LinkDevelopmentImagePeer::retrieveByTempRef($iTempDevelopmentId);

        $aBc = array();
        $aBc[$this->generateUrl('portal_developments')] = $oI18n->__('portal.developments');
        $aBc[$this->generateUrl('portal_developments_add')] = $oI18n->__('text.addDevelopment');
        $this->getResponse()->setSlot('bc', $aBc);

    }

    public function executeEditDevelopment(sfWebRequest $oRequest) {
        $this->getResponse()->setSlot('menu_portal', 'developments');
        /** @var MSHWebsiteUser $oUser */

        $iDevelopment = $oRequest->getParameter('id',null);
        $oDevelopment = DevelopmentPeer::retrieveByPK($iDevelopment);

        $oUser = $this->getUser();

        $oI18n = $this->getContext()->getI18N();

        if($oUser->hasCredential('ROLE_ASSOCIATION')) {
            if($oDevelopment->getAssociationId() !== $oUser->getUser()->getAssociationId()) {
                $this->redirect404();
            }
        } else {
            $this->redirect404();
        }
        
        $this->aLang = LanguagePeer::getForPortal();
        
        // Generate missing translations (else template fails)
        DevelopmentI18N::generateMissingTranslations($oDevelopment, $this->aLang);

        $oForm = new FrontendDevelopmentForm($oDevelopment);
        $this->form = $oForm;

        $this->oDevelopment = $oDevelopment;

        if($oRequest->isMethod('POST')) {
            $oForm->bind($oRequest->getParameter($oForm->getName()), $oRequest->getFiles($oForm->getName()));
            if($oForm->isValid()) {
                $oForm->save();
                // save image order
                $oDevelopment->sequenceImagesByOrder(explode(',',$oRequest->getParameter('development_image_order')));
                $oUser->setNotification('info', $oI18n->__('portal.notification.developmentsaved'));
                $this->redirect('portal_developments');
            } else {
                $oUser->setNotification('error', $oI18n->__('notice.errorsinform'));
            }
        }

        $aBc = array();
        $aBc[$this->generateUrl('portal_developments')] = $oI18n->__('portal.developments');
        $aBc[$this->generateUrl('portal_developments_edit', array('id' => $oDevelopment->getId()))] = $oDevelopment->getTitle();
        $this->getResponse()->setSlot('bc', $aBc);
    }

    public function executeDeleteDevelopment(sfWebRequest $oRequest) {
        /** @var MSHWebsiteUser $oUser */

        $iDevelopment = $oRequest->getParameter('id',null);
        $oDevelopment = DevelopmentPeer::retrieveByPK($iDevelopment);

        $oUser = $this->getUser();
        if($oUser->hasCredential('ROLE_ASSOCIATION')) {
            if($oDevelopment->getAssociationId() !== $oUser->getUser()->getAssociationId()) {
                $this->redirect404();
            }
        } else {
            $this->redirect404();
        }

        $oDevelopment->delete();
        $this->redirect('portal_developments');
    }

    public function executeUploadDevelopmentImage(sfWebRequest $oRequest) {
        sfConfig::set('sf_web_debug', false);
        $this->getResponse()->setContentType('application/json');
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();

        $iDevelopment = $oRequest->getParameter('id',null);

        if(null===$iDevelopment) {
            // adding development
            $iTempDevelopmentId = $oUser->getAttribute('portal.temp_development_id',null);
            if(null===$iTempDevelopmentId) {
                return $this->renderText(json_encode(array(
                    'status' => 'error',
                    'message' => "no temporary development id"
                )));
            }
        } else {
            $oDevelopment = DevelopmentPeer::retrieveByPK($iDevelopment);

            $oUser = $this->getUser();
            if($oUser->hasCredential('ROLE_ASSOCIATION')) {
                if($oDevelopment->getAssociationId() !== $oUser->getUser()->getAssociationId()) {
                    return $this->renderText(json_encode(array(
                        'status' => 'error',
                        'message' => "no access"
                    )));
                }
            } else {
                return $this->renderText(json_encode(array(
                    'status' => 'error',
                    'message' => "no access"
                )));
            }
        }



        $plupload = new kmFileUploader(
            $oRequest->getParameter('chunk', 0),
            $oRequest->getParameter('chunks', 0),
            $oRequest->getParameter('name', 'file.tmp')
        );

        $plupload->processUpload(
            $oRequest->getFiles($oRequest->getParameter('file-data-name', 'file')),
            $plupload->getContentType($oRequest)
        );

        if (!$plupload->isComplete())
        {
            return $this->renderText(json_encode(array(
                'status' => 'incomplete'
            )));
        }

        $oLinkDevelopmentImage = new LinkDevelopmentImage();

        $oSfImage = new sfImage($plupload->getFilePath());
        $oImage = Image::newFromSfImageWithWidthHeight($oSfImage, 'property',"", 1024, 768);
        $oLinkDevelopmentImage->setImageId($oImage->getId());


        if(null===$oDevelopment) {
            $oLinkDevelopmentImage->setTempRef($iTempDevelopmentId);
            $oLinkDevelopmentImage->setSequence(LinkDevelopmentImagePeer::getMaxSequenceTemp($iTempDevelopmentId)+1);
        } else {
            $oLinkDevelopmentImage->setDevelopment($oDevelopment);
            $oLinkDevelopmentImage->setSequence(LinkDevelopmentImagePeer::getMaxSequence($oDevelopment->getId())+1);
        }


        $oLinkDevelopmentImage->save();


        return $this->renderText(json_encode(array(
            'status' => 'complete',
            'file' => $oImage->getFormatUrl(90, 60),
            'file_big' => $oImage->getFormatUrl(1024, 768),
            'id' => $oLinkDevelopmentImage->getId()
        )));

    }

    public function executeDeleteDevelopmentImage(sfWebRequest $oRequest) {
        //sfConfig::set('sf_web_debug', false);
        $this->getResponse()->setContentType('application/json');
        /** @var MSHWebsiteUser $oUser */

        $iLinkImage = $oRequest->getParameter('id',null);
        $oLinkImage = LinkDevelopmentImagePeer::retrieveByPK($iLinkImage);
        if(null===$oLinkImage) {
            throw new Exception("could not find image: ". $iLinkImage);
        }

        $oDevelopment = $oLinkImage->getDevelopment();

        $oUser = $this->getUser();
        if($oUser->hasCredential('ROLE_ASSOCIATION')) {
            if(null===$oDevelopment) {
                $iTempDevelopmentId = $oUser->getAttribute('portal.temp_development_id',null);
                if($oLinkImage->getTempRef() !== $iTempDevelopmentId) {
                    throw new Exception("error");
                }
            }
            else if($oDevelopment->getAssociationId() !== $oUser->getUser()->getAssociationId()) {
                throw new Exception("error");
            }
        } else {
            throw new Exception("error");
        }

        $oLinkImage->delete();

        return $this->renderText(json_encode(array(
            'status' => 'ok',
        )));
    }

    public function executeProperties(sfWebRequest $oRequest) {
        $this->getResponse()->setSlot('menu_portal', 'properties');
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        if($oUser->hasCredential('ROLE_ASSOCIATION')) {
            $this->aProperty = PropertyPeer::retrieveForProvider($oUser->getUser()->getAssociationId(), true, 999999);
            $this->aPropertyOffline = PropertyPeer::retrieveForProvider($oUser->getUser()->getAssociationId(), false, 999999);
        } else {
            $this->aProperty = PropertyPeer::retrieveForUser($oUser->getUser()->getId(), true, 999999);
            $this->aPropertyOffline = PropertyPeer::retrieveForUser($oUser->getUser()->getId(), false, 999999);
        }

        $oI18n = $this->getContext()->getI18N();
        $aBc = array();
        $aBc[$this->generateUrl('portal_properties')] = $oI18n->__('portal.properties');
        $this->getResponse()->setSlot('bc', $aBc);
    }

    public function executeAddProperty(sfWebRequest $oRequest) {
        $this->getResponse()->setSlot('menu_portal', 'properties');
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();

        $oI18n = $this->getContext()->getI18N();

        $iTempPropertyId = $oUser->getAttribute('portal.temp_property_id',null);
        if(null===$iTempPropertyId) {
            $oUser->setAttribute('portal.temp_property_id', sha1($oUser->getUser()->getId().time()));
        }
        $iTempPropertyId = $oUser->getAttribute('portal.temp_property_id',null);

        $oForm = new FrontendPropertyForm();
        $this->form = $oForm;

        $this->aLang = LanguagePeer::getForPortal();


        $bActivate = $oRequest->getParameter('property_activate', true);
        $this->bActivate = $bActivate;

        if($oRequest->isMethod('POST')) {
            $oForm->bind($oRequest->getParameter($oForm->getName()), $oRequest->getFiles($oForm->getName()));
            if($oForm->isValid()) {
                /** @var Property $oProperty */
                $oProperty = $oForm->save();

                $iTempPropertyId = $oUser->getAttribute('portal.temp_property_id',null);
                $aImage = LinkPropertyImagePeer::retrieveByTempRef($iTempPropertyId);
                /** @var LinkPropertyImage $oImage */
                foreach($aImage as $oImage) {
                    $oImage->setProperty($oProperty);
                    $oImage->setTempRef(null);
                    $oImage->save();
                }


                // save image order
                $oProperty->sequenceImagesByOrder(explode(',',$oRequest->getParameter('property_image_order')));
                $oUser->setAttribute('portal.temp_property_id', sha1($oUser->getUser()->getId().time()));
                $iTempPropertyId = $oUser->getAttribute('portal.temp_property_id',null);

                if($oUser->hasCredential('ROLE_ASSOCIATION')) {
                    $oProperty->setAssociation($oUser->getUser()->getAssociation());
                }

                $oProperty->setUser($oUser->getUser());


                if($bActivate) {

                    if($oUser->hasCredential('ROLE_ASSOCIATION')) {
                        if(!$oProperty->getOnline()) {
                            $iActiveProperties = PropertyPeer::retrieveCountForProvider($oUser->getUser()->getAssociationId(), true);
                            if($iActiveProperties>=$oUser->getUser()->getAssociation()->getMaxProperties()) {
                                $oUser->setNotification('error', $oI18n->__('portal.notification.propertyaddedbutnotactivatedduetomaxonlinepropertiesinsubscriptionreached'));
                            } else {
                                $oProperty->setOnline(true);
                                $oUser->setNotification('info', $oI18n->__('portal.notification.propertyaddedandactivated'));
                            }
                        }
                    } else {
                        // @todo redirect to payment page
                        $oUser->setNotification('info', $oI18n->__('portal.notification.propertyadded'));
                    }
                } else {
                    $oUser->setNotification('info', $oI18n->__('portal.notification.propertyadded'));
                }

                $oProperty->save();

                if(!$oUser->hasCredential('ROLE_ASSOCIATION')) {
                    $oTransaction = new Transaction();
                    $oTransaction->setType(Transaction::TRANS_CONSUMERPROPERTY);
                    $oTransaction->setState(Transaction::STATE_PAID);
                    $oTransaction->setDescription("New property for consumer account " . $oProperty);
                    $oTransaction->setUserId($oUser->getUser()->getId());
                    $oTransaction->setProperty($oProperty);
                    $oTransaction->save();
                }

                $this->redirect('portal_properties');
            } else {
                $oUser->setNotification('error', $oI18n->__('notice.errorsinform'));
            }
        }

        $this->aImage = LinkPropertyImagePeer::retrieveByTempRef($iTempPropertyId);
        $aBc = array();
        $aBc[$this->generateUrl('portal_properties')] = $oI18n->__('portal.properties');
        $aBc[$this->generateUrl('portal_properties_add')] = $oI18n->__('text.addProperty');
        $this->getResponse()->setSlot('bc', $aBc);
    }


    public function executeEditProperty(sfWebRequest $oRequest) {
        $this->getResponse()->setSlot('menu_portal', 'properties');
        /** @var MSHWebsiteUser $oUser */

        $iProperty = $oRequest->getParameter('id',null);
        $oProperty = PropertyPeer::retrieveByPK($iProperty);

        $oUser = $this->getUser();

        $oI18n = $this->getContext()->getI18N();

        if($oUser->hasCredential('ROLE_ASSOCIATION')) {
            if($oProperty->getAssociationId() !== $oUser->getUser()->getAssociationId()) {
                $this->redirect404();
            }
        } else {
            if($oProperty->getUserId() !== $oUser->getUser()->getId()) {
                $this->redirect404();
            }
        }

        $oForm = new FrontendPropertyForm($oProperty);
        $this->form = $oForm;

        $this->aLang = LanguagePeer::getForPortal();
        $this->oProperty = $oProperty;

        if($oRequest->isMethod('POST')) {
            $oForm->bind($oRequest->getParameter($oForm->getName()), $oRequest->getFiles($oForm->getName()));
            if($oForm->isValid()) {
                $oForm->save();
                // save image order
                $oProperty->sequenceImagesByOrder(explode(',',$oRequest->getParameter('property_image_order')));
                $oUser->setNotification('info', $oI18n->__('portal.notification.propertysaved'));
                $this->redirect('portal_properties');
            } else {
                $oUser->setNotification('error', $oI18n->__('notice.errorsinform'));
            }
        }

        $aBc = array();
        $aBc[$this->generateUrl('portal_properties')] = $oI18n->__('portal.properties');
        $aBc[$this->generateUrl('portal_properties_edit', array('id' => $oProperty->getId()))] = $oProperty->getAddress1() . ', ' . $oProperty->getCity();
        $this->getResponse()->setSlot('bc', $aBc);
    }

    public function executeDeleteProperty(sfWebRequest $oRequest) {
        /** @var MSHWebsiteUser $oUser */

        $iProperty = $oRequest->getParameter('id',null);
        $oProperty = PropertyPeer::retrieveByPK($iProperty);

        $oUser = $this->getUser();
        if($oUser->hasCredential('ROLE_ASSOCIATION')) {
            if($oProperty->getAssociationId() !== $oUser->getUser()->getAssociationId()) {
                $this->redirect404();
            }
        } else {
            if($oProperty->getUserId() !== $oUser->getUser()->getId()) {
                $this->redirect404();
            }
        }

        $oProperty->delete();
        $this->redirect('portal_properties');
    }

    public function executeActivateProperty(sfWebRequest $oRequest) {
        /** @var MSHWebsiteUser $oUser */

        $iProperty = $oRequest->getParameter('id',null);
        $oProperty = PropertyPeer::retrieveByPK($iProperty);

        $oUser = $this->getUser();

        $oI18n = $this->getContext()->getI18N();

        if($oUser->hasCredential('ROLE_ASSOCIATION')) {
            if($oProperty->getAssociationId() !== $oUser->getUser()->getAssociationId()) {
                $this->redirect404();
            }

            if(!$oProperty->getOnline()) {
                $iActiveProperties = PropertyPeer::retrieveCountForProvider($oUser->getUser()->getAssociationId(), true);
                if($iActiveProperties>=$oUser->getUser()->getAssociation()->getMaxProperties()) {
                    $oUser->setNotification('info', $oI18n->__('portal.notification.maxonlinepropertiesinsubscriptionreached'));
                    $this->redirect('portal_properties');
                } else {
                    $oProperty->setOnline(true);
                    $oProperty->save();
                    $oUser->setNotification('info', $oI18n->__('portal.notification.propertyactivated'));
                    $this->redirect('portal_properties');
                }

            } else {
                $oUser->setNotification('info', $oI18n->__('portal.notification.propertyallreadyactivated'));
                $this->redirect('portal_properties');
            }


        } else {
            if($oProperty->getUserId() !== $oUser->getUser()->getId()) {
                $this->redirect404();
            }

            /** @var DateTime $oPaidUntil */
            $oPaidUntil = $oProperty->getPaidUntil(null);
            /*if(null==$oPaidUntil || $oPaidUntil->getTimestamp() < time()) {
                // need to pay again to put property online
            } else {*/
                $oProperty->setOnline(true);
                $oProperty->save();
                $oUser->setNotification('info', $oI18n->__('portal.notification.propertyactivated'));
                $this->redirect('portal_properties');
            //}
        }
    }

    public function executeDeactivateProperty(sfWebRequest $oRequest) {
        /** @var MSHWebsiteUser $oUser */

        $iProperty = $oRequest->getParameter('id',null);
        $oProperty = PropertyPeer::retrieveByPK($iProperty);

        $oUser = $this->getUser();

        $oI18n = $this->getContext()->getI18N();

        if($oUser->hasCredential('ROLE_ASSOCIATION')) {
            if($oProperty->getAssociationId() !== $oUser->getUser()->getAssociationId()) {
                $this->redirect404();
            }
        } else {
            if($oProperty->getUserId() !== $oUser->getUser()->getId()) {
                $this->redirect404();
            }
        }

        if($oProperty->getOnline()) {
            $oProperty->setOnline(false);
            $oProperty->save();
            $oUser->setNotification('info', $oI18n->__('portal.notification.propertydeactivated'));
        }
        $this->redirect('portal_properties');
    }

    public function executeUpsellProperty(sfWebRequest $oRequest) {
        $this->getResponse()->setSlot('menu_portal', 'properties');
        /** @var MSHWebsiteUser $oUser */

        $iProperty = $oRequest->getParameter('id',null);
        $oProperty = PropertyPeer::retrieveByPK($iProperty);

        $oUser = $this->getUser();

        $oI18n = $this->getContext()->getI18N();
        $iAvailCredits = 0;

        if($oUser->hasCredential('ROLE_ASSOCIATION')) {
            if($oProperty->getAssociationId() !== $oUser->getUser()->getAssociationId()) {
                $this->redirect404();
            }

            $iAvailCredits = $oUser->getUser()->getAssociation()->getAvailableCredits();

        } else {
            if($oProperty->getUserId() !== $oUser->getUser()->getId()) {
                $this->redirect404();
            }

            $iAvailCredits = $oUser->getUser()->getAvailableCredits();
        }

        $this->oProperty = $oProperty;


        if($oRequest->hasParameter('type')) {
            $sType = $oRequest->getParameter('type');
            if($sType == 'toprated') {
                $iCost = sfConfig::get('app_upsell_cost_toprated');
                if($iCost > $iAvailCredits) {
                    $oUser->setNotification('error', $oI18n->__('portal.notification.buymorecreditsfirst'));
                } else {
                    $oTransaction = new Transaction();
                    $oTransaction->setType(Transaction::TRANS_DEDUCTCREDITS);
                    $oTransaction->setCredits($iCost);
                    $oTransaction->setState(Transaction::STATE_PAID);
                    $oTransaction->setDescription("Upsell toprated property " . $oProperty);
                    if($oUser->hasCredential('ROLE_ASSOCIATION')) {
                        $oTransaction->setAssociationId($oUser->getUser()->getAssociationId());
                    }
                    $oTransaction->setUserId($oUser->getUser()->getId());
                    $oTransaction->setProperty($oProperty);
                    $oTransaction->save();

                    /** @var \DateTime $oDateTime */
                    $oDateTime = $oProperty->getPromotedUntil(null);
                    if(null===$oDateTime || $oDateTime->getTimestamp() < time()) {
                        $oProperty->setPromotedUntil(strtotime("+1 month"));
                    } else {
                        $oProperty->setPromotedUntil(strtotime("+1 month",$oDateTime->getTimestamp()));
                    }
                    $oProperty->save();

                    $oUser->setNotification('info', $oI18n->__('portal.notification.propertyisnowtoprated'));
                }

            } else if($sType == 'newsletter') {
                $iCost = sfConfig::get('app_upsell_cost_newsletter');
                if($iCost > $iAvailCredits) {
                    $oUser->setNotification('error', $oI18n->__('portal.notification.buymorecreditsfirst'));
                } else {
                    $oTransaction = new Transaction();
                    $oTransaction->setType(Transaction::TRANS_DEDUCTCREDITS);
                    $oTransaction->setCredits($iCost);
                    $oTransaction->setState(Transaction::STATE_PAID);
                    $oTransaction->setDescription("Upsell newsletter property " . $oProperty);
                    if($oUser->hasCredential('ROLE_ASSOCIATION')) {
                        $oTransaction->setAssociationId($oUser->getUser()->getAssociationId());
                    }
                    $oTransaction->setUserId($oUser->getUser()->getId());
                    $oTransaction->setProperty($oProperty);
                    $oTransaction->save();

                    $oNewsletterProperty = new NewsletterProperty();
                    $oNewsletterProperty->setProperty($oProperty);
                    $oProperty->save();

                    $oUser->setNotification('info', $oI18n->__('portal.notification.propertyisaddedtothenextnewsletter'));
                }
            }

            $this->redirect($this->generateUrl('portal_properties_upsell', array('id' => $iProperty)));
        }

        $aBc = array();
        $aBc[$this->generateUrl('portal_properties')] = $oI18n->__('portal.properties');
        $aBc[$this->generateUrl('portal_properties_upsell', array('id' => $oProperty->getId()))] = $oI18n->__('portal.text.upsellproperty') . ': ' . $oProperty->getAddress1() . ', ' . $oProperty->getCity();
        $this->getResponse()->setSlot('bc', $aBc);
    }

    public function executeUploadPropertyImage(sfWebRequest $oRequest) {
        sfConfig::set('sf_web_debug', false);
        $this->getResponse()->setContentType('application/json');
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();

        $iProperty = $oRequest->getParameter('id',null);

        if(null===$iProperty) {
            // adding property
            $iTempPropertyId = $oUser->getAttribute('portal.temp_property_id',null);
            if(null===$iTempPropertyId) {
                return $this->renderText(json_encode(array(
                    'status' => 'error',
                    'message' => "no temporary property id"
                )));
            }
        } else {
            $oProperty = PropertyPeer::retrieveByPK($iProperty);

            $oUser = $this->getUser();
            if($oUser->hasCredential('ROLE_ASSOCIATION')) {
                if($oProperty->getAssociationId() !== $oUser->getUser()->getAssociationId()) {
                    return $this->renderText(json_encode(array(
                        'status' => 'error',
                        'message' => "no access"
                    )));
                }
            } else {
                if($oProperty->getUserId() !== $oUser->getUser()->getId()) {
                    return $this->renderText(json_encode(array(
                        'status' => 'error',
                        'message' => "no access"
                    )));
                }
            }
        }



        $plupload = new kmFileUploader(
            $oRequest->getParameter('chunk', 0),
            $oRequest->getParameter('chunks', 0),
            $oRequest->getParameter('name', 'file.tmp')
        );

        $plupload->processUpload(
            $oRequest->getFiles($oRequest->getParameter('file-data-name', 'file')),
            $plupload->getContentType($oRequest)
        );

        if (!$plupload->isComplete())
        {
            return $this->renderText(json_encode(array(
                'status' => 'incomplete'
            )));
        }

        $oLinkPropertyImage = new LinkPropertyImage();

         if(null===$oProperty) {
            $index = $iTempPropertyId;
        } else {
            $index = $oProperty->getId();
        }
        
        $oSfImage = new sfImage($plupload->getFilePath());
        $oImage = Image::newFromSfImageWithWidthHeight($oSfImage, 'property',$index, 1024, 768);
        $oLinkPropertyImage->setImageId($oImage->getId());


        if(null===$oProperty) {
            $oLinkPropertyImage->setTempRef($iTempPropertyId);
            $oLinkPropertyImage->setSequence(LinkPropertyImagePeer::getMaxSequenceTemp($iTempPropertyId)+1);
        } else {
            $oLinkPropertyImage->setProperty($oProperty);
            $oLinkPropertyImage->setSequence(LinkPropertyImagePeer::getMaxSequence($oProperty->getId())+1);
        }

        $oLinkPropertyImage->save();

        return $this->renderText(json_encode(array(
            'status' => 'complete',
            'file' => $oImage->getFormatUrl(90, 60, true, false, $index),
            'file_big' => $oImage->getFormatUrl(1024, 768, true, false, $index),
            'id' => $oLinkPropertyImage->getId()
        )));

    }

    public function executeDeletePropertyImage(sfWebRequest $oRequest) {
        //sfConfig::set('sf_web_debug', false);
        $this->getResponse()->setContentType('application/json');
        /** @var MSHWebsiteUser $oUser */

        $iLinkImage = $oRequest->getParameter('id',null);
        $oLinkImage = LinkPropertyImagePeer::retrieveByPK($iLinkImage);
        if(null===$oLinkImage) {
            throw new Exception("could not find image: ". $iLinkImage);
        }

        $oProperty = $oLinkImage->getProperty();

        $oUser = $this->getUser();
        if($oUser->hasCredential('ROLE_ASSOCIATION')) {
            if(null===$oProperty) {
                $iTempPropertyId = $oUser->getAttribute('portal.temp_property_id',null);
                if($oLinkImage->getTempRef() !== $iTempPropertyId) {
                    throw new Exception("error");
                }
            }
            else if($oProperty->getAssociationId() !== $oUser->getUser()->getAssociationId()) {
                throw new Exception("error");
            }
        } else {
            if(null===$oProperty) {
                $iTempPropertyId = $oUser->getAttribute('portal.temp_property_id',null);
                if($oLinkImage->getTempRef() !== $iTempPropertyId) {
                    throw new Exception("error");
                }
            }
            else if($oProperty->getUserId() !== $oUser->getUser()->getId()) {
                throw new Exception("error");
            }
        }

        $oLinkImage->delete();

        return $this->renderText(json_encode(array(
            'status' => 'ok',
        )));
    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeConversions(sfWebRequest $oRequest) {
        $this->getResponse()->setSlot('menu_portal', 'conversions');
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        if($oUser->hasCredential('ROLE_ASSOCIATION')) {
            $this->aContact = ContactRequestPeer::retrieveForProvider($oUser->getUser()->getAssociationId(), 999999);
        } else {
            $this->aContact = ContactRequestPeer::retrieveForUser($oUser->getUser()->getId(), 999999);
        }

        $oI18n = $this->getContext()->getI18N();
        $aBc = array();
        $aBc[$this->generateUrl('portal_conversions')] = $oI18n->__('portal.conversions');
        $this->getResponse()->setSlot('bc', $aBc);
    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeShowConversion(sfWebRequest $oRequest) {
        $this->getResponse()->setSlot('menu_portal', 'conversions');
        /** @var MSHWebsiteUser $oUser */

        $iContact = $oRequest->getParameter('id',null);
        $oContact = ContactRequestPeer::retrieveByPK($iContact);

        $oUser = $this->getUser();
        if($oUser->hasCredential('ROLE_ASSOCIATION')) {
            if(null!== $oContact->getProperty()) {
                if($oContact->getProperty()->getAssociationId() !== $oUser->getUser()->getAssociationId()) {
                    $this->redirect404();
                }
            } else if(null!==$oContact->getDevelopment()) {
                if($oContact->getDevelopment()->getAssociationId() !== $oUser->getUser()->getAssociationId()) {
                    $this->redirect404();
                }
            } else if($oContact->getAssociationId() !== $oUser->getUser()->getAssociationId()) {
                $this->redirect404();
            }

        } else {
            if($oContact->getProperty()->getUserId() !== $oUser->getUser()->getId()) {
                $this->redirect404();
            }
        }
        $this->oContact = $oContact;

        $oI18n = $this->getContext()->getI18N();
        $aBc = array();
        $aBc[$this->generateUrl('portal_conversions')] = $oI18n->__('portal.conversions');
        $aBc[$this->generateUrl('portal_conversions_show', array('id' => $oContact->getId()))] = $oContact->getName();
        $this->getResponse()->setSlot('bc', $aBc);
    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeDeleteConversion(sfWebRequest $oRequest) {
        /** @var MSHWebsiteUser $oUser */

        $iContact = $oRequest->getParameter('id',null);
        $oContact = ContactRequestPeer::retrieveByPK($iContact);

        $oUser = $this->getUser();
        if($oUser->hasCredential('ROLE_ASSOCIATION')) {
            if(null!== $oContact->getProperty()) {
                if($oContact->getProperty()->getAssociationId() !== $oUser->getUser()->getAssociationId()) {
                    $this->redirect404();
                }
            } else if(null!==$oContact->getDevelopment()) {
                if($oContact->getDevelopment()->getAssociationId() !== $oUser->getUser()->getAssociationId()) {
                    $this->redirect404();
                }
            } else if($oContact->getAssociationId() !== $oUser->getUser()->getAssociationId()) {
                $this->redirect404();
            }

        } else {
            if($oContact->getProperty()->getUserId() !== $oUser->getUser()->getId()) {
                $this->redirect404();
            }
        }
        $oContact->delete();
        $sGoto = $oRequest->getParameter('goto', 'conversions');

        if($sGoto == 'conversions') {
            $this->redirect($this->generateUrl('portal_conversions'));
        } else {
            $this->redirect($this->generateUrl('portal_overview'));
        }

    }


    /** statistics */

    public function executeOauthCallback(sfWebRequest $oRequest)
    {
        $oAnalytics = GoogleAnalytics::getInstance($this->getUser(), true);


        if($oAnalytics->needsAccess()) {
            $sCode = $oRequest->getParameter("code",null);
            if($sCode == null) {
                $this->redirect($oAnalytics->getAccessRedirectUrl());
            }
            else {
                $oAnalytics->newAccess($sCode);
            }
        }
        //$this->
        return sfView::NONE;
    }

    public function executeStatistics(sfWebRequest $oRequest)
    {
        $oUser = $this->getUser();

        $oForm = new PortalStatisticsForm(array(), array('culture'=>'en'));
        
        //
        $this->getResponse()->setSlot('menu_portal','statistics');


        if($oRequest->isMethod('POST')) {
            $oForm->bind($this->getRequest()->getParameter($oForm->getName()));

            if($oForm->isValid()) {
                /** @var myUser $oUser  */

                $oUser->setGraphStartDate($oForm->getValue('startDate'));
                $oUser->setGraphEndDate($oForm->getValue('endDate'));
                $oUser->setGraphMetric($oForm->getValue('type'));
                $iCountry =$oForm->getValue('country');
                $oCountry = CountryPeer::retrieveByPK($iCountry);
                $sCountry = $oCountry == null ? '' : $oCountry->getTitle('en');
                if($sCountry == 'The Netherlands') {
                    $sCountry = 'Netherlands';
                }
                $oUser->setGraphCountry($sCountry);
                //$oUser->setGraphAssociation($oForm->getValue('association'));
            }
        }

        $this->sMetric = PortalStatisticsForm::$aTypes[$oUser->getGraphMetric()];
        //$this->sProvince = $oUser->getGraphProvince();

        $this->form = $oForm;

        $oI18n = $this->getContext()->getI18N();
        $aBc = array();
        $aBc[$this->generateUrl('portal_statistics')] = $oI18n->__('portal.statistics');
        $this->getResponse()->setSlot('bc', $aBc);
    }

    public function executeStatisticsGraph(sfWebRequest $oRequest) {
        $oProperty = null;
        //require_once('jpgraph.php');
        //require_once('jpgraph_line.php');
        //require_once('jpgraph_date.php');
        //require_once ('jpgraph_utils.inc.php');

        //setlocale(LC_TIME, 'nl_NL');

        /** @var myUser $oUser  */
        $oUser = $this->getUser();

        if($oUser->hasCredential("ROLE_ASSOCIATION")) {
            $sSearch = 'p#a:'.$oUser->getUser()->getAssociationId();
        } else {
            $sSearch = 'p#u:'.$oUser->getUser()->getId();
        }

        //$sStart = date('Y-m-d', strtotime($iYear."W".$iWeek."1"));
        //$sEnd = date('Y-m-d', strtotime($iYear."W".$iWeek."7"));

        $sStart = $oUser->getGraphStartDate();
        $sEnd = $oUser->getGraphEndDate();
        $sMetric = $oUser->getGraphMetric();
        $sCountry = $oUser->getGraphCountry();

        $oStartDate = new DateTime($sStart);
        $oEndDate = new DateTime($sEnd);
        $oDateDiff = $oStartDate->diff($oEndDate);

        if($oDateDiff->m > 6) {
            $sDateFormat = "M Y";
            $iTicks = 60*60*24*31;
            $iDateAlign = MONTHADJ_1;
            $iDateAlignEnd = MONTHADJ_1;
            $sDateCallback = "dateCallbackMonth";
        } else if($oDateDiff->m > 2){
            $sDateFormat = "W M";
            $iTicks = 60*60*24*7;
            $iDateAlign = DAYADJ_WEEK;
            $iDateAlignEnd = DAYADJ_WEEK;
            $sDateCallback = "dateCallbackWeek";
        } else {
            $sDateFormat = "d M";
            $iTicks = 60*60*24;
            $iDateAlign = DAYADJ_1;
            $iDateAlignEnd = DAYADJ_1;
            $sDateCallback = "dateCallbackDay";
        }

        function dateCallbackMonth($aVal) {
            $sMonth = Functions::getMonth(date('m',$aVal));
            return $sMonth . date(' Y',$aVal);
        }

        function dateCallbackWeek($aVal) {
            return date('\w\e\e\k W Y',$aVal);
        }

        function dateCallbackDay($aVal) {
            //setlocale(LC_TIME,"nl_NL");
            return date('d ',$aVal).Functions::getMonth(date('m',$aVal));
        }


        //$aResults = array();
        /*for($i=1; $i<=7; $i++) {
            $aResults[date('Ymd', strtotime($iYear."W".$iWeek.$i))] = 0;
        }*/

        $oAnalytics = GoogleAnalytics::getInstance($oUser);

        $aData = array();
        $aLabel = array();
        $aIndexes = array();

        if(!$oAnalytics->needsAccess()) {
            $aTotals = $oAnalytics->getEventActionGraphData($sSearch, $sStart, $sEnd, $sMetric, $sCountry);

            $i = 0;

            foreach($aTotals as $oTotals) {
                if(isset($oTotals->rows)) {
                    foreach($oTotals->rows as $aRow) {

                        if(!array_key_exists($aRow[0],$aIndexes)) {
                            $aIndexes[$aRow[0]] = $i;
                            $aLabel[$aIndexes[$aRow[0]]] = strtotime($aRow[0]);
                            $aData[$aIndexes[$aRow[0]]] = 0;
                            $i++;
                        }

                        $aData[$aIndexes[$aRow[0]]] += $aRow[1];

                        /*switch($sMetric) {
                            case "contact":
                                if($aRow[1] == "public_visit") {
                                    $aData[$aIndexes[$aRow[0]]] += $aRow[2];
                                } else if($aRow[1] == "contact") {
                                    $aData[$aIndexes[$aRow[0]]] += $aRow[2];
                                }
                                break;

                            default:
                                if($aRow[1] == $sMetric) {

                                }
                                break;
                        }*/
                    }
                }
            }

        }

        //die();



        //$dateUtils = new DateScaleUtils();
        // Setup the graph
        $graph = new Graph(725,350);
        $graph->SetScale("datint",0, max($aData));
        //$graph->SetScale("intlin", 0, 0, min($aLabel), max($aLabel));

        $theme_class=new UniversalTheme;

        $graph->SetTheme($theme_class);
        $graph->img->SetAntiAliasing(true);
        $graph->title->Set('');
        $graph->SetBox(false);

        $graph->img->SetAntiAliasing();

        $graph->yaxis->HideZeroLabel();
        $graph->yaxis->HideLine(false);
        $graph->yaxis->HideTicks(false,false);

        $graph->xgrid->Show();
        $graph->xgrid->SetLineStyle("solid");
        $graph->xaxis->SetLabelAngle(90);
        $graph->xaxis->SetLabelFormatCallback($sDateCallback);

        $graph->xaxis->scale->ticks->Set($iTicks);
        $graph->xaxis->scale->SetDateFormat($sDateFormat, true);
        $graph->xaxis->scale->SetDateAlign( $iDateAlign, $iDateAlignEnd );

        $graph->xgrid->SetColor('#E3E3E3');



        //list($tickPos, $minTickPos) = $dateUtils->getTicks($aLabel, DSUTILS_MONTH1);
        //$graph->xaxis->SetTickPositions($tickPos, $minTickPos);

        // Create the first line
        $p1 = new LinePlot($aData, $aLabel);
        //$p1->mark->SetType(MARK_X);
        $graph->Add($p1);
        $p1->SetColor("#FFC53C");
        //$p1->SetLineWeight(10);
        $p1->SetWeight(3);

        $sTitle = ($oProperty != null ? PortalStatisticsForm::$aTypes_single[$sMetric] : PortalStatisticsForm::$aTypes[$sMetric]) . ($sCountry != '' ? ' in ' . $sCountry : '');
        $p1->SetLegend($sTitle);

        $graph->legend->SetFrameWeight(1);
        $graph->legend->SetPos(0.05,0.05,'right','top');

        // Output line
        $graph->Stroke();
        return sfView::NONE;
    }

    /** profile */

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executePackage(sfWebRequest $oRequest) {
        //
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        $oI18n = $this->getContext()->getI18N();

        $oUser = $this->getUser();
        if(!$oUser->hasCredential('ROLE_ASSOCIATION')) {
            $this->redirect404();
        }


        $this->aLang = LanguagePeer::getForPortal();
        $oProvider = $oUser->getUser()->getAssociation();

        if($oRequest->isMethod("POST")) {
            $iNewPackage = $oRequest->getPostParameter('package', null);
            $iPackagePeriod = $oRequest->getParameter('contract_period', $oUser->getAttribute('register.package.period', null));


            /*$iActiveProperties = PropertyPeer::retrieveCountForProvider($oProvider->getId(), true);
            $iDevelopment = DevelopmentPeer::retrieveCountForProvider($oProvider->getId());

            $oContract = ContractPeer::retrieveByPK($iNewPackage);*/

            $oProvider->setContractId($iNewPackage);
            $oProvider->setContractPeriod($iPackagePeriod);
            $oProvider->save();

            $oUser->setNotification('info', $oI18n->__('portal.notification.packagechanged'));
            $this->redirect($this->generateUrl('portal_overview'));
        }

        $this->aPackage = ContractPeer::getActive();
        $this->iPackage = $oProvider->getContractId();
        $this->iPackagePeriod = $oProvider->getContractPeriod();



        $aBc = array();
        $aBc[$this->generateUrl('portal_profile')] = $oI18n->__('portal.title.profile');
        $this->getResponse()->setSlot('bc', $aBc);

    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeProfile(sfWebRequest $oRequest) {
        //
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        $oI18n = $this->getContext()->getI18N();

        $oUser = $this->getUser();
        if(!$oUser->hasCredential('ROLE_ASSOCIATION')) {
            $this->redirect404();
        }
        
        $this->aLang = LanguagePeer::getForPortal();
        $this->oProvider = $oUser->getUser()->getAssociation();
        
        // Generate missing translations
        AssociationI18n::generateMissingTranslations($this->oProvider, $this->aLang);
        
        $oForm = new FrontendAssociationForm($oUser->getUser()->getAssociation());

        if($oRequest->isMethod("POST")) {
            $oForm->bind($oRequest->getParameter($oForm->getName()), $oRequest->getFiles($oForm->getName()));
            if($oForm->isValid()) {
                $oAssociation = $oForm->save();
                $oAssociation->save();
                //$oForm = new FrontendAssociationForm($oAssociation);
                $oUser->setNotification('info', $oI18n->__('portal.notification.profilesaved'));
                $oForm = new FrontendAssociationForm($oUser->getUser()->getAssociation());
            }
        }
        
        $this->oForm = $oForm;

        $aBc = array();
        $aBc[$this->generateUrl('portal_profile')] = $oI18n->__('portal.title.profile');
        $this->getResponse()->setSlot('bc', $aBc);
        
        //
        $this->getResponse()->setSlot('menu_portal', 'profile');

    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeProfileAddEmployee(sfWebRequest $oRequest) {
        //
        /** @var MSHWebsiteUser $oUser */
        $oUser = $this->getUser();
        $oI18n = $this->getContext()->getI18N();


        if(!$oUser->hasCredential('ROLE_ASSOCIATION')) {
            $this->redirect404();
        }

        $oForm = new FrontendAssociationUserForm();

        if($oRequest->isMethod("POST")) {
            $oForm->bind($oRequest->getParameter($oForm->getName()), $oRequest->getFiles($oForm->getName()));
            if($oForm->isValid()) {

                /** @var User $oNewUser */
                $oNewUser = $oForm->save();
                $oNewUser->setTypeId(3);
                $oNewUser->setAssociationId($oUser->getUser()->getAssociationId());
                $oNewUser->save();
                $oUser->setNotification('info', $oI18n->__('portal.notification.employeeadded'));
                $this->redirect($this->generateUrl('portal_profile'));
            }
        }

        $this->aLang = LanguagePeer::getForPortal();
        $this->oForm = $oForm;
        $this->oProvider = $oUser->getUser()->getAssociation();

        $aBc = array();
        $aBc[$this->generateUrl('portal_profile')] = $oI18n->__('portal.title.profile');
        $aBc[$this->generateUrl('portal_profile_add_user')] = $oI18n->__('portal.title.addEmployee');
        $this->getResponse()->setSlot('bc', $aBc);

    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeProfileEditEmployee(sfWebRequest $oRequest) {
        //
        /** @var MSHWebsiteUser $oLoggedOnUser */
        $oLoggedOnUser = $this->getUser();
        $oI18n = $this->getContext()->getI18N();

        $iUser = $oRequest->getParameter('id');
        $oUser = UserPeer::retrieveByPK($iUser);

        if(!$oLoggedOnUser->hasCredential('ROLE_ASSOCIATION') || $oLoggedOnUser->getUser()->getAssociationId() !== $oUser->getAssociationId()) {
            $this->redirect404();
        }

        $oForm = new FrontendAssociationUserForm($oUser);

        if($oRequest->isMethod("POST")) {
            $oForm->bind($oRequest->getParameter($oForm->getName()), $oRequest->getFiles($oForm->getName()));
            if($oForm->isValid()) {
                $oUser = $oForm->save();
                $oLoggedOnUser->setNotification('info', $oI18n->__('portal.notification.employeesaved'));
                $this->redirect($this->generateUrl('portal_profile'));
            }
        }

        $this->aLang = LanguagePeer::getForPortal();
        $this->oForm = $oForm;
        $this->oProvider = $oLoggedOnUser->getUser()->getAssociation();
        $this->oUser = $oUser;

        $aBc = array();
        $aBc[$this->generateUrl('portal_profile')] = $oI18n->__('portal.title.profile');
        $aBc[$this->generateUrl('portal_profile_edit_user', array('id' => $oUser->getId()))] = $oI18n->__('portal.title.editEmployee');
        $this->getResponse()->setSlot('bc', $aBc);

    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeProfileDeleteEmployee(sfWebRequest $oRequest) {
        //
        /** @var MSHWebsiteUser $oLoggedOnUser */
        $oLoggedOnUser = $this->getUser();
        $oI18n = $this->getContext()->getI18N();

        $iUser = $oRequest->getParameter('id');
        $oUser = UserPeer::retrieveByPK($iUser);

        if(!$oLoggedOnUser->hasCredential('ROLE_ASSOCIATION') || $oLoggedOnUser->getUser()->getAssociationId() !== $oUser->getAssociationId() || $oLoggedOnUser->getUser()->getId() == $oUser->getId()) {
            $this->redirect404();
        }

        $oUser->delete();

        $oLoggedOnUser->setNotification('info', $oI18n->__('portal.notification.employeedeleted'));
        $this->redirect($this->generateUrl('portal_profile'));

    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeProfileConsumer(sfWebRequest $oRequest) {
        //
        /** @var MSHWebsiteUser $oLoggedOnUser */
        $oLoggedOnUser = $this->getUser();
        $oI18n = $this->getContext()->getI18N();

        if(!$oLoggedOnUser->hasCredential('ROLE_CONSUMER')) {
            $this->redirect404();
        }

        $oForm = new FrontendAssociationUserForm($oLoggedOnUser->getUser());

        if($oRequest->isMethod("POST")) {
            $oForm->bind($oRequest->getParameter($oForm->getName()), $oRequest->getFiles($oForm->getName()));
            if($oForm->isValid()) {
                $oUser = $oForm->save();
                $oLoggedOnUser->setNotification('info', $oI18n->__('portal.notification.profilesaved'));
                $this->redirect($this->generateUrl('portal_overview'));
            }
        }

        $this->aLang = LanguagePeer::getForPortal();
        $this->oForm = $oForm;
        $this->oProvider = $oLoggedOnUser->getUser()->getAssociation();

        $aBc = array();
        $aBc[$this->generateUrl('portal_profile')] = $oI18n->__('portal.title.profile');
        $this->getResponse()->setSlot('bc', $aBc);

    }


}
