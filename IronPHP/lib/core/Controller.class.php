<?php

/**
 * 控制器基类
 * Class Controller
 */
class Controller
{
    protected $_controller;
    protected $_action;
    protected $_view;

    function __construct($controller, $action)
    {
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_view = new View($controller, $action);
    }

    function assign($name, $value)
    {
        $this->_view->assign($name, $value);
    }

    function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->_view->render();
    }
}