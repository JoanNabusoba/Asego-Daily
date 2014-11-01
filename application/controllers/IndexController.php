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

    /*this function handles the redirection depending on the role*/
    protected function _loggedinas()
    {
        // Get our authentication adapter and check credentials
       $mystorage = Zend_Auth::getInstance()->getStorage()->read();
	       if(isset($mystorage)){
            if($mystorage->role=='editor'){

               /*if role is editor redirect to add action of editor controller*/
                    $this->_redirect('editor/add');
                  }else if($mystorage->role=='reporter'){

                    /*if role is reporter redirect to add action of editor controller*/
                    $this->_redirect('editor/add');
                  }else if($mystorage->role=='administrator'){

                    /*if role is administrator redirect to index action of admin controller*/
                    $this->_redirect('admin/index');
                  }else if($mystorage->role=='user'){
                    
                    /*if role is user redirect to subscribed action of user controller*/
                    $this->_redirect('index/subscribed');
                  }else{}
                }else{

                }
              }

    

    public function subscribedAction()
    {
      $mystorage = Zend_Auth::getInstance()->getStorage()->read();
      if(isset($mystorage)){

        /*displays the username*/
        $this->view->username = $mystorage->fname. " ".$mystorage->lname;   
      }
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



