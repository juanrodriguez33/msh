<?php
/**
 * Created by JetBrains PhpStorm.
 * User: simonsabelis
 * Date: 4/26/13
 * Time: 10:43
 * To change this template use File | Settings | File Templates.
 */

class AskQuestionForm extends QuestionForm{

    public function configure()
    {
        parent::configure();
        
        // ValidatorSchema
        $this->validatorSchema['title'] = new sfValidatorString(array(
            'max_length' => 30, 
            'required' => false
        ));
        

        unset($this['language_id']);
        unset($this['country_id']);

        $this->widgetSchema['category_id'] = new sfWidgetFormPropelChoice(
            array('add_empty' => true, 'model' => 'Category', 'criteria' => CategoryPeer::retrieveByMainCriteria(CategoryPeer::retrieveByIsPhase3Criteria()) )
        );
    }
}