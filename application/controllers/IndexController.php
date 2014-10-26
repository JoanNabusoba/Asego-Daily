<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
		 $this->_loggedinas();
        $news = new Application_Model_DbTable_News();

$this->view->normal = $news ->fetchAll("status='published' and type='normal'");
$this->view->subscribed = $news ->fetchAll("status='published' and type='subscribed'");
$thisid = $this->_getParam('id');
if(isset($thisid)){
$this->view->latest = $news ->getNews($thisid);}
else{
$this->view->latest = $news ->getNews($news->lastID());
}    



    }

    protected function _loggedinas()
    {
        // Get our authentication adapter and check credentials
       $mystorage = Zend_Auth::getInstance()->getStorage()->read();
	  if(isset($mystorage)){
if($mystorage->role=='editor'){
                    $this->_redirect('editor/add');

}else if
($mystorage->role=='reporter'){
                    $this->_redirect('editor/add');

}else if
($mystorage->role=='administrator'){

                    $this->_redirect('admin/index');

}else if
($mystorage->role=='user'){
$this->_redirect('index/subscribed');

}else{
}}else{
}
	}

    

    public function subscribedAction()
    {
    $news = new Application_Model_DbTable_News();

$this->view->normal = $news ->fetchAll("status='published' and type='normal'");
$this->view->subscribed = $news ->fetchAll("status='published' and type='subscribed'");
$thisid = $this->_getParam('id');
if(isset($thisid)){
$this->view->latest = $news ->getNews($thisid);}
else{
$this->view->latest = $news ->getNews($news->lastID());
}    
   }


}



