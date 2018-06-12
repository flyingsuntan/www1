<meta http-equiv="content-type" content="text/html;charset=gb2312"/>
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/7
 * Time: 10:47
 */
require 'BaseModel.class.php';
class UserModel extends BaseModel {

    function GetAllUser(){
       /* $config = array(
            db_host => '127.0.0.1',
            db_port => '3306',
            db_user =>'root',
            db_pwd => '',
            bm => 'utf8',
            databas => 'ceshi'
        );*/
        $sql = "select * from yonghubiao";
       // $db = MySQLDB::GetInstance($config);
        $date = $this->db->GetRows($sql);
        return $date;

    }
    function GetUserCount(){
       /* $config = array(
            db_host => '127.0.0.1',
            db_port => '3306',
            db_user =>'root',
            db_pwd => '',
            bm => 'gb2312',
            databas => 'ceshi'
        );*/
        $sql = "select count(*) from yonghubiao";
        //$db = MySQLDB::GetInstance($config);
        $date = $this->db->GetOneData($sql);
        return $date;
    }
}
$obj1 = new UserModel();
