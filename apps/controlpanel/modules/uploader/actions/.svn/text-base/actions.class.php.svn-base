<?php


/**
 * linkpropertyimage actions.
 *
 * @package    vindjeplek
 * @subpackage linkpropertyimage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class linkpropertyimageActions extends kmActions
{



    public function executeUpload(sfWebRequest $oRequest){

        $sHash = $oRequest->getPostParameter('hash', false);
        $this->forward404Unless($sHash);

        $oLinkPropertyImage = new LinkPropertyImage();

        $aHashParts     = explode('#', $sHash);
        $sType          = $aHashParts[0];
        $iObjectId      = $aHashParts[1];
        $sPropertyHash  = $aHashParts[2];


        $this->forward404Unless($sType == "property");

        $iSlot = $oRequest->getPostParameter('slot', null);

        sfContext::getInstance()->getLogger()->info("Uploading image for slot: " . $iSlot);


        if($iObjectId) {
            $oLinkPropertyImage->setPropertyId($iObjectId);
        } else {
            $oLinkPropertyImage->setTempRef($sPropertyHash);
        }

        $oForm = new PropertyImageNewForm($oLinkPropertyImage);
        if($oRequest->isMethod('POST')) {
            $oForm->bind($oRequest->getParameter($oForm->getName()), $oRequest->getFiles($oForm->getName()));
            if($oForm->isValid()) {
                $oLinkPropertyImage = $oForm->save();
                if($iSlot !== null) {
                    $oLinkPropertyImage->setSequence(($iSlot+1));
                    $oLinkPropertyImage->save();
                }
            }
            else {
                // send error message back to uploader
                echo "error#".$oRequest->getParameter('name','').' '.$oForm['image_id']->getError();
                sfContext::getInstance()->getLogger()->err("image upload failed!: " .var_export($oForm['image_id']->renderError(), true));
                exit();
            }
        }

        /** @var LinkPropertyImage $oLinkPropertyImage */
        echo($oLinkPropertyImage->getImage()->getFormatUrl(48, 35, false) . "#" . $oLinkPropertyImage->getId(), $oLinkPropertyImage->getImportId());

        exit();

    }

    public function executeCancel(sfWebRequest $oRequest) {
        $sId = $oRequest->getPostParameter("id",false);
        $this->forward404Unless($sId);
        sfContext::getInstance()->getLogger()->log("Deleting image: ". $sId);

        $oLinkPropertyImage = LinkPropertyImagePeer::retrieveByPK($sId);
        $oLinkPropertyImage->delete();
        $iSequence = $oLinkPropertyImage->getSequence();
        if($oLinkPropertyImage->getProperty() !== null) {
            $aLinkedImages = LinkPropertyImagePeer::retrieveByPropertyId($oLinkPropertyImage->getPropertyId());
        } else {
            $aLinkedImages = LinkPropertyImagePeer::retrieveByTempRef($oLinkPropertyImage->getTempRef());
        }

        /** @var LinkPropertyImage $oLinkedImage */
        foreach($aLinkedImages as $oLinkedImage) {
            if($oLinkedImage->getSequence() > $iSequence) {
                $oLinkedImage->setSequence($oLinkedImage->getSequence()-1);
                $oLinkedImage->save();
            }
        }
        exit;
    }
}
