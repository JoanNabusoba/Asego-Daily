<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
	
        $email = $this->createElement('text','email');
        $email->setLabel('Email: ')
              ->setRequired(true);
 $email->setAttrib('placeholder', 'E.g. example@yahoo.com');
 $this->setAttrib('class', 'ink-form control-group all-33');
 $this->setAttrib('style', 'margin:auto');
 $this->addMyClass($email);

        $password = $this->createElement('password','password');
        $password->setLabel('Password: ')
                 ->setRequired(true);
 
        $signin = $this->createElement('submit','signin');
        $signin->setLabel('Sign in')
               ->setIgnore(true);
			   $signin->setAttrib('class', 'ink-button blue all-33 aling-left');
			   $signin->setAttrib('style', 'margin-left:-20px');
	$this->addMyClass($password);

        $this->addElements(array(
            $email,
            $password,
            $signin,
        ));
		
    }
public function addMyClass($element){
$element->setDecorators( array(
    'Errors',
    'ViewHelper',
    array( array( 'wrapperField' => 'HtmlTag' ), array( 'tag' => 'div', 'class' => 'control slab-700 required' ) ),
    array( 'Label', array( 'placement' => 'prepend', 'class' => ' slab-700 '  ) ),
    array( array( 'wrapperAll' => 'HtmlTag' ), array( 'tag' => 'div', 'class' => 'control-group required' ) ),
) );
}
}

