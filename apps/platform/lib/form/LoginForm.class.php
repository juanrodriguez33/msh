<?php

class LoginForm extends sfForm{
	
	public function configure(){
		
		$this->setWidgets(array(
			'user'     => new sfWidgetFormInput        (array(), array('class' => 'w450')),
			'password' => new sfWidgetFormInputPassword(array(), array('class' => 'w300'))
		));
		$this->widgetSchema->setNameFormat('sign_in[%s]');
		
		$this->setValidators(array(
			'user' => new sfValidatorAnd(
				array(
					new sfValidatorEmail(),
					new sfValidatorCallback(
						array(
							'callback'  => array('LoginValidator', 'execute'),
							'arguments' => array('password' => sfContext::getInstance()->getRequest()->getPostParameter('sign_in[password]'))
						)
					)
				),
				array('required' => true)
			),
			'password' => new sfValidatorString(array())
		));
		
	}
	
}