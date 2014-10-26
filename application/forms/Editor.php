<?php

class Application_Form_Editor extends Zend_Form
{
public function init()
{
$this->setName('Edit Article');
$id = new Zend_Form_Element_Hidden('id');
$id->addFilter('Int');
$title = new Zend_Form_Element_Text('title');
$title->setLabel('Article Title')
->setRequired(true)
->addFilter('StripTags')
->addFilter('StringTrim')
->addValidator('NotEmpty')
->setAttrib('placeholder', 'Title: Capitalize Start of each word');


$content = new Zend_Form_Element_TextArea('content');
$content->setLabel('Article Content')
->setRequired(true)
->addFilter('StripTags')
->addFilter('StringTrim')
->addValidator('NotEmpty')
->setAttrib('placeholder', 'Please Paste here editor-ready Content...');
$this->addMyClass($content);
$this->addMyClass($title);

$submit = new Zend_Form_Element_Submit('save');
$submit->setAttrib('id', 'submitbutton');
$submit->setAttrib('class', 'ink-button blue all-33 aling-left');
			   $submit->setAttrib('style', 'margin-left:-20px');
$submit2 = new Zend_Form_Element_Submit('submit');
$submit2->setAttrib('id', 'submitbutton');
$submit2->setAttrib('class', 'ink-button blue all-33 aling-left');
			   $submit2->setAttrib('style', 'margin-left:-20px');

$this->setAttrib('class', 'ink-form control-group all-100');
 $this->setAttrib('style', 'margin:0 auto');
$this->addElements(array($id, $title, $content, $submit,$submit2));
}    

public function addMyClass($element){
$element->setDecorators( array(
    'Errors',
    'ViewHelper', 
    array( array( 'wrapperField' => 'HtmlTag' ), array( 'tag' => 'div', 'class' => 'control slab-700 required' ) ),
    array( 'Label', array( 'placement' => 'prepend', 'class' => ' slab-400 '  ) ),
    array( array( 'wrapperAll' => 'HtmlTag' ), array( 'tag' => 'div', 'class' => 'control-group required' ) ),
) );
}
}

