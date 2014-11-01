<?php
 /*adds news items*/

class EditorController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

     /*innitialize database action*/
    public function indexAction()
    {
    $news = new Application_Model_DbTable_News();

        $this->view->all = $news ->fetchAll();

    }


     /*add news items to the database*/
    public function addAction()
    {
        $form = new Application_Form_Editor();

	    $this->view->form = $form;
        $news = new Application_Model_DbTable_News();

$this->view->normal = $news ->fetchAll("status='published' and type='normal'");
$this->view->subscribed = $news ->fetchAll("status='published' and type='subscribed'");
$form->submit->setLabel('Add');
$this->view->form = $form;
if ($this->getRequest()->isPost()) {
$formData = $this->getRequest()->getPost();
if ($form->isValid($formData)) {
$title = $form->getValue('title');
$content = $form->getValue('content');
$id = $this->getId();
$id2 = "0";
$status = 'submitted';
$rnd = substr(SHA1(mt_rand()),0, 3);
$newsarticle = new Application_Model_DbTable_News();

/* Uploading Document File on Server */
 $upload = new Zend_File_Transfer_Adapter_Http();
 $upload->setDestination("images");
 try {
 // upload received file(s)
 $upload->receive();
 } catch (Zend_File_Transfer_Exception $e) {
 $e->getMessage();
 }

 // so, Finally lets See the Data that we received on Form Submit
 $uploadedData = $form->getValues();
 Zend_Debug::dump($uploadedData, 'Form Data:');


 # Returns the file name for 'doc_path' named file element
 $name = $upload->getFileName('myimages');

 # Returns the size for 'doc_path' named file element 
 # Switches of the SI notation to return plain numbers
  $size = $upload->getFileSize('myimages');

 # Returns the mimetype for the 'doc_path' form element
 $mimeType = $upload->getMimeType('myimages');

 // following lines are just for being sure that we got data
 print "Name of uploaded file: $name 
";
 print "File Size: $size 
";
 print "File's Mime Type: $mimeType";

 // New Code For Zend Framework :: Rename Uploaded File
 $renameFile = $rnd.'image.jpg';

 $fullFilePath = 'images/'.$renameFile;

 // Rename uploaded file using Zend Framework
 $filterFileRename = new Zend_Filter_File_Rename(array('target' => $fullFilePath, 'overwrite' => true));

 $filterFileRename -> filter($name);


$newsarticle->saveNews($title, $content,$id,$id2,$status,$fullFilePath);
$this->_helper->redirector('index');
 exit; 
 } 

 else {

 // this line will be called if data was not submited
 $form->populate($formData);
 }
 
}

    }
    

    public function updateAction()
    {
        // action body
    }

    public function deleteAction()
    {
        // action body
    }

    public function publishAction()
    {
        // action body
    }
public function getId(){
     $mystorage = Zend_Auth::getInstance()->getStorage()->read();
      if(isset($mystorage)){

    return $mystorage->id;
}

}

}