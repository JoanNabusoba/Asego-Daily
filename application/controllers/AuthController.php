<?php

class AuthController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        /*redirects to login page*/
     $this->_redirect('auth/login');
    }

    /*handles user login*/
    public function loginAction()
    {
        $users = new Application_Model_DbTable_User();
        $form = new Application_Form_Login();
		
        $this->view->form = $form;
        $request = $this->getRequest();
        if($request ->isPost()) {
            if($form->isValid($request->getPost())) {

                /*get form values*/
                $data = $form->getValues();

                /*check user authorization*/
                $auth = Zend_Auth::getInstance();
                $authAdapter = new Zend_Auth_Adapter_DbTable($users->getAdapter(),'users');
                $authAdapter->setIdentityColumn('email')->setCredentialColumn('password');
                $authAdapter->setIdentity($data['email'])->setCredential($data['password']);
                $authAdapter->setCredentialTreatment('SHA1(CONCAT(?,salt))');
                $result = $auth->authenticate($authAdapter);


                if($result->isValid()) {
                    $storage = new Zend_Auth_Storage_Session();

                    /*save user data in the session storage*/
                    $storage->write($authAdapter->getResultRowObject());
                    $mysession = new Zend_Session_Namespace('mysession');
                    if(isset($mysession->destination_url)) {
                        $url = $mysession->destination_url;
                        unset($mysession->destination_url);
                        $this->_redirect($url);
                        }
                        $this->_redirect('index/index');
                        } else {
                            $this->view->errorMessage = "<div class='ink-alert basic error' role='alert'><button class='ink-dismiss'>&times;</button>
                            <p><b>Login Error:</b> The password or email entered is incorrect!!</p></div>";
                }
            }
        }
    }


   /*handles user logout*/
    public function logoutAction()
    {
        /*deletes data from session storage*/
        $storage = new Zend_Auth_Storage_Session();
        $storage->clear();
        $this->_redirect('auth/login');
    }


    /*handles user registration*/
    public function registerAction()
    {
        $form = new Application_Form_Register();

        $this->view->form = $form;
        $request = $this->getRequest();
        if($request ->isPost()) {
            if($form->isValid($request->getPost())) {

                /*get form data*/
                $data = $form->getValues();
                $users = new Application_Model_DbTable_User();

                /*generate salt value*/
                $salt = substr(SHA1(mt_rand()),0, 40);
                $encrypted_password = $data['password'];
    
                 /*saving user data and loging in*/
                 $users->saveUser($data['fname'], $data['lname'],$data['email'], $encrypted_password,$salt);
                 $this->view->errorMessage = "<div class='ink-alert basic success' role='alert'>
                 <button class='ink-dismiss'>&times;</button>
                 <p><b>Registration Successful:</b>Login in!</p></div>";
                    $this->_redirect('auth/login');


            }
}

    }

     /*checking authorization*/
    public function noauthAction()
    {
$this->view->errorMessage = "<div class='ink-alert basic error' role='alert'>
    <button class='ink-dismiss'>&times;</button>
    <p><b>Authorization Error:</b> Sorry! You have no authorization to view this page!</p>
</div>";
    }



 
}





