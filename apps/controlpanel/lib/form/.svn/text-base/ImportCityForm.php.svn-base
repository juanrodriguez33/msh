<?php
/**
 * Created by JetBrains PhpStorm.
 * User: simonsabelis
 * Date: 12/8/11
 * Time: 11:19
 * To change this template use File | Settings | File Templates.
 */
class ImportCityForm extends sfForm {

    public function configure(){

        $this->setWidgets(array(
            'file'        => new sfWidgetFormInputFile(),
        ));
        $this->widgetSchema->setNameFormat('credit[%s]');

        $this->widgetSchema->setLabels(array(
            'file'        => 'Importfile',
        ));

        $this->setValidators(array(
            'file'        => new sfValidatorFile(array('required' => true))
        ));

    }

}
