<?php
class Zend_View_Helper_Signup extends Zend_View_Helper_Abstract 
{
    public function signUp()
    {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
           
        return '';  
        } 

        $request = Zend_Controller_Front::getInstance()->getRequest();
        $controller = $request->getControllerName();
        $action = $request->getActionName();
        if($controller == 'auth' && $action == 'register') {
 $signupurl = $this->view->url(array('controller'=>'auth', 'action'=>'login'), null, true);
            return" <a href=".$signupurl.">Login</a> ";
    }        
          $signupurl = $this->view->url(array('controller'=>'auth', 'action'=>'register'), null, true);
            return" <a href=".$signupurl.">Signup</a> ";
    }
    
}