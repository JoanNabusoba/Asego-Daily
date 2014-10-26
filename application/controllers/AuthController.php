<?php

class AuthController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
                    $this->_redirect('auth/login');
    }

    public function loginAction()
    {
        $users = new Application_Model_DbTable_User();
        $form = new Application_Form_Login();
		
        $this->view->form = $form;
        $request = $this->getRequest();
        if($request ->isPost()) {
            if($form->isValid($request->getPost())) {
                $data = $form->getValues();
                $auth = Zend_Auth::getInstance();
                $authAdapter = new Zend_Auth_Adapter_DbTable($users->getAdapter(),'users');
                $authAdapter->setIdentityColumn('email')->setCredentialColumn('password');
                $authAdapter->setIdentity($data['email'])->setCredential($data['password']);
                $result = $auth->authenticate($authAdapter);
                if($result->isValid()) {
                    $storage = new Zend_Auth_Storage_Session();
                    $storage->write($authAdapter->getResultRowObject());
                    $mysession = new Zend_Session_Namespace('mysession');
                    if(isset($mysession->destination_url)) {
                        $url = $mysession->destination_url;
                        unset($mysession->destination_url);
                        $this->_redirect($url);
                    }
                    $this->_redirect('index/index');
                } else {
                    $this->view->errorMessage = "<div class='ink-alert basic error' role='alert'>
    <button class='ink-dismiss'>&times;</button>
    <p><b>Login Error:</b> The password or email entered is incorrect!!</p>
</div>";
                }
            }
        }
    }

    public function logoutAction()
    {
        $storage = new Zend_Auth_Storage_Session();
        $storage->clear();
        $this->_redirect('auth/login');
    }

    public function registerAction()
    {
        // action body
    }

    public function noauthAction()
    {
$this->view->errorMessage = "<div class='ink-alert basic error' role='alert'>
    <button class='ink-dismiss'>&times;</button>
    <p><b>Authorization Error:</b> Sorry! You have no authorization to view this page!</p>
</div>";
    }


}









