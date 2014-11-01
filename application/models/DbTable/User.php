<?php

class Application_Model_DbTable_User extends Zend_Db_Table_Abstract
{

    protected $_name = 'users';
    protected $_primary = 'id';

public function saveUser($fname, $lname,$email,$password,$salt)
{
	$date = new Zend_Db_Expr('NOW()');
	
$data = array(
'fname' => $fname,
'lname' => $lname,
'password'=>sha1( $password.$salt),
'role'=> 'user',
'date_created'=>$date,
'salt'=> $salt,
'email' => $email
);
$this->insert($data);
}
public function adminsaveUser($fname, $lname,$email,$password,$salt,$role)
{
	$date = new Zend_Db_Expr('NOW()');
	
$data = array(
'fname' => $fname,
'lname' => $lname,
'password'=>sha1( $password.$salt),
'role'=> $role,
'date_created'=>$date,
'salt'=> $salt,
'email' => $email
);
$this->insert($data);
}
public function admineditUser($id,$fname, $lname,$email,$password,$salt,$role)
{
	$date = new Zend_Db_Expr('NOW()');
	
$data = array(
'fname' => $fname,
'lname' => $lname,
'password'=>sha1( $password.$salt),
'role'=> $role,
'date_created'=>$date,
'salt'=> $salt,
'email' => $email
);
$this->update($data, 'id = '. (int)$id);
}
}

