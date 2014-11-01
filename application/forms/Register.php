<?php

class Application_Form_Register extends Zend_Form
{

    public function init()
    {
    	//email element
     $email = $this->createElement('text','email');
     $email->setLabel('Email: ')
              ->setRequired(true);
 $email->setAttrib('placeholder', 'E.g. someone@example.com')
 ->setOrder(1);
 //name Element
 $fname = $this->createElement('text','fname');
     $fname->setLabel('First Name: ')
              ->setRequired(true);
 $fname->setAttrib('placeholder', 'John')
->setOrder(2);

 $lname = $this->createElement('text','lname');
     $lname->setLabel('Last Name: ')
              ->setRequired(true);
 $lname->setAttrib('placeholder', 'Smith')
->setOrder(3);
//styling the form
 $this->setAttrib('class', 'ink-form control-group all-40');
 $this->setAttrib('style', 'margin:auto');
 $this->addMyClass($email);
  $this->addMyClass($lname);
   $this->addMyClass($fname);



        $password = $this->createElement('password','password', array(
'filters' => array('StringTrim'),
'validators' => array(
array('Alnum'),
array('StringLength', false, array(6, 100))
)));
         $password->setAttrib('placeholder', '**********')
->setOrder(4);
        $password->setLabel('Password: ')
                 ->setRequired(true);
 $password_confirm = $this->createElement('password','password_confirm', array(
'filters' => array('StringTrim'),
'validators' => array(
array('Alnum'),
array('StringLength', false, array(6, 100)), array('identical',false, array('token' => 'password')))));
$password_confirm ->getValidator('identical')->setMessage('Sorry! Passwords do not match!');
        $password_confirm->setLabel('Confirm Password: ')
                 ->setRequired(true)
                 ->setOrder(5);
          $password_confirm->setAttrib('placeholder', '**********');

        $signup = $this->createElement('submit','signin');
        $signup->setLabel('Sign in')
               ->setIgnore(true);
			   $signup->setAttrib('class', 'ink-button blue all-33 aling-left');
			   $signup->setAttrib('style', 'margin-left:-20px')
               ->setOrder(6);
	$this->addMyClass($password);
	$this->addMyClass($password_confirm);

        $this->addElements(array(
            $email,
            $fname,
            $lname,
            $password,
            $password_confirm,
            $signup,
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

