<?php
class Model extends Db
{
    protected $_model;
    protected $_table;

    function __construct()
    {
        $this->connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        //获取模型名称
        $this->_model = get_class($this);
        $this->_model = rtrim($this->_model, 'Model');

        $this->_table = strtolower($this->_model);

    }

    function __destruct()
    {

    }

}