<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/7
 * Time: 14:15
 */
require 'MySQLDB.class.php';
class BaseModel{
    //��������ڴ洢���ݿ⹤�ߵ�ʵ��������
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
