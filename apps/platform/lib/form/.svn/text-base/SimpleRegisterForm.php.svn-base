<?php
/**
 * Created by JetBrains PhpStorm.
 * User: simonsabelis
 * Date: 4/26/13
 * Time: 10:43
 * To change this template use File | Settings | File Templates.
 */

class SimpleRegisterForm extends sfForm{

    public function setup() {

        $oI18n = sfContext::getInstance()->getI18N();

        $aChoice = array('private' => $oI18n->__('portal.title.accounttypeprivate'), 'business' => $oI18n->__('portal.title.accounttypebusiness'));
        $this->setWidgets(array(

            'account_type'                  => new sfWidgetFormChoice(array('choices' => $aChoice, 'expanded' => true),array('class' => 'w280')),
            'company_name'                  => new sfWidgetFormInputText(array(),array('class' => 'w280')),
            'personal_email'                => new sfWidgetFormInputText(array(),array('class' => 'w280')),
            'personal_surname'              => new sfWidgetFormInputText(array(),array('class' => 'w280')),

        ));
        $this->setValidators(array(
            'account_type'            => new sfValidatorChoice(array('choices' => array_keys($aChoice))),
            'company_name'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'personal_email'          => new sfValidatorEmail(array('max_length' => 255, 'required' => true)),
            'personal_surname'        => new sfValidatorString(array('max_length' => 255, 'required' => true)),
        ));

        $this->widgetSchema->setLabels(array(
            'company_name' => $oI18n->__('portal.formlabel.company_name'),
            'personal_email' => $oI18n->__('portal.formlabel.personal_email'),
            'personal_surname' => $oI18n->__('portal.formlabel.personal_surname'),
        ));

        $this->widgetSchema->setNameFormat("simple_register[%s]");

    }

    public function configure()
    {
        /** @var MSHWebsiteUser $oUser */
        $oUser = sfContext::getInstance()->getUser();
        $oI18n = sfContext::getInstance()->getI18N();
        $oRequest = sfContext::getInstance()->getRequest();



        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array(
            'callback' => array($this, 'checkRegistration'),
        )));
    }

    public function checkRegistration($validator, $values) {

        $oI18n = sfContext::getInstance()->getI18N();

        $errors = array();

        if($values['account_type'] == 'business') {
            if(strlen(trim($values['company_name'])) == 0) {
                $errors['company_name'] = new sfValidatorError($validator, 'required');
            }
        }

        $oExistingUser = UserPeer::retrieveByEmail($values['personal_email']);
        if(strlen(trim($values['personal_email']))!=0 && null!==$oExistingUser) {
            $errors['personal_email'] = new sfValidatorError($validator, $oI18n->__('portal.form.error.emailadressinuse'));
        }


        if(sizeof($errors) > 0) {
            throw new sfValidatorErrorSchema($validator, $errors);
        }
        return $values;
    }

}