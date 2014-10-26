<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
 $user = new Application_Model_DbTable_Adminusers();
        $this->view->user = $user ->fetchAll();
            }

    public function addAction()
    {
        $form = new Application_Form_User();
$form->submit->setLabel('Add A User');
$this->view->form = $form;
if ($this->getRequest()->isPost()) {
$formData = $this->getRequest()->getPost();
if ($form->isValid($formData)) {
$email = $form->getValue('email');
$password = $form->getValue('password');
$role = $form->getValue('role');
$user = new Application_Model_DbTable_AdminUsers();
$user->addUser($email,$role, $password);
$this->_helper->redirector('admin');
} else {
$form->populate($formData);
}
}
    }

    public function deleteAction()
    {
      if ($this->getRequest()->isPost()) {
$del = $this->getRequest()->getPost('del');
if ($del == 'Yes') {
$id = $this->getRequest()->getPost('id');
$user = new Application_Model_DbTable_Adminusers();
$albums->deleteUser($id);
}
$this->_helper->redirector('admin');
} else {
$id = $this->_getParam('id', 0);
$user = new Application_Model_DbTable_Adminusers();
$this->view->user = $user->getUser($id);
}
    }

    public function editAction()
    {
        $form = new Application_Form_User();
$form->submit->setLabel('Save User');
$this->view->form = $form;
if ($this->getRequest()->isPost()) {
$formData = $this->getRequest()->getPost();
if ($form->isValid($formData)) {
$id = (int)$form->getValue('id');
$email = $form->getValue('email');
$password = $form->getValue('password');
$role = $form->getValue('role');
$user = new Application_Model_DbTable_AdminUsers();
$user->updateUser($id, $email,$role, $password);
$this->_helper->redirector('admin');
} else {
$form->populate($formData);
}
} else {
$id = $this->_getParam('id', 0);
if ($id > 0) {
$user = new Application_Model_DbTable_AdminUsers();
$form->populate($user->getUser($id));
}
}  
    }


}







