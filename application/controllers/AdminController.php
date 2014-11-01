<!-- this is the section where the administrator can control the users of the system -->


<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    
    {
        /* Initializing the user db table and adding it to the view */
         $user = new Application_Model_DbTable_User();
         $this->view->user = $user ->fetchAll();
    }

    public function addAction()
    {
        /* Initializing & declaring the registration form */
        $form = new Application_Form_Register();
        $this->view->form = $form;

        /* Adding a new element to the form here i.e role */
        $role = $form->createElement('text','role');
        $role->setLabel('User Role: ')
              ->setRequired(true);
        $role->setAttrib('placeholder', 'e.g. administrator');
        $form->addMyClass($role);
        $form ->addElement($role);

        /* changing button lable*/
        $form->signin->setLabel('Add A User');

        /* form handling code goes here */

        $request = $this->getRequest();
        if($request ->isPost()) {
            if($form->isValid($request->getPost())) {
                /*get all form values */
                $data = $form->getValues();
                /*instatiate the database adapter */
                $users = new Application_Model_DbTable_User();

                /* generating a random 40 digit number, creating the salt*/
                $salt = substr(SHA1(mt_rand()),0, 40);

                /* get the pasword value*/
                $encrypted_password = $data['password'];

                /*saving user data into the database, creating an accout */
                $users->adminsaveUser($data['fname'], $data['lname'],$data['email'], $encrypted_password,$salt,$data['role']);
                
                /* display success message */
                $this->view->errorMessage = "<div class='ink-alert basic success' role='alert'><button class='ink-dismiss'>&times;</button>
    <p><b>Registration Successful:</b>Login in!</p></div>";
                
                /* redirect the user if the registration is successful*/
                $this->_redirect('admin/index');
            }
        }
    }

/*deletes a user */
    public function deleteAction()
    {
    
        
        if ($this->getRequest()->isPost()) {
                $del = $this->getRequest()->getPost('del');
                    /* gets user sellection*/
                    if ($del == 'Yes') {
                            $id = $this->getRequest()->getPost('id');
                            $user = new Application_Model_DbTable_Adminusers();
                            $user->deleteUser($id);
                        }
               
                $this->_helper->redirector('index');
               
                } else {
               
                $id = $this->_getParam('id', 0);
                $user = new Application_Model_DbTable_Adminusers();
                $this->view->user = $user->getUser($id);
            }
    
    }

/*updates the sellected user */
    public function editAction()
    {
        $form = new Application_Form_Register();


        /*displays the form */
        $this->view->form = $form;

        /*adding new form elements id and role */
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        $role = $form->createElement('text','role');
        $role->setLabel('User Role: ')
              ->setRequired(true);
        $role->setAttrib('placeholder', 'e.g. administrator');
        $form->addMyClass($role);
        $form ->addElement($role);
        $form ->addElement($id);


        /*change button lable*/
        $form->signin->setLabel('Add A User');

        $request = $this->getRequest();
        if($request ->isPost()) {
            if($form->isValid($request->getPost())) {
                

                /* get all form values*/     
                $data = $form->getValues();

                /*instatiate db table*/
                $users = new Application_Model_DbTable_User();

                /*generate the salt value*/
                $salt = substr(SHA1(mt_rand()),0, 40);

                $encrypted_password = $data['password'];
    
                /*iupdate the data*/
                $users->admineditUser($data['id'], $data['fname'], $data['lname'],$data['email'], $encrypted_password,$salt,$data['role']);
        
                $this->view->errorMessage = "<div class='ink-alert basic success' role='alert'>
                                    <button class='ink-dismiss'>&times;</button>
                                     <p><b>Registration Successful:</b>Login in!</p>
                                    </div>";
                $this->_redirect('admin/index');


            
                 }else {
                     /*populate the form*/
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







