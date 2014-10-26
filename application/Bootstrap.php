<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
protected function _initPlugins()
    {
        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->registerNamespace('My_');
 
        $objFront = Zend_Controller_Front::getInstance();
        $objFront->registerPlugin(new My_Controller_Plugin_ACL(), 1);
        return $objFront;
    }
}

