<?php
/**
 * Created by JetBrains PhpStorm.
 * User: simonsabelis
 * Date: 3/29/12
 * Time: 16:03
 * To change this template use File | Settings | File Templates.
 */
class PropertyBrochureForm extends sfForm
{
    public function configure() {
        parent::configure();

        /** @var Property $oProperty  */
        $oProperty = $this->getOption('oProperty');
        if($oProperty === null) {
            return;
        }

        $iMax = 9;

        $aChoices = array_keys(array_fill(0,$iMax,1));
        $aChoices = array_combine($aChoices, $aChoices);
        $aChoices[0] = '';

        $aWidgets = array();
        $aValidators = array();

        $aWidgets['impression'] = new sfWidgetFormChoice(array('choices' => $aChoices));
        $aValidators['impression'] = new sfValidatorChoice(array('choices' => array_keys($aChoices)));

        $aWidgets['details'] = new sfWidgetFormChoice(array('choices' => $aChoices));
        $aValidators['details'] = new sfValidatorChoice(array('choices' => array_keys($aChoices)));

        $aWidgets['content'] = new sfWidgetFormChoice(array('choices' => $aChoices));
        $aValidators['content'] = new sfValidatorChoice(array('choices' => array_keys($aChoices)));

        $aWidgets['map'] = new sfWidgetFormChoice(array('choices' => $aChoices));
        $aValidators['map'] = new sfValidatorChoice(array('choices' => array_keys($aChoices)));

        $aWidgets['neighbourhood_information'] = new sfWidgetFormChoice(array('choices' => $aChoices));
        $aValidators['neighbourhood_information'] = new sfValidatorChoice(array('choices' => array_keys($aChoices)));

        $aWidgets['offers'] = new sfWidgetFormChoice(array('choices' => $aChoices));
        $aValidators['offers'] = new sfValidatorChoice(array('choices' => array_keys($aChoices)));

        $aWidgets['contact_info'] = new sfWidgetFormChoice(array('choices' => $aChoices));
        $aValidators['contact_info'] = new sfValidatorChoice(array('choices' => array_keys($aChoices)));

        $aWidgets['photos'] = new sfWidgetFormChoice(array('choices' => $aChoices));
        $aValidators['photos'] = new sfValidatorChoice(array('choices' => array_keys($aChoices)));


        $aWidgets['custom_content'] = new sfWidgetFormChoice(array('choices' => array(0 => 'Gebruik originele omschrijving', 1 => 'Pas omschrijving aan'), 'expanded' => true));
        $aValidators['custom_content'] = new sfValidatorChoice(array('choices' => array(0,1)));
        $aValidators['impression'] = new sfValidatorChoice(array('choices' => array_keys($aChoices)));
        $aWidgets['content_edit'] = new sfWidgetFormTextarea(array(),array('class' => 'tinymce'));

        $aValidators['content_edit'] = new sfValidatorString(array('required' => false));

        $aWidgets['singlepage'] = new sfWidgetFormInputHidden();
        $aValidators['singlepage'] = new sfValidatorPass();


        $aImages = $oProperty->getImages();

        $iMax = sizeof($aImages);

        $aChoices = array_keys(array_fill(0,$iMax+1,1));
        $aChoices = array_combine($aChoices, $aChoices);
        $aChoices[0] = '';


        foreach($aImages as $oImage) {
            $aWidgets['photo_sequence_'.$oImage->getId()] = new sfWidgetFormChoice(array('choices' => $aChoices));

            $aValidators['photo_sequence_'.$oImage->getId()] = new sfValidatorChoice(array('choices'=> array_keys($aChoices)));
        }

        $this->setWidgets($aWidgets);
        $this->setValidators($aValidators);

        if($oProperty->getBrochureContent() == null) {
            $this->widgetSchema->setDefault('content_edit', $oProperty->getContent());
        } else {
            $this->widgetSchema->setDefault('content_edit', $oProperty->getBrochureContent());
        }

        $this->widgetSchema->setDefault('custom_content', 0);

        $this->widgetSchema->setNameFormat("property_brochure[%s]");
    }
}
