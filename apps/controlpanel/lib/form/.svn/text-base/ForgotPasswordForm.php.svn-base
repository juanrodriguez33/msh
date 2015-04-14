<?php

class ForgotPasswordForm extends sfForm{
	
	public function configure(){
		
		$this->setWidgets(array(
			'user'     => new sfWidgetFormInput        (array(), array('class' => 'w450')),
		));
		$this->widgetSchema->setNameFormat('forgot_password[%s]');
		
		$this->widgetSchema->setLabels(array(
			'user'     => 'E-mailadres',
		));
		
		$this->setValidators(array(
			'user' => new sfValidatorAnd(
				array(
					new sfValidatorEmail(array(), array('invalid' => 'Het e-mailadres is ongeldig')),
					new sfValidatorCallback(
						array(
							'callback'  => array('kmValidatorForgotPassword', 'execute'),
							'arguments' => array()
						),
						array('invalid' => 'Er is een onbekend e-mailadres ingevoerd')
					)
				),
				array('required' => true),
				array('required' => 'Er is geen e-mailadres ingevoerd')
			)
		));
		
	}
	
}