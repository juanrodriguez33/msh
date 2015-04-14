<?php
/**
 * Created by JetBrains PhpStorm.
 * User: simonsabelis
 * Date: 12/6/11
 * Time: 10:30
 * To change this template use File | Settings | File Templates.
 */
class PropertyImageNewForm extends LinkPropertyImageForm
{

    public function configure() {
        parent::configure();

        unset($this['temp_ref']);
        unset($this['property_id']);
        unset($this['sequence']);
        $iMaxSizeMB = 5;

        $this->validatorSchema['image_id'] = new sfValidatorFile(
            array(
                'max_size'   => $iMaxSizeMB * 1024 * 1024,
                'required'   => false,
                'path'       => sfConfig::get('sf_upload_dir') . '/temp',
                'mime_types' => 'web_images'
            ),
            array(
                'invalid'    => 'De afbeelding is ongeldig',
                'max_size'   => 'is te groot, selecteer een bestand van maximaal '.$iMaxSizeMB.' MB',
                'mime_types' => 'De afbeelding heeft een verkeerde bestandsextensie'
            )
        );

        $this->widgetSchema->setNameFormat("property_image[%s]");
    }

    public function updateObject($oConnection = NULL) {

        parent::updateObject($oConnection);

        if($this->isValid() && ($this->getValue('image_id') !== NULL)){

            sfContext::getInstance()->getLogger()->log("Saving Image");
            $oUpload = $this->getValue('image_id');
            if(is_object($oUpload)){

                $oSfImage = new sfImage($oUpload->getSavedName());
                $oProperty = $this->getObject()->getProperty();

                if($oProperty !== null) {
                    $oImage = Image::newFromSfImage($oSfImage, 'woning', $oProperty->getImportId(), $oProperty->getId(), null);
                } else {
                    $oImage = Image::newFromSfImage($oSfImage, 'woning', $oProperty->getImportId(), $this->getObject()->getTempRef(),null);
                }

                $this->getObject()->setImageId($oImage->getId());
            }
        }

        return $this->getObject();
    }
}
