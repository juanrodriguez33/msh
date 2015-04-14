<?php

class Sign_inForm extends sfForm{
	
	public function configure(){
		
		$this->setWidgets(array(
			'user'     => new sfWidgetFormInput        (array(), array('class' => 'w450')),
			'password' => new sfWidgetFormInputPassword(array(), array('class' => 'w300'))
		));
		$this->widgetSchema->setNameFormat('sign_in[%s]');
		
		$this->widgetSchema->setLabels(array(
			'user'     => 'E-mailadres',
			'password' => 'Wachtwoord'
		));
		
		$this->setValidators(array(
			'user' => new sfValidatorAnd(
				array(
					new sfValidatorEmail(array(), array('invalid' => 'Het e-mailadres is ongeldig')),
					new sfValidatorCallback(
						array(
							'callback'  => array('kmValidatorSign_in', 'execute'),
							'arguments' => array('password' => sfContext::getInstance()->getRequest()->getPostParameter('sign_in[password]'))
						),
						array('invalid' => 'De gebruikersnaam of het wachtwoord is incorrect')
					)
				),
				array('required' => true),
				array('required' => 'Er is geen e-mailadres ingevoerd')
			),
			'password' => new sfValidatorString(array(), array('required' => 'Er is geen wachtwoord ingevoerd'))
		));
		
	}
	
}