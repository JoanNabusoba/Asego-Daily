<?php // library/My/Acl.php
class My_Acl extends Zend_Acl
{
    public function __construct()
    {
        // Add a new role called "guest"
        $this->addRole(new Zend_Acl_Role('guest'));
        // Add a role called user, which inherits from guest
        $this->addRole(new Zend_Acl_Role('user'), 'guest');
        // Add a role called admin, which inherits from user
        $this->addRole(new Zend_Acl_Role('reporter'), 'user');
		 
		$this->addRole(new Zend_Acl_Role('editor'), 'user');
        $this->addRole(new Zend_Acl_Role('administrator'), 'editor');
 
        // Add some resources in the form controller::action
        $this->add(new Zend_Acl_Resource('error::error'));
        $this->add(new Zend_Acl_Resource('auth::login'));
        $this->add(new Zend_Acl_Resource('auth::register'));

        $this->add(new Zend_Acl_Resource('auth::logout'));
        $this->add(new Zend_Acl_Resource('index::index'));
		        $this->add(new Zend_Acl_Resource('index::subscribed'));

        $this->add(new Zend_Acl_Resource('editor::index'));
		$this->add(new Zend_Acl_Resource('editor::add'));
        $this->add(new Zend_Acl_Resource('admin::add'));
$this->add(new Zend_Acl_Resource('admin::index'));
$this->add(new Zend_Acl_Resource('admin::edit'));
$this->add(new Zend_Acl_Resource('admin::delete'));
$this->add(new Zend_Acl_Resource('auth::noauth'));

 
        // Allow guests to see the error, login and index pages
        $this->allow('guest', 'error::error');
        $this->allow('guest', 'auth::login');
        $this->allow('guest', 'auth::register');

        $this->allow('guest', 'index::index');
        $this->allow('guest', 'auth::noauth');
        // Allow users to access logout and the index action from the user controller
        $this->allow('user', 'auth::logout');
        $this->allow('user', 'index::index');
                $this->allow('user', 'index::subscribed');

        // Allow admin to access admin controller, index action
        $this->allow('editor', 'editor::index');
		        $this->allow('editor', 'editor::add');
$this->allow('administrator', 'admin::index');
$this->allow('administrator', 'admin::add');
$this->allow('administrator', 'admin::edit');
$this->allow('administrator', 'admin::delete'); 
        // You will add here roles, resources and authorization specific to your application, the above are some examples
    }
}