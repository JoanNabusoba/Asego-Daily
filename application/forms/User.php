<?php

class Application_Form_User extends Zend_Form
{

    public function init()
    {
$this->setName('Users');
$id = new Zend_Form_Element_Hidden('id');
$id->addFilter('Int');
$email = new Zend_Form_Element_Text('email');
$email->setLabel('Email')
->setRequired(true)
->addFilter('StripTags')
->addFilter('StringTrim')
->addValidator('NotEmpty');
$role = new Zend_Form_Element_Text('role');
$role->setLabel('Role')
->setRequired(true)
->addFilter('StripTags')
->addFilter('StringTrim')
->addValidator('NotEmpty');
$this->addMyClass($role);
$this->addMyClass($email);
$submit = new Zend_Form_Element_Submit('submit');
$submit->setAttrib('id', 'submitbutton');
$submit->setAttrib('class', 'ink-button blue all-33 aling-left');
			   $submit->setAttrib('style', 'margin-left:-20px');
$this->setAttrib('class', 'ink-form control-group all-33');
 $this->setAttrib('style', 'margin:0 auto');
$this->addElements(array($id, $email, $role, $submit));
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

