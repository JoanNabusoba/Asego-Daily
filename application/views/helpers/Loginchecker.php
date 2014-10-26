<?php 
class Zend_View_Helper_Loginchecker extends Zend_View_Helper_Abstract 
{public function loginchecker()
    {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
           // $username = $auth->getIdentity()->username;
            $loggedoutUrl = $this->view->url(array('controller'=>'index', 'action'=>'index'), null, true);
            return" <a href=".$loggedoutUrl.">Home</a> ";
        } 

       /* $request = Zend_Controller_Front::getInstance()->getRequest();
        $controller = $request->getControllerName();
        $action = $request->getActionName();
        if($controller == 'auth' && $action == 'index') {
            return '';
        }*/
        $loggedinUrl = $this->view->url(array('controller'=>'index', 'action'=>'subscribed'));
        return '<a href="'.$loggedinUrl.'">Home</a>';
    }
}