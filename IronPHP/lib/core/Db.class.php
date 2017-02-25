<?php

class Db
{
    protected $_dbHandle;
    protected $_result;

    public function connect($host, $user, $password, $name)
    {
        try{
            $dsn = sprintf("mysql:host=s%;dbname=s%;charset=utf8", $host, $name);
            $this->_dbHandle = new PDO($dsn, $user, $password, array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));

        }catch(PDOException $e){
            exit('错误 '.$e->getMessage());
        }
    }

    public function selectAll()
    {
        $sql = sprintf("select * from `s%`", $this->_table);
        $sth = $this->_dbHandle->prepare($sql);
        $sth->excute();

        return $sth->fetchAll();
    }
}