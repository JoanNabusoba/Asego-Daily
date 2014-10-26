<?php

// application/models/User.php
class Application_Model_User
{
    protected $_id;
    protected $_email;
    protected $_password;
    protected $_role;
 
    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }
 
    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
 
        return $this;
    }
 
    public function setId($id)
    {
        $this->_id = (int) $id;
 
        return $this;
    }
 
    public function getId()
    {
        return $this->_id;
    }
 
    public function setEmail($email)
    {
        $this->_email = (string) $email;
 
        return $this;
    }
 
    public function getEmail()
    {
        return $this->_email;
    }
 
    public function setPassword($password)
    {
        $this->_password = (string) $password;
 
        return $this;
    }
 
    public function getPassword()
    {
        return $this->_password;
    }
 
    public function setRole($role)
    {
        $this->_role = (string) $role;
 
        return $this;
    }
 
    public function getRole()
    {
        return $this->_role;
    }
}

