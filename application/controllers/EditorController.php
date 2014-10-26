<?php

class EditorController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    $news = new Application_Model_DbTable_News();

        $this->view->all = $news ->fetchAll();

    }

    public function addAction()
    {
        $form = new Application_Form_Editor();
	    $this->view->form = $form;
        $news = new Application_Model_DbTable_News();

$this->view->normal = $news ->fetchAll("status='published' and type='normal'");
$this->view->subscribed = $news ->fetchAll("status='published' and type='subscribed'");

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


}









