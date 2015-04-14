<?php
/**
 * Created by JetBrains PhpStorm.
 * User: simonsabelis
 * Date: 4/26/13
 * Time: 10:43
 * To change this template use File | Settings | File Templates.
 */

class FrontendAssociationUserForm extends BaseUserForm{

    public function configure()
    {
        parent::configure();

        unset($this['salt']);
        unset($this['type_id']);
        unset($this['association_id']);

        $oI18n = sfContext::getInstance()->getI18N();

        $this->widgetSchema['password'] = new sfWidgetFormInputPassword();
        $this->widgetSchema['password_confirm'] = new sfWidgetFormInputPassword();

        if(!$this->isNew()) {
            $this->validatorSchema['password']->setOption('required', false);
        }

        $this->validatorSchema['email_address'] = new sfValidatorEmail();
        $this->validatorSchema['password_confirm'] = new sfValidatorPass();

        $this->widgetSchema['image_id'] = new sfWidgetFormInputFileEditable(array(
            'file_src'     => $this->getObject()->getImage() ? $this->getObject()->getImage()->getFormat(200, 200, true)->getFile() : '',
            'is_image'     => true,
            'edit_mode'    => $this->getObject()->getImage(),
            'with_delete'  => !$this->isNew(),
            'delete_label' => $oI18n->__('portal.profile.removeemployeephoto'),
            'template'     => '%file%<br />%delete% %delete_label%<br /><br />%input%'
        ));
        $this->validatorSchema['image_id'] = new sfValidatorFile(
            array(
                'required'   => false,
                'path'       => sfConfig::get('sf_upload_dir') . '/temp',
                'mime_types' => 'web_images'
            ),
            array(
                'required'   => 'No image has been uploaded',
                'invalid'    => 'The image is invalid',
                'max_size'   => 'The image is to big in size (max %max_size% bytes)',
                'mime_types' => 'The image has an incorrect extension'
            )
        );
        $this->validatorSchema['image_id_delete'] = new sfValidatorPass();


        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array(
            'callback' => array($this, 'checkRegistration'),
        )));
    }

    public function checkRegistration($validator, $values) {

        $oI18n = sfContext::getInstance()->getI18N();

        $errors = array();

        if($values['password'] !== $values['password_confirm']) {
            $errors['password'] = new sfValidatorError($validator, 'De wachtwoorden komen niet overeen');
        }

        $oExistingUser = UserPeer::retrieveByEmail($values['personal_email']);
        if(null!==$oExistingUser && (null===$this->getObject() || $this->getObject()->getId()!==$oExistingUser->getId())) {
            $errors['personal_email'] = new sfValidatorError($validator, $oI18n->__('portal.form.error.emailadressinuse'));
        }


        if(sizeof($errors) > 0) {
            throw new sfValidatorErrorSchema($validator, $errors);
        }
        return $values;
    }

    public function updateObject($oConnection = NULL){

        parent::updateObject();

        $oImage = $this->getObject()->getImage();


        if($this->isValid() && ($this->getValue('image_id') !== NULL || $this->getValue('image_id_delete') !== NULL)){

            $this->getObject()->setImageId(NULL);
            $this->getObject()->save      ();

            if($oImage) $oImage->delete();

            $oUpload = $this->getValue('image_id');

            if(is_object($oUpload) && !$this->getValue('image_id_delete')){

                $oSfImage = new sfImage($oUpload->getSavedName());
                $oImage = Image::newFromSfImage($oSfImage,"user","",null,(string)$this->getObject());
                $this->getObject()->setImageId($oImage->getId());
            }
        }



        $this->getObject()->save();

    }

}