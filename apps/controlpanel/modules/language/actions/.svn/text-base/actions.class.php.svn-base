<?php

require_once dirname(__FILE__).'/../lib/languageGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/languageGeneratorHelper.class.php';

/**
 * language actions.
 *
 * @package    mysecondhome
 * @subpackage language
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class languageActions extends autoLanguageActions
{
    public function executeListTranslations(sfWebRequest $oRequest) {
        $iLanguage = $oRequest->getParameter('id', null);
        $this->redirect('translations_edit', array('id' => $iLanguage));
    }
    public function executeTranslations(sfWebRequest $oRequest) {

        $sBaseDir = sfConfig::get('sf_apps_dir');

        ini_set('max_input_vars', 10000);

        $iLanguage = $oRequest->getParameter('id', null);
        $oLanguage = LanguagePeer::retrieveByPK($iLanguage);
        if(null===$oLanguage) {
            $this->forward404();
        }
        $this->oLanguage = $oLanguage;

        $oMessageSource = sfMessageSource::factory('XLIFF', $sBaseDir.'/platform/i18n');
        $oMessageSource->setCulture('en');
        $oMessageSource->load();

        $bMainLang = false;

        $aMessagesEN = array_shift(array_values($oMessageSource->read()));

        if($oLanguage->getCulture() !== 'en') {
            $oMessageSource->setCulture($oLanguage->getCulture());
            $oMessageSource->load();
            $aMessagesCulture = array_shift(array_values($oMessageSource->read()));
            /*if(null===$aMessagesCulture) {
                $aMessagesCulture = array();
            }*/
        } else {
            $aMessagesCulture = $aMessagesEN;
            $bMainLang = true;
        }

        $oForm = new sfForm();

        foreach($aMessagesEN as $sSource => $aDescr) {

            $oForm->setWidget($sSource.'_value', new sfWidgetFormInputText());
            $oForm->setValidator($sSource.'_value', new sfValidatorString(array('required' => false)));
            $oForm->setDefault($sSource.'_value', isset($aMessagesCulture[$sSource]) && !empty($aMessagesCulture[$sSource][0]) ? $aMessagesCulture[$sSource][0] : $aDescr[0]);

            if($bMainLang) {
                $oForm->setWidget($sSource.'_comment', new sfWidgetFormInputText());
                $oForm->setValidator($sSource.'_comment', new sfValidatorString(array('required' => false)));
                $oForm->setDefault($sSource.'_comment', $aMessagesCulture[$sSource][2]);
            }

        }

        $this->bMainLang = $bMainLang;
        $oForm->getWidgetSchema()->setNameFormat('translations_'.$oLanguage->getCulture().'[%s]');

        $this->oForm = $oForm;
        $this->aMessagesEN = $aMessagesEN;

        $aValues = $oRequest->getParameter($oForm->getName());

        if($oRequest->isMethod('POST')) {

            $oForm->bind($oRequest->getParameter($oForm->getName()));
            if($oForm->isValid()) {
                foreach($aMessagesEN as $sSource => $aDescr) {
                    if($bMainLang) {
                        $oMessageSource->update($sSource, $oForm->getValue($sSource.'_value'), $oForm->getValue($sSource.'_comment'));
                    } else {
                        if(!array_key_exists($sSource, $aMessagesCulture)) {
                            $oMessageSource->append($sSource);
                        }
                        $oMessageSource->update($sSource, $oForm->getValue($sSource.'_value'), $aDescr[2]);

                    }
                }
                $oMessageSource->save();
            }
        }
    }

}
