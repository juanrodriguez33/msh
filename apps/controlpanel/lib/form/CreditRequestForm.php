<?php
/**
 * Created by JetBrains PhpStorm.
 * User: simonsabelis
 * Date: 12/8/11
 * Time: 11:19
 * To change this template use File | Settings | File Templates.
 */
class CreditRequestForm extends sfForm {

    public function configure(){

        $aChoices = array();

        $aChoices[10] = "10 woningplaatsingen voor &euro; 150,- per stuk";
        $aChoices[25] = "25 woningplaatsingen voor &euro; 135,- per stuk";
        $aChoices[50] = "50 woningplaatsingen voor &euro; 120,- per stuk";
        $aChoices[100] = "100 woningplaatsingen voor &euro; 100,- per stuk";
        $aChoices["anders"] = "Meer woningplaatsingen";
        
        $this->setWidgets(array(
            'amount'        => new sfWidgetFormSelectRadio(array('choices' => $aChoices)),
            'content'       => new sfWidgetFormTextarea()
        ));
        $this->widgetSchema->setNameFormat('credit[%s]');

        $this->widgetSchema->setLabels(array(
            'amount'        => 'Aantal',
            'content'       => 'Bericht'
        ));

        $this->setValidators(array(
            'amount'        => new sfValidatorChoice(array('choices' => array_keys($aChoices))),
            'content'       => new sfValidatorString(array('required' => false)),
        ));

    }

}
