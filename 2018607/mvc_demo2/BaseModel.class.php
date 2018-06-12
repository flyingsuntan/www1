<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/7
 * Time: 14:15
 */
require 'MySQLDB.class.php';
class BaseModel{
    //这个，用于存储数据库工具的实例（对象）
    protected $db = null;
    function __construct()
    {
        $config = array(
            db_host => '127.0.0.1',
            db_port => '3306',
            db_user =>'root',
            db_pwd => '',
            bm => 'utf8',
            databas => 'ceshi'
        );
        $this->db = MySQLDB::GetInstance($config);
    }
}
