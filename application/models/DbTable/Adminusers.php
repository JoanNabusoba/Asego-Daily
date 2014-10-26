<?php

class Application_Model_DbTable_Adminusers extends Zend_Db_Table_Abstract
{

    protected $_name = 'users';
public function getUser($id)
{$id= (int)$id;
$row=$this->fetchRow('id = '.$id);
if(!$row) 
{throw new Exception("Could not find row $id");}
return $row ->toArray();
}
public function addUser($email,$role, $password)
{$data=array
('email'=>$email,
'role'=>$role,
'password'=>$password,);
$this->insert($data);
}
public function updateUser($id,$email,$role, $password)
{
$data=array('email'=>$email,
'role'=>$role,
'password'=>$password,);
$this->update($data,'id = '. (int)$id);
}
public function deleteUser($id)
{$this->delete('id ='. (int)$id);
}

}

